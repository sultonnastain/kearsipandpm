<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Pengelolaan akun admin DPM Vokasi UB</h1>
<p class="mb-4">Berikut merupakan halaman pebgelolaan admin website kearsipan DPM Vokasi Universitas Brawijaya.</p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Masukkan data sesuai ketentuan</h6>
    </div>
    <div class="card-body">
                <button class="btn btn-primary"data-toggle="modal" data-target="#modal-tambah"><i class="fa fa-plus"></i> Tambah Data</button>
                <button class="btn btn-warning"data-toggle="modal" data-target="#modal-upload"><i class="fa fa-file-import"></i> Import Excel</button>
                <button class="btn btn-danger"data-toggle="modal" data-target="#modal-multiple"><i class="fa fa-file-upload"></i> Upload Multiple Foto</button>
               <br><br>
        <div id="tampil">
        </div>
    </div>
</div>
<div class="modal fade" id="modal-tambah">
          <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Tambah Data admin</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id="form-tambah">
            <input type="hidden" name="id"/>
            <div class="col-lg-12">
                <div class="form-group">
                    <label for="nomor">Nama</label>
                    <input type="text" class="form-control" autocomplete="off" name="nama" placeholder="Masukkan Nama admin">
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" autocomplete="off" name="username" placeholder="Masukkan Username">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="text" class="form-control" autocomplete="off" name="password" placeholder="Masukkan Password">
                </div>
                <div class="form-group">
                <select class="form-control select2" name="level" id="level" style="width: 100%;">
                    <option value="kabiro">Kabiro</option>
                    <option value="staff">Staff</option>
                    </select>
                  <!-- <select>
                    <label for="Level">Level</label>
                    <select class="form-control select2" name="level" required id="level">
                    <?php foreach($admin as $row) : ?>
                      <option value="<?php echo $row->id ?>"><?php echo $row->level ?></option>
                     <?php endforeach ?>
                  </select> -->
                </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
              <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
            </div>
            </form>
          </div>
          <!-- /.modal-content -->
      </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->