<style>
.btn2{
  font-weight:900;
}
</style>
<table id="konstitusi" class="table table-bordered table-striped">
    <thead>
        <tr>
                        <th>No</th>
                        <th>penomoran</th>
                        <th>Nama Konstitusi</th>
                        <th>Berkas Konstitusi</th>
                        <th>Tanggal Pengesahan</th>
                        <th>Aksi</th>
                    </tr>
    </thead>
    <tbody>
        <?php $no = 1; ?>
        <?php foreach($konstitusi->result() as $result) : ?>
        <tr>
            <td><?php echo $no++ ?></td>
            <td><?php echo $result->id_penomoran ?></td>
            <td><?php echo $result->nama_konstitusi ?></td>
            <td><?php echo $result->berkas ?></td>
            <td><?php echo $result->tanggal ?></td>
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
              <h4 class="modal-title">Edit Data Berkas Proposal</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id="form-edit-konstitusi">
            <input type="hidden" name="id"/>
            <div class="col-lg-12">
               <div class="form-group">
                    <label for="id_penomoran">penomoran</label>
                    <select class="form-control select2" name="id_penomoran" required id="id_penomoran_edit">
                    <?php foreach($penomoran as $row) : ?>
                      <option value="<?php echo $row->id ?>"><?php echo $row->penomoran ?></option>
                     <?php endforeach ?>
                  </select>
                </div>
                <div class="form-group">
                    <label for="nama_konstitusi">Nama Konstitusi</label>
                    <input type="text" class="form-control" autocomplete="off" name="nama_konstitusi" placeholder="Masukkan Nama Kegiatan">
                </div>
                <div class="form-group">
                    <label for="berkas">Berkas Konstitusi(Kosongkan bila file tidak diganti)</label></br>
                    <input type="file" name="berkas"/>
                    <p id="p_nama_berkas"></p>
                </div>
                <div class="form-group">
                    <label for="tanggal">Tanggal Pengesahan</label>
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
        url: '<?=site_url('konstitusi/get_by_id')?>',
        type: 'GET',
        dataType: 'json',
        data: {id: id},
      })
      .done(function(data) {
        $("#form-edit-konstitusi input[name='id']").val(data.object.id);
        // $("#form-edit-konstitusi input[name='id_penomoran']").val(data.object.id_penomoran);
        //untuk dropdown di bawah
        $("#id_penomoran_edit").val(data.object.id_penomoran);
        $("#form-edit-konstitusi input[name='nama_konstitusi']").val(data.object.nama_konstitusi);
        $("#p_nama_berkas").text("Berkas Terupload : "+data.object.berkas);
        $("#form-edit-konstitusi input[name='tanggal']").val(data.object.tanggal);
        $('#id_penomoran_edit').select2({
          theme: 'bootstrap4'
        });
        modal_edit.modal('show').on('shown.bs.modal', function(e) {
          $("#form-edit-konstitusi input[name='id']").focus();
        });
      });
    });
    //Proses Update ke Db
    $("#form-edit-konstitusi").submit(function(e) {
    e.preventDefault();
    form = $(this);
    $.ajax({
      url: '<?=site_url('konstitusi/crud/update')?>',
      type: 'POST',
      dataType: 'json',
      data:new FormData(this),
      processData:false,
      contentType:false,
      cache:false,
      async:false,
      success: function(data){ 
        form[0].reset();
        modal_edit.modal('hide');
        swal("Berhasil!", "Data rekap konstitusi berhasil diedit.", "success");
        $('#konstitusi').DataTable().clear().destroy();
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
             url: '<?=site_url('konstitusi/crud/delete')?>',
             type: 'POST',
             dataType: 'json',
             data: {id: id},
             error: function() {
                alert('Something is wrong');
             },
             success: function(data) {
                  swal("Berhasil!", "Data Berhasil Dihapus.", "success");
                  $('#konstitusi').DataTable().clear().destroy();
                  refresh_table();
             }
          });
        } else {
          swal("Dibatalkan", "Data yang dipilih tidak jadi dihapus", "error");
        }
      });
    });
    var base_url = "<?php echo base_url();?>";
    $(".dawnload-data").click(function(e) {
      id = $(this).data('id');
      location.href = base_url+`konstitusi/download/${id}`;
    });
    
</script>