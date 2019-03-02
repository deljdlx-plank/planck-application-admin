<?php



if(is_file(__DIR__.'/static-vendor/planck/__planckbootstrap/application-bootstrap.php')) {
    define('PHI_LIB_PATH', __DIR__.'/static-vendor/phi');
    $planckApplicationBootstrap = require(__DIR__.'/static-vendor/planck/__planckbootstrap/application-bootstrap.php');
}
else if(is_file(__DIR__.'/../__shared/static-vendor/planck/__planckbootstrap/application-bootstrap.php')){
    define('PHI_LIB_PATH', __DIR__.'/../__shared/static-vendor/phi');
    $planckApplicationBootstrap = require(__DIR__.'/../__shared/static-vendor/planck/__planckbootstrap/application-bootstrap.php');
}
else {
    throw new Exception('Can not load Planck application bootstrap');
}



/**
 * @var PlanckApplicationBootstrap $planckApplicationBootstrap
 */
$planckApplicationBootstrap->getAutoloader()->addNamespace('PlanckeyBlog', __DIR__.'/source/class');



$planckApplicationBootstrap->registerVirtualPath(
    realpath(__DIR__.'/../__data/public'),
    __DIR__.'/www/data',
    'front-data'
);


$planckApplicationBootstrap->registerVirtualPath(
   __DIR__.'/../__data/backend',
   __DIR__.'/data',
   'data'
);



/*

*/



return $planckApplicationBootstrap;





