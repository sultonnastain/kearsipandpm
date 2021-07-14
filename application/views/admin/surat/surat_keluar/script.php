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
    $('#id_penomoran').select2({
      theme: 'bootstrap4',
      placeholder: "Pilih Id Penomoran"
    });
  
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
        modal_tambah.modal('hide');
        swal("Berhasil!", "Data Surat Keluar Berhasil Ditambahkan.", "success");
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
