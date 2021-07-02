<table id="surat_masuk" class="table table-bordered table-striped">
    <thead>
        <tr>
                        <th>No</th>
                        <th>Nama pengirim</th>
                        <th>Nama Kegiatan</th>
                        <th>Link</th>
                        <th>Tanggal kegiatan</th>
                        <th>Aksi</th>
                    </tr>
    </thead>
    <tbody>
        <?php $no = 1; ?>
        <?php foreach($surat_masuk->result() as $result) : ?>
        <tr>
            <td><?php echo $no++ ?></td>
            <td><?php echo $result->nama_pengirim ?></td>
            <td><?php echo $result->jenis_kegiatan ?></td>
            <td><?php echo $result->link ?></td>
            <td><?php echo $result->tanggal ?></td>
            <td class="text-center">
                <i class="btn btn-xs btn-primary fa fa-edit edit-data" data-id="<?php echo $result->id ?>" data-placement="top" title="Edit"></i>
                <i class="btn btn-xs btn-danger fas fa-trash-alt hapus-data" data-id="<?php echo $result->id ?>" data-placement="top" title="Delete"></i>
            </td>
        </tr>
        <?php endforeach;?>
    </tbody>
</table>
      <div class="modal fade" id="modal-edit">
          <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edit Data Berkas Proposal</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id="form-edit-surat_masuk">
            <input type="hidden" name="id"/>
            <div class="col-lg-12">
                <div class="form-group">
                    <label for="nomor">Nama Pengirim</label>
                    <input type="text" class="form-control" autocomplete="off" name="nama_pengirim" placeholder="Masukkan Nomor Proposal">
                </div>
                <div class="form-group">
                    <label for="nama_kegiatan">Nama Kegiatan</label>
                    <input type="text" class="form-control" autocomplete="off" name="jenis_kegiatan" placeholder="Masukkan Nama Kegiatan">
                </div>
                <div class="form-group">
                    <label for="link">Link Drive surat</label>
                    <input type="text" class="form-control" autocomplete="off" name="link" placeholder="Masukkan Link drive Proposal">
                </div>
                <div class="form-group">
                    <label for="tanggal_kegiatan">Tanggal Kegiatan</label>
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
        <!-- /.modal-dialog -->
      </div>

<script>
  //Menampilkan data diedit
    modal_edit = $("#modal-edit");
    $(".edit-data").click(function(e) {
      id = $(this).data('id');
      $.ajax({
        url: '<?=site_url('surat_masuk/get_by_id')?>',
        type: 'GET',
        dataType: 'json',
        data: {id: id},
      })
      .done(function(data) {
        $("#form-edit-surat_masuk input[name='id']").val(data.object.id);
        $("#form-edit-surat_masuk input[name='nama_pengirim']").val(data.object.nama_pengirim);
        $("#form-edit-surat_masuk input[name='jenis_kegiatan']").val(data.object.jenis_kegiatan);
        $("#form-edit-surat_masuk input[name='link']").val(data.object.link);
        $("#form-edit-surat_masuk input[name='tanggal']").val(data.object.tanggal);
        modal_edit.modal('show').on('shown.bs.modal', function(e) {
          $("#form-edit-surat_masuk input[name='id']").focus();
        });
      });
    });
    //Proses Update ke Db
    $("#form-edit-surat_masuk").submit(function(e) {
    e.preventDefault();
    form = $(this);
    $.ajax({
      url: '<?=site_url('surat_masuk/crud/update')?>',
      type: 'POST',
      dataType: 'json',
      data: form.serialize(),
      success: function(data){ 
        form[0].reset();
        alert('success!');
        modal_edit.modal('hide');
        $('#surat_masuk').DataTable().clear().destroy();
        refresh_table();
      },
      error: function(response){
          alert(response);
      }
     })
    });
    $(".hapus-data").click(function(e) {
      e.preventDefault();
      id = $(this).data('id');
      if (confirm("Anda yakin menghapus data ini?")) {
        $.ajax({
          url: '<?=site_url('surat_masuk/crud/delete')?>',
          type: 'POST',
          dataType: 'json',
          data: {id: id},
          success: function(data){ 
          $('#surat_masuk').DataTable().clear().destroy();
          refresh_table();
          },
          error: function(response){
          alert(response);
          }
        })
      }
    });
    
</script>