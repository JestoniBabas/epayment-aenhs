<?php

require '../model/Dbh.php';
require '../model/Settings.php';

$pid = $_POST['pid'];
$payment_for = $_POST['payment_for'];
$payment_val = $_POST['payment_val'];

$db = new Settings();

$db->update_contributions($pid, $payment_for, $payment_val);

