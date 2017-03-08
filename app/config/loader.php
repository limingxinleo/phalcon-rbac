<?php

$loader = new \Phalcon\Loader();

/**
 * We're a registering a set of directories taken from the configuration file
 */
$loader
    ->registerNamespaces(
        [
            'MyApp\Controllers' => $config->application->controllersDir,
            'MyApp\Controllers\Api' => $config->application->controllersDir . 'api/',
            'MyApp\Models' => $config->application->modelsDir,
            'MyApp\Tasks' => $config->application->tasksDir,
            'MyApp\Tasks\System' => $config->application->tasksDir . 'system/',
            'MyApp\Traits' => $config->application->traitsDir,
            'MyApp\Traits\System' => $config->application->traitsDir . 'system/',
            'MyApp\Listeners' => $config->application->listenersDir,
            'MyApp\Listeners\System' => $config->application->listenersDir . 'system/',
        ]
    )->registerFiles(
        [
            'function' => $config->application->libraryDir . 'helper.php',
        ]
    )->register();
