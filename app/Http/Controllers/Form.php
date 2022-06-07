<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Validation\ValidationException;
use Jenssegers\Agent\Agent;

class Form extends Controller
{
    public function process(Request $request, $form)
    {
        $form = _c('forms.' . $form);

        if( ! $form ) abort(404);

        try
        {
            $form_data = $request->validate($form['rules']);
        }

        catch(ValidationException $e)
        {
            return back();
        }

        _l($form_data);
    }
}