<?php

//base values
$SERVER_KEY = "SERVER_TOKEN";
$CLIENT_KEY = 'FCM_TOKEN';
$LOGO = "LINK_OF_IMAGE";

//notification values
$title = "Notification title";
$body = "Hello I am from Your php server";

//data value
$data = ["id" => 1];

//push notification with notif or not
$isNotif = false;

//Ready sth to push
$url = "https://fcm.googleapis.com/fcm/send";
$token = $CLIENT_KEY;
$serverKey = $SERVER_KEY;
$notification = array('title' => $title, 'body' => $body, 'sound' => 'default', 'badge' => '1', 'image' => $LOGO);
$arrayToSend = array('to' => $token, 'priority' => 'high', 'data' => $data);
if ($isNotif)
    $arrayToSend['notification'] = $notification;
//

//Push
$json = json_encode($arrayToSend);
$headers = array();
$headers[] = 'Content-Type: application/json';
$headers[] = 'Authorization: key=' . $serverKey;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$response = curl_exec($ch);
if ($response === FALSE) {
    die('FCM Send Error: ' . curl_error($ch));
}
curl_close($ch);
//
