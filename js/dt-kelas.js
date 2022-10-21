$(function () {
	    
	//datatables
var table = $('#data-kelas').DataTable({
      dom: 'Bfrtip',
		  responsive: true,
      processing:true,
      serverSide:false, //client-side
      ajax:"json.php?p=kelas",
      columnDefs:[
        {targets:[0],'className':'hide'},
        {targets:[1],width:5},
        {targets:[1,3], orderable:false},
        {targets:[3],className:'text-center',width:200}
      ],
      buttons: [
         {
            text: 'TAMBAH DATA ',
            className: 'btn bg-indigo btn-sm',
            action: function ( e, dt, node, config ) {
               var cek = showModal(0);
                  $('.reset').trigger('click');
                   if(cek) {
                     $(".reset").on('click', function(){
                       //$("#jurusan, #id_kelas").selectpicker('deselectAll');
                     });
                   }
            }
         }
      ],
      language:{
        'sSearch':'Cari',
        'sSearchPlaceholder':'Cari...'
      }
      
   });
  $("#data-kelas").on("click", ".edit", function(e){
    e.stopPropagation();
  });
  $("#data-kelas").on("click", ".hapus", function(e){
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
               var data = $(this).serialize()+"&p=kelas&mod=hapus&id="+id;
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
     var data = $(this).serialize()+"&p=kelas&mod=tambah";
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
     var data = $(this).serialize()+"&p=kelas&mod=edit";
     //alert(data);
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
