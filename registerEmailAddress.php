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

function registerEmailAddress($app_key, $api_function, $uid, $emailAddress){
    $url = 'https://api-mail.cloud.toast.com/email/v1.4/appKeys/'.$app_key.'/'.$api_function.'/'.$uid.'/email-addresses';
    $postfields = array("emailAddress" => $emailAddress);
    post($url, $postfields);
}

$app_key = "{APP_KEY}";
$uidApi = "uids";
$uid = '4';
$emailAddress = 'woodikol1258@gmail.com';

registerEmailAddress($app_key, $uidApi, $uid, $emailAddress);

?>