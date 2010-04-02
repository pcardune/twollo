{include file='header.tpl'}

<h1 id="title">
  <span><a href="{$smarty.get.user}">{$smarty.get.user}</a></span>
  &amp;
  <span><a href="{$smarty.get.other}">{$smarty.get.other}</a></span>
</h1>

<div id="results">
  <div class="block">
    <h2>Friends in Common</h2>
    <div>{$commonFriendsCount}</div>
  </div>

  <div class="block">
    <h2>Followers in Common</h2>
    <div>{$commonFollowersCount}</div>
  </div>
  <div>
    <a class="button" href="index.php">Again!</a>
  </div>
</div>
{include file='footer.tpl'}
