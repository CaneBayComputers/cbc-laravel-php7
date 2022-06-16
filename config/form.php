<?php

return [

	'ip_attempt_timeframe_seconds' => 15,

	'ip_max_attempts_per_timeframe' => 3,

	'recaptcha' => [

		'site_key' => env('RECAPTCHA_SITE_KEY'),

		'secret_key' => env('RECAPTCHA_SECRET_KEY'),

        'url' => 'https://www.google.com/recaptcha/api/siteverify',

        'threshold' => 0.7,
    ],

	'names' => [

		'contact' => [

			'return_to' => '/examples/form',

			'subject' => env('APP_NAME', 'Laravel') . ' Contact Form',

			'rules' => [
				'email' => 'required_without:phone|email|max:100',
				'phone' => 'required_without:email|max:100',
				'recaptcha' => 'required|string',
				'message' => 'required|string|max:7000',
				'name' => 'required_without_all:first_name,last_name|string|min:3|max:100',
				'first_name' => 'required_without:name|string|max:40',
				'last_name' => 'required_without:name|string|max:40',
				'timezone' => 'string',
			],
		],
	],
];