<?php
return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header

        // Renderer settings
        'renderer' => [
            'template_path' => __DIR__ . '/../templates/',
        ],

        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' => __DIR__ . '/../logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],

        //configuracion del Token y la base de datos
        'app_token_name'    => 'x#Je3r',
        'connectionString'  =>[
            'dns'   => 'mysql:host=localhost;dbname=vos_andes;charset=utf8',
            'user'  =>  'root',
            'pass'  =>  '1234',
            'name_db' => 'vos_andes',
            'host' => 'localhost'
        ]

    ],
];
