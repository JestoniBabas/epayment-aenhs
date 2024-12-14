<?php

require '../model/Dbh.php';
require '../model/Settings.php';

$studtype = $_POST['studtype'];
$section = $_POST['section'];

$db = new Settings();

$db->set_yr_sections($studtype, $section);
