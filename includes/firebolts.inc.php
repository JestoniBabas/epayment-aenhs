<?php

session_start();
require '../model/Dbh.php';
require '../model/Students.php';
require '../model/Settings.php';

$students = new Students();
$settings = new Settings();

$stud_data = $students->getAllStudents();
$sy_data = $settings->get_sy();

//fetch and insert
foreach($stud_data as $row){
    $students->insertStudentsRecord($row['lrn'], $row['fname'], $row['mname'], $row['lname'], $row['xname'], $row['sex'], $row['studtype'], $row['section'], $row['teacher'], $sy_data['sy_from'], $sy_data['sy_to']);
}
//then delete
foreach($stud_data as $row){
    $students->deleteStudentsRecord($row['studid']);
}



header("Location:../controllers/settings.php?success");