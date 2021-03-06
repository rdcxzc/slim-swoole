<?php

/*
 * This file is part of PHP CS Fixer.
 * (c) kcloze <pei.greet@qq.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

if (PHP_SAPI == 'cli-server') {
    // To help the built-in PHP dev server, check if the request was actually for
    // something which should probably be served as a static file
    $url  = parse_url($_SERVER['REQUEST_URI']);
    $file = __DIR__ . $url['path'];
    if (is_file($file)) {
        return false;
    }
}

require __DIR__ . '/../vendor/autoload.php';

session_start();

// Instantiate the app
$settings = require __DIR__ . '/../app/config/settings.php';
$app      = new \Slim\App($settings);

// Set up dependencies
require __DIR__ . '/../app/config/dependencies.php';

// Register middleware
require __DIR__ . '/../app/config/middleware.php';

// Register routes
require __DIR__ . '/../app/config/routes.php';

// Run app
$app->run();
