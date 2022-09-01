<?php

// DO NO EDIT ANYTHING TO WORK PORPELY 
// © @AvishkarPatil | https://github.com/moaj257

require ('token.php');

session_start();

// header("Content-Type: application/vnd.apple.mpegurl");
// header("Access-Control-Allow-Origin: *");
// header("Access-Control-Expose-Headers: Content-Length,Content-Range");
// header("Access-Control-Allow-Headers: Range");
// header("Accept-Ranges: bytes");

$_SESSION["p"] = $token;

print_r(getenv('ssoToken'));

if ($token != "" && @$_REQUEST["c"] != "")
{

    // $opts = [
    //     "http" => [
    //         "method" => "GET",
    //         "header" => "User-Agent: plaYtv/6.0.9 (Linux; Android 5.1.1) ExoPlayerLib/2.13.2"
    //     ]
    // ];

    // $cx = stream_context_create($opts);
    // print_r($cx); echo "<br/><br/><br/>";
    // echo "https://jiotv.live.cdn.jio.com/" . $_REQUEST["c"] . "/" . $_REQUEST["c"] . "_" . $_REQUEST["q"] . ".m3u8";

    // $hs = file_get_contents("https://jiotv.live.cdn.jio.com/" . $_REQUEST["c"] . "/" . $_REQUEST["c"] . "_" . $_REQUEST["q"] . ".m3u8" . $token, false, $cx);
    // print_r($hs); echo "<br/><br/><br/>";
    // $hs= @preg_replace("/" . $_REQUEST["c"] . "_" . $_REQUEST["q"] ."-([^.]+\.)key/", 'stream.php?key='  . $_REQUEST["c"] . '/' .   $_REQUEST["c"] . '_' . $_REQUEST["q"] . '-\1key', $hs);
    // print_r($hs); echo "<br/><br/><br/>";
    // $hs= @preg_replace("/" . $_REQUEST["c"] . "_" . $_REQUEST["q"] ."-([^.]+\.)ts/", 'stream.php?ts='  . $_REQUEST["c"] . '/' .   $_REQUEST["c"] . '_' . $_REQUEST["q"] . '-\1ts', $hs);
    // print_r($hs); echo "<br/><br/><br/>";

    // $hs=str_replace("https://tv.media.jio.com/streams_live/" .  $_REQUEST["c"] . "/","",$hs);
    // print_r($hs); echo "<br/><br/><br/>";
    // $hs = str_replace("https://tv.media.jio.com/streams_hotstar/" . $_REQUEST["c"] . "/","",$hs);
    // print_r($hs); echo "<br/><br/><br/>";

    // $hs = file_get_contents('https://www.techiesneh.tk/api/jiolive?c='.$_REQUEST["c"].'&q='.$_REQUEST["q"].'&e=junk.m3u8');
    $opts = ["http" => ["method" => "GET", "header" => "User-Agent: plaYtv/6.0.9 (Linux; Android 5.1.1) ExoPlayerLib/2.13.2"]];
    $cx = stream_context_create($opts);
    $hs = file_get_contents("https://jiotv.live.cdn.jio.com/" . $_REQUEST["c"] . "/" . $_REQUEST["c"] . "_" . $_REQUEST["q"] . ".m3u8" . $token, false, $cx);
    $hs = @preg_replace("/" . $_REQUEST["c"] . "_" . $_REQUEST["q"] . "-([^.]+\.)key/", 'stream.php?key=' . $_REQUEST["c"] . '/' . $_REQUEST["c"] . '_' . $_REQUEST["q"] . '-\1key', $hs);
    $hs = @preg_replace("/" . $_REQUEST["c"] . "_" . $_REQUEST["q"] . "-([^.]+\.)ts/", 'stream.php?ts=' . $_REQUEST["c"] . '/' . $_REQUEST["c"] . '_' . $_REQUEST["q"] . '-\1ts', $hs);
    $hs = str_replace("https://tv.media.jio.com/streams_live/" . $_REQUEST["c"] . "/", "", $hs);


    print $hs;
}
die();
?>
