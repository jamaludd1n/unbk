$(function(){
 tinymce.init({
    selector: '#q',
    width:'100%',
    height: 300,
    plugins: ['image code'],
    toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect | link unlink anchor | image media | forecolor backcolor  | print preview code |",
    image_advtab:true,
    browser_spellcheck : true,
    menu: {
        format: { 
            title: 'Format', 
            items: 'bold italic underline strikethrough superscript subscript codeformat | formats blockformats fontformats fontsizes align | forecolor backcolor | removeformat' 
        }
    },
        branding: false,
        mobile: {
            menubar: true
        },
        // upload image functionality
        images_upload_url: 'upload.php',
        images_upload_handler: function (blobInfo, success, failure) {
            var xhr, formData;
            xhr = new XMLHttpRequest();
            xhr.withCredentials = false;
            xhr.open('POST', 'upload.php');
            xhr.onload = function() {
                var json;
                if (xhr.status != 200) {
                    failure('HTTP Error: ' + xhr.status);
                    console.log(xhr.responseText);
                    return;
                }
                json = JSON.parse(xhr.responseText);
                if (!json || typeof json.location != 'string') {
                    failure('Invalid JSON: ' + xhr.responseText);
                    console.log(xhr.responseText);
                    return;
                }
                success(json.location);
            };
            formData = new FormData();
            formData.append('file', blobInfo.blob(), blobInfo.filename());
            xhr.send(formData);
        },
    });
    
    tinymce.init({
        selector: '#a,#b,#c,#d,#e',
        width:'100%',
        height: 140,
        menubar:false
    });

    //validasi form 
    var form = $("#ftambah-soal");
    $.validator.setDefaults({
        submitHandler:function(){
            saveData(form.serialize());
        }
    });
    form.validate({
        rules: {
            'j': {
                required: true,
            }
        },
        messages:{
            'j':{
                required: "Kunci jawaban belum di pilih !"
            }
        },
        highlight: function (input) {
            $(input).parents('.form-line').addClass('error');
        },
        unhighlight: function (input) {
            $(input).parents('.form-line').removeClass('error');
        },
        errorPlacement: function (error, element) {
            $(element).parents('.form-group').append(error);
        }
    });

    $("#fedit-soal").submit(function(e){
            e.preventDefault();
            var data = $(this).serialize();
            saveData(data);
    });

    function saveData(data){
       // alert(data);
       $.ajax({
           url : "prosess.php",
           data:data,
           type: "POST",
           success:function(msg){
               console.log(msg);
            var pesan = $.parseJSON(msg);
                swal({
                    type : pesan[0],
                    title: "DATA",
                    text : pesan[1]
                    },
                function(isOk){
                    setTimeout(reload,1000);
                });
           },
           error:function(e){
               console.log(e);
           }
       });
    }
    //form
    
    //table
    var table = $('#isi-soal').DataTable({
        serverSide:false,
        processing:true,
        responsive:true,
        pageLength:1,
        ajax:{
            url : "json.php?p=isi-soal&id="+$('.id_paket').val()
        },
        columnDefs:[
          {targets:[0,4],'className':'hide'},
          {targets:[1], width:1},
          {targets:[2], width:'80%','className':'justify'},
          {targets:[3],width:'20%','className':'text-right pull-right'},
          {targets:[0,1,2,3], orderable:false}
        ]
    });
    //action
    $("#isi-soal").on("click", ".hapus", function(e){
        e.preventDefault();
        var id = $(this).attr('id');
            console.log(id);
        //alert(id);
         swal({
             title: "HAPUS ?",
             text: "Apakah anda yakin akan menghapusnya ?",
             type: "warning",
             showCancelButton: true,
             confirmButtonColor: "#DD6B55",
             confirmButtonText: "Ya, hapus!",
             cancelButtonText: "Batalkan",
             closeOnConfirm: false,
             closeOnCancel: false
           },
           function(isConfirm){
             if (isConfirm) {
                var data = "&p=isi-soal&mod=hapus&id_bank="+id;
                $.ajax({
                  url: "prosess.php",
                  data: data,
                  type: "POST",
                  success:function(msg){
                    var pesan = $.parseJSON(msg);
                    swal({
                       type : pesan[0],
                       title: "Dihapus !",
                       text : pesan[1]
                     },function(isOk){
                         table.ajax.reload();
                     });
                  }
                });
             } else {
               swal("Dibatalkan", "Data batal dihapus!", "error");
             }
          });
    });

   $("#isi-soal , .is_active").on("click", "tr", function(e){
     e.stopPropagation();
      var sts = table.row (this).data();
      $.ajax({
          url : "prosess.php",
          data: "&p=isi-soal&mod=update-status&id="+sts[0]+"&is_active="+sts[4],
          type: "POST",
          success: function(e){
           table.ajax.reload();
          }
      });
   });
   
   function reload(){
     window.location.reload();
   }
});