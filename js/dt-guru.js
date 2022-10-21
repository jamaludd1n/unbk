$(function () {
	    
	//datatables
var table = $('#data-guru').DataTable({
      dom: 'Bfrtip',
		  responsive: true,
      processing:true,
      serverSide:false, //client-side
      ajax:"json.php?p=data-guru",
      pageLength:4,
      columnDefs:[
        {targets:[0,7],'className':'hide'},
        {targets:[1],width:5},
        {targets:[2,4,5,6], orderable:false},
        {targets:[4,5,6],className:'text-center'},
        {targets:[6],width:200}

      ],
      buttons: [
         {
            text: '<i class="material-icons">person_add</i> ',
            className: 'btn bg-indigo btn-sm',
            action: function ( e, dt, node, config ) {
              showModal(0);
            }
         },
         {
            text: '<i class="material-icons">print</i> ',
            className: 'btn bg-black btn-sm',
            action: function ( e, dt, node, config ) {
               var href = window.location.href;
                var uri  = href.split("?");
                var data = uri[1]+"&"+$(this).serialize();
                var option = "width="+screen.availWidth+", height="+screen.availHeight+", fullscreen=1";
                window.open('cetak.php?'+data, 'Download Data', option);
            }
         },
         {
            text: '<i class="material-icons">import_export</i>',
            className: 'btn bg-green btn-sm',
            action: function ( e, dt, node, config ) {
              
            }
         }
      ],
      language:{
        'sSearch':'Cari',
        'sSearchPlaceholder':'Cari...'
      }
      
   });
   $("#data-guru , .is_active").on("click", "tr", function(e){
      e.preventDefault();
      var sts = table.row (this).data();
      $.ajax({
          url : "prosess.php",
          data: "&p=data-guru&mod=update-status&id_guru="+sts[0]+"&is_active="+sts[7],
          type: "POST",
          success: function(e){
            table.ajax.reload();
            //alert(e);
          }
      });
   });
  $("#data-guru").on("click", ".edit", function(e){
    e.stopPropagation();
  });
  $("#data-guru").on("click", ".reset-pass", function(e){
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
          data:"&p=reset&mod=guru&id="+id,
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
  $("#data-guru").on("click", ".lihat-pass", function(e){
    e.stopPropagation();
    var id = $(this).attr('id');
    swal(id,'','info');
  });
  $("#data-guru").on("click", ".hapus", function(e){
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
               var data = $(this).serialize()+"&p=data-guru&mod=hapus&id_guru="+id;
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
     var data = $(this).serialize()+"&p=data-guru&mod=tambah";
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
     var data = $(this).serialize()+"&p=data-guru&mod=edit";
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

   function reload(){
     window.location.reload();
   }
});
