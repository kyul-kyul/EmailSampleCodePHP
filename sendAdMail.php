<?php
/**
 * Created by PhpStorm.
 * User: NHNEnt
 * Date: 2019-01-14
 * Time: 오후 9:38
 */
function post($url, $postfields){

    $options=[
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POSTFIELDS => json_encode($postfields),
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_HTTPHEADER => ['Content-Type: application/json']
    ];
    $ch = curl_init($url);
    curl_setopt_array($ch, $options);
    $result=curl_exec($ch);
    curl_close($ch);
    var_dump($result);
    printf(($result));
}

function sendAdMail($app_key, $api_function, $receiveMailAddr, $receiveName, $receiveType, $senderAddress, $title, $body){
    $url = "https://api-mail.cloud.toast.com/email/v1.4/appKeys/".$app_key."/sender/".$api_function;
    $receiver1 = array ("receiveMailAddr" => $receiveMailAddr, "receiveName" => $receiveName, "receiveType" => $receiveType);
    $receiverList = array ($receiver1);
    $postfields = array ("senderAddress" => $senderAddress, "title" => $title, "body" => $body, "receiverList" => $receiverList);
    post($url, $postfields);
}
$app_key = "{APP_KEY}";
$adMailApi = "ad-mail";
$receiveMailAddr = 'hankyul.lee@nhnent.com';
$receiveName = 'lee';
$receiveType = 'MRT0';
$senderAddress = 'woodikol1258@gmail.com';
$title = '(광고)title';
$body = 'body';

sendAdMail($app_key, $adMailApi, $receiveMailAddr, $receiveName, $receiveType, $senderAddress, $title, $body);

?>