<?php
use WPSP\Funcs;

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application for file storage.
    |
    */

    'default' => env('WPSP_FILESYSTEM_DRIVER', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Below you may configure as many filesystem disks as necessary, and you
    | may even configure multiple disks for the same driver. Examples for
    | most supported storage drivers are configured here for reference.
    |
    | Supported drivers: "local", "ftp", "sftp", "s3"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => Funcs::instance()->_getStoragePath('app/private'),
            'serve' => true,
            'throw' => false,
            'report' => false,
        ],

        'public' => [
            'driver'     => 'local',
            'root'       => Funcs::instance()->_getStoragePath('app/public'),
            'url'        => rtrim(env('WPSP_APP_URL', 'http://localhost'), '/') . '/storage',
            'visibility' => 'public',
            'throw'      => false,
            'report'	 => false,
        ],

        's3' => [
            'driver'                  => 's3',
            'key'                     => env('WPSP_AWS_ACCESS_KEY_ID'),
            'secret'                  => env('WPSP_AWS_SECRET_ACCESS_KEY'),
            'region'                  => env('WPSP_AWS_DEFAULT_REGION'),
            'bucket'                  => env('WPSP_AWS_BUCKET'),
            'url'                     => env('WPSP_AWS_URL'),
            'endpoint'                => env('WPSP_AWS_ENDPOINT'),
            'use_path_style_endpoint' => env('WPSP_AWS_USE_PATH_STYLE_ENDPOINT', false),
            'throw'                   => false,
            'report' 				  => false,
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Symbolic Links
    |--------------------------------------------------------------------------
    |
    | Here you may configure the symbolic links that will be created when the
    | `storage:link` Artisan command is executed. The array keys should be
    | the locations of the links and the values should be their targets.
    |
    */

    'links' => [
        Funcs::instance()->_getPublicPath('storage') => Funcs::instance()->_getStoragePath('app/public'),
    ],

];