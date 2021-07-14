<?php

return [
    'repository_full_path' => TEST_REPOSITORY,
    'auth_file' => APP_ROOT_DIR . DIR_SEP . 'private' . DIR_SEP . 'users.json',
    'routes_file' => APP_ROOT_DIR . DIR_SEP . 'backend' . DIR_SEP . 'routes.config.php',
    'public_path' => APP_PUBLIC_PATH,
    'public_dir' => APP_PUBLIC_DIR,
    'tmpfs_path' => TEST_TMP_PATH,
    'log_file' => APP_ROOT_DIR . DIR_SEP . 'private' . DIR_SEP . 'logs' . DIR_SEP . 'app.log',
    'overwrite_on_upload' => false,
    'timezone' => 'UTC', // https://www.php.net/manual/en/timezones.php
    'download_inline' => ['pdf'], // download inline in the browser, array of extensions, use * for all

    'frontend_config' => [
        'app_name' => 'FileGator',
        'app_version' => APP_VERSION,
        'language' => 'english',
        'logo' => 'https://filegator.io/img/logo.png',
        'upload_max_size' => 2 * 1024 * 1024, // 1MB
        'upload_chunk_size' => 1 * 1024 * 1024, // 1MB
        'upload_simultaneous' => 3,
        'default_archive_name' => 'archive.zip',
        'editable' => ['.txt', '.css', '.js', '.ts', '.html', '.php', '.json', '.md'],
        'date_format' => 'YY/MM/DD hh:mm:ss', // see: https://momentjs.com/docs/#/displaying/format/
        'guest_redirection' => '', // useful for external auth adapters
        'search_simultaneous' => 5,
        'filter_entries' => [],
    ],

    'services' => [
        'Filegator\Services\Logger\LoggerInterface' => [
            'handler' => '\Filegator\Services\Logger\Adapters\MonoLogger',
            'config' => [
                'monolog_handlers' => [
                    function () {
                        return new \Monolog\Handler\NullHandler();
                    },
                ],
            ],
        ],
        'Filegator\Services\Session\SessionStorageInterface' => [
            'handler' => '\Filegator\Services\Session\Adapters\SessionStorage',
            'config' => [
                'handler' => function () {
                    return new \Symfony\Component\HttpFoundation\Session\Storage\MockFileSessionStorage();
                },
            ],
        ],
        'Filegator\Services\Tmpfs\TmpfsInterface' => [
            'handler' => '\Filegator\Services\Tmpfs\Adapters\Tmpfs',
            'config' => [
                'path' => TEST_TMP_PATH,
                'gc_probability_perc' => 10,
                'gc_older_than' => 60 * 60 * 24 * 2, // 2 days
            ],
        ],
        'Filegator\Services\View\ViewInterface' => [
            'handler' => '\Filegator\Services\View\Adapters\Vuejs',
            'config' => [
                'add_to_head' => '',
                'add_to_body' => '',
            ],
        ],
        'Filegator\Services\Storage\Filesystem' => [
            'handler' => '\Filegator\Services\Storage\Filesystem',
            'config' => [
                'separator' => '/',
                'adapter' => function () {
                    return new \League\Flysystem\Adapter\Local(
                        TEST_REPOSITORY
                    );
                },
            ],
        ],
        'Filegator\Services\Auth\AuthInterface' => [
            'handler' => '\Tests\MockUsers',
        ],
        'Filegator\Services\Archiver\ArchiverInterface' => [
            'handler' => '\Filegator\Services\Archiver\Adapters\ZipArchiver',
            'config' => [],
        ],
        'Filegator\Services\Router\Router' => [
            'handler' => '\Filegator\Services\Router\Router',
            'config' => [
                'query_param' => 'r',
                'routes_file' => APP_ROOT_DIR . DIR_SEP . 'backend' . DIR_SEP . 'routes.config.php',
            ],
        ],
    ],
];
