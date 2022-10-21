
    $(function () {
        //deklarasi variable form
        	$("#sign").validate({
                rules: {
                    'noreg': {required: true},
                    'pwd':{required:true}
                },
                messages:{
                    'noreg':{required: "Ups... No. Registrasi tidak boleh kosong !"},
                    'pwd':{required: "Ups... Password tidak boleh kosong !"},
	                },
	            highlight: function (input) {
	                $(input).parents('.form-line').addClass('error');
	            },
	            unhighlight: function (input) {
	                $(input).parents('.form-line').removeClass('error');
	            },
	            errorPlacement: function (error, element) {
	                $(element).parents('.input-group').append(error);
	            }
	        });
        $("#sign").submit(function(e){
        	e.preventDefault();
	        
            $.ajax({
                url : "prosess-login.php",
                type: 'POST',
                data: $(this).serialize()+"&p=siswa",
                success:function(xhr){
                    var data = $.parseJSON(xhr);
                        for(var i=0; i<data.length; i++){
                            var txtData  = data[i].split('|');
                            var color    = txtData[0];
                            var txt      = txtData[1];
                            showNotification(color,txt,'top','right','animated bounceInDown','animated bounceInDown');
                            if(color == 'bg-green'){
                                setTimeout(function(){
                                    window.location=txtData[2];
                                },3000);
                            }
                        }
                },
                error:function(){
                    console.log('error request ajax');
                }
            });
        });
        $("#data").submit(function(e){
        	e.preventDefault();
        	$.ajax({
                url : "prosess-login.php",
                type: 'POST',
                data: $(this).serialize()+"&p=verifikasi-data",
                success:function(xhr){
                    var data = $.parseJSON(xhr);
                        for(var i=0; i<data.length; i++){
                            var txtData  = data[i].split('|');
                            var color    = txtData[0];
                            var txt      = txtData[1];
                            showNotification(color,txt,'top','right','animated bounceInDown','animated bounceInDown');
                            if(color == 'bg-green'){
                                setTimeout(function(){
                                    window.location=txtData[2];
                                },3000);
                            }
                        }
                },

                error:function(){
                    console.log('error request ajax');
                }
            });
        });
        $("#tes").submit(function(e){
        	e.preventDefault();
        	$.ajax({
                url : "prosess-login.php",
                type: 'POST',
                data: $(this).serialize()+"&p=verifikasi-tes",
                success:function(xhr){
                    var data = $.parseJSON(xhr);
                        for(var i=0; i<data.length; i++){
                            var txtData  = data[i].split('|');
                            var color    = txtData[0];
                            var txt      = txtData[1];
                            showNotification(color,txt,'top','right','animated bounceInDown','animated bounceInDown');
                            if(color == 'bg-green'){
                                setTimeout(function(){
                                    window.location=txtData[2];
                                },3000);
                            }
                        }
                },

                error:function(){
                    console.log('error request ajax');
                }
            });
        });
        //validate when user submit the form

        //function for notification 
        function showNotification(colorName, text, placementFrom, placementAlign, animateEnter, animateExit) {
            if (colorName === null || colorName === '') { colorName = 'bg-black'; }
            if (text === null || text === '') { text = 'Turning standard Bootstrap alerts'; }
            if (animateEnter === null || animateEnter === '') { animateEnter = 'animated fadeInDown'; }
            if (animateExit === null || animateExit === '') { animateExit = 'animated fadeOutUp'; }
            var allowDismiss = true;

            $.notify({
                message: text
            },
                {
                    type: colorName,
                    allow_dismiss: allowDismiss,
                    newest_on_top: true,
                    timer: 1000,
                    placement: {
                        from: placementFrom,
                        align: placementAlign
                    },
                    animate: {
                        enter: animateEnter,
                        exit: animateExit
                    },
                    template: '<div data-notify="container" class="bootstrap-notify-container alert alert-dismissible {0} ' + (allowDismiss ? "p-r-35" : "") + '" role="alert">' +
                    '<button type="button" aria-hidden="true" aria-label="close" class="close" data-notify="dismiss"><span aria-hidden="true">×</span></button>' +
                    '<span data-notify="icon"></span> ' +
                    '<span data-notify="title">{1}</span> ' +
                    '<span data-notify="message">{2}</span>' +
                    '<div class="progress" data-notify="progressbar">' +
                    '<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
                    '</div>' +
                    '<a href="{3}" target="{4}" data-notify="url"></a>' +
                    '</div>'
                });
        }

});