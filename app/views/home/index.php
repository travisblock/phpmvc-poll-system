<div class="row-center">
  <h1 class="border-bottom"><?= $data['view']['judul_voting']; ?></h1>
</div>


<div class="row-box">
  <?php
  if(!empty($data)){
  foreach($data['poll'] as $key){
  ?>
  <div class="pool-card">
    <h3><?= $key['name']; ?></h3>
    <span class="text-suara"><?= $key['value']; ?> suara</span>
    <div class="pool-bar">
      <span class="span1">
        <span class="span2" style="width:<?= $key['value']; ?>%">
          <span class="span3"><?= $key['value']; ?>%</span>
        </span>
      </span>
    </div>
  </div>

  <?php
  }
  }
  ?>
</div>
