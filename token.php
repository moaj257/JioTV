<?php


// DO NO EDIT ANYTHING TO WORK PORPELY 
// © @moaj257 | https://github.com/moaj257


// $auth = json_decode(file_get_contents('data/auth.json') , true);
$ssoToken = getenv('ssoToken');

$jctBase = "cutibeau2ic";

function tokformat($str)
{
    $str = base64_encode(md5($str, true));
    return str_replace("\n", "", str_replace("\r", "", str_replace("/", "_", str_replace("+", "-", str_replace("=", "", $str)))));
}
function generateJct($st, $pxe)
{
    global $jctBase;
    return trim(tokformat($jctBase . $st . $pxe));
}
function generatePxe()
{
    return time() + 6000000;
}
function generateSt()
{
    global $ssoToken;
    return tokformat($ssoToken);
}
function generateToken()
{
    $st = generateSt();
    $pxe = generatePxe();
    $jct = generateJct($st, $pxe);
    return "?jct=" . $jct . "&pxe=" . $pxe . "&st=" . $st;
}

$token = generateToken();

?>
