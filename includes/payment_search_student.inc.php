<?php

require '../model/Dbh.php';
require '../model/Students.php';

$lrn = $_POST['lrn'];

$db = new Students();

$db->search_student($lrn);
