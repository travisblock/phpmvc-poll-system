<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reset Password</title>
    <link rel="stylesheet" href="<?= BASEURL; ?>/public/css/style_admin.css">
  </head>
  <body>
    <div class="container-luar">
      <div class="container-login-s" id="container">
        <div class="form-container sigin-container">
          <form method="post" action="<?= BASEURL .'/admin/resetPass/'.$data['ses_code']; ?> ">
            <div class="err-place">
              <?= Msg::show(); ?>
            </div>
            <h1>Reset Password</h1>
            <span></span>
            <input type="password" name="pass" placeholder="New password">
            <a class="forgot" href="#"></a>
            <button class="tombol" type="submit">Submit</button>
          </form>
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
