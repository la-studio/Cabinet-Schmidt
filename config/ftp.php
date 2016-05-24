<?php
return array(

    /*
	|--------------------------------------------------------------------------
	| Default FTP Connection Name
	|--------------------------------------------------------------------------
	|
	| Here you may specify which of the FTP connections below you wish
	| to use as your default connection for all ftp work.
	|
	*/

    'default' => 'connection1',

    /*
    |--------------------------------------------------------------------------
    | FTP Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the FTP connections setup for your application.
    |
    */

    'connections' => array(

        'connection1' => array(
            'host'   => env('FTP_HOST', ''),
            'port'  => env('FTP_PORT', 21),
            'username' => env('FTP_USERNAME', ''),
            'password'   => env('FTP_PASSWORD', ''),
            'passive'   => env('FTP_PASSIVE', false),
        ),
    ),
);