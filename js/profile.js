$(document).ready(function () {
	var img_file = $(".file");
		 var img = $(".img");
		img_file.on('change', function(){
			var files = this.files[0];
			var reader = new FileReader();
				reader.onload = function(e){
					img.attr({
						'src':e.target.result
					});
				}
				reader.readAsDataURL(files);
				console.log(reader);
		});
});