<div class="container">
  <div class="content content-title">
    <h2>User Manager</h2>
  </div>
  <div class="content">
    <a class="tbl-aksi tbl-add" href="<?= BASEURL; ?>/admin/userman/tambah">+ tambah user</a>
    <div class="tabel-responsive">
      <form id="massDelete" style="width:100%" method="POST" action="<?= BASEURL; ?>/admin/userman/massdelete">
        <table class="tabel">
          <thead>
            <tr>
              <th width="5%"><input type="checkbox" id="btnCheckHapus" onclick="checkAll()"></th>
              <th width="10%">No.</th>
              <th width="45%">Username</th>
              <th width="20%">Status</th>
              <th width="20%">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
              if(!empty($data['user'])){
                $no = 1;
                foreach($data['user'] as $user){

            ?>
            <tr class="<?php echo ($user['sudah'] > 0) ? 'sudah' : "belum" ?>" >
              <td width="5%"><input id="checkHapus" type="checkbox" name="hapusU[]" value="<?= $user['id']; ?>"></td>
              <td width="10%"><?= $no; ?></td>
              <td width="45%"><?= $user['username']; ?></td>
              <td width="20%"><?php echo ($user['sudah'] > 0) ? 'Sudah' : "Belum" ?></td>
              <td width="20%"><a class="tbl-aksi tbl-hapus" href="<?= BASEURL . '/admin/userman/hapus/' . $user['id']; ?>" onclick="return confirm('Yakin akan menghapus user ?')">Hapus</a>&nbsp;
                  <a class="tbl-aksi tbl-edit" href="<?= BASEURL . '/admin/userman/edit/' . $user['id']; ?>">Edit</a>
              </td>
            </tr>
            <?php
                $no++;
                }
              }
            ?>
          </tbody>
        </table>
        <input type="submit" class="tbl-aksi tbl-del" value="Mass Delete">
      </form>
    </div>
  </div>

</div>
