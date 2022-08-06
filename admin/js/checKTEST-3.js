$(document).ready(function(){

    $("#add_student_btn").on("click", function(e){
    	e.preventDefault();
            $.ajax({
			url : './php_classes/add_student.php',
			method : "POST",
			data : $("#add_student_form").serialize(),
			beforeSend:function(){
					$('#add_student_btn').attr('disabled', 'disabled');
					$('#add_student_btn').val('Loading..');
				},
			success : function(response){
				console.log(response);
				var resp = $.parseJSON(response);
				if (resp.status == 202) {
					getData();
					$(".message").html('<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> <b>'+resp.message+'.!</b></div>');
					$("#add_student_form").trigger("reset");
					$('#add_student').modal('hide');
				}else if(resp.status == 303){
					$(".message_2").html('<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> <b>'+resp.message+'.!</b></div>');
				}
			  $('#add_student_btn').val('save');
              $('#add_student_btn').attr('disabled', false);
			}
		});

	});


	 getData();
	function getData(){
		$.ajax({
			url : './php_classes/add_student.php',
			method : 'POST',
			data : {Get_Data:1},
			success : function(response){
				console.log(response);
				var resp = $.parseJSON(response);

				var brandHTML = '';

				$.each(resp.message, function(index, value){
					brandHTML += '<tr>'+
									'<td>'+value.student_reg_no+'</td>'+
									'<td>'+value.Year+'</td>'+
									'<td><a class="btn btn-sm btn-info edit-data"><span style="display:none;">'+JSON.stringify(value)+'</span><i class="fas fa-pencil-alt"></i></a>&nbsp;<a bid="'+value.student_reg_no+'" class="btn btn-sm btn-danger delete-data"><i class="fas fa-trash-alt"></i></a></td>'+
								'</tr>';
				});

				$("#display_list").html(brandHTML);

			}
		})
		
	}

	$("#add_student_CSV_btn").on("click", function(e){
    	e.preventDefault();
            $.ajax({
			url : './php_classes/add_student.php',
			method : "POST",
			data : new FormData($("#add_student_CSV_form")[0]),
			contentType : false,
			cache : false,
			processData : false,
			beforeSend:function(){
					$('#add_student_CSV_btn').attr('disabled', 'disabled');
					$('#add_student_CSV_btn').val('Loading..');
				},
			success : function(response){
				console.log(response);
				var resp = $.parseJSON(response);
				if (resp.status == 202) {
					getData();
					$(".message").html('<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> <b>'+resp.message+'.!</b></div>');
					$("#add_student_CSV_form").trigger("reset");
					$('#add_student_CSV_modal').modal('hide');
				}else if(resp.status == 303){
					$(".message_2").html('<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> <b>'+resp.message+'.!</b></div>');
				}
			  $('#add_student_CSV_btn').val('save');
              $('#add_student_CSV_btn').attr('disabled', false);
			}
		});

	});

});
