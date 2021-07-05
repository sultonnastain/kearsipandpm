<style>
.btn2{
  font-weight:900;
}
</style>
<table id="template_surat" class="table table-bordered table-striped">
    <thead>
        <tr>
                        <th>No</th>
                        <th>Nama Kegiatan</th>
                        <th>Berkas</th>
                        <th>Aksi</th>
                    </tr>
    </thead>
    <tbody>
        <?php $no = 1; ?>
        <?php foreach($template_surat->result() as $result) : ?>
        <tr>
            <td><?php echo $no++ ?></td>
            <td><?php echo $result->jenis_kegiatan ?></td>
            <td><?php echo $result->berkas ?></td>
            <td class="text-center">
            <i class="btn btn2 btn-xs btn-primary fa fa-file-download dawnload-data" data-id="<?php echo $result->id ?>" data-placement="top" title="Dawnload"></i>
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
              <h4 class="modal-title">Edit Template Surat</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id="form-edit-template_surat">
            <input type="hidden" name="id"/>
            <div class="col-lg-12">
                <div class="form-group">
                    <label for="nama_kegiatan">Nama Kegiatan</label>
                    <input type="text" class="form-control" autocomplete="off" name="jenis_kegiatan" placeholder="Masukkan Nama Kegiatan">
                </div>
                <!-- code masih salah -->
                <div class="form-group">
                    <label for="berkas">Berkas</label>
                    <input type="file"/>
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
        url: '<?=site_url('template_surat/get_by_id')?>',
        type: 'GET',
        dataType: 'json',
        data: {id: id},
      })
      .done(function(data) {
        $("#form-edit-template_surat input[name='id']").val(data.object.id);
        $("#form-edit-template_surat input[name='jenis_kegiatan']").val(data.object.jenis_kegiatan);
        $("#form-edit-template_surat input[name='berkas']").val(data.object.berkas);
        modal_edit.modal('show').on('shown.bs.modal', function(e) {
          $("#form-edit-template_surat input[name='id']").focus();
        });
      });
    });
    //Proses Update ke Db
    $("#form-edit-template_surat").submit(function(e) {
    e.preventDefault();
    form = $(this);
    $.ajax({
      url: '<?=site_url('template_surat/crud/update')?>',
      type: 'POST',
      dataType: 'json',
      data: form.serialize(),
      success: function(data){ 
        form[0].reset();
        alert('success!');
        modal_edit.modal('hide');
        $('#template_surat').DataTable().clear().destroy();
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
          url: '<?=site_url('template_surat/crud/delete')?>',
          type: 'POST',
          dataType: 'json',
          data: {id: id},
          success: function(data){ 
          $('#template_surat').DataTable().clear().destroy();
          refresh_table();
          },
          error: function(response){
          alert(response);
          }
        })
      }
    });
    $(".dawnload-data").click(function(e) {
      e.preventDefault();
      id = $(this).data('id');
        $.ajax({
          url: '<?=site_url('template_surat/crud/dawnload')?>',
          type: 'GET',
          data: {id: id},
          success: function(data){ 
          },
          error: function(response){
          alert(response);
          }
        })
    });
    
</script>