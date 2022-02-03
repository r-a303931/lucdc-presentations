<?php
    if (empty($_POST['hmac']) || empty($_POST['host'])) {
        header('HTTP/1.0 400 Bad Request');
        echo "\r\n\r\nNo; bad (400)";
        exit;
    }

    $secret = getenv("SECRET");

    if (isset($_POST['nonce']))
        $secret = hash_hmac('sha256', $_POST['nonce'], $secret);

    $hmac = hash_hmac('sha256', $_POST['host'], $secret);

    if ($hmac !== $_POST['hmac']) {
        header('HTTP/1.0 403 Forbidden');
        echo "\r\n\r\nNo; bad (403)";
        exit;
    }

    echo "\r\n";
    echo "\r\n";

    echo passthru("host ".$_POST['host']);
