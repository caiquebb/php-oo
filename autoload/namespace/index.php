<?php

use Pigvelop\Export\JsonExport;
use Pigvelop\Export\XmlExport;

// function autoload($class)
// {
//     $baseFolder = __DIR__ . '/src/';
    
//     $class = str_replace('\\', '/', $class);
//     require $baseFolder . $class . '.php';
// }

// spl_autoload_register('autoload');

require __DIR__ . '/autoload-psr4.php';

if ($_GET['export'] == 'xml') {
    print (new XmlExport)->doExport();
}

if ($_GET['export'] == 'json') {
    print (new JsonExport)->doExport();
}
