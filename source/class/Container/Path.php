<?php

namespace PlanckeyBlog\Container;


class Path extends \Planck\Extension\Bootstrap\Container\Path
{
    public function initialize()
    {

        parent::initialize();



        $this->set('filepath-root', function () {

            return realpath(__DIR__.'/../../..');
        });






    }

}