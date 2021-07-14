<table id="surat_keluar" class="table table-bordered table-striped">
    <thead>
        <tr>
                        <th>No</th>
                        <th>penomoran</th>
                        <th>Nama Penerima</th>
                        <th>Nama Kegiatan</th>
                        <th>Link</th>
                        <th>Tanggal kegiatan</th>
                        <th>Aksi</th>
                    </tr>
    </thead>
    <tbody>
        <?php $no = 1; ?>
        <?php foreach($surat_keluar->result() as $result) : ?>
        <tr>
            <td><?php echo $no++ ?></td>
            <td><?php echo $result->penomoran ?></td>
            <td><?php echo $result->nama_dikirim ?></td>
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
              <h4 class="modal-title">Edit Data Surat Keluar</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id="form-edit-surat_keluar">
            <input type="hidden" name="id"/>
            <div class="col-lg-12">
               <div class="form-group">
                    <label for="id_penomoran">penomoran</label>
                    <select class="form-control select2" name="id_penomoran" required id="id_penomoran_edit" style="width: 100%;">
                    <?php foreach($penomoran as $row) : ?>
                      <option value="<?php echo $row->id ?>"><?php echo $row->penomoran ?></option>
                     <?php endforeach ?>
                  </select>
                </div>
                <div class="form-group">
                    <label for="nama_kegiatan">Nama Penerima</label>
                    <input type="text" class="form-control" autocomplete="off" name="nama_dikirim" placeholder="Masukkan Nama Penerima">
                </div>
                <div class="form-group">
                    <label for="nama_kegiatan">Nama Kegiatan</label>
                    <input type="text" class="form-control" autocomplete="off" name="jenis_kegiatan" placeholder="Masukkan Nama Kegiatan">
                </div>
                <div class="form-group">
                    <label for="link">Link Drive Surat Keluar</label>
                    <input type="text" class="form-control" autocomplete="off" name="link" placeholder="Masukkan Link drive Surat Keluar">
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
        url: '<?=site_url('surat_keluar/get_by_id')?>',
        type: 'GET',
        dataType: 'json',
        data: {id: id},
      })
      .done(function(data) {
        $("#form-edit-surat_keluar input[name='id']").val(data.object.id);
        $("#id_penomoran_edit").val(data.object.id_penomoran);
        $('#id_penomoran_edit').select2({
          theme: 'bootstrap4'
        });
        $("#form-edit-surat_keluar input[name='nama_dikirim']").val(data.object.nama_dikirim);
        $("#form-edit-surat_keluar input[name='jenis_kegiatan']").val(data.object.jenis_kegiatan);
        $("#form-edit-surat_keluar input[name='link']").val(data.object.link);
        $("#form-edit-surat_keluar input[name='tanggal']").val(data.object.tanggal);
        modal_edit.modal('show').on('shown.bs.modal', function(e) {
          $("#form-edit-surat_keluar input[name='id']").focus();
        });
      });
    });
    //Proses Update ke Db
    $("#form-edit-surat_keluar").submit(function(e) {
    e.preventDefault();
    form = $(this);
    $.ajax({
      url: '<?=site_url('surat_keluar/crud/update')?>',
      type: 'POST',
      dataType: 'json',
      data: form.serialize(),
      success: function(data){ 
        form[0].reset();
        swal("Berhasil!", "Data surat keluar berhasil diedit.", "success");
        modal_edit.modal('hide');
        $('#surat_keluar').DataTable().clear().destroy();
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
      swal({
        title: "Apa Anda Yakin?",
        text: "Data yang terhapus,tidak dapat dikembalikan!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Ya, Hapus!",
        cancelButtonText: "Batalkan!",
        closeOnConfirm: false,
        closeOnCancel: false
      },
      function(isConfirm) {
        if (isConfirm) {
          $.ajax({
             url: '<?=site_url('surat_keluar/crud/delete')?>',
             type: 'POST',
             dataType: 'json',
             data: {id: id},
             error: function() {
                alert('Something is wrong');
             },
             success: function(data) {
                  swal("Berhasil!", "Data Berhasil Dihapus.", "success");
                  $('#surat_keluar').DataTable().clear().destroy();
                  refresh_table();
             }
          });
        } else {
          swal("Dibatalkan", "Data yang dipilih tidak jadi dihapus", "error");
        }
      });
    });
    
</script>