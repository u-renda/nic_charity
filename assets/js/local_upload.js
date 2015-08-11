(function () {
	var input = document.getElementById("images"), 
		formdata = false;

	if (window.FormData) {
  		formdata = new FormData();
  		document.getElementById("btn_uploader").style.display = "none";
	}
	
 	input.addEventListener("change", function (evt) {
 		$('#loading').show();
		$('#upload_form #images').hide();
 		var i = 0, len = this.files.length, img, reader, file;
	
		file = this.files[0];
		if (!!file.type.match(/image.*/)) {
			if ( window.FileReader ) {
				reader = new FileReader();
				/*reader.onloadend = function (e) { 
					showUploadedItem(e.target.result, file.fileName);
				};*/
				reader.readAsDataURL(file);
			}
			if (formdata) {
				formdata.append("images", file);
			}
		}
	
		if (formdata) {
			$.ajax({
				url: "http://upload.infokost.id/images/local_upload",
				type: "POST",
				data: formdata,
				processData: false,
				contentType: false,
				crosDomain: true,
				success: function (res) {
					window.parent.receive(res);
					$('#upload_form #images').show();
					$('#loading').hide();
					$('#upload_form #images').val("");
				}
			});
		}
	}, false);
}());
