<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 2018-12-31
 * Time: 오후 3:58
 */

function prettyPrint( $json )
{
    $result = '';
    $level = 0;
    $in_quotes = false;
    $in_escape = false;
    $ends_line_level = NULL;
    $json_length = strlen( $json );

    for( $i = 0; $i < $json_length; $i++ ) {
        $char = $json[$i];
        $new_line_level = NULL;
        $post = "";
        if( $ends_line_level !== NULL ) {
            $new_line_level = $ends_line_level;
            $ends_line_level = NULL;
        }
        if ( $in_escape ) {
            $in_escape = false;
        } else if( $char === '"' ) {
            $in_quotes = !$in_quotes;
        } else if( ! $in_quotes ) {
            switch( $char ) {
                case '}': case ']':
                $level--;
                $ends_line_level = NULL;
                $new_line_level = $level;
                break;

                case '{': case '[':
                $level++;
                case ',':
                    $ends_line_level = $level;
                    break;

                case ':':
                    $post = " ";
                    break;

                case " ": case "\t": case "\n": case "\r":
                $char = "";
                $ends_line_level = $new_line_level;
                $new_line_level = NULL;
                break;
            }
        } else if ( $char === '\\' ) {
            $in_escape = true;
        }
        if( $new_line_level !== NULL ) {
            $result .= "\n".str_repeat( "\t", $new_line_level );
        }
        $result .= $char.$post;
    }

    return $result;
}

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

function delete($url, $postfields){

    $options=[
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POSTFIELDS => json_encode($postfields),
        CURLOPT_CUSTOMREQUEST => "DELETE",
        CURLOPT_HTTPHEADER => ['Content-Type: application/json']
    ];
    $ch = curl_init($url);
    curl_setopt_array($ch, $options);
    $result=curl_exec($ch);
    curl_close($ch);
    var_dump($result);
    printf(($result));
}

function sendMail($app_key, $api_function, $receiveMailAddr, $receiveName, $receiveType, $senderAddress, $title, $body){
    $url = "https://api-mail.cloud.toast.com/email/v1.4/appKeys/".$app_key."/sender/".$api_function;
    $receiver1 = array ("receiveMailAddr" => $receiveMailAddr, "receiveName" => $receiveName, "receiveType" => $receiveType);
    $receiverList = array ($receiver1);
    $postfields = array ("senderAddress" => $senderAddress, "title" => $title, "body" => $body, "receiverList" => $receiverList);
    post($url, $postfields);
}

function sendAuthMail($app_key, $api_function, $receiveMailAddr, $receiveName, $senderAddress, $title, $body){
    $url = "https://api-mail.cloud.toast.com/email/v1.4/appKeys/".$app_key."/sender/".$api_function;
    $receiver = array("receiveMailAddr" => $receiveMailAddr, "receiveName" => $receiveName);
    $postfields = array ("senderAddress" => $senderAddress, "title" => $title, "body" => $body, "receiver" => $receiver);
    post($url, $postfields);
}

function sendTagMail($app_key, $api_function, $tagExpression, $senderAddress, $title, $body){
    $url = "https://api-mail.cloud.toast.com/email/v1.4/appKeys/".$app_key."/sender/".$api_function;
    $postfields = array ("senderAddress" => $senderAddress, "title" => $title, "body" => $body, "tagExpression" => $tagExpression);
    post($url, $postfields);
}

function uploadFile($app_key, $fileName, $createUser, $imgSource){
    $url = "https://api-mail.cloud.toast.com/email/v1.4/appKeys/".$app_key ."/attachfile/binaryUpload";
    $imgBinary = fread(fopen($imgSource, "r"), filesize($imgSource));
    $fileBody = base64_encode($imgBinary);
    $postfileds = array("fileName" => $fileName, "createUser" => $createUser, "fileBody" => $fileBody);
    post($url, $postfileds);
}

function sendMailWithFile($app_key, $api_function, $receiveMailAddr, $receiveName, $receiveType, $senderAddress, $title, $body, $attachFileIdList){
    $url = "https://api-mail.cloud.toast.com/email/v1.4/appKeys/".$app_key."/sender/".$api_function;
    $receiver1 = array ("receiveMailAddr" => $receiveMailAddr, "receiveName" => $receiveName, "receiveType" => $receiveType);
    $receiverList = array ($receiver1);
    $postfields = array ("senderAddress" => $senderAddress, "title" => $title, "body" => $body, "receiverList" => $receiverList, "attachFileIdList" => $attachFileIdList);
    post($url, $postfields);
}

