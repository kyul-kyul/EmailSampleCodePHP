<?php
/**
 * Created by PhpStorm.
 * User: NHNEnt
 * Date: 2019-01-14
 * Time: 오후 9:27
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

function sendTagMail($app_key, $api_function, $tagExpression, $senderAddress, $title, $body){
    $url = "https://api-mail.cloud.toast.com/email/v1.4/appKeys/".$app_key."/sender/".$api_function;
    $postfields = array ("senderAddress" => $senderAddress, "title" => $title, "body" => $body, "tagExpression" => $tagExpression);
    post($url, $postfields);
}

$app_key = "{APP_KEY}";
$tagMailApi = "tagMail";
$senderAddress = 'woodikol1258@gmail.com';
$title = 'title';
$body = 'body';
$tagExpression = array('h2ORKmz0', 'OR', 'xnh4cmXU');

sendTagMail($app_key, $tagMailApi, $tagExpression, $senderAddress, $title, $body);

?>
