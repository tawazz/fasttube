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
                    <iframe width=\"100%\" height=\"166\" scrolling=\"no\" frameborder=\"no\" src=\"https://w.soundcloud.com/player/?url={$track->uri}&amp;color=ff5500&amp;auto_play=false&amp;hide_related=false&amp;show_comments=false&amp;show_user=true&amp;show_reposts=false\"></iframe>
                    <a class=\"btn btn-primary\" href='download_mp3.php?title=".urlencode($track->title)."&url={$track->stream_url}' target='_blank'>Download <span class=\"glyphicon glyphicon-save\" aria-hidden=\"true\"></span></a>
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
