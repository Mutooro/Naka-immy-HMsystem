$(document).ready(function(){
getData()
//for getting hostel name 
$.ajax({
			url : './php_classes/add_room.php',
			method : 'POST',
			data : {Get_Hostel:1},
			success : function(response){
				console.log(response);
                $("#display_hostel").html(response);
                $("#display_hostel_2").html(response);
			}
		});


//for adding rooms

    $("#add_room_btn").on("click", function(e){
    	e.preventDefault();
            $.ajax({
			url : './php_classes/add_room.php',
			method : "POST",
			data : new FormData($("#add_room_form")[0]),
			contentType : false,
			cache : false,
			processData : false,
			beforeSend:function(){
					$('#add_room_btn').attr('disabled', 'disabled');
					$('#add_room_btn').val('Uploading...Wait');
				},
			success : function(response){
				console.log(response);
				var resp = $.parseJSON(response);
				if (resp.status == 202) {
					getData()
					$(".message").html('<div class="alert alert-success text-center"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> <b>'+resp.message+'</b></div>');
					$("#add_room_form").trigger("reset");
					$('#add_room_modal').modal('hide');
					
				}else if(resp.status == 303){
					$(".message_2").html('<div class="alert alert-danger text-center"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> <b>'+resp.message+'</b></div>');
				}
			  $('#add_room_btn').val('save');
              $('#add_room_btn').attr('disabled', false);
			}
		});

	});

 //for fetching data
	function getData(){
		$.ajax({
			url : './php_classes/add_room.php',
			method : 'POST',
			data : {Get_Data:1},
			success : function(response){
				console.log(response);
				var resp = $.parseJSON(response);

				var brandHTML = '';

				$.each(resp.message, function(index, value){
					brandHTML += '<tr>'+
									'<td>'+value.hostel_name+'</td>'+
									'<td>'+value.seater+'</td>'+
									'<td>'+value.fee+'</td>'+
									'<td>'+value.cooking+'</td>'+
									'<td><img width="60" height="60" src="uploaded-img/'+value.room_image_1+'"></td>'+
									'<td><a class="btn btn-sm btn-info edit-data"><span style="display:none;">'+JSON.stringify(value)+'</span><i class="fas fa-pencil-alt"></i></a>&nbsp;<a bid="'+value.room_id+'" class="btn btn-sm btn-danger delete-data"><i class="fas fa-trash-alt"></i></a></td>'+
								'</tr>';
				});

				$("#display").html(brandHTML);

			}
		})
		
	}
 
 //editing
 $(document.body).on("click", ".edit-data", function(){

		var data = $.parseJSON($.trim($(this).children("span").html()));
		console.log(data);
		$("input[name='fee']").val(data.fee);
		$("input[name='room_id']").val(data.room_id);

		$("#edit_room_modal").modal('show');
});

$("#edit_room_btn").on("click", function(){

		$.ajax({
			url : './php_classes/add_room.php',
			method : "POST",
			data : new FormData($("#edit_room_form")[0]),
			contentType : false,
			cache : false,
			processData : false,
			beforeSend:function(){
					$('#edit_room_btn').attr('disabled','disabled');
					$('#edit_room_btn').val('Updating...Please Wait.');
				},
			success : function(response){
				console.log(response);
				var resp = $.parseJSON(response);
				if (resp.status == 202) {
					getData();
					$(".message").html('<div class="alert alert-success text-center"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> <b>'+resp.message+'</b></div>');
					$("#edit_room_form").trigger("reset");
					$('#edit_room_modal').modal('hide');
				}else if(resp.status == 303){
					$(".message_2").html('<div class="alert alert-danger text-center"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> <b>'+resp.message+'</b></div>');
				}
			  $('#edit_room_btn').val('update');
              $('#edit_room_btn').attr('disabled', false);
			}
		});

	});

   

$(document.body).on('click', '.delete-data', function(){

		var bid = $(this).attr('bid');

		if (confirm("Are you sure to delete this post")) {
			$.ajax({
				url : './php_classes/add_room.php',
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







});

