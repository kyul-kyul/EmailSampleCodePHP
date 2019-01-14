<?php
/**
 * Created by PhpStorm.
 * User: NHNEnt
 * Date: 2019-01-14
 * Time: 오후 9:32
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

function registerBlockReceiver($app_key, $api_function, $mailAddress, $blockDate){
    $url = 'https://api-mail.cloud.toast.com/email/v1.4/appKeys/'.$app_key.'/'.$api_function;
    $blockReceiverList = array( array("mailAddress" => $mailAddress, "blockDate" => $blockDate));
    $postfields = array("blockReceiverList" => $blockReceiverList);
    post($url, $postfields);
}

$app_key = "{APP_KEY}";
$blockReceiverApi = "block-receivers";
$mailAddress = 'vmfltm13@naver.com';
$blockDate = '2019-12-31 11:42:00';

registerBlockReceiver($app_key, $blockReceiverApi, $mailAddress, $blockDate);

?>
