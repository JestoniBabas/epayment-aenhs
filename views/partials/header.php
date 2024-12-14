<?php
session_start();
$title = parse_url($_SERVER['REQUEST_URI'])['path'];

$getLasturl = explode("/", $title);
$lastUrl = end($getLasturl);
$targetName = explode(".php", $lastUrl);

$locName = $targetName[0];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?= $locName; ?></title>
      <meta charset="utf-8"/>
      <meta name="viewport" content="width=device-width, initial-scale=1"/>
      <link rel="stylesheet" type="text/css" href="../css/glyphicons.css"/>
      <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css"/>
      <link rel="stylesheet" type="text/css" href="../css/app.css"/>
      <link rel="icon" href="../images/logo.png"/>
</head>
<body>
<div id="ajaxInnerCover">
  <div id="ajaxOuterCover"></div>
</div>
