<?php

require '../model/Dbh.php';
require '../model/Settings.php';

$db = new Settings();

$ylsid = $_POST['ylsid'];
$studtype = $_POST['studtype'];
$section = $_POST['section'];

$db->update_year_level_section($ylsid, $studtype, $section);