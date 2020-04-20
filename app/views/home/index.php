<div class="row-center">
  <h1 class="border-bottom">Polling</h1>
</div>


<div class="row-box">
  <?php
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
  ?>

  <!-- <div class="pool-card">
    <h3>CodeIgniter</h3>
    <span class="text-suara">30 suara</span>
    <div class="pool-bar">
      <span class="span1">
        <span class="span2" style="width:30%">
          <span class="span3">30%</span>
        </span>
      </span>
    </div>
  </div>
  <div class="pool-card">
    <h3>Symfony</h3>
    <span class="text-suara">20 suara</span>
    <div class="pool-bar">
      <span class="span1">
        <span class="span2" style="width:20%">
          <span class="span3">20%</span>
        </span>
      </span>
    </div>
  </div> -->
</div>
