<div class="container">
  <div class="content">

    <?php if(!empty($data['user'])){?>
    <form class="" action="<?= BASEURL; ?>/admin/userman/edit/<?= $data['user']['id']; ?>" method="post">
      <input type="text" name="username" value="<?= $data['user']['username']; ?>">
      <input type="text" name="pass">
      <input type="submit" value="submit">
    </form>

  <?php } ?>
  </div>
</div>
