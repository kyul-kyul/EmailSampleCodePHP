<?php
/**
 * Created by PhpStorm.
 * User: NHNEnt
 * Date: 2019-01-14
 * Time: 오후 9:30
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

function inquireTagMailReceiver($app_key, $api_function, $requestId){
    $url = 'https://api-mail.cloud.toast.com/email/v1.4/appKeys/'.$app_key.'/'.$api_function.'/'.$requestId;
    $params = array();
    get($url, $params);
}

$app_key = "{APP_KEY}";
$inquireTagMailApi = "tagMails";
$requestId = '2019010311175312940014';

inquireTagMailReceiver($app_key, $inquireTagMailApi, $requestId);

?>