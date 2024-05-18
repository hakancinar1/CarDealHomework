<?php

function generateToken($username, $key)
{
    $tokenData = array(
        "username" => $username,
        "timestamp" => time() 
    );


    $token = jwt_encode($tokenData, $key);

    return $token;
}
function jwt_encode($data, $key)
{
    $header = json_encode(['typ' => 'JWT', 'alg' => 'HS256']);
    $payload = json_encode($data);

    $base64UrlHeader = base64UrlEncode($header);
    $base64UrlPayload = base64UrlEncode($payload);

    $signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, $key, true);
    $base64UrlSignature = base64UrlEncode($signature);

    $jwt = $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;

    return $jwt;
}
function base64UrlEncode($data)
{
    $base64 = base64_encode($data);
    if ($base64 === false) {
        return false;
    }
    $base64Url = strtr($base64, '+/', '-_');
    return rtrim($base64Url, '=');
}

?>