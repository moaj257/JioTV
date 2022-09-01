<?php
    $q = $_GET['q'];
    $json = json_decode(file_get_contents('data/channels.json'));
    $search = [];
    foreach($json->result as $res) {
        // echo strpos($res->channel_name, $q); die();
        if(strpos(strtolower($res->channel_name), $q) !== false) {
            $search[] = $res;
        }
    }
    $json->result = $search;
    echo json_encode($json, true);
?>