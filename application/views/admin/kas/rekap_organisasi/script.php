<script>
    function refresh_table() {
    $.ajax({
        type: 'POST',
        url: "<?php echo base_url(); ?>/rekap_organisasi/get_all",
        cache: false,
        success: function(data) {
          $("#tampil").html(data);
          $('#rekap_organisasi').DataTable({
          "responsive": true, "lengthChange": true, "autoWidth": false
          });
        }
      });
    };
    refresh_table();
    $('#id_admin').select2({
      theme: 'bootstrap4',
      placeholder: "Pilih Admin"
    });
  
    $("#form-tambah").submit(function(e) {
      e.preventDefault();
      modal_tambah = $("#modal-tambah");
      form = $(this);
      $.ajax({
       url: '<?=site_url('rekap_organisasi/crud/insert')?>',
       type: 'POST',
       dataType: 'json',
       data:new FormData(this),
       processData:false,
       contentType:false,
       cache:false,
       async:false,
      success: function(){ 
        modal_tambah.modal('hide');
        swal("Berhasil!", "Data Rekap Organisasi Berhasil Ditambahkan.", "success");
        form[0].reset();
        $('#rekap_organisasi').DataTable().clear().destroy();
        refresh_table();
      },
      error: function(response){
          alert(response);
      }
     })
    });
</script>
