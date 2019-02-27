<?php

namespace PlanckeyBlog\Container;

use Planck\Container;
use Planck\Tool\Encrypt;
use Planck\View\ComponentManager;

class Main extends \Planck\Extension\Bootstrap\Container\Main
{
    public function initialize()
    {
        $this->pathManager = \Phi\Core\VirtualPathManager::getInstance();

        parent::initialize();


        $this->set('database', function() {

            $path = $this->pathManager->getPathByName('data');

            $dsn = 'sqlite:' . $path.'/database/main.sqlite';
            $driver = new \Phi\Database\Driver\PDO\Source($dsn);
            $database = new \Phi\Database\Source($driver);
            return $database;
        });

        $this->set('model', function() {
            $database = $this->get('database');
            $model = new \Planck\Model\Model();
            $model->addSource($database);
            return $model;
        });



    }

}

