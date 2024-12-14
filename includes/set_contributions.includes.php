<?php

require '../model/Dbh.php';
require '../model/Settings.php';

$payment_for = $_POST['payment_for'];
$payment_val = $_POST['payment_val'];

$db = new Settings();

$db->set_contributions($payment_for, $payment_val);