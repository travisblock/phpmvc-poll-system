<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login / Register</title>
    <link rel="stylesheet" href="<?= BASEURL; ?>/public/css/style-login.css">
  </head>
  <body>
    <div class="content">
      <div class="heading">
        <div class="signin border" id="signin">Signin</div>
        <div class="login" id="login">Login</div>
      </div>
        <div class="signinform" id="signinform">
          <form method="post" action="<?= BASEURL; ?>/user/register">
            <input type="text" class="input" placeholder="Username" name="user">
            <input type="email" class="input" placeholder="email" name="email">
            <input type="password" class="input" placeholder="password" name="pass">
            <input type="submit" class="submit" value="SignIn">
          </form>
        </div>

        <div class="loginform hide" id="loginform" >
          <form method="post" action="<?= BASEURL;?>/user/login">
            <input type="text" name='user' class="input" placeholder="username">
            <input type="password" name='pass' class="input" placeholder="password">
            <span class="lupa"><a href="#">Forgot Password</a></span>
            <input type="submit" class="submit" value="Login">
          </form>
        </div>
    </div>

  <script type="text/javascript" src="<?= BASEURL; ?>/public/js/script-login.js">


  </script>
</body>
</html>
