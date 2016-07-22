<?php
    session_start();
    require 'vendor/autoload.php';
    require 'app/models/soundcloud.php';
    use Slim\Slim;

    $app = new Slim([
      'view'=> new \Slim\Views\Twig(),
      'debug'=> TRUE
    ]);

    //dependencys

    $app->container->singleton('sc',function () use($app){
      return new SCservice();
    });
    //views
    $view = $app->view();
    $view->setTemplatesDirectory('app/views');
    $view->parserOptions    = ['debug' => true];
    $view->parserExtensions = [new \Slim\Views\TwigExtension(),new \Twig_Extension_Debug()];

    //routes
    require'app/routes/routes.php';

    $app->run();
 ?>
