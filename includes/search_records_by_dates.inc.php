<?php

session_start();

$d_from = $_POST['d_from'];
$d_to = $_POST['d_to'];

require '../model/Dbh.php';
require '../model/Payments.php';

$db = new Payments();

$data = $db->search_records_dates($d_from, $d_to);

if($data === "0"){
    echo "empty";
    die();
}

$_SESSION['data'] = $data;
$_SESSION['d_from'] = $d_from;
$_SESSION['d_to'] = $d_to;

header("Location:../views/print.view.php");