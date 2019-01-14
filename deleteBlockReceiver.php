<?php
/**
 * Created by PhpStorm.
 * User: NHNEnt
 * Date: 2019-01-14
 * Time: 오후 9:32
 */

function put($url, $postfields){

    $options=[
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POSTFIELDS => json_encode($postfields),
        CURLOPT_CUSTOMREQUEST => "PUT",
        CURLOPT_HTTPHEADER => ['Content-Type: application/json']
    ];
    $ch = curl_init($url);
    curl_setopt_array($ch, $options);
    $result=curl_exec($ch);
    curl_close($ch);
    var_dump($result);
    printf(($result));
}

function deleteBlockReceiver($app_key, $api_function, $deleted, $mailAddress){
    $url = 'https://api-mail.cloud.toast.com/email/v1.4/appKeys/'.$app_key.'/'.$api_function;
    $blockReceiverList = array( array("mailAddress" => $mailAddress));
    $postfields = array("deleted" => $deleted, "blockReceiverList" => $blockReceiverList);
    put($url, $postfields);
}

$app_key = "{APP_KEY}";
$blockReceiverApi = "block-receivers";
$deleted = True;
$mailAddress = 'vmfltm13@naver.com';

deleteBlockReceiver($app_key, $blockReceiverApi, $deleted, $mailAddress);

?>