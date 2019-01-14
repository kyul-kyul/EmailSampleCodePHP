<?php
/**
 * Created by PhpStorm.
 * User: NHNEnt
 * Date: 2019-01-14
 * Time: 오후 9:31
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

function registerUid($app_key, $api_function, $uid, $tagIds, $contact){
    $url = 'https://api-mail.cloud.toast.com/email/v1.4/appKeys/'.$app_key.'/'.$api_function;
    $contact = array("contactType" => "EMAIL_ADDRESS", "contact"=> $contact);
    $postfields = array("uid" => $uid, "tagIds" => $tagIds, "contact" => $contact);
    post($url, $postfields);
}

$app_key = "{APP_KEY}";
$uidApi = "uids";
$tagId = 'ODrn4sdH';
$uid = '4';
$contact = 'woodikol1258@gmail.com';

registerUid($app_key, $uidApi, $uid, $tagId, $contact);

?>