$(document).ready(function(){

	 getData();
	function getData(){
		$.ajax({
			url : './php_classes/add_admin.php',
			method : 'POST',
			data : {Get_Data:1},
			success : function(response){
				var resp = $.parseJSON(response);

				var brandHTML = '';

				$.each(resp.message, function(index, value){
					brandHTML += '<tr>'+
									'<td>'+value.full_names+'</td>'+
									'<td>'+value.username +'</td>'+
									'<td><a name="'+value.username+'" bid="'+value.admin_id+'" class="btn btn-sm btn-danger delete-data"><i class="fas fa-trash-alt"></i></a></td>'+
								'</tr>';
				});

				$("#display").html(brandHTML);

			}
		})
		
	}


    $("#add_admin_btn").on("click", function(e){
    	e.preventDefault();
            $.ajax({
			url : './php_classes/add_admin.php',
			method : "POST",
			data : $("#add_admin_form").serialize(),
			beforeSend:function(){
					$('#add_admin_btn').attr('disabled', 'disabled');
					$('#add_admin_btn').val('Loading..');
				},
			success : function(response){
				var resp = $.parseJSON(response);
				if (resp.status == 202) {
					getData();
					$(".message").html('<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> <b>'+resp.message+'.!</b></div>');
					$("#add_admin_form").trigger("reset");
					$('#add_admin_modal').modal('hide');
					
				}else if(resp.status == 303){
					$(".message_2").html('<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> <b>'+resp.message+'.!</b></div>');
				}
			  $('#add_admin_btn').val('save');
              $('#add_admin_btn').attr('disabled', false);
			}
		});

	});


	$(document.body).on('click', '.delete-data', function(){

		var bid = $(this).attr('bid');
		var name = $(this).attr('name');

		if (confirm("Are you sure to delete")) {
			$.ajax({
				url : './php_classes/add_admin.php',
				method : 'POST',
				data : {DELETE_DATA:1,bid:bid,name:name},
				success : function(response){
				var resp = $.parseJSON(response);
                   if (resp.status == 202) {
					getData();
					alert("deleted.")
				}

				}
			});
		}else{
			alert('Cancelled');
		}
   });

});

