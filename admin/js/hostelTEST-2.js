$(document).ready(function(){

	 getData();
	function getData(){
		$.ajax({
			url : './php_classes/add_hostel.php',
			method : 'POST',
			data : {Get_Data:1},
			success : function(response){
				console.log(response);
				var resp = $.parseJSON(response);

				var brandHTML = '';

				$.each(resp.message, function(index, value){
					brandHTML += '<tr>'+
									'<td>'+value.name+'</td>'+
									'<td>'+value.description+'</td>'+
									'<td>'+value.call_number_1+'</td>'+
									'<td>'+value.call_number+'</td>'+
									'<td><a class="btn btn-sm btn-info edit-data"><span style="display:none;">'+JSON.stringify(value)+'</span><i class="fas fa-pencil-alt"></i></a>&nbsp;<a bid="'+value.hostel_id+'" class="btn btn-sm btn-danger delete-data"><i class="fas fa-trash-alt"></i></a></td>'+
								'</tr>';
				});

				$("#display").html(brandHTML);

			}
		})
		
	}


    $("#add_hostel_btn").on("click", function(){
            $.ajax({
			url : './php_classes/add_hostel.php',
			method : "POST",
			data : $("#add_hostel_form").serialize(),
			beforeSend:function(){
					$('#add_hostel_btn').attr('disabled', 'disabled');
					$('#add_hostel_btn').val('Loading..');
				},
			success : function(response){
				console.log(response);
				var resp = $.parseJSON(response);
				if (resp.status == 202) {
					getData();
					$(".message").html('<div class="alert alert-success text-center"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> <b>'+resp.message+'</b></div>');
					$("#add_hostel_form").trigger("reset");
					$('#add_hostel_modal').modal('hide');
					
				}else if(resp.status == 303){
					$(".message_2").html('<div class="alert alert-danger text-center"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> <b>'+resp.message+'</b></div>');
				}
			  $('#add_hostel_btn').val('save');
              $('#add_hostel_btn').attr('disabled', false);
			}
		});

	});


	$(document.body).on('click', '.delete-data', function(){

		var bid = $(this).attr('bid');

		if (confirm("Are you sure to delete this post")) {
			$.ajax({
				url : './php_classes/add_hostel.php',
				method : 'POST',
				data : {DELETE_DATA:1, bid:bid},
				success : function(response){
				console.log(response);
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

	
$(document.body).on("click", ".edit-data", function(){

		var data = $.parseJSON($.trim($(this).children("span").html()));
		console.log(data);
		$("input[name='hostel_name']").val(data.name);
		$("input[name='hostel_desc']").val(data.description);
		$("input[name='call_number_1']").val(data.call_number_1);
		$("input[name='call_number']").val(data.call_number);
		

		$("#edit_hostel_modal").modal('show');
});

$("#edit_hostel_btn").on$("input[name='hid']").val(data.hostel_id);("click", function(){

		$.ajax({
			url : './php_classes/add_hostel.php',
			method : "POST",
			data : $("#edit_hostel_form").serialize(),
			beforeSend:function(){
					$('#edit_hostel_btn').attr('disabled','disabled');
					$('#edit_hostel_btn').val('Loading..');
				},
			success : function(response){
				console.log(response);
				var resp = $.parseJSON(response);
				if (resp.status == 202) {
					getData();
					$(".message").html('<div class="alert alert-success text-center"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> <b>'+resp.message+'</b></div>');
					$("#edit_hostel_form").trigger("reset");
					$('#edit_hostel_modal').modal('hide');
				}else if(resp.status == 303){
					$(".message").html('<div class="alert alert-danger text-center"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> <b>'+resp.message+'</b></div>');
					$('#edit_hostel_modal').modal('hide');
				}
			  $('#edit_hostel_btn').val('save');
              $('#edit_hostel_btn').attr('disabled', false);
			}
		});

	});


});
