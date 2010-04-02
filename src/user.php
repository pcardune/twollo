<?php
require_once "base.inc.php";
require_once "models/user.inc.php";
require_once "HTTP.php";

if ($_POST['other']){
  HTTP::redirect("$_GET[user]+$_POST[other]");
  exit;
}

$user = Twollo_User::lookup_c($_GET['user']);
//var_dump($user->to_array());

$smarty->assign('user',$user->to_array());
$smarty->display('user.tpl');


//  print '<pre>'; var_dump($commonFriendIds); print '</pre>';

?>
