<?php
    $app->get('/' , function() use($app){
        $app->render('home/index.php');
    })->name('home');

    $app->get('/tracks/:name' , function($name) use($app){
        $tracks = $app->sc->request($name);
        $app->render('home/tracks.php',['tracks'=>$tracks]);
    })->name('track');
    $app->post('/tracks' , function() use($app){
        $tracks = $app->sc->request($app->request->post('query'));
        $app->render('home/tracks.php',['tracks'=>$tracks]);
    });

	$app->get('/download' , function() use($app){
      $track = $app->sc->resolve($app->request->get('url'));
      $title = $app->request->get('title');
      $mpegStream = $app->sc->download($track->stream_url);

      $response = $app->response();
      $response['Content-Type'] = 'audio/mpeg';
      $response['Content-Disposition'] = 'attachment;filename="'.$title.'.mp3"';
      $response['Cache-Control'] = 'no-cache';
      $response['Content-Description'] = 'File Transfer';
      $response['Content-Transfer-Encoding'] = 'binary';
      $response->status(200);

      echo $mpegStream;


    })->name('download');

    $app->get('/about',function() use ($app){
      $app->render('home/about.php');
    })->name('about');

    $app->get('/contact',function() use ($app){
      $app->render('home/contact.php');
    })->name('contact');

    $app->get('/help',function() use ($app){
      $app->render('home/help.php');
    })->name('help');

    require 'api.php';
 ?>
