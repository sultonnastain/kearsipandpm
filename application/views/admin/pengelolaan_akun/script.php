<script>
    function refresh_table() {
    $.ajax({
        url: "<?php echo base_url(); ?>/pengelolaan_akun/get_all",
        cache: false,
        success: function(data) {
          $("#tampil").html(data);
          $('#pengelolaan_akun').DataTable({
          "responsive": true, "lengthChange": true, "autoWidth": false
          });
        }
      });
    };
    refresh_table();
  
    $("#form-tambah").submit(function(e) {
      e.preventDefault();
      modal_tambah = $("#modal-tambah");
      form = $(this);
      $.ajax({
       url: '<?=site_url('pengelolaan_akun/crud/insert')?>',
       type: 'POST',
       data:new FormData(this),
       processData:false,
       contentType:false,
       cache:false,
       async:false,
      success: function(){ 
        modal_tambah.modal('hide');
        swal("Berhasil!", "Data Akun Baru Telah Ditambahkan.", "success");
        form[0].reset();
        $('#pengelolaan_akun').DataTable().clear().destroy();
        refresh_table();
      },
      error: function(response){
          alert(response);
      }
     })
    });
</script>