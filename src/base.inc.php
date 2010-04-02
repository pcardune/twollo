<?php
require_once("libs/Smarty/Smarty.class.php");
require_once "libs/twitter.php";
require_once "Log.php";

$logger = &Log::singleton('file','/var/log/twollo.log', 'TWOLLO');

$memcache = new Memcache();
$memcache->connect('localhost', 11211);
session_start();
$smarty = new Smarty();
$smarty->template_dir = 'templates';
$smarty->compile_dir = 'templates_c';
$smarty->assign('MEDIA_ROOT', '/twollo');

$twitter = new Twitter("pcardune", "cardusey");


?>
