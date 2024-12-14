<?php

session_start();
require '../model/Dbh.php';
require '../model/Students.php';

$lrn = strtoupper($_POST['lrn']);
$fname = strtoupper($_POST['fname']);
$mname = strtoupper($_POST['mname']);
$lname = strtoupper($_POST['lname']);
$xname = $_POST['xname'];
if(empty($xname)){
    $xname = "-";
} else {
    $xname = strtoupper($_POST['xname']);
}
   
$sex = strtoupper($_POST['sex']);


$db = new Students();

//get year level
$data = $db->getTeacherYrlevel($_SESSION['section']);

$studtype = $data['studtype'];

$db->insertStudent($lrn, $fname, $mname, $lname, $xname, $sex, $studtype, $_SESSION['section'], $_SESSION['fullname']);

