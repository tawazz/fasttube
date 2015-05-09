<?php
    require_once "soundcloud.php";
    $SC = new SCservice();
    $track = $SC->download($_GET['url']);
    $title = $_GET['title'];
    $size = mb_strlen($track, '8bit');
    set_time_limit(0);
header('Content-Type: audio/mpeg');
    header('Content-Disposition:attachment;filename="'.$title.'.mp3"');
    header('Cache-Control: no-cache');

    echo $track;
    exit;
?>