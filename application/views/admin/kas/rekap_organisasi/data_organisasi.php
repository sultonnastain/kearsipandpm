<table id="rekap_organisasi" class="table table-bordered table-striped">
    <thead>
        <tr>
                        <th>No</th>
                        <th>ID admin</th>
                        <th>Bulan</th>
                        <th>Berkas</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
    </thead>
    <tbody>
        <?php $no = 1; ?>
        <?php foreach($rekap_organisasi->result() as $result) : ?>
        <tr>
            <td><?php echo $no++ ?></td>
            <td><?php echo $result->id_admin ?></td>
            <td><?php echo $result->bulan?></td>
            <td><?php echo $result->berkas ?></td>
            <td><?php echo $result->keterangan ?></td>
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
              <h4 class="modal-title">Edit Data Rekap Organisasi</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id="form-edit-rekap_organisasi">
            <input type="hidden" name="id"/>
            <div class="col-lg-12">
               <div class="form-group">
                    <label for="id_admin">ID admin</label>
                    <select class="form-control select2" name="id_admin" required id="id_admin_edit">
                    <?php foreach($admin as $row) : ?>
                      <option value="<?php echo $row->id ?>"><?php echo $row->nama ?></option>
                     <?php endforeach ?>
                  </select>
                </div>
                <div class="form-group">
                    <label for="bulan">Bulan</label>
                    <input type="text" class="form-control" autocomplete="off" name="bulan" placeholder="Masukkan Nama bulan">
                </div>
                <div class="form-group">
                    <label for="berkas">Berkas</label>
                    <input type="file" name="berkas"/>
                </div>
                <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <input type="text" class="form-control" autocomplete="off" name="keterangan" placeholder="Masukkan Keterangan">
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
        url: '<?=site_url('rekap_organisasi/get_by_id')?>',
        type: 'GET',
        dataType: 'json',
        data: {id: id},
      })
      .done(function(data) {
        $("#form-edit-rekap_organisasi input[name='id']").val(data.object.id);
        // $("#form-edit-rekap_organisasi input[name='id_admin']").val(data.object.id_admin);
        //untuk dropdown di bawah
        $("#id_admin_edit").val(data.object.id_admin);
        $("#form-edit-rekap_organisasi input[name='bulan']").val(data.object.bulan);
        $("#form-edit-rekap_organisasi input[name='berkas']").val(data.object.berkas);
        $("#form-edit-rekap_organisasi input[name='keterangan']").val(data.object.keterangan);
        modal_edit.modal('show').on('shown.bs.modal', function(e) {
          $("#form-edit-rekap_organisasi input[name='id']").focus();
        });
      });
    });
    //Proses Update ke Db
    $("#form-edit-rekap_organisasi").submit(function(e) {
    e.preventDefault();
    form = $(this);
    $.ajax({
      url: '<?=site_url('rekap_organisasi/crud/update')?>',
      type: 'POST',
      dataType: 'json',
      data: form.serialize(),
      success: function(data){ 
        form[0].reset();
        alert('success!');
        modal_edit.modal('hide');
        $('#rekap_organisasi').DataTable().clear().destroy();
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
          url: '<?=site_url('rekap_organisasi/crud/delete')?>',
          type: 'POST',
          dataType: 'json',
          data: {id: id},
          success: function(data){ 
          $('#rekap_organisasi').DataTable().clear().destroy();
          refresh_table();
          },
          error: function(response){
          alert(response);
          }
        })
      }
    });
    
</script>