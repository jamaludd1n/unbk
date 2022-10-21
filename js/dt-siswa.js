$(function () {
	    
	//datatables
var table = $('#data-siswa').DataTable({
      dom: 'Bfrtip',
		  responsive: true,
      processing:true,
      serverSide:false, //client-side
      ajax:"json.php?p=data-siswa",
      pageType:"numbers",
      scrollX:true,
      pageLength:4,
      columnDefs:[
        {targets:[0,9],'className':'hide'},
        {targets:[1],width:5},
        {targets:[0,1,2,3,5,8], orderable:false},
        {targets:[7,8],className:'text-center'}
      ],
      buttons: [
         {
            text: '<i class="material-icons">person_add</i> ',
            className: 'btn bg-indigo btn-sm',
            action: function ( e, dt, node, config ) {
               var cek = showModal(0);
                  $('.reset').trigger('click');
                   if(cek) {
                     $(".reset").on('click', function(){
                       $("#jurusan, #id_kelas").selectpicker('deselectAll');
                     });
                   }
            }
         },
         {
            text: '<i class="material-icons">print</i> ',
            className: 'btn bg-black btn-sm',
            action: function ( e, dt, node, config ) {
              $('#modalReport').modal('show');
            }
         },
         {
            text: '<i class="material-icons">import_export</i>',
            className: 'btn bg-green btn-sm',
            action: function ( e, dt, node, config ) {
              
            }
         }
      ]
   });
   $("#data-siswa , .is_active").on("click", "tr", function(e){
     e.preventDefault();
      var sts = table.row (this).data();
      $.ajax({
          url : "prosess.php",
          data: "&p=data-siswa&mod=update-status&id_siswa="+sts[0]+"&is_active="+sts[9],
          type: "POST",
          success: function(e){
            table.ajax.reload();
            //alert(e);
          }
      });
   });
  $("#data-siswa").on("click", ".edit", function(e){
    e.stopPropagation();
  });
  $("#data-siswa").on("click", ".reset-pass", function(e){
    e.stopPropagation();
    var id = $(this).attr('id');
    swal({
      title: "Apakah anda yakin ?",
      text: "Password akan di reset ke 12345678",
      type: "warning",
      showCancelButton: true,
      closeOnConfirm: false,
      showLoaderOnConfirm: true,
    },
    function(isConfirm){
      if(isConfirm){
        $.ajax({
          url: "prosess.php",
          type: "POST",
          data:"&p=reset&mod=siswa&id="+id,
          success:function(msg){  
            var pesan = $.parseJSON(msg);
            setTimeout(function(){
              swal({
                type:pesan[0],
                title:'',
                text:pesan[1]
              });
              table.ajax.reload();
            }, 2000);
          }
        });
      }
    });    
  });
  $("#data-siswa").on("click", ".lihat-pass", function(e){
    e.stopPropagation();
    var id = $(this).attr('id');
    swal(id,'','info');
  });
  $("#data-siswa").on("click", ".hapus", function(e){
    e.stopPropagation();
    
       var id = $(this).attr('id');
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
               var data = $(this).serialize()+"&p=data-siswa&mod=hapus&id_siswa="+id;
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

   $("#ftambah").submit(function(e){
     e.preventDefault();
     var data = $(this).serialize()+"&p=data-siswa&mod=tambah";
     $.ajax({
       url : "prosess.php",
       data:data,
       type: "POST",
       success:function(msg){
         var pesan = $.parseJSON(msg);
             swal({
                  type : pesan[0],
                  title: "DATA",
                  text : pesan[1]
                  },
               function(isOk){
                     table.ajax.reload();
              });
             $("#close").trigger("click");
       }
     })
   }); 

   $("#fedit").submit(function(e){
     e.preventDefault();
     var data = $(this).serialize()+"&p=data-siswa&mod=edit";
     $.ajax({
       url: "prosess.php",
       data: data,
       type: "POST",
       success:function(msg){
        var pesan = $.parseJSON(msg);
            swal({
                 type : pesan[0],
                 title: "DATA",
                 text : pesan[1]
                 },
              function(isOk){
                    setTimeout(reload,10);
             });
       }
     });
   });
  
  function showModal(id){
    if(id === 0){
      $("#label").text("TAMBAH DATA");
      $("#myModal").modal("show");
    }else{
      $("#label").text("EDIT DATA");
      $("#myModal").modal("show");
    }
    return true;
  }   



  $('#report-data-siswa').submit(function(event){
    event.preventDefault();
    var href = window.location.href;
    var uri  = href.split("?");
    var data = uri[1]+"&"+$(this).serialize();
    var option = "width="+screen.availWidth+", height="+screen.availHeight+", fullscreen=1";
    window.open('cetak.php?'+data, 'Download Data', option);
  });

   function reload(){
     window.location.reload();
   }
});