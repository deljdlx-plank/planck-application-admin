<?php


$filepathRoot = realpath(__DIR__.'/../../..');

$applicationFilepathRoot = realpath(__DIR__.'/..');


define('APPLICATION_FILEPATH_ROOT', $applicationFilepathRoot);



//=======================================================

$autoloader = require(__DIR__.'/../../../shared/static-vendor/phi-core/get-autoloader.php');

$virtualPathManager = \Phi\Core\VirtualPathManager::getInstance();



$virtualPathManager->registerPath(
    $filepathRoot.'/shared/static-vendor', __DIR__.'/static-vendor'
);

$virtualPathManager->registerPath(
    $filepathRoot.'/shared/extension', __DIR__.'/extension'
);


$virtualPathManager->registerPath(
    $filepathRoot.'/shared/theme', realpath(__DIR__.'/../public').'/theme'
);


$virtualPathManager->registerPath(
    $filepathRoot.'/shared/public/planck-front-vendor', realpath(__DIR__.'/../public').'/vendor'
);


$virtualPathManager->deploy(
    realpath(__DIR__.'/..'),
    realpath(__DIR__.'/../../test')
);


