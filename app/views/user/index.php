<div class="row-center">
  <h1><?= $data['view']['judul_web']; ?></h1>
</div>
<div class="heading-2">
  <h2 class="border-bottom"><?= $data['view']['judul_voting']; ?></h2>
</div>
<div class="row-box" id="pollData">
  <?php
  foreach($data['poll'] as $key){
  ?>
  <div class="pool-card">
    <h3><?= $key['name']; ?></h3>
    <span class="text-suara"><?= $key['value']; ?> suara</span>
    <div class="pool-bar">
      <span class="span1">
        <span class="span2" style="width:<?= $key['value']; ?>%">
          <span class="span3"><?= $key['value']; ?>&nbsp;Suara</span>
        </span>
      </span>
    </div>
    <div class="tombol">
      <label for="click" class="button detailBtn" data-id="<?= $key['id']; ?>">Detail</label>
    </div>
  </div>
  <?php
  }
  ?>
</div>


<input type="checkbox" id="click">
<div class="modal-content" id="pollDetail">

</div>
