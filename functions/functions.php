<?php

function curl($url, $parameters = '', $getCookie = null, $proxy = null)
{
    $userAgent = 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.43 Safari/537.31';
    $requestHeaders = array();
    $requestHeaders[] = 'User-Agent: ' . $userAgent;
    $requestHeaders[] = 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8';

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    if ($proxy) {
        curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 0);
        curl_setopt($ch, CURLOPT_PROXY, $proxy);
    }

    if ($getCookie) {
        curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
    }

    if ($parameters) {
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters);
    }

    curl_setopt($ch, CURLOPT_HTTPHEADER, $requestHeaders);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    $response = curl_exec($ch);
    curl_close($ch);
    return $response;
}

function json($result, $msg, $data = [])
{
    $encode['result'] = $result;
    $encode['msg'] = $msg;
    if (!empty($data)) {
        $encode['data'] = $data;
    }

    return json_encode($encode);
}

function sign_creator($username, $password) {
    $data = array(
        // 'api_key' => '882a8490361da98702bf97a021ddc14d', // fb for android
        'api_key' => '3e7c78e35a76a9299309885393b02d97',
        'email' => $username,
        'format' => 'JSON',
        'generate_machine_id' => '1',
        'generate_session_cookies' => '1',
        'locale' => 'vi_vn',
        'method' => 'auth.login',
        'password' => $password,
        'return_ssl_resources' => '0',
        'v' => '1.0',
    );

    $sig = "";
    foreach ($data as $key => $value) {
        $sig .= "$key=$value";
    }

    $sig .= 'c1e620fa708a1d5696fb991c1bde5662';
    // $sig .= '62f8ce9f74b12f84c123cc23437a4a32';
    $sig = md5($sig);
    $data['sig'] = $sig;

    return file_get_contents('https://api.facebook.com/restserver.php?' . http_build_query($data));
}