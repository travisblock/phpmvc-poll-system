<div class="container">
  <div class="content content-title">
    <h2>Polling Manager</h2>
  </div>
  <div class="content">
    <a class="tbl-aksi tbl-add" href="<?= BASEURL; ?>/admin/polling/tambah">+ tambah kandidat</a>
    <div class="tabel-responsive">
      <table class="tabel">

        <thead>
          <tr>
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
    </div>
  </div>

</div>
