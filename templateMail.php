<?php
/**
 * Created by PhpStorm.
 * User: NHNEnt
 * Date: 2019-01-14
 * Time: 오후 9:29
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

function templateMail($app_key, $api_function, $receiveMailAddr, $receiveName, $receiveType, $senderAddress, $templateId, $templateParameter){
    $url = "https://api-mail.cloud.toast.com/email/v1.4/appKeys/".$app_key."/sender/".$api_function;
    $receiver1 = array ("receiveMailAddr" => $receiveMailAddr, "receiveName" => $receiveName, "receiveType" => $receiveType);
    $receiverList = array ($receiver1);
    $postfields = array ("senderAddress" => $senderAddress, "receiverList" => $receiverList, "templateId" => $templateId,"templateParameter" => $templateParameter);
    post($url, $postfields);
}

$app_key = "{APP_KEY}";
$receiveMailAddr = 'hankyul.lee@nhnent.com';
$receiveName = 'lee';
$receiveType = 'MRT0';
$senderAddress = 'woodikol1258@gmail.com';
$templateId = "id";
$templateParameter = array("title_name" => "클라우드고객1", "body_content" => "test1");

templateMail($app_key, $standardMailApi, $receiveMailAddr, $receiveName, $receiveType, $senderAddress, $templateId, $templateParameter);

?>