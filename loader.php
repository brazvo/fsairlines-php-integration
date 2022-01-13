<?php
$dirs = [
    __DIR__ . '/src/Operations',
    __DIR__ . '/src/Model',
    __DIR__ . '/src/Decorator',
    __DIR__ . '/src'
];

spl_autoload_register(function ($className) use($dirs) {
    // get off namespace
    $exploded = explode('\\', $className);
    $filename = end($exploded) . '.php';
    foreach ($dirs as $dir) {
        if (file_exists($dir . DIRECTORY_SEPARATOR . $filename)) {
            include_once $dir . DIRECTORY_SEPARATOR . $filename;
        }
    }
});
