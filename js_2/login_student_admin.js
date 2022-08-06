$(document).ready(function(){

    $("#student_login_btn").on("click", function(e){
    	e.preventDefault();
            $.ajax({
			url : './php_classes/login_student_admin.php',
			method : "POST",
			data : $("#student_login_form").serialize(),
			beforeSend:function(){
					$('#student_login_btn').attr('disabled', 'disabled');
					$('#student_login_btn').val('Loading..');
				},
			success : function(response){
				var resp = $.parseJSON(response);
				if (resp.status == 202) {
					$("#student_login_form").trigger("reset");
					$('#studentLoginModal').modal('hide');
					window.location.href = "home.php";
				}else if(resp.status == 303){
					$(".message_2").html('<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> <b>'+resp.message+'.!</b></div>');
				}

			  $('#student_login_btn').val('Login');
              $('#student_login_btn').attr('disabled', false);
			}
		});

	});

	$("#admin_login_btn").on("click", function(e){
    	e.preventDefault();
            $.ajax({
			url : './php_classes/login_student_admin.php',
			method : "POST",
			data : $("#admin_login_form").serialize(),
			beforeSend:function(){
					$('#admin_login_btn').attr('disabled', 'disabled');
					$('#admin_login_btn').val('Loading..');
				},
			success : function(response){
				var resp = $.parseJSON(response);
				if (resp.status == 202) {
					$("#admin_login_form").trigger("reset");
					$('#adminLoginModal').modal('hide');
					window.location.href = "admin/index.php";
				}else if(resp.status == 303){
					$(".message_2").html('<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> <b>'+resp.message+'.!</b></div>');
				}

			  $('#admin_login_btn').val('Login');
              $('#admin_login_btn').attr('disabled', false);
			}
		});

	});

	

});