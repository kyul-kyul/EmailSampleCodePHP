<?php
/**
 * Created by PhpStorm.
 * User: NHNEnt
 * Date: 2019-01-14
 * Time: 오후 9:32
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

function inquireStatistics($app_key, $api_function, $fromDate, $toDate, $searchType){
    $url = 'https://api-mail.cloud.toast.com/email/v1.4/appKeys/'.$app_key.'/'.$api_function;
    $params = array("from" => $fromDate, "to" => $toDate, "searchType" => $searchType);
    get($url, $params);
}

$app_key = "{APP_KEY}";
$statisticsApi = "statistics/view";

$fromDate = '2018-12-01 00:00';
$toDate = '2018-12-24 00:00';
$searchType = 'DATE';

inquireStatistics($app_key, $statisticsApi, $fromDate, $toDate, $searchType);

?>