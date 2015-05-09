<?php
require_once "soundcloud.php";
 header('Content-Type: text/xml');
 echo '<?xml version="1.0" encoding="UTF-8" standalone="yes" ?>';

 echo '<response>';
    $query = $_POST['query'];
    $SC = new SCservice();
    $tracks = $SC->request($query);
    $max_tracks =15;
    $i=0;
    echo "<div class=\"row\">";
   foreach($tracks as $track){
       if($track->streamable == TRUE){
           echo "<div class=\"col-xs-12\">
                    <h4><a href='{$track->permalink_url}' target='_blank'>{$track->title}</a></h4>
                    <div class='col-xs-4 col-md-2'>
                        <img src=".$track->artwork_url." class=\"img-responsive\" alt=\"thumbnail\">
                    </div>
                    <a href='download_mp3.php?title=".urlencode($track->title)."&url={$track->stream_url}' target='_blank'>download</a>
            </div>";
            $i++;
            if($i==$max_tracks){
                break;
            }
       }
    }
    echo " </div>";
 echo '</response>';
?>
