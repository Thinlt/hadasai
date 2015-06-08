<?php

function tv__encrypt($string, $encryption_key) {
    $iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_CFB);
    $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);

    $cipherText = mcrypt_encrypt(MCRYPT_BLOWFISH, $encryption_key, $string, MCRYPT_MODE_CFB, $iv);
    $cipherText = $iv . $cipherText;
    return base64_encode($cipherText);
}

function tv__decrypt($string, $key) {
    $cipherText_dec = base64_decode($string);
    $iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_CFB);
    $iv_dec = substr($cipherText_dec, 0, $iv_size);
    $cipherText_dec = substr($cipherText_dec, $iv_size);
    return mcrypt_decrypt(MCRYPT_BLOWFISH, $key, $cipherText_dec, MCRYPT_MODE_CFB, $iv_dec);
}

function xxxxxGetRealIpAddr() {
    if (!empty($_SERVER['HTTP_X_REAL_IP'])) {   //check ip from share internet
        $ip = $_SERVER['HTTP_X_REAL_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {   //to check ip is pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

$ip_rule = array("127.0.0.1");   //ip truy cap
if (!in_array(xxxxxGetRealIpAddr(), $ip_rule)) {
//new key
    $_tv_key = 'nk_tao@*&^$#*viec.com.' . date('Y-m-d H');
    $_tv_key = 'giasuapple.comv.vn' . date('Y-m-d H');
    $token = isset($_GET['t']) ? $_GET['t'] : '';
    $token = tv__decrypt($token, $_tv_key);
    $token = json_decode($token,true);
    if (!$token['ok']) {
        die('Token fail');
    }
}

