<?php

// DO NO EDIT ANYTHING TO WORK PORPELY 
// © @AvishkarPatil | https://github.com/moaj257

require ('token.php');

session_start();

header("Content-Type: application/vnd.apple.mpegurl");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Expose-Headers: Content-Length,Content-Range");
header("Access-Control-Allow-Headers: Range");
header("Accept-Ranges: bytes");

$_SESSION["p"] = $token;

print_r($token);
print_r($_REQUEST);
print_r($_SESSION);

if ($token != "" && @$_REQUEST["c"] != "")
{

    $opts = [
        "http" => [
            "method" => "GET",
            "header" => "User-Agent: plaYtv/6.0.9 (Linux; Android 5.1.1) ExoPlayerLib/2.13.2" 
    
        ]
    ];

    $cx = stream_context_create($opts);

    $hs = file_get_contents("https://jiotv.live.cdn.jio.com/" . $_REQUEST["c"] . "/" . $_REQUEST["c"] . "_" . $_REQUEST["q"] . ".m3u8" . $token, false, $cx);
    $hs= @preg_replace("/" . $_REQUEST["c"] . "_" . $_REQUEST["q"] ."-([^.]+\.)key/", 'stream.php?key='  . $_REQUEST["c"] . '/' .   $_REQUEST["c"] . '_' . $_REQUEST["q"] . '-\1key', $hs);
    $hs= @preg_replace("/" . $_REQUEST["c"] . "_" . $_REQUEST["q"] ."-([^.]+\.)ts/", 'stream.php?ts='  . $_REQUEST["c"] . '/' .   $_REQUEST["c"] . '_' . $_REQUEST["q"] . '-\1ts', $hs);

    $hs=str_replace("https://tv.media.jio.com/streams_live/" .  $_REQUEST["c"] . "/","",$hs);
    $hs = str_replace("https://tv.media.jio.com/streams_hotstar/" . $_REQUEST["c"] . "/","",$hs);


    print $hs;
}
die();
?>
