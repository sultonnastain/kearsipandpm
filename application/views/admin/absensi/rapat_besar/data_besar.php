<table id="rapat_besar" class="table table-bordered table-striped">
    <thead>
        <tr>
                        <th>No</th>
                        <th>Admin</th>
                        <th>Agenda</th>
                        <th>Notulensi</th>
                        <th>Tanggal Rabes</th>
                        <th>Aksi</th>
                    </tr>
    </thead>
    <tbody>
        <?php $no = 1; ?>
        <?php foreach($rapat_besar->result() as $result) : ?>
        <tr>
            <td><?php echo $no++ ?></td>
            <td><?php echo $result->nama_admin ?></td>
            <td><?php echo $result->nama ?></td>
            <td class="ck-content"><?php echo $result->notulen ?></td>
            <td><?php echo $result->tanggal ?></td>
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
              <h4 class="modal-title">Edit Data Rabes</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <input type="hidden" name="id" id="hidden_id"/>
            <div class="col-lg-12">
               <div class="form-group">
                    <label for="id_admin">ID admin</label>
                    <select class="form-control select2" name="id_admin" required id="id_admin_edit" style="width: 100%;">
                    <?php foreach($admin as $row) : ?>
                      <option value="<?php echo $row->id ?>"><?php echo $row->nama ?></option>
                     <?php endforeach ?>
                  </select>
                </div>
                <div class="form-group">
                    <label for="nama">Agenda</label>
                    <input type="text" class="form-control" autocomplete="off" id="agenda_edit"  placeholder="Masukkan Nama Agenda">
                </div>
                <label for="isi">Notulensi</label>
                <div class="centered">
                  <div class="row row-editor">
                    <div class="editor-edit">
                  </div>
                </div>
		         	  </div>
                <div class="form-group">
                    <label for="tanggal">Tanggal Rabes</label>
                    <input type="date" class="form-control" autocomplete="off" id="tgl_rabes_edit"  placeholder="Masukkan Tanggal Rabes">
                </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
              <button type="submit" id="submit_edit" name="submit" class="btn btn-primary">Simpan</button>
            </div>
          </div>
          <!-- /.modal-content -->
      </div>
        <!-- /.modal-dialog -->
      </div>

<script>
  let datack_edit;
  ClassicEditor
    .create( document.querySelector( '.editor-edit' ), {
      toolbar: {
      items: [
        'heading',
        '|',
        'fontSize',
        'fontFamily',
        '|',
        'fontColor',
        'fontBackgroundColor',
        '|',
        'bold',
        'italic',
        'underline',
        'strikethrough',
        'subscript',
        'superscript',
        'specialCharacters',
        '|',
        'alignment',
        '|',
        'numberedList',
        'bulletedList',
        '|',
        'outdent',
        'indent',
        '|',
        'todoList',
        'link',
        'blockQuote',
        'imageInsert',
        'insertTable',
        'mediaEmbed',
        'highlight',
        '|',
        'undo',
        'redo',
        'restrictedEditingException',
        'textPartLanguage',
        'codeBlock',
        'horizontalLine',
        'htmlEmbed',
        'pageBreak',
        'code',
        'removeFormat',
        // 'imageUpload'
      ]
    },
    mediaEmbed: {
      previewsInData: true
    },
    language: 'en',
    image: {
          // Configure the available styles.
          styles: [
              'alignLeft', 'alignCenter', 'alignRight'
          ],

          // Configure the available image resize options.
          resizeOptions: [
              {
                  name: 'resizeImage:original',
                  label: 'Original',
                  value: null
              },
              {
                  name: 'resizeImage:25',
                  label: '25%',
                  value: '25'
              },
              {
                  name: 'resizeImage:50',
                  label: '50%',
                  value: '50'
              },
              {
                  name: 'resizeImage:75',
                  label: '75%',
                  value: '75'
              }
          ],
    
          // You need to configure the image toolbar, too, so it shows the new style
          // buttons as well as the resize buttons.
          toolbar: [
              'imageStyle:alignLeft', 'imageStyle:alignCenter', 'imageStyle:alignRight',
              '|',
              'resizeImage',
              '|',
              'imageTextAlternative'
          ]
          },
    table: {
      contentToolbar: [
        'tableColumn',
        'tableRow',
        'mergeTableCells',
        'tableCellProperties',
        'tableProperties'
      ]
    },
    table: {
      contentToolbar: [
        'tableColumn',
        'tableRow',
        'mergeTableCells',
        'tableCellProperties',
        'tableProperties'
      ]
    },
      licenseKey: '',
      
    } )
    .then( editor => {
      datack_edit=editor;
      window.editor = editor;
    } )
    .catch( error => {
      console.error( 'Oops, something went wrong!' );
      console.error( 'Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:' );
      console.warn( 'Build id: 27gw32nl3ltt-cd9y4a801chs' );
      console.error( error );
  } );
  //Menampilkan data diedit
    modal_edit = $("#modal-edit");
    $(document).on('click', '.edit-data', function(e){ 
      id = $(this).data('id');
      $.ajax({
        url: '<?=site_url('rapat_besar/get_by_id')?>',
        type: 'GET',
        dataType: 'json',
        data: {id: id},
      })
      .done(function(data) {
        $("#hidden_id").val(data.object.id);
        // $("#form-edit-rapat_besar input[name='id_admin']").val(data.object.id_admin);
        //untuk dropdown di bawah
        $("#id_admin_edit").val(data.object.id_admin);
        $("#agenda_edit").val(data.object.nama);
        $("#tgl_rabes_edit").val(data.object.tanggal);
        $("#form-edit-rapat_besar input[name='nama']").val(data.object.nama);
        datack_edit.setData(data.object.notulen);
        $('#id_admin_edit').select2({
          theme: 'bootstrap4'
        });
        modal_edit.modal('show').on('shown.bs.modal', function(e) {
          $("#form-edit-rapat_besar input[name='id']").focus();
        });
      });
    });
    //Proses Update ke Db
    document.querySelector( '#submit_edit' ).addEventListener( 'click', () => {
    const editorData = datack_edit.getData();
    var id_admin = $("#id_admin_edit").val();
	  var agenda = $("#agenda_edit").val();
	  var tanggal  = $("#tgl_rabes_edit").val();
    var id  = $("#hidden_id").val();
    $.ajax({
      url: '<?=site_url('rapat_besar/crud/update')?>',
      type: 'POST',
      dataType: 'json',
      data: {
       id : id,
		   id_admin :id_admin,
		   notulen : editorData,
		   nama : agenda,
		   tanggal : tanggal
	    },
      success: function(data){ 
        modal_edit.modal('hide');
        swal("Berhasil!", "Data rapat besar berhasil diedit.", "success");
        $('#rapat_besar').DataTable().clear().destroy();
        refresh_table();
      },
      error: function(response){
          alert(response);
      }
     })
    });
    $(document).on('click', '.hapus-data', function(e){ 
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
             url: '<?=site_url('rapat_besar/crud/delete')?>',
             type: 'POST',
             dataType: 'json',
             data: {id: id},
             error: function() {
                alert('Something is wrong');
             },
             success: function(data) {
                  swal("Berhasil!", "Data Berhasil Dihapus.", "success");
                  $('#rapat_besar').DataTable().clear().destroy();
                  refresh_table();
             }
          });
        } else {
          swal("Dibatalkan", "Data yang dipilih tidak jadi dihapus", "error");
        }
      });
    });
    
</script>