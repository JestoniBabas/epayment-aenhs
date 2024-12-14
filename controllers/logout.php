<?php

session_start();
session_destroy();
$stm = null;
$q = null;
$db = null;

header("Location:../index.php?logout=success");