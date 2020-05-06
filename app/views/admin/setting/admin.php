<div class="container">
  <div class="content content-title">
    <h2>Admin Setting</h2>
  </div>
  <div class="content">
    <div class="form-bungkus">
      <form class="form-group" method="POST" action="<?= BASEURL; ?>/admin/setting/admin">
        <div class="input-group">
          <span>Username</span>
          <input type="text" name="user" value="<?= $data['admin']['user']; ?>">
        </div>

        <div class="input-group">
          <span>Password</span>
          <input type="password" name="pass" value="">
        </div>

        <div class="input-group">
          <span>Email</span>
          <input type="email" name="email" value="<?= $data['admin']['email']; ?>">
        </div>
        <div class="input-group-btn">
          <input class="btn submit" type="submit" value="Save">
          <button class="btn close" onClick='history.back();'> Batal </button>
        </div>
      </form>
    </div>
  </div>
</div>
