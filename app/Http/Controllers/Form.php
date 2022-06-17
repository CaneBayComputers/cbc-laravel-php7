<?php

namespace App\Http\Controllers;

use App\Mail\ContactForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Jenssegers\Agent\Agent;

class Form extends Controller
{
    public function process(Request $request, Agent $agent, $form_name)
    {
        $form = _c('form.names.' . $form_name);

        if( ! $form ) abort(404);

        $redirect = redirect($form['return_to']);

        $form_data = $request->all();

        $validator = Validator::make($form_data, $form['rules']);

        if( $validator->fails() )
        {
            return $redirect->withErrors($validator)->withInput();
        }

        $remoteip = $_SERVER['REMOTE_ADDR'];

        $form_data['timestamp'] = now()->toDayDateTimeString() . ' GMT';

        $form_data['device'] = $agent->device();

        $form_data['device_type'] = ucwords($agent->deviceType());

        $form_data['platform'] = $agent->platform();

        $form_data['browser'] = $agent->browser();

        $form_data['languages'] = implode(', ', $agent->languages());

        $form_data['ip'] = $remoteip;


        // Reject too many attempts with same IP
        $cache_key = 'form-' . $form_name . '-attempt-' . $remoteip;

        if( ! $req_count = Cache::get($cache_key) )
        {
            $req_count = 1;

            Cache::add($cache_key, $req_count, _c('form.ip_attempt_timeframe_seconds'));
        }

        if( ! is_dev() && $req_count > _c('form.ip_max_attempts_per_timeframe') )
        {
            return $redirect->withErrors(['Too many attempts'])->withInput();
        }

        Cache::increment($cache_key);


        // Eval user agent
        if( $form_data['device_type'] == 'Robot' )
        {
            return $redirect->withErrors(['Device type is robot'])->withInput();
        }


        // Check message for links
        if( ! empty($form_data['message']) )
        {
            if( preg_match('/http(s)*:/i', $form_data['message']) )
            {
                return $redirect->withErrors(['Please remove links'])->withInput();
            }
        }


        // Recaptcha
        $recaptcha_data = [
            'secret' => _c('form.recaptcha.secret_key'),
            'response' => $form_data['recaptcha'],
            'remoteip' => $remoteip,
        ];

        $recaptcha_options = [
            'http' => [
                'header' => "Content-type: application/x-www-form-urlencoded",
                'method' => 'POST',
                'content' => http_build_query($recaptcha_data),
            ]
        ];
        
        $context = stream_context_create($recaptcha_options);

        $recaptcha_result = file_get_contents(_c('form.recaptcha.url'), false, $context);

        $recaptcha_result = json_decode($recaptcha_result, true);

        $request_data['recaptcha_result'] = $recaptcha_result;

        if( ! isset($recaptcha_result['score']) )
        {
            abort(500, 'Recaptcha score not set');
        }

        if ( $recaptcha_result['score'] < _c('form.recaptcha.threshold') )
        {
            return $redirect->withErrors(['Request appears automated'])->withInput();
        }

        unset($form_data['g-recaptcha-response']);

        unset($form_data['recaptcha']);

        unset($form_data['_token']);

        Mail::to(env('FORM_MAIL_TO'))->send(new ContactForm($form_data));

        return $redirect->with('success', true);
    }
}