<div class="container">
  <div class="content content-title">
    <h2>Polling Manager</h2>
  </div>
  <div class="content">
    <form id="massDelete" style="width:100%" method="POST" action="<?= BASEURL; ?>/admin/polling/massdelete">
      <a class="tbl-aksi tbl-add" href="<?= BASEURL; ?>/admin/polling/tambah">+ tambah kandidat</a>
      <input type="submit" class="tbl-aksi tbl-del" onclick="return confirm('Yakin akan menghapus user secara massal ?')" value="Mass Delete">
      <div class="tabel-responsive">
        <table class="tabel">
          <thead>
            <tr>
              <th width="5%"><input type="checkbox" id="btnCheckHapus" onclick="checkAll()"></th>
              <th width="5%">No.</th>
              <th width="25%">Nama</th>
              <th width="50%">Detail</th>
              <th width="15%">Action</th>
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
              <td width="5%"><?= $no; ?></td>
              <td width="25%"><?= $poll['name']; ?></td>
              <td width="50%"><?= substr($poll['detail'], 0, 90); ?>...</td>
              <td width="15%"><a class="tbl-aksi tbl-hapus" href="<?= BASEURL . '/admin/polling/hapus/' . $poll['id']; ?>" onclick="return confirm('Yakin akan menghapus?\nIni juga menghapus fotonya');">Hapus</a>&nbsp;
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
      </div>
    </form>
  </div>

</div>
