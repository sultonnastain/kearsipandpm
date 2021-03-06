<script>
    function refresh_table() {
    $.ajax({
        type: 'POST',
        url: "<?php echo base_url(); ?>/template_surat/get_all",
        cache: false,
        success: function(data) {
          $("#tampil").html(data);
          $('#template_surat').DataTable({
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
       url: '<?=site_url('template_surat/crud/insert')?>',
       type: 'POST',
       dataType: 'json',
       data:new FormData(this),
       processData:false,
       contentType:false,
       cache:false,
       async:false,
      success: function(){ 
        modal_tambah.modal('hide');
        swal("Berhasil!", "Data Template Surat Berhasil Ditambahkan.", "success");
        form[0].reset();
        $('#template_surat').DataTable().clear().destroy();
        refresh_table();
      },
      error: function(response){
          alert(response);
      }
     })
    });
</script>