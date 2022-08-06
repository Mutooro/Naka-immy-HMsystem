$(document).ready(function(){

	 getData();
	function getData(){
		$.ajax({
			url : './php_classes/post_notif.php',
			method : 'POST',
			data : {Get_Data:1},
			success : function(response){
				console.log(response);
				var resp = $.parseJSON(response);

				var brandHTML = '';

				$.each(resp.message, function(index, value){
					brandHTML += '<tr>'+
									'<td>'+value.not_date+'</td>'+
									'<td>'+value.not_desc+'</td>'+
									'<td><a class="btn btn-sm btn-info edit_post"><span style="display:none;">'+JSON.stringify(value)+'</span><i class="fas fa-pencil-alt"></i></a>&nbsp;<a id="'+value.id+'" class="btn btn-sm btn-danger delete_post"><i class="fas fa-trash-alt"></i></a></td>'+
								'</tr>';
				});

				$("#display").html(brandHTML);

			}
		})
	}


    $("#post_notification_btn").on("click", function(e){
    	e.preventDefault();
            $.ajax({
			url : './php_classes/post_notif.php',
			method : "POST",
			data : $("#post_notification_form").serialize(),
			beforeSend:function(){
					$('#post_notification_btn').attr('disabled', 'disabled');
					$('#post_notification_btn').val('Loading..');
				},
			success : function(response){
				console.log(response);
				var resp = $.parseJSON(response);
				if (resp.status == 202) {
					getData();
					$(".message").html('<div class="alert alert-success text-center"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> <b>'+resp.message+'</b></div>');
					$("#post_notification_form").trigger("reset");
					$('#post_notification_modal').modal('hide');
					
				}else if(resp.status == 303){
					$(".message_2").html('<div class="alert alert-danger text-center"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> <b>'+resp.message+'</b></div>');
				}
			  $('#post_notification_btn').val('post');
              $('#post_notification_btn').attr('disabled', false);
			}
		});

	});

	$(document.body).on("click", ".edit_post", function(){

		var data = $.parseJSON($.trim($(this).children("span").html()));
		console.log(data);
		$("textarea[name='not_desc']").val(data.not_desc);
		$("input[name='id']").val(data.id);

		$("#edit_post_notification_modal").modal('show');
});

$("#edit_post_notification_btn").on("click", function(){

		$.ajax({
			url : './php_classes/post_notif.php',
			method : "POST",
			data : $("#edit_post_notification_form").serialize(),
			beforeSend:function(){
					$('#edit_post_notification_btn').attr('disabled','disabled');
					$('#edit_post_notification_btn').val('Loading..');
				},
			success : function(response){
				console.log(response);
				var resp = $.parseJSON(response);
				if (resp.status == 202) {
					getData();
					$(".message").html('<div class="alert alert-success text-center"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> <b>'+resp.message+'</b></div>');
					$("#edit_post_notification_form").trigger("reset");
					$('#edit_post_notification_modal').modal('hide');
				}else if(resp.status == 303){
					$(".message_2").html('<div class="alert alert-danger text-center"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> <b>'+resp.message+'</b></div>');
					$('#edit_hostel_modal').modal('hide');
				}
			  $('#edit_post_notification_btn').val('post');
              $('#edit_post_notification_btn').attr('disabled', false);
			}
		});

	});

$(document.body).on('click', '.delete_post', function(){

		var id = $(this).attr('id');

		if (confirm("Are you sure to delete this post")) {
			$.ajax({
				url : './php_classes/post_notif.php',
				method : 'POST',
				data : {DELETE_DATA:1, id:id},
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