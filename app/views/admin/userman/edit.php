<?php if(!empty($data['user'])){?>
<div class="container">
  <div class="content content-title">
    <h2>Edit User</h2>
  </div>
  <div class="content">
    <div class="form-bungkus">
      <form class="form-group" method="POST" action="<?= BASEURL; ?>/admin/userman/edit/<?= $data['user']['id']; ?>">
        <div class="input-group">
          <span>Username</span>
          <input type="text" name="username" placeholder="Username" value="<?= $data['user']['username']; ?>">
        </div>

        <div class="input-group">
          <span>Password</span>
          <input type="password" name="pass" placeholder="Password">
        </div>

        <div class="input-group-btn">
          <input class="btn submit" type="submit" value="Submit">
          <a class="btn close" onClick='history.back();'> Batal </a>
        </div>
      </form>
    </div>
  </div>
</div>
<?php } ?>
