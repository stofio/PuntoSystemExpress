<?php

require '/var/www/html/vendor/autoload.php';

function SEND_MAIL($RECIPIENT,$EMAILSUBJECT,$EMAILBODY){

    //Get Refresh Token From Database set when running Authentication File
    $conn = new mysqli("servername", "username", "password", 'database');

    $sql = "SELECT * FROM refresh_token";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $token = $row['original'];
            $refresh_token = $row['refresh'];
        }
    }
    $conn->close();

    // Replace this with your Google Client ID
    $client_id     = 'blabla.apps.googleusercontent.com';
    $client_secret = 'secret';
    $redirect_uri  = 'https://www.redirecturl'; 

    $client = new Google_Client();
    $client->setClientId($client_id);
    $client->setClientSecret($client_secret);
    $client->setRedirectUri($redirect_uri);
    $client->addScope("https://www.googleapis.com/auth/gmail.compose");
    $client->setAccessType('offline');
    $client->setApprovalPrompt('force');

    $client->setAccessToken($token);

    if ($client->isAccessTokenExpired()) {
    $client->refreshToken($refresh_token);
    $newtoken = $client->getAccessToken();
    $client->setAccessToken($newtoken);
    }

    $service = new Google_Service_Gmail($client);

    $fromemail = "<the-email-you-want-to-send-from>@gmail.com";

    $strRawMessage = "From: Email <$fromemail> \r\n";
    $strRawMessage .= "To: <$RECIPIENT>\r\n";
    $strRawMessage .= 'Subject: =?utf-8?B?' . base64_encode($EMAILSUBJECT) . "?=\r\n";
    $strRawMessage .= "MIME-Version: 1.0\r\n";
    $strRawMessage .= "Content-Type: text/html; charset=utf-8\r\n";
    $strRawMessage .= 'Content-Transfer-Encoding: quoted-printable' . "\r\n\r\n";
    $strRawMessage .= "$EMAILBODY\r\n";
    $mime = rtrim(strtr(base64_encode($strRawMessage), '+/', '-_'), '=');
    $msg = new Google_Service_Gmail_Message();
    $msg->setRaw($mime);
    $service->users_messages->send("me", $msg);
}

SEND_MAIL('stofio@live.com', 'Test', 'Hey!');

   ?>