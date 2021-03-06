<?php
/**
 * Created by PhpStorm.
 * User: sidler
 * Date: 27.10.14
 * Time: 10:51
 */



//register PSR-4 based class-loader
spl_autoload_register(function ($class) {

    // project-specific namespace prefix
    $prefix = 'de\\mulchprod\\kajona\\modulegenerator';

    // base directory for the namespace prefix
    $base_dir = __DIR__ . '/src/';

    // does the class use the namespace prefix?
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        // no, move to the next registered autoloader
        return;
    }

    // get the relative class name
    $relative_class = substr($class, $len);

    // replace the namespace prefix with the base directory, replace namespace
    // separators with directory separators in the relative class name, append
    // with .php
    $file = $base_dir . str_replace('\\', '/', $class) . '.php';

    // if the file exists, require it
    if (file_exists($file)) {
        require $file;
    }
});

define("BASE_PATH", __DIR__);

//create the output folder by default
if(!is_dir(BASE_PATH."/output"))
    mkdir(BASE_PATH."/output");

session_start();