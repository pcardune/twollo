<?php
require_once "libs/twitter.php";

class Twollo_User{
  public $raw;

  public static function lookup($id){
    global $twitter;
    $r = new Twollo_User();
    $r->raw = $twitter->getUser($id);
    return $r;
  }

  public static function lookup_c($id){
    global $memcache;
    $key = "user-$id";
    $r = $memcache->get($key);
    if (!$r){
      $r = Twollo_User::lookup($id);
      $memcache->set($key, $r);
    }
    return $r;
  }

  public function to_array(){
    return $this->raw;
  }

  public function get_id(){
    return $this->raw['id'];
  }

  public function get_screen_name(){
    return $this->raw['screen_name'];
  }

  public function get_name(){
    return $this->raw['name'];
  }

  function get_follower_ids(){
    global $twitter;
    return $twitter->getFollowerIds($this->get_id());
  }

  function get_followers_ids_c(){
    global $memcache, $twitter;
    $user = $this->get_id();
    $key = "followers-{$user}";
    $result = $memcache->get($key);
    if (!$result){
      $result = $this->get_follower_ids();
      $memcache->set($key, $result);
    }
    return $result;
  }

  function get_friend_ids(){
    global $twitter;
    return $twitter->getFriendIds($this->get_id());
  }

  function get_friends_ids_c(){
    global $memcache, $twitter;
    $user = $this->get_id();
    $key = "friends-{$user}";
    $result = $memcache->get($key);
    if (!$result){
      $result = $this->get_friend_ids();
      $memcache->set($key, $result);
    }
    return $result;
  }

  function get_friends(){
    global $twitter;
    return $twitter->getFriends($this->get_id());
  }

  function get_friends_c(){
    global $memcache, $twitter;
    $user = $this->get_id();
    $key = "user-{$user}";
    $result = $memcache->get($key);
    if (!$result){
      $result = $this->get_friends();
      $memcache->set($key, $result);
    }
    return $result;
  }

}

?>