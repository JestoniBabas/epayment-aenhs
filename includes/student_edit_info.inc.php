<?php

require '../model/Dbh.php';
require '../model/Students.php';

$studid = $_POST['studid'];
$lrn = $_POST['lrn'];
$fname = strtoupper($_POST['fname']);
$mname = strtoupper($_POST['mname']);
$lname = strtoupper($_POST['lname']);
$xname = strtoupper($_POST['xname']);
$sex = strtoupper($_POST['sex']);

$db = new Students();

$db->editStudentInfo($studid, $lrn, $fname, $mname, $lname, $xname, $sex);