function templateMail($app_key, $api_function, $receiveMailAddr, $receiveName, $receiveType, $senderAddress, $templateId, $templateParameter){
    $url = "https://api-mail.cloud.toast.com/email/v1.4/appKeys/".$app_key."/sender/".$api_function;
    $receiver1 = array ("receiveMailAddr" => $receiveMailAddr, "receiveName" => $receiveName, "receiveType" => $receiveType);
    $receiverList = array ($receiver1);
    $postfields = array ("senderAddress" => $senderAddress, "receiverList" => $receiverList, "templateId" => $templateId,"templateParameter" => $templateParameter);
    post($url, $postfields);
}

function inquireMailList($app_key, $api_function, $requestId, $startSendDate){
    $url = 'https://api-mail.cloud.toast.com/email/v1.4/appKeys/'.$app_key.'/sender/'.$api_function;
    $params = array("requestId" => $requestId, "startSendDate" => $startSendDate);
    get($url, $params);
}

function inquireMailDetail($app_key, $api_function, $requestId, $mailSeq){
    $url = 'https://api-mail.cloud.toast.com/email/v1.4/appKeys/'.$app_key.'/sender/'.$api_function;
    $params = array("requestId" => $requestId, "mailSeq" => $mailSeq);
    get($url, $params);
}

function inquireTagMailRequest($app_key, $api_function, $startSendDate, $endSendDate){
    $url = 'https://api-mail.cloud.toast.com/email/v1.4/appKeys/'.$app_key.'/'.$api_function;
    $params = array("startSendDate" => $startSendDate, "endSendDate" => $endSendDate);
    get($url, $params);
}

function inquireTagMailReceiver($app_key, $api_function, $requestId){
    $url = 'https://api-mail.cloud.toast.com/email/v1.4/appKeys/'.$app_key.'/'.$api_function.'/'.$requestId;
    $params = array();
    get($url, $params);
}

function inquireTagMailDetail($app_key, $api_function, $requestId, $mailSeq){
    $url = 'https://api-mail.cloud.toast.com/email/v1.4/appKeys/'.$app_key.'/'.$api_function.'/'.$requestId.'/'.$mailSeq;
    $params = array();
    get($url, $params);
}

function inquireTemplate($app_key, $api_function){
    $url = 'https://api-mail.cloud.toast.com/email/v1.4/appKeys/'.$app_key.'/'.$api_function;
    $params = array();
    get($url, $params);
}

function inquireTemplateDetail($app_key, $api_function, $templateId){
    $url = 'https://api-mail.cloud.toast.com/email/v1.4/appKeys/'.$app_key.'/'.$api_function.'/'.$templateId;
    $params = array();
    get($url, $params);
}

function inquireTag($app_key, $api_function){
    $url = 'https://api-mail.cloud.toast.com/email/v1.4/appKeys/'.$app_key.'/'.$api_function;
    $params = array();
    get($url, $params);
}

function registerTag($app_key, $api_function, $tagName){
    $url = 'https://api-mail.cloud.toast.com/email/v1.4/appKeys/'.$app_key.'/'.$api_function;
    $postfields = array("tagName" => $tagName);
    post($url, $postfields);
}

function modifyTag($app_key, $api_function, $tagId, $tagName){
    $url = 'https://api-mail.cloud.toast.com/email/v1.4/appKeys/'.$app_key.'/'.$api_function.'/'.$tagId;
    $postfields = array("tagName" => $tagName);
    put($url, $postfields);
}

function deleteTag($app_key, $api_function, $tagId){
    $url = 'https://api-mail.cloud.toast.com/email/v1.4/appKeys/'.$app_key.'/'.$api_function.'/'.$tagId;
    $postfieds = array();
    delete($url, $postfieds);
}

function inquireUid($app_key, $api_function){
    $url = 'https://api-mail.cloud.toast.com/email/v1.4/appKeys/'.$app_key.'/'.$api_function;
    $params = array();
    get($url, $params);
}

