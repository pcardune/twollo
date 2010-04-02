<?php
require_once "base.inc.php";
require_once "models/user.inc.php";
require_once "HTTP.php";

$smarty->assign('user',$_GET['user']);
$smarty->assign('other',$_GET['other']);


function getUser(){
  $user = $_GET['user'];
  if ($user){
    $_SESSION['user'] = $user;
  } else {
    $user = $_SESSION['user'];
  }
  return $user;
}

if ($_POST['user'] && $_POST['other']){
  HTTP::redirect("u/$_POST[user]+$_POST[other]");
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

  $user_obj = Twollo_User::lookup_c($user);
  $other_obj = Twollo_User::lookup_c($other);

  $commonFriendIds = array_intersect($user_obj->get_friend_ids(),
                                     $other_obj->get_friend_ids());
  $commonFollowerIds = array_intersect($user_obj->get_follower_ids(),
                                       $other_obj->get_follower_ids());
//  print '<pre>'; var_dump($commonFriendIds); print '</pre>';

  $smarty->assign('commonFriendsCount',count($commonFriendIds));
  $smarty->assign('commonFollowersCount',count($commonFollowerIds));

  $smarty->display('result.tpl');
} else {
  $smarty->display('form.tpl');
}

?>
