$(function () {
	    
	//datatables
var table = $('#ruang-ujian').DataTable({
      dom:"Bfrtip",
		  responsive: true,
      processing:true,
      serverSide:false, //client-side
      ajax:"json.php?p=ruang-ujian",
      pageType:"numbers",
      scrollX:true,
      pageLength:4,
      columnDefs:[
        {targets:[0,7],'className':'hide'},
        {targets:[1],width:5},
        {targets:[6],'className':'text-center',width:200},
        {targets:[0,1,4,5,6], orderable:false}
      ],
      buttons: [
         {
            text: '<i class="material-icons">undo</i>',
            className: 'btn bg-grey btn-sm',
            action: function ( e, dt, node, config ) {
              window.history.back();
            }
         },

         {
            text: '<i class="material-icons">file_download</i>',
            className: 'btn btn-success btn-sm',
            action: function ( e, dt, node, config ) {
              $('#myModal').modal('show');
              $('.btn-modal').text("DOWNLOAD");
              $('.tipe').val('d');
            }
         },

         {
            text: '<i class="material-icons">print</i>',
            className: 'btn bg-black btn-sm',
            action: function ( e, dt, node, config ) {
              $('#myModal').modal('show');
              $('.btn-modal').text("PRINT");
              $('.tipe').val('p');
            }
         }
      ]
   });

   $("#ruang-ujian , .is_active").on("click", "tr", function(e){
     e.stopPropagation();
      var sts = table.row (this).data();
      $.ajax({
          url : "prosess.php",
          data: "&p=ruang-ujian&mod=update-status&id="+sts[0]+"&is_active="+sts[7],
          type: "POST",
          success: function(e){
           table.ajax.reload();
          }
      });
   });
  $("#ruang-ujian").on("click", ".more", function(e){
    e.stopPropagation();
  });
  $("#ruang-ujian").on("click", ".hapus", function(e){
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
               var data = "&p=ruang-ujian&mod=hapus&id="+id;
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
  

  $(".print").click(function(e){
    e.preventDefault();
    var id = $(this).data("id");
    var url = "cetak.php?p=ruang-ujian&mod=details&id="+id+"&status=p";
    var option = "width="+screen.availWidth+", height="+screen.availHeight;
    window.open(url, "Halaman print", option);
  });

  $(".download").click(function(e){
    e.preventDefault();
    var id = $(this).data("id");
    var url = "cetak.php?p=ruang-ujian&mod=details&id="+id+"&status=d";
    var option = "width="+screen.availWidth+", height="+screen.availHeight;
    window.open(url, "Halaman print", option);
  });

  $('#print_download').submit(function(event){
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