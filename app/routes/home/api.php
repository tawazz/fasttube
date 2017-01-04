<?php

$app->get('/api/search/:name' , function($name) use($app){
   $tracks = $app->sc->request($name);
   for($i=0;$i<sizeof($tracks);$i++){
       if(!$tracks[$i]->streamable){
           unset($tracks[$i]);
       }
   }
   $obj = (object) array('tracks' => array_values((array) $tracks));
   $T =[];

   foreach ($obj->tracks as $track) {
       $track->artwork_url = str_replace("large","t500x500",$track->artwork_url);
       $T[]=$track;
   }
   $response = $app->response();
   $response['Content-Type'] = 'application/json';
   $response['X-Powered-By'] = 'Tazzy';
   $response->status(200);
   $response->body(json_encode($T));
})->name('search');

 $app->get('/api/explore' , function() use($app){
   $recs = $app->sc->explore();
   $T =[];

   foreach ($recs->collection as $track) {
       $track->track->artwork_url = str_replace("large","t500x500",$track->track->artwork_url);
       $T[]=$track->track;
   }
   $obj = (object) array('tracks' => array_values((array) $T));
   $response = $app->response();
   $response['Content-Type'] = 'application/json';
   $response['X-Powered-By'] = 'Tazzy';
   $response->status(200);
   $response->body(json_encode($T));
 });

  $app->get('/api/search/users/:name' , function($name) use($app){
   $user = $app->sc->resolve("https://soundcloud.com/".$name);
   $favs = $app->sc->userTracks($user->id);

   $response = $app->response();
   $response['Content-Type'] = 'application/json';
   $response['X-Powered-By'] = 'Tazzy';
   $response->status(200);
   $response->body(json_encode($favs));
   })->name('search-users');


 ?>
