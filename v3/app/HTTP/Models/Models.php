<?php

  $app->container->set('User',function(){
    return new HTTP\Models\User();
  });
  $app->container->set('sc',function(){
    return new HTTP\Models\SoundCloud();
  });
 ?>
