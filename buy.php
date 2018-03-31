<?php
session_start();

include_once 'encrypt.php';

header('Content-Type: text/html; charset=utf-8');

echo "<script>";

if (!empty($_GET['payment']) && ($payment = decrypt($_GET['payment']))) {
    $data = explode('||', $payment);

    if (count($data) != 3 || intval($data[2]) > $_SESSION['money']) {
        echo "alert('failed!');";
    } else {
        $_SESSION['money'] -= intval($data[2]);
        if ($data[0] === '4') {
        	// this is a fake flag
        	// but you can read flag from here in challenge env
            echo "alert('BUPT{read_flag_from_here}');";
        }
        echo "alert('success!');";
    }
}

echo "location.href='/index.php';";
    
echo "</script>";