function inquireOneUid($app_key, $api_function, $uid){
    $url = 'https://api-mail.cloud.toast.com/email/v1.4/appKeys/'.$app_key.'/'.$api_function;
    $params = array("uid" => $uid);
    get($url, $params);
}

function registerUid($app_key, $api_function, $uid, $tagIds, $contact){
    $url = 'https://api-mail.cloud.toast.com/email/v1.4/appKeys/'.$app_key.'/'.$api_function;
    $contact = array("contactType" => "EMAIL_ADDRESS", "contact"=> $contact);
    $postfields = array("uid" => $uid, "tagIds" => $tagIds, "contact" => $contact);
    post($url, $postfields);
}

function deleteUid($app_key, $api_function, $uid){
    $url = 'https://api-mail.cloud.toast.com/email/v1.4/appKeys/'.$app_key.'/'.$api_function.'/'.$uid;
    $postfields = array();
    delete($url, $postfields);
}

function registerEmailAddress($app_key, $api_function, $uid, $emailAddress){
    $url = 'https://api-mail.cloud.toast.com/email/v1.4/appKeys/'.$app_key.'/'.$api_function.'/'.$uid.'/email-addresses';
    $postfields = array("emailAddress" => $emailAddress);
    post($url, $postfields);
}

function deleteEmailAddress($app_key, $api_function, $uid, $emailAddress){
    $url = 'https://api-mail.cloud.toast.com/email/v1.4/appKeys/'.$app_key.'/'.$api_function.'/'.$uid.'/email-addresses/'.$emailAddress;
    $postfields = array();
    delete($url, $postfields);
}

function inquireStatistics($app_key, $api_function, $fromDate, $toDate, $searchType){
    $url = 'https://api-mail.cloud.toast.com/email/v1.4/appKeys/'.$app_key.'/'.$api_function;
    $params = array("from" => $fromDate, "to" => $toDate, "searchType" => $searchType);
    get($url, $params);
}

function inquireBlockReceiver($app_key, $api_function){
    $url = 'https://api-mail.cloud.toast.com/email/v1.4/appKeys/'.$app_key.'/'.$api_function;
    $params = array();
    get($url, $params);
}

function registerBlockReceiver($app_key, $api_function, $mailAddress, $blockDate){
    $url = 'https://api-mail.cloud.toast.com/email/v1.4/appKeys/'.$app_key.'/'.$api_function;
    $blockReceiverList = array( array("mailAddress" => $mailAddress, "blockDate" => $blockDate));
    $postfields = array("blockReceiverList" => $blockReceiverList);
    post($url, $postfields);
}

function deleteBlockReceiver($app_key, $api_function, $deleted, $mailAddress){
    $url = 'https://api-mail.cloud.toast.com/email/v1.4/appKeys/'.$app_key.'/'.$api_function;
    $blockReceiverList = array( array("mailAddress" => $mailAddress));
    $postfields = array("deleted" => $deleted, "blockReceiverList" => $blockReceiverList);
    put($url, $postfields);
}

$app_key = "{APP_KEY}";

$standardMailApi = "mail";
$eachMailApi = "eachMail";
$adMailApi = "ad-mail";
$adEachMailApi = "ad-eachMail";
$authMailApi = "auth-mail";
$tagMailApi = "tagMail";
$inquireMailListApi = "mails";
$inquireTagMailApi = "tagMails";
$inquireTemplateApi = "templates";
$tagApi = "tags";
$uidApi = "uids";
$statisticsApi = "statistics/view";
$blockReceiverApi = "block-receivers";


$receiveMailAddr = 'hankyul.lee@nhnent.com';
$receiveName = 'lee';
$receiveType = 'MRT0';
$senderAddress = 'woodikol1258@gmail.com';
$title = 'title';
$adTitle = '(광고)title';
$body = 'body';
$tagExpression = array('h2ORKmz0', 'OR', 'xnh4cmXU');

$imgSource = "123.jpg";
$fileName = 'fileName';
$createUser = 'lee';
$attachFileIdList = array(287);

$templateId = "id";
$templateParameter = array("title_name" => "클라우드고객1", "body_content" => "test1");

$requestId = '2019010311175312940014';
$startSendDate = '2018-12-20 00:00:00';
$endSendDate = '2018-12-31 00:00:00';
$mailSeq = '0';
$tagMailRequestId = '2018121917070788070014';

$tagName = 'tagName';
$tagId = 'ODrn4sdH';
$newTagName = 'new_tagName';

$uid = '4';
$contact = 'woodikol1258@gmail.com';
$emailAddress = 'woodikol1258@gmail.com';

$fromDate = '2018-12-01 00:00';
$toDate = '2018-12-24 00:00';
$searchType = 'DATE';
$mailAddress = 'vmfltm13@naver.com';
$blockDate = '2019-12-31 11:42:00';
$deleted = True;

#일반 메일
sendMail($app_key, $standardMailApi, $receiveMailAddr, $receiveName, $receiveType, $senderAddress, $title, $body);
/*
#개별 메일
sendMail($app_key, $eachMailApi, $receiveMailAddr, $receiveName, $receiveType, $senderAddress, $title, $body);
#광고성 일반 메일
sendMail($app_key, $adMailApi, $receiveMailAddr, $receiveName, $receiveType, $senderAddress, $adTitle, $body);
#광고성 개별 메일
sendMail($app_key, $adEachMailApi, $receiveMailAddr, $receiveName, $receiveType, $senderAddress, $adTitle, $body);
#인증 메일
sendAuthMail($app_key, $authMailApi, $receiveMailAddr, $receiveName, $senderAddress, $title, $body);
#태그 메일 (결과는 Succcess, 그러나 메일이 도착 안함)
sendTagMail($app_key, $tagMailApi, $tagExpression, $senderAddress, $title, $body);
#첨부파일 업로드
uploadFile($app_key, $fileName, $createUser, $imgSource);
#첨부 메일
sendMailWithFile($app_key, $standardMailApi, $receiveMailAddr, $receiveName, $receiveType, $senderAddress, $title, $body, $attachFileIdList);
#템플릿 메일
templateMail($app_key, $standardMailApi, $receiveMailAddr, $receiveName, $receiveType, $senderAddress, $templateId, $templateParameter);

#메일 발송 리스트 조회
inquireMailList($app_key, $inquireMailListApi, $requestId, $startSendDate);
#메일 발송 상세 조회
inquireMailDetail($app_key, $inquireMailListApi, $requestId, $mailSeq);
#태그 메일 발송 요청 조회
inquireTagMailRequest($app_key, $inquireTagMailApi, $startSendDate, $endSendDate);
#태그 메일 발송 수신자 조회 (결과는 Success이나, data가 공백)
inquireTagMailReceiver($app_key, $inquireTagMailApi, $requestId);
#태그 메일 발송 상세 조회 (Not exist data 오류)
inquireTagMailDetail($app_key, $inquireTagMailApi, $requestId, $mailSeq);

#템플릿 조회
inquireTemplate($app_key, $inquireTemplateApi);
#템플릿 상세 조회
inquireTemplateDetail($app_key, $inquireTemplateApi, $templateId);

#태그 조회
inquireTag($app_key, $tagApi);
#태그 등록
registerTag($app_key, $tagApi, $tagName);
#태그 수정
modifyTag($app_key, $tagApi, $tagId, $newTagName);
#태그 삭제
deleteTag($app_key, $tagApi, $tagId);
#UID 조회
inquireUid($app_key, $uidApi);
#UID 단건 조회
inquireOneUid($app_key, $uidApi, $uid);
#UID 등록 (Internal Error)
registerUid($app_key, $uidApi, $uid, $tagId, $contact);
#UID 삭제
deleteUid($app_key, $uidApi, $uid);
#메일 주소 등록
registerEmailAddress($app_key, $uidApi, $uid, $emailAddress);
#메일 주소 삭제
deleteEmailAddress($app_key, $uidApi, $uid, $emailAddress);
#통계 조회
inquireStatistics($app_key, $statisticsApi, $fromDate, $toDate, $searchType);

#수신 거부 조회
inquireBlockReceiver($app_key, $blockReceiverApi);
#수신 거부 등록
registerBlockReceiver($app_key, $blockReceiverApi, $mailAddress, $blockDate);
#수신 거부 삭제
deleteBlockReceiver($app_key, $blockReceiverApi, $deleted, $mailAddress);
*/
?>