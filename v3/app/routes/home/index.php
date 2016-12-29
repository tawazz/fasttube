<?php
    $app->get('/' , function() use($app){
        $recs = $app->sc->explore();
        $T =[];

        foreach ($recs->collection as $track) {
            $track->track->artwork_url = str_replace("large","crop",$track->track->artwork_url);
            $T[]=$track->track;
        }
        //var_dump($T);
        $app->render('home/index.php',['tracks'=>$T]);

    })->name('home');

    $app->get('/tracks/:name' , function($name) use($app){
        $tracks = $app->sc->request($name);
        $app->render('home/tracks.php',['tracks'=>$tracks]);
    })->name('track');
    $app->post('/tracks' , function() use($app){
        $tracks = $app->sc->request($app->request->post('query'));
        $app->render('home/tracks.php',['tracks'=>$tracks]);
    });

	/**
	* function deprecated
	* change of soundcloud api/explore

    $app->get('/download' , function() use($app){
      $track = $app->sc->download($app->request->get('url'));
      $title = $app->request->get('title');

      $response = $app->response();
      $response['Content-Type'] = 'audio/mpeg';
      $response['Content-Disposition'] = 'attachment;filename="'.$title.'.mp3"';
      $response['Cache-Control'] = 'no-cache';
      $response['Content-Description'] = 'File Transfer';
      $response['Content-Transfer-Encoding'] = 'binary';
      $response->status(200);

      echo $track ;

    })->name('download');

	*/

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

 $app->get('/api/search/:name' , function($name) use($app){
    $tracks = $app->sc->request($name);
    for($i=0;$i<sizeof($tracks);$i++){
        if(!$tracks[$i]->streamable){
            unset($tracks[$i]);
        }
    }

	$obj = (object) array('tracks' => array_values((array) $tracks));
	$response = $app->response();
    $response['Content-Type'] = 'application/json';
	$response['X-Powered-By'] = 'Tazzy';
	$response->status(200);
	$response->body(json_encode($obj));
    })->name('search');

	$app->get('/api/explore' , function() use($app){
		$recs = $app->sc->explore();
        $T =[];

        foreach ($recs->collection as $track) {
          $T[]=$track->track;
        }
		$obj = (object) array('tracks' => array_values((array) $T));
		$response = $app->response();
		$response['Content-Type'] = 'application/json';
		$response['X-Powered-By'] = 'Tazzy';
		$response->status(200);
		$response->body(json_encode($obj));
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
    $app->get('/about',function() use ($app){
      $app->render('home/about.php');
    })->name('about');

    $app->get('/contact',function() use ($app){
      $app->render('home/contact.php');
    })->name('contact');

    $app->get('/help',function() use ($app){
      $app->render('home/help.php');
    })->name('help');
 ?>
