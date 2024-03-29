<?php
	return 
	[
		/*
		|--------------------------------------------------------------------------
		| API Keys
		|--------------------------------------------------------------------------
		|
		| Set the public and private API keys as provided by reCAPTCHA.
		|
		| In version 2 of reCAPTCHA, public_key is the Site key,
		| and private_key is the Secret key.
		|
		*/
		'public_key'	=> '6LdJPwcTAAAAAPyhvJJw0Ukq6-YHg4NizOH2QmKK',
		'private_key'	=> '6LdJPwcTAAAAAHNMg6ukwYjzjsDbtgYfAS610PUp',
		
		/*
		|--------------------------------------------------------------------------
		| Template
		|--------------------------------------------------------------------------
		|
		| Set a template to use if you don't want to use the standard one.
		|
		*/
		'template' => '',

		/*
		|--------------------------------------------------------------------------
		| Driver
		|--------------------------------------------------------------------------
		|
		| Determine how to call out to get response; values are 'curl' or 'native'.
		| Only applies to v2.
		|    
		*/    
		'driver' => 'curl',

		/*
		|--------------------------------------------------------------------------
		| Options
		|--------------------------------------------------------------------------
		|
		| Various options for the driver
		|    
		*/    
		'options' => 
		[
			'curl_timeout' 	=> 1,
			'lang'			=> 'nl',
		],

		/*
		|--------------------------------------------------------------------------
		| Version
		|--------------------------------------------------------------------------
		|
		| Set which version of ReCaptcha to use.
		|    
		*/    
		'version' => 2,
	];