<?php


namespace PlanckeyBlog;

use Planck\Extension\Bootstrap\Router\Extension as ExtensionRouter;
use Planck\Theme\PlanckBoard\PlanckBoard;


class Application extends \Planck\Extension\Bootstrap\WebContentApplication
{





    public function __construct($path = null, $instanceName = null, $autobuild = true)
    {
        parent::__construct($path, $instanceName, $autobuild);

        $pathContainer = new \PlanckeyBlog\Container\Path();
        $this->addContainer($pathContainer);


        $mainContainer = new \PlanckeyBlog\Container\Main();
        $this->addContainer($mainContainer);
        $this->setModel($mainContainer->get('model'));


        $this->addExtension(\Planck\Extension\User::class, '?/user');

    }


    public function initialize()
    {
        parent::initialize();


        $this->registerRoutes();

        $this->setRouteRights();
        $this->customizeRedirections();

    }



    public function getTheme()
    {
        if(!$this->theme) {
            $this->theme = new PlanckBoard();
        }
        return $this->theme;
    }


    public function render()
    {

        //=======================================================

        $state = $this->getStatus();
        if($state->forbidden()) {

            $layout = $this->getTheme()->getLayout('Login');
            $layout->setVariable(
                'loginURL',
                $this->getExtension($this->getExtension(\Planck\Extension\User::class)->getName())->buildURL(
                    'Account', 'Api', 'login'
                )
            );

            $layout->addResources($this->getExtensionsAssets());
            $layout->addResourcesFromResponses($this->getResponses());


            $this->setRenderer(
                $layout
            );

            $this->addHeader(
                new \Phi\HTTP\Header\Forbidden()
            );
        }
        //=======================================================
        else if($state->notFound()) {
            $this->addHeader(
                new \Phi\HTTP\Header\NotFound()
            );

            $layout = $this->getTheme()->getLayout('Status404');
            $layout->addResources($this->getExtensionsAssets());
            $layout->addResourcesFromResponses($this->getResponses());


            $this->setRenderer($layout);

        }
        else if($state->ok()) {

            /*
            $application->addHeader(
                new \Phi\HTTP\Header\Ok()
            );
            */


            if($this->isHTMLResponse()) {

                $layout = $this->getTheme()->getLayout('Main');
                $layout->addResources($this->getExtensionsAssets());
                $layout->addResourcesFromResponses($this->getResponses());
                $this->setRenderer(
                    $layout
                );
            }
        }
        return parent::render();

    }


    //=======================================================


    protected function registerRoutes()
    {


        $applicationRouter = new \Planck\Routing\Router();

        $homeRoute = $applicationRouter->get('home', '`\??$`', function() {
            echo '@todo home';
            //$layout = new \Planck\Theme\PlanckBoard\View\Layout\LandingPage();
            //echo $layout->render();
        })->html();

        $homeRoute->doBefore(function(\Planck\Routing\Route $route) {
            return $this->checkUser($route);
        });
        $this->addRouter($applicationRouter);
        return $this;
    }


    protected function customizeRedirections()
    {

        $userExtension = $this->getExtension(\Planck\Extension\User::class);

        $accountRouter = $userExtension
            ->getModule('Account')
            ->getRouter('Api')
        ;

        $accountRouter
            ->getRouteByName('login')
            ->doAfter(function() {
                $this->redirect('?');
            })
        ;

        $accountRouter
            ->getRouteByName('logout')
            ->doAfter(function() {
                $this->redirect('?');
            })
        ;
        return $this;
    }

    //=======================================================


    protected function setRouteRights()
    {

        $extensions = $this->getExtensions();
        foreach ($extensions as $extensionName => $extension) {

            if($extension->getName() == \Planck\Extension\User::class) {
                continue;
            }
            $routes = $extension->getRoutes();
            foreach ($routes as $route) {
                $route->doBefore(function(\Planck\Routing\Route $route) {
                    return $this->checkUser($route);
                });
            }
        }

        return $this;

    }

    protected function checkUser(\Planck\Routing\Route $route)
    {
        if($userAspect = $this->getAspect('user')) {


            $user = $userAspect->getCurrentUser();
            if($user) {
                return true;
            }
        }
        $this->getStatus()->forbidden(true);
        return false;
    }




}