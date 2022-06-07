<?php

return [

	'contact' => [

		'subject' => env('APP_NAME', 'Laravel') . ' Contact Form',

		'rules' => [
			'email' => 'required|email|max:100',
			'recaptcha' => 'required|string',
			'message' => 'required|string|max:7000',
			'returnto' => 'required|string',
			'name' => 'required_without_all:first_name,last_name|string|min:3|max:100',
			'first_name' => 'required_without:name|string|max:40',
			'last_name' => 'required_without:name|string|max:40',
		],
	],
];