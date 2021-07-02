<script>
    function refresh_table() {
    $.ajax({
        type: 'POST',
        url: "<?php echo base_url(); ?>/surat_keluar/get_all",
        cache: false,
        success: function(data) {
          $("#tampil").html(data);
          $('#surat_keluar').DataTable({
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
       url: '<?=site_url('surat_keluar/crud/insert')?>',
       type: 'POST',
       dataType: 'json',
       data: form.serialize(),
      success: function(){ 
        alert('success!');
        modal_tambah.modal('hide');
        form[0].reset();
        $('#surat_keluar').DataTable().clear().destroy();
        refresh_table();
      },
      error: function(response){
          alert(response);
      }
     })
    });
</script>
