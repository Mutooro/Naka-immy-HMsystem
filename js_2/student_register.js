$(document).ready(function(){

    $("#createStudent_btn").on("click", function(e){
    	e.preventDefault();
            $.ajax({
			url : './php_classes/student_register.php',
			method : "POST",
			data : $("#createStudent_form").serialize(),
			beforeSend:function(){
					$('#createStudent_btn').attr('disabled', 'disabled');
					$('#createStudent_btn').val('Loading..');
				},
			success : function(response){
				console.log(response);
				var resp = $.parseJSON(response);
				if (resp.status == 202) {
					$(".message").html('<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> <b>'+resp.message+'.!</b></div>');
					$("#createStudent_form").trigger("reset");
				}else if(resp.status == 303){
					$(".message").html('<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> <b>'+resp.message+'.!</b></div>');
				}

			  $('#createStudent_btn').val('Create');
              $('#createStudent_btn').attr('disabled', false);
			}
		});

	});

});
