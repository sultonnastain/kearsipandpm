<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Surat Masuk DPM Vokasi UB</h1>
<p class="mb-4">Berikut merupakan kumpulan surat masuk DPM Vokasi Universitas Brawijaya.</p>

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
              <h4 class="modal-title">Tambah Data Surat Masuk</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id="form-tambah">
            <input type="hidden" name="id"/>
            <div class="col-lg-12">
                <div class="form-group">
                    <label for="id_penomoran">Nama Pengirim</label>
                    <input type="text" class="form-control" autocomplete="off" name="nama_pengirim" placeholder="Masukkan nama Pengirim">
                </div>
                <div class="form-group">
                    <label for="nama_kegiatan">Nama Kegiatan</label>
                    <input type="text" class="form-control" autocomplete="off" name="jenis_kegiatan" placeholder="Masukkan Nama Kegiatan">
                </div>
                <div class="form-group">
                    <label for="link">Link Drive Proposal</label>
                    <input type="text" class="form-control" autocomplete="off" name="link" placeholder="Masukkan Link drive Proposal">
                </div>
                <div class="form-group">
                    <label for="link">Tanggal Kegiatan</label>
                    <input type="date" class="form-control" autocomplete="off" name="tanggal" placeholder="Masukkan Tanggal Kegiatan">
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