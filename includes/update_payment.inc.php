<?php
session_start();
$studid = $_POST['studid'];
$studname = $_POST['studname'];
$teacher = $_POST['teacher'];
$payment_for = $_POST['payment_for'];
$studtype = $_POST['studtype'];
$section = $_POST['section'];
$paymentid = $_POST['paymentid'];
$lrn = $_POST['lrn'];
$payment_val = $_POST['payment_val'];
$payment_bal = $_POST['payment_bal'];
$nonteaching = $_SESSION['fullname'];


if($payment_val > $payment_bal){
    header("Location:../controllers/payment_history.php?query=overpay");
} else {
    require '../model/Users.php';
    require '../model/Payments.php';
    require '../model/Notifications.php';

    $bal = $payment_bal - $payment_val;

    $data = new Users();
    $db = new Payments();
    $alert = new Notifications();

    $db->update_payment_info($paymentid, $lrn, $bal);
    $rr = $data->get_teacher_uid($teacher, $studtype, $section);
    
     $icon = "update_payment.png";
    $notification = "Your student ".$studname." pay the ".$payment_for." amounting to ".$payment_val." balance of ".$bal." and was updated by ".$nonteaching;
    $alert->insert_notifications($rr['uid'], $icon, $notification);

    //notify admin
    $row = $alert->getAdminUid();

    $notification = "Student ".$studname." ".$studtype.", section ".$section." paid the ".$payment_for." amounting to ".$payment_val." balance of ".$bal." and was received by ".$nonteaching;
    $alert->insert_notifications($row['uid'], $icon, $notification);

    header("Location:../controllers/payment_history.php?query=$lrn");
}