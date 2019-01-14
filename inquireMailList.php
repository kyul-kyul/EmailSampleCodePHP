<?php
/**
 * Created by PhpStorm.
 * User: NHNEnt
 * Date: 2019-01-14
 * Time: 오후 9:29
 */

function get($url, $params){
    $options=[
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => ['Content-Type: application/json']
    ];
    $url = $url.'?'.http_build_query($params);
    $ch = curl_init($url);
    curl_setopt_array($ch, $options);
    $result=curl_exec($ch);
    curl_close($ch);
    var_dump($result);
    printf(($result));
}

function inquireMailList($app_key, $api_function, $requestId, $startSendDate){
    $url = 'https://api-mail.cloud.toast.com/email/v1.4/appKeys/'.$app_key.'/sender/'.$api_function;
    $params = array("requestId" => $requestId, "startSendDate" => $startSendDate);
    get($url, $params);
}

$app_key = "{APP_KEY}";
$inquireMailListApi = "mails";
$requestId = '2019010311175312940014';
$startSendDate = '2018-12-20 00:00:00';

inquireMailList($app_key, $inquireMailListApi, $requestId, $startSendDate);

?>
