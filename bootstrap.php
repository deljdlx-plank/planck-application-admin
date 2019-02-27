<?php

if(is_file(__DIR__.'/__planckbootstrap/application-bootstrap.php')) {
    $planckApplicationBootstrap = require(__DIR__.'/__planckbootstrap/application-bootstrap.php');
}
else if(is_file(__DIR__.'/../__shared/__planckbootstrap/application-bootstrap.php')){
    $planckApplicationBootstrap = require(__DIR__.'/../__shared/__planckbootstrap/application-bootstrap.php');
}
else {
    throw new Exception('Can not load application bootstrap');
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





