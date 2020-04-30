<div class="container">
  <div class="content content-title">
    <h2>Polling Manager</h2>
  </div>
  <div class="content">
    <a class="tbl-aksi tbl-add" href="<?= BASEURL; ?>/admin/polling/tambah">+ tambah kandidat</a>
    <div class="tabel-responsive">
      <form id="massDelete" style="width:100%" method="POST" action="<?= BASEURL; ?>/admin/polling/massdelete">
        <table class="tabel">

          <thead>
            <tr>
              <th><input type="checkbox" id="btnCheckHapus" onclick="checkAll()"></th>
              <th>No.</th>
              <th>Nama</th>
              <th>Detail</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
              if(!empty($data['polling'])){
                $no = 1;
                foreach($data['polling'] as $poll){

            ?>
            <tr>
              <td width="5%"><input id="checkHapus" type="checkbox" name="hapusK[]" value="<?= $poll['id']; ?>"></td>
              <td><?= $no; ?></td>
              <td><?= $poll['name']; ?></td>
              <td><?= substr($poll['detail'], 0, 90); ?>...</td>
              <td><a class="tbl-aksi tbl-hapus" href="<?= BASEURL . '/admin/polling/hapus/' . $poll['id']; ?>" onclick="return confirm('Yakin akan menghapus?\nIni juga menghapus fotonya');">Hapus</a>&nbsp;
                  <a class="tbl-aksi tbl-edit" href="<?= BASEURL . '/admin/polling/edit/' . $poll['id']; ?>">Edit</a>
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
