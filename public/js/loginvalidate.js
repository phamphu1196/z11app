$(document).ready(function() {

	$.validator.setDefaults({
    highlight: function(element) {
        $(element).closest('.form-group').addClass('has-error');
        $(".fa-spinner").hide();
    },
    unhighlight: function(element) {
        $(element).closest('.form-group').removeClass('has-error');
        $(".fa-spinner").show();

    },
    errorElement: 'span',
    errorClass: 'help-block',
    errorPlacement: function(error, element) {
        if(element.parent('.input-group').length) {
            error.insertAfter(element.parent());
        } else {
            error.insertBefore(element);
        }
    }
});
	$("#login-form").validate({
		rules: {
			username : {
				required : true,
				maxlength : 30
			},
			password : {
				required : true,
			},
		},

		messages : {
			username : {
				required : "Không đưọc bỏ trống tên đăng nhập",
				maxlength : "Chiều dài tối đa là 30 kí tự"
			},
			password : {
				required : "Mật khẩu không được bỏ trống",
			},			
		}
	});

});