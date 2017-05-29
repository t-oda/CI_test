<?php 
header("Content-Type: text/html; charset=UTF-8");
$token = 'fUXdh15N23KWU7OYOQ3v2w9d6hEVNlD0/zkz3u2855Xu4tmd/ULYXtXaaTi5SOqQK1yfhL0Yk77EIhwx3ADHvpS0mQqCZ/kXK9dUSq7dNp3jN1cmgULqsYZZlrKzKj1DTiPj8sPy7DF3lPMUmJvEkwdB04t89/1O/w1cDnyilFU=';

//callback確認
$obj = json_decode(file_get_contents('php://input'));
error_log($obj);
//textとreplyToken取得
$event = $obj->{"events"}[0];
$text = $event->{"message"}->{"text"};
$replyToken = $event->{"replyToken"};

$post = [
    "replyToken" => $replyToken,
    "messages" => [
                    "type" => "text",
                    "text" => $text]
                  ];
error_log(json_encode($post));

$ch = curl_init("https://api.line.me/v2/bot/message/reply");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post));
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json; charser=UTF-8',
    'Authorization: Bearer ' . $token
    ));
$result = curl_exec($ch);
error_log($result);
curl_close($ch);
