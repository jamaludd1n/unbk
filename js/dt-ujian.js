$(function () {
	    
	//datatables
var table = $('#data-ujian').DataTable({
      dom: 'Bfrtip',
		  responsive: true,
      processing:true,
      serverSide:false, //client-side
      ajax:"json.php?p=data-ujian",
      pageType:"numbers",
      scrollX:true,
      pageLength:4,
      columnDefs:[
        {targets:[0,8],'className':'hide'},
        {targets:[1],width:5},
        {targets:[2],width:150},
        {targets:[7],'className':'text-center',width:200},
        {targets:[0,1,4,5,6,8], orderable:false}
      ],
      buttons: [
         {
            text: '<i class="material-icons">add_box</i> ',
            className: 'btn bg-indigo btn-sm',
            action: function ( e, dt, node, config ) {
               var cek = showModal(0);
                  $('.reset').trigger('click');
                   if(cek) {
                     $(".reset").on('click', function(){
                       $("#paket, #id_kelas").selectpicker('deselectAll');
                     });
                   }
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
      ]
   });
  $("#data-ujian").on("click", ".renew", function(e){
      e.preventDefault();
      e.stopPropagation();
       var id = $(this).attr('id');
      $.ajax({
          url : "prosess.php",
          data: "&p=data-ujian&mod=update-kode&id="+id,
          type: "POST",
          success: function(e){
            table.ajax.reload();
            //alert(e);
          }
      });
   });

   $("#data-ujian , .is_active").on("click", "tr", function(e){
     e.preventDefault();
     e.stopPropagation();
      var sts = table.row (this).data();
      $.ajax({
          url : "prosess.php",
          data: "&p=data-ujian&mod=update-status&id="+sts[0]+"&is_active="+sts[8],
          type: "POST",
          success: function(e){
           table.ajax.reload();
          }
      });
   });
  $("#data-ujian").on("click", ".edit", function(e){
    e.stopPropagation();
  });
  $("#data-ujian").on("click", ".more", function(e){
    e.stopPropagation();
  });
  $("#data-ujian").on("click", ".hapus", function(e){
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
               var data = $(this).serialize()+"&p=data-ujian&mod=hapus&id="+id;
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
     var data = $(this).serialize()+"&p=data-ujian&mod=tambah";
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
     var data = $(this).serialize()+"&p=data-ujian&mod=edit";
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