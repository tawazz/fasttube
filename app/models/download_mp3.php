<?php
    require_once "soundcloud.php";
    $SC = new SCservice();
    $track = $SC->download($_GET['url']);
    $title = $_GET['title'];
    $myfile = fopen("/fasttube/temp/track.mp3", "w") or die("Unable to open file!");
    fwrite($myfile, $track);
    fclose($myfile);
    header('Content-Type: audio/mpeg');
    header('Content-Disposition:attachment;filename="'.$title.'.mp3"');
    header('Cache-Control: no-cache');
    header("Content-Description: File Transfer");
    header("Content-Transfer-Encoding: binary");

   // read the file from disk
    readfile($myfile);
    exit;
?>
