<?php
session_start();

require_once "encrypt.php";

header('Content-Type: text/html; charset=utf-8');

if(!isset($_SESSION['money'])) {
    $_SESSION['money'] = 100;
}

$money = $_SESSION['money'];

$goods = array(
    '1' => 10,
    '2' => 15,
    '3' => 100,
    '4' => 1000
);

if(!empty($_GET['action']) && $_GET['action'] === 'buy' &&
    !empty($_POST['goods'])) {
    if(in_array($_POST['goods'], array('1', '2', '3', '4'))) {
        header('Location: /buy.php?payment='.encrypt($_POST['goods'].'||'.$_POST['message'].'||'.$goods[$_POST['goods']]));
        exit(0);
    } else {
        $error_message = '没有这个货物';
        require_once 'tpl/index.php';
    }
}

require_once 'tpl/index.php';