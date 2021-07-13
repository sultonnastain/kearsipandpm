<script src="<?=base_url()?>assets/vendor/ck-standart/build/ckeditor.js"></script>
<script>
      let datack;
    ClassicEditor
			.create( document.querySelector( '.editor' ), {
				
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
                datack=editor;
				window.editor = editor;
			} )
			.catch( error => {
				console.error( 'Oops, something went wrong!' );
				console.error( 'Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:' );
				console.warn( 'Build id: 27gw32nl3ltt-cd9y4a801chs' );
				console.error( error );
			} );
    function refresh_table() {
    $.ajax({
        type: 'POST',
        url: "<?php echo base_url(); ?>/rapat_pleno/get_all",
        cache: false,
        success: function(data) {
          $("#tampil").html(data);
          $('#rapat_pleno').DataTable({
          "responsive": true, "lengthChange": true, "autoWidth": false
          });
        }
      });
    };
    refresh_table();
  
    document.querySelector( '#submit_save' ).addEventListener( 'click', () => {
      const editorData = datack.getData();
      modal_tambah = $("#modal-tambah");
	  var id_admin = $("#id_admin").val();
	  var agenda = $("#agenda").val();
	  var tanggal  = $("#tgl_pleno").val();
      $.ajax({
       url: '<?=site_url('rapat_pleno/crud/insert')?>',
       type: 'POST',
       dataType: 'json',
	   data: {
		   id_admin :id_admin,
		   notulen : editorData,
		   nama : agenda,
		   tanggal : tanggal
	   },
      success: function(){ 
        modal_tambah.modal('hide');
		swal("Berhasil!", "Data Rapat Pleno Berhasil Ditambahkan.", "success");
        $('#rapat_pleno').DataTable().clear().destroy();
        refresh_table();
      },
      error: function(response){
          alert(response);
      }
     })
    });
</script>
