<?php
/**
 * Created by PhpStorm.
 * User: NHNEnt
 * Date: 2019-01-14
 * Time: 오후 9:31
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

function modifyTag($app_key, $api_function, $tagId, $tagName){
    $url = 'https://api-mail.cloud.toast.com/email/v1.4/appKeys/'.$app_key.'/'.$api_function.'/'.$tagId;
    $postfields = array("tagName" => $tagName);
    put($url, $postfields);
}

$app_key = "{APP_KEY}";
$tagApi = "tags";
$newTagName = 'new_tagName';
$tagId = 'ODrn4sdH';

modifyTag($app_key, $tagApi, $tagId, $newTagName);

?>