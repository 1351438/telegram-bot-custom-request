<?php

file_put_contents('log.txt', file_get_contents("log.txt") . json_encode($_GET ?? $_POST));
$url = 'https://api.telegram.org/bot' . $_GET['token'] . '/' . $_GET['action'];
unset($_GET['token']);
unset($_GET['action']);
header("Content-type:application/json");
$a =  array_merge($_GET, $_POST);
echo json_encode(curl($url,$a ), 128);


function curl($url, $datas = [])
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $datas);
    $res = curl_exec($ch);
    if (curl_error($ch)) {
        var_dump(curl_error($ch));
    } else {
        return json_decode($res);
    }
    return $res;
}
