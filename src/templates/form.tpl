{include file='header.tpl'}

<h1 id="title">Twollo</h1>
<p>Find your common followers!</p>
<form method="POST">
  <div class="block">
    <h2>Your Twitter Username:</h2>
    <input type="text" name="user" spellcheck="false" value="{$user}"/>
  </div>

  <div class="block">
    <h2>The Twitter username of the person trying to follow you:</h2>
    <input type="text" name="other" spellcheck="false"/>
  </div>

  <div>
    <button type="submit">Who do we follow in common?</button>
  </div>
</form>

{include file='footer.tpl'}
