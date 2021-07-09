<table id="rekap_anggota" class="table table-bordered table-striped">
    <thead>
        <tr>
                        <th>No</th>
                        <th>ID admin</th>
                        <th>Nama </th>
                        <th>Tunggakan</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
    </thead>
    <tbody>
        <?php $no = 1; ?>
        <?php foreach($rekap_anggota->result() as $result) : ?>
        <tr>
            <td><?php echo $no++ ?></td>
            <td><?php echo $result->id_admin ?></td>
            <td><?php echo $result->nama ?></td>
            <td><?php echo $result->tunggakan ?></td>
            <td><?php echo $result->total ?></td>
            <td><?php echo $result->status ?></td>
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
              <h4 class="modal-title">Edit Data Anggota</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id="form-edit-rekap_anggota">
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
                    <label for="nama">Nama Anggota</label>
                    <input type="text" class="form-control" autocomplete="off" name="nama" placeholder="Masukkan Nama Anggota">
                </div>
                <div class="form-group">
                    <label for="tunggakan">Tunggakan</label>
                    <input type="text" class="form-control" autocomplete="off" name="tunggakan" placeholder="Masukkan Tunggakan jika ada">
                </div>
                <div class="form-group">
                    <label for="total">Total</label>
                    <input type="text" class="form-control" autocomplete="off" name="total" placeholder="Masukkan Total yang telah dibayarkan">
                </div>
                <div class="form-group">
                    <label for="status">status</label>
                    <select class="form-control select2" name="status" style="width: 100%;">
                    <option value="lunas">lunas</option>
                    <option value="belum lunas">belum lunas</option>
                    </select>
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
        url: '<?=site_url('rekap_anggota/get_by_id')?>',
        type: 'GET',
        dataType: 'json',
        data: {id: id},
      })
      .done(function(data) {
        $("#form-edit-rekap_anggota input[name='id']").val(data.object.id);
        // $("#form-edit-rekap_anggota input[name='id_admin']").val(data.object.id_admin);
        //untuk dropdown di bawah
        $("#id_admin_edit").val(data.object.id_admin);
        $("#form-edit-rekap_anggota input[name='nama']").val(data.object.nama);
        $("#form-edit-rekap_anggota input[name='tunggakan']").val(data.object.tunggakan);
        $("#form-edit-rekap_anggota input[name='total']").val(data.object.total);
        $("#form-edit-rekap_anggota input[name='status']").val(data.object.status);
        modal_edit.modal('show').on('shown.bs.modal', function(e) {
          $("#form-edit-rekap_anggota input[name='id']").focus();
        });
      });
    });
    //Proses Update ke Db
    $("#form-edit-rekap_anggota").submit(function(e) {
    e.preventDefault();
    form = $(this);
    $.ajax({
      url: '<?=site_url('rekap_anggota/crud/update')?>',
      type: 'POST',
      dataType: 'json',
      data: form.serialize(),
      success: function(data){ 
        form[0].reset();
        alert('success!');
        modal_edit.modal('hide');
        $('#rekap_anggota').DataTable().clear().destroy();
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
          url: '<?=site_url('rekap_anggota/crud/delete')?>',
          type: 'POST',
          dataType: 'json',
          data: {id: id},
          success: function(data){ 
          $('#rekap_anggota').DataTable().clear().destroy();
          refresh_table();
          },
          error: function(response){
          alert(response);
          }
        })
      }
    });
    
</script>