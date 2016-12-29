<?php
  session_start();
  require_once 'vendor/autoload.php';
  require_once 'app/config/db.config.php';
  require_once 'Tazzy-Helpers/autoload.php';
  use Slim\Slim;
  use HTTP\MiddleWare\{Before,Dump,Csrf};
  $app = new Slim([
    'view'=> new \Slim\Views\Twig(),
    'debug'=> Settings::get('debug'),
  ]);

  //views
  $view = $app->view();
  $view->setTemplatesDirectory('app/views');
  $view->parserExtensions = [
    new \Slim\Views\TwigExtension(),
    new \Twig_Extension_Debug()
  ];
  $view->appendData([
    "baseUrl"  => $app->baseUrl,
    "ver"      => Settings::get('ver'),
    "brand"    => Settings::get('locale.brand'),
    "address"  => Settings::get('locale.address'),
    "phone"    => Settings::get('locale.phone'),
    "email"    => Settings::get('locale.email'),
  ]);
  //Middleware
  $app->add(new Dump());
  $app->add(new Before());
  $app->add(new Csrf());
  require 'app/HTTP/MiddleWare/auth_filters.php';

  //dependancies
  $app->container->singleton('session',function(){
    return  new Session();
  });
  $app->container->singleton('hash',function(){
    return  new Hash();
  });

  $app->container->singleton('Config',function(){
    return  new Settings();
  });
  //Models

  require 'app/HTTP/Models/Models.php';

  //routes
  require'app/routes/routes.php';

  $app->run();
 ?>
