<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Page</title>
    <link rel="stylesheet" href="<?= BASEURL; ?>/public/css/style_admin.css">
  </head>
  <body>
    <div class="container-luar">
      <div class="container-login" id="container">
        <div class="form-container sigin-container">
          <form method="post" action="<?= $data['action_login']; ?>">
            <div class="err-place">
              <?= Msg::show(); ?>
            </div>
            <h1>Login Account</h1>
            <span>Use username and password</span>
            <input type="text" name="username" placeholder="username">
            <input type="password" name="password" placeholder="password">
            <a class="forgot" href="<?= BASEURL; ?>/admin/forgotPass">Forgot your password</a>
            <button class="tombol" type="submit">Login</button>
          </form>
        </div>
        <div class="overlay-container">
          <div class="overlay">
            <div class="overlay-panel">
              <h1>Hello Friend</h1>
              <p class="p">Enter your Username and Password to Login</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script>
        window.setTimeout(function(){
          var msg = document.getElementById('msg');
          if(msg !== null)
            msg.classList.toggle('hide');
        }, 3000);

        window.setTimeout(function(){
          var msg = document.getElementById('msg');
          if(msg !== null)
            msg.remove();
        }, 4000);
    </script>
  </body>
</html>
