<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| Source path
	|--------------------------------------------------------------------------
	|
	| This is the location of your less, js files etc.
	| Typically stored in app/assets e.g.
	|
	| 	/app/assets/less/myfile.less
	|
	*/

	'src_path' => app_path() . '/assets',

	/*
	|--------------------------------------------------------------------------
	| Local output path
	|--------------------------------------------------------------------------
	|
	| This is where you would like the files to be published
	| locally (rather than on a CDN)
	|
	*/

	'local_path' => public_path() . '/packages/assetically',

	/*
	|--------------------------------------------------------------------------
	| CDN output path
	|--------------------------------------------------------------------------
	|
	| This is where you would like the files to be published
	| when generating files for a CDN
	|
	*/

	'cdn_path' => app_path() . '/storage/cdn',

);