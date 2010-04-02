<?php
require("libs/Smarty/Smarty.class.php");
require_once "Log.php";

include "libs/twitter.php";

$logger = &Log::singleton('file','/var/log/twollo.log', 'TWOLLO');

$memcache = new Memcache();
$memcache->connect('localhost', 11211);
session_start();

$smarty = new Smarty();
$smarty->template_dir = 'templates';
$smarty->compile_dir = 'templates_c';
$smarty->assign('MEDIA_ROOT', '/twollo');
$smarty->assign('user',$user);
$smarty->assign('other',$other);

$twitter = new Twitter("pcardune", "cardusey");

function getFriendIds($user){
  global $memcache, $twitter;
  $key = "friendIds-{$user}";
  $result = $memcache->get($key);
  if (!$result){
    $result = $twitter->getFriendIds($user);
    $memcache->set($key, $result);
  }
  return $result;
}

function getFollowerIds($user){
  global $memcache, $twitter;
  $key = "followerIds-{$user}";
  $result = $memcache->get($key);
  if (!$result){
    $result = $twitter->getFollowerIds($user);
    $memcache->set($key, $result);
  }
  return $result;
}

function getFriends($user){
  global $memcache, $twitter;
  $key = "friends-{$user}";
  $result = $memcache->get($key);
  if (!$result){
    $result = $twitter->getFriends($user);
    $memcache->set($key, $result);
  }
  return $result;
}

function byId($friends){
  $byId = array();
  foreach($friends as $friend){
    $byId[$friend['id']] = $friend;
  }
  return $byId;
}

function getUser(){
  $user = $_GET['user'];
  if ($user){
    $_SESSION['user'] = $user;
  } else {
    $user = $_SESSION['user'];
  }
  return $user;
}

function relativeRedirect($path){
  $host  = $_SERVER['HTTP_HOST'];
  $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
  header("Location: http://$host$uri/$path");
  exit;
}

if ($_POST['user'] && $_POST['other']){
  relativeRedirect("u/$_POST[user]+$_POST[other]");
}

$user = getUser();
$smarty->assign('user', $user);
$other = $_GET['other'];

if (!isset($_SESSION['count'])){
  $_SESSION['count'] = 0;
}
$_SESSION['count']++;


if ($user && $other){
  $logger->log("Finding commonality between $user and $other.", PEAR_LOG_INFO);

  $userFriends = getFriends($user);
  $otherFriends = getFriends($other);

  $commonFriends = array_intersect_key(byId($otherFriends),byId($userFriends));
  $commonFriendIds = array_intersect(getFriendIds($user),getFriendIds($other));
  $commonFollowerIds = array_intersect(getFollowerIds($user),getFollowerIds($other));
//  print '<pre>'; var_dump($commonFriendIds); print '</pre>';

  $smarty->assign('commonFriendsCount',count($commonFriendIds));
  $smarty->assign('commonFollowersCount',count($commonFollowerIds));




  $smarty->display('result.tpl');
} else {
  $smarty->display('form.tpl');
}

?>
