function addNewLogo(avatar){
	if (avatar.files && avatar.files[0]) {
		var reader = new FileReader();
		reader.onload = function (e){
			$('#logo-img').attr('src', e.target.result);
		}
		reader.readAsDataURL(avatar.files[0]);
	}
}