<?php

$lrn = $_POST['lrn'];

require '../model/Dbh.php';
require '../model/Payments.php';

$db = new Payments();

$db->search_student_lrn($lrn);




