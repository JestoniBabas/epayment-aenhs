<?php
session_start();
require '../model/Dbh.php';
require '../model/Payments.php';
require '../model/Notifications.php';

$uid = $_POST['uid'];
$studid = $_POST['studid'];
$studtype = $_POST['studtype'];
$section = $_POST['section'];
$studname = $_POST['studname'];
$teacher = $_POST['teacher'];
$payment_for = $_POST['payment_for'];
$payment_val = $_POST['payment_val'];
$lrn = $_POST['lrn'];

$nonteaching = $_SESSION['fullname'];

$db = new Payments();

$stm = $db->insert_payment($lrn, $studid, $studname, $studtype, $section, $teacher, $payment_for, $payment_val);

if($stm !== false){
    
    $alert = new Notifications();
    $icon = "pay.png";
    $notification = "Your student ".$studname." pay the ".$payment_for." amounting to ".$payment_val." and received by ".$nonteaching;
    $alert->insert_notifications($uid, $icon, $notification);

    //notify admin
    $row = $alert->getAdminUid();

    $notification = "Student ".$studname." ".$studtype.", section ".$section." paid the ".$payment_for." amounting to ".$payment_val." and received by ".$nonteaching;
    $alert->insert_notifications($row['uid'], $icon, $notification);
    

    header("Location:../controllers/payments.php?payment=success");
} else {
    header("Location:../controllers/payments.php?payment=failed");

}
