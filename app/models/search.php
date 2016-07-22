<?php
require_once "service.php";
 header('Content-Type: text/xml');
 echo '<?xml version="1.0" encoding="UTF-8" standalone="yes" ?>';

 echo '<response>';
    $query = $_POST['query'];

    $Tube = new Service();
    $items = $Tube->request($query);
    //echo "<div class=\"row\">";
    echo $_SERVER['SERVER_ADDR'];
    print_r($items);
   foreach($items->items as $item){
       $videoId = $item->id->videoId;
       echo "<div class=\"col-xs-12\">
                
                <h4><a href='player.php?v={$videoId}&q={$query}'>{$item->snippet->title}</a></h4>
                <div class='col-xs-4 col-md-2'>
                    <img src=".$item->snippet->thumbnails->default->url." class=\"img-responsive\" alt=\"thumbnail\">
                </div>
                <div class='col-xs-8 col-md-8'>
                    <div class=\"caption\">
                        <p>".$item->snippet->description."</p>
                     </div>
                 </div>
        </div>";
    }
    echo " </div>";
 echo '</response>';
?>