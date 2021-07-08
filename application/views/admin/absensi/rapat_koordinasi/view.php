<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Absensi dan Notulensi Rapat Koordinasi DPM Vokasi UB</h1>
<p class="mb-4">Berikut merupakan notulensi dan absensi kegiatan Rapat Koordinasi DPM Vokasi Universitas Brawijaya.</p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Masukkan data sesuai ketentuan</h6>
    </div>
    <div class="card-body">
                <button class="btn btn-primary"data-toggle="modal" data-target="#modal-tambah"><i class="fa fa-plus"></i> Tambah Data</button>
               <br><br>
        <div id="tampil">
        </div>
    </div>
</div>
<div class="modal fade" id="modal-tambah">
          <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Tambah Data Rakor</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id="form-tambah">
            <input type="hidden" name="id"/>
            <div class="col-lg-12">
                <div class="form-group">
                    <label for="id_admin">ID admin</label>
                    <!-- bagian foreavh di bawah digunakan untuk mendapatkan data penomoran-->
                    <select class="form-control select2" name="id_admin" required id="id_admin">
                    <?php foreach($admin as $row) : ?>
                      <option value="<?php echo $row->id ?>"><?php echo $row->nama ?></option>
                     <?php endforeach ?>
                  </select>
                </div>
                <div class="form-group">
                    <label for="nama">Agenda</label>
                    <input type="text" class="form-control" autocomplete="off" name="nama" placeholder="Masukkan agenda rabes">
                </div>
                <div class="form-group">
                    <label for="link">Notulensi</label>
                    <input type="text" class="form-control" autocomplete="off" name="notulen" placeholder="Masukkan Notulensi">
                </div>
                <div class="form-group">
                    <label for="tanggal">Tanggal Rakor</label>
                    <input type="date" class="form-control" autocomplete="off" name="tanggal" placeholder="Masukkan Tanggal Rabes">
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