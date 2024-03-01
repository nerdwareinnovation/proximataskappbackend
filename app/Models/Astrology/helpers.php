<?php

function send_push_notification($firebaseToken,$message){


    $SERVER_API_KEY = 'AAAA6jYsBh8:APA91bGQQ96JLORhjSQ2pSBIIojjGhAiXzdELNthkVr_NgGSTbdqgXWnZDPOwBlDW4waNAgESOZ80-J3pmHRjHCYk-AFFUC8R6piz6r4-4u_BSw59rTvkg-aFuCToo01OhoQhr7jtEj9';

    $data = [
        "registration_ids" => $firebaseToken,
        "notification" => [
            "title" => $message['message_title'],
            "body" => $message['message_text'],
        ]
    ];
    $dataString = json_encode($data);

    $headers = [
        'Authorization: key=' . $SERVER_API_KEY,
        'Content-Type: application/json',
    ];

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

    $response = curl_exec($ch);

    return  $response;
}

function productImagePath($image_name)
{
    return public_path('images/products/'.$image_name);
}
