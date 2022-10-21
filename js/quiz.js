
$(function(){
    $(window).scroll(function() {
        if ($(this).scrollTop() > 1){
            $('.navbar').addClass('hide');
            $("#header").css({
                'position':'fixed',
                'top':0
            });
            $("#time").css({
                'position':'fixed',
                'right':30
            });
        }
        else{
            $('#header').css({
                'position':'static'
            }).add('div').addClass('clearfix');
            $('.navbar').removeClass('hide');
        }
    });

    //toogle
    $('.box-slide').hide();
    $(".btn-no").click(function(e){
    	e.preventDefault();
    	$('.box-slide').toggle().addClass('slideInRight');
    	$('.tombol').toggle();
    });

    $('input[name="j"').click(function(){
          $.ajax({
              url:"prosess.php",
              data: $("#kirim").serialize()+"&p=quiz&mod=tmp_jawaban",
              type: "POST",
              success:function(msg){
                  window.location.reload();
              }
          });
    });

    $("#sebelumnya, #selanjutnya").on('click', function(e){
          $.ajax({
              url:"prosess.php",
              data: $("#kirim").serialize()+"&p=quiz&mod=tmp_jawaban",
              type: "POST",
              success:function(msg){
                  setTimeout(function(){
                    window.location.reload();
                  },2000)
              }
          });
    });

    
var waktu = document.querySelector('.waktu_server').getAttribute('id');
    console.log(waktu);
    set_timer($(".waktu_server"), [0,Number(waktu),0], function(block){
        $(".waktu_server").text("00:00:00").show();
         swal("Waktu habis !", "", "success");
        var waktu_tersisa = $('.waktu_server').text();
        var data = $("#kirim").serialize()+"&p=quiz&sisa_waktu="+waktu_tersisa;
        $.ajax({
          url : "prosess.php",
          data:data+"&mod=selesai",
          type:"POST",
          success:function(hasil){
            setTimeout(function(){
              window.location.href=hasil;
            },1000);
          }
        });
    });


    $("#selesai").click(function(e){
        e.preventDefault();
        var waktu_tersisa = $('.waktu_server').text();
        var data = $("#kirim").serialize()+"&p=quiz&sisa_waktu="+waktu_tersisa;
        $.ajax({
          url : "prosess.php",
          data:data+"&mod=selesai",
          type:"POST",
          success:function(hasil){
            setTimeout(function(){
              window.location.href=hasil;
            },2000);
          }
        });
    });
});
