<?php

return [

	/*
	|--------------------------------------------------------------------------
	| Client Identifier
	|--------------------------------------------------------------------------
	|
	| Your applications client identifier. Used when generating authentication
	| tokens and to receive your authorization code. This must always be set
	| to fetch data from Instagram.
	|
	*/

	'client_id' => '',

	/*
	|--------------------------------------------------------------------------
	| Client Secret
	|--------------------------------------------------------------------------
	|
	| Your applications client secret. Used when generating authentication
	| tokens and to receive your authorization code. Leave this NULL if you
	| only are going to fetch public data.
	|
	*/

	'client_secret' => null,

	/*
	|--------------------------------------------------------------------------
	| Callback URL
	|--------------------------------------------------------------------------
	|
	| Your applications callback url. Used to authorize users and generating
	| tokens. Leave this NULL if you only are going to fetch public data.
	|
	*/

	'callback_url' => null

];
