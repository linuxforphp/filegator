<?php

return [
    'repository_full_path' => APP_ROOT_DIR . DIR_SEP . 'repository',
    'auth_file' => APP_ROOT_DIR . DIR_SEP . 'private' . DIR_SEP . 'users.json',
    'routes_file' => APP_ROOT_DIR . DIR_SEP . 'backend' . DIR_SEP . 'routes.config.php',
    'public_path' => APP_PUBLIC_PATH,
    'public_dir' => APP_PUBLIC_DIR,
    'tmpfs_path' => APP_ROOT_DIR . DIR_SEP . 'private' . DIR_SEP . 'tmp' . DIR_SEP,
    'log_file' => APP_ROOT_DIR . DIR_SEP . 'private' . DIR_SEP . 'logs' . DIR_SEP . 'app.log',
    'overwrite_on_upload' => false,
    'timezone' => 'UTC', // https://www.php.net/manual/en/timezones.php
    'download_inline' => ['pdf'], // download inline in the browser, array of extensions, use * for all

    'frontend_config' => [
        'app_name' => 'FileGator',
        'app_version' => APP_VERSION,
        'language' => 'english',
        'logo' => 'https://filegator.io/img/logo.png',
        'upload_max_size' => 100 * 1024 * 1024, // 100MB
        'upload_chunk_size' => 1 * 1024 * 1024, // 1MB
        'upload_simultaneous' => 3,
        'default_archive_name' => 'archive.zip',
        'editable' => ['.txt', '.css', '.js', '.ts', '.html', '.php', '.json', '.md'],
        'date_format' => 'YY/MM/DD hh:mm:ss', // see: https://momentjs.com/docs/#/displaying/format/
        'guest_redirection' => '', // useful for external auth adapters
        'search_simultaneous' => 5,
        'filter_entries' => [],
    ],
];
