{include file='header.tpl'}

<h1 id="title">
  <span><a href="http://twitter.com/{$user.screen_name}" target="_blank">{$user.screen_name}</a></span>
</h1>

<form method="POST">
  <div class="block">
    <h2>Your Twitter Username</h2>
    <div>
      <input type="text" name="other"/>
    </div>
  </div>
  <div>
    <button>Find Common Friends</a>
  </div>
</form>

{include file='footer.tpl'}
