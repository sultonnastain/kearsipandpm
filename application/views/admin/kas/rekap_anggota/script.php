<script>
    function refresh_table() {
    $.ajax({
        type: 'POST',
        url: "<?php echo base_url(); ?>/rekap_anggota/get_all",
        cache: false,
        success: function(data) {
          $("#tampil").html(data);
          $('#rekap_anggota').DataTable({
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
       url: '<?=site_url('rekap_anggota/crud/insert')?>',
       type: 'POST',
       dataType: 'json',
       data: form.serialize(),
      success: function(){ 
        modal_tambah.modal('hide');
        swal("Berhasil!", "Data Rekap Kas Anggota Berhasil Ditambahkan.", "success");
        form[0].reset();
        $('#rekap_anggota').DataTable().clear().destroy();
        refresh_table();
      },
      error: function(response){
          alert(response);
      }
     })
    });
</script>
