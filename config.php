<?php
$client_id     = '1761168490878727'; // ClientID
$client_secret = '250b251272b5767a73ddde0a797f5ab7'; // ClientSecretKey
$redirect_uri  = 'http://localhost/'; // RedirectURIs

$url = 'https://www.facebook.com/dialog/oauth'; //BaseAuthURL

$params = array(
    'client_id' => $client_id, // ClientID
    'redirect_uri' => $redirect_uri, // RedirectURIs
    'response_type' => 'code', //Type_of_response_type
    'scope' => 'email,user_birthday,publish_actions,user_about_me,user_likes,user_hometown,user_status'
    //Permissions
);
?>