<?php if(!empty($data['preview'])){?>
<div  class="content">
    <?php
    if($data['E_ALL'] > 0){
      echo "<div id='adaError'>Error: Ada data yang kosong</div>";
    }
    ?>
    <h2 class="preview-title">Preview</h2>
    <h5 style="text-align:center">Total Data : <?= $data['total']; ?></h5>
  <div class="tabel-responsive" >
    <table class="tabel" style="width:auto;min-width:420px">
      <thead>
        <tr>
          <th width="20%">No.</th>
          <th width="40%">Username</th>
          <th width="40%">Password</th>
        </tr>
      </thead>
      <tbody>
        <?php
          for($i  = 1;$i < count($data['preview']);$i++){
            $err  = "style='background:#d94447'";
            $user = (!empty($data['preview'][$i][0])) ? "" : $err;
            $pass = (!empty($data['preview'][$i][1])) ? "" : $err;
        ?>
            <tr>
              <td width="20%"><?= $i; ?></td>
              <td <?= $user; ?> width="40%"><?= $data['preview'][$i][0]; ?></td>
              <td <?= $pass; ?> width="40%"><?= $data['preview'][$i][1]; ?></td>
            </tr>

        <?php
          }
        ?>
      </tbody>
    </table>
  </div>
</div>
<?php } ?>
