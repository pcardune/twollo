{include file='header.tpl'}

<h1>Welcome to Twollow</h1>
<form method="GET">
  <div>
    <label for="user">
      Your Twitter Username:
    </label>
    <input type="text" name="user"/>
  </div>

  <div>
    <label for="other">
      The Twitter username of the person trying to follow you:
    </label>
    <input type="text" name="other"/>
  </div>

  <div>
    <button type="submit">Who do we follow in common?</button>
  </div>
</form>

{include file='footer.tpl'}
