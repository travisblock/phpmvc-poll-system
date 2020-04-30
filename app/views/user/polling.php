<div class="header">
  <h2><?= $data['name']; ?></h2>
  <label for="click" class="close">
    <svg height="30px" viewBox="0 0 365 365" width="30px" xmlns="http://www.w3.org/2000/svg"><path d="m243.1875 182.859375 113.132812-113.132813c12.5-12.5 12.5-32.765624 0-45.246093l-15.082031-15.082031c-12.503906-12.503907-32.769531-12.503907-45.25 0l-113.128906 113.128906-113.132813-113.152344c-12.5-12.5-32.765624-12.5-45.246093 0l-15.105469 15.082031c-12.5 12.503907-12.5 32.769531 0 45.25l113.152344 113.152344-113.128906 113.128906c-12.503907 12.503907-12.503907 32.769531 0 45.25l15.082031 15.082031c12.5 12.5 32.765625 12.5 45.246093 0l113.132813-113.132812 113.128906 113.132812c12.503907 12.5 32.769531 12.5 45.25 0l15.082031-15.082031c12.5-12.503906 12.5-32.769531 0-45.25zm0 0"/></svg>
  </label>
</div>
<div class="isi">
  <img class="foto-kandidat" src="<?= BASEURL . '/public/img/' . $data['img']; ?>" style="max-width:250px">
  <p><?= $data['detail']; ?></p>
  <form method="post" action="<?= BASEURL; ?>/polling/pilih">
    <input type="hidden" name="idPoll" value="<?= $data['id']; ?>">
    <div class="submit-group">
      <input type="submit" class="submit-btn" value="pilih">
      <div class="gap"></div>
      <label for="click" class="close-btn" >Close</label>
    </div>
  </form>
</div>
