<?php
namespace HTTP\Middleware;
use Slim\Middleware;

/**
 *
 */
class Before extends Middleware{

  public function call (){
    $this->app->hook('slim.before',[$this,'run']);
    $this->next->call();
  }

  public function run(){
    $this->app->baseUrl = $this->app->request->getScriptName();
    $this->app->referrer = (isset($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : null;
    $this->IncludeTwigHelpers();
    #$this->UserSessionHelper();
    #$this->CachingHelper();
  }

  public function IncludeTwigHelpers(){
    $app = $this->app;
    $twig = $this->app->view->getEnvironment();

    $function = new \Twig_SimpleFunction('assets', function ($path,$host = false) use($app) {
      if(substr($path,-1)==='/')
      {
        $path = substr($path,0,-1);
      }
      if(substr($path,0,1)==='/')
      {
        $path = substr($path,1);
      }
      return ($host) ? "http://".$_SERVER['HTTP_HOST'].$app->baseUrl."/public/".$path : $app->baseUrl."/public/".$path ;
    });

    $twig->addFunction( new \Twig_SimpleFunction('dump', function ($var){
        dump($var);
    }));
    $twig->addFunction($function);
  }

  public function UserSessionHelper()
  {
    if($this->app->session->exists('id')){
      $user = $this->app->User;
      if($user->read($this->app->session->get('id'))){
        $this->app->auth = $user->get();
      }
      $this->app->view()->appendData([
          "auth"=>$this->app->auth
      ]);
    }
  }

  public function CachingHelper()
  {
    $this->app->lastModified(strtotime($this->app->siteInfo->last_modified));
    $this->app->expires('+1 year');
  }

}

 ?>
