<?php
$logo = "logo.png";
ini_set("display_errors", 1);
$titulo    = "Tony Almazan";
$path      = '/home4/tonyalma/public_html/';
$url_master = 'https://tonyalmazan.com/';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

error_reporting(E_ALL);
error_reporting(0);
ini_set("memory_limit", -1);
/////Formato fecha
$sdt = date("Y-m-d H:i:s");
$stz = new DateTimeZone('UTC');
$dtz = date_default_timezone_set('America/Mexico_City');
$dt  = new DateTime($sdt, $stz);
//$dt->setTimeZone($dtz);
$hora_actual = $dt->format('Y-m-d H:i:s');
?>