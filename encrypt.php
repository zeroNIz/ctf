<?php

$pass = "xxxxxxxxxx"; // 在部署时请修改该密钥, 现在这里存的密钥不是正确的密钥

function encrypt($string) {
    global $pass;
    $algorithm = 'rijndael-128';
    $key       = md5($pass, true);
    $encrypted = mcrypt_encrypt($algorithm, $key, $string, MCRYPT_MODE_ECB);
    $result    = base64url_encode($encrypted);
    return $result;
}
function decrypt($encrypted) {
    global $pass;
    $algorithm = 'rijndael-128';
    $key       = md5($pass, true);
    $encrypted    = base64url_decode($encrypted);
    $result    = mcrypt_decrypt($algorithm, $key, $encrypted, MCRYPT_MODE_ECB);
    $result    = rtrim($result, "\0");
    return $result;
}

function base64url_encode($data) {
    return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
}
function base64url_decode($data) {
    return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
}