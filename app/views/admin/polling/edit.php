<div class="container">
  <div class="content">
    <form class="" action="<?= BASEURL; ?>/admin/polling/edit/1" method="post">
      <?php if(!empty($data['kandidat'])){?>
      <input type="text" name="nama" value="<?= $data['kandidat']['name']; ?>">
      <input type="text" name="detail" value="<?= $data['kandidat']['detail']; ?>">
      <input type="submit" value="submit">
    <?php } ?>
    </form>
  </div>
</div>
