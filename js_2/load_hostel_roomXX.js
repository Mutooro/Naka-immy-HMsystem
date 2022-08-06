$(document).ready(function(){
// load hostel list on hostels.php
	$.ajax({
			url : 'action.php',
			method : 'POST',
			data : {Get_Hostel:1},
			success : function(response){
				console.log(response);
				var resp = $.parseJSON(response);

				var brandHTML = '';

				$.each(resp, function(index, value){
					brandHTML += '<tr>'+
									'<td>'+ value.name+'</td>'+
									'<td><button hid="'+value.name+'" class="btn btn-sm btn-info view_data">view rooms</button></td>'+
								'</tr>';
				});

				$("#display_list").html(brandHTML);

			}
		});

//for loading single hostel rooms only
$(document.body).on('click', '.view_data', function(){

		var hostel_name = $(this).attr('hid');
		
		    $.ajax({
			url : 'action.php',
			method : "POST",
			data : {GET_Hostel_rooms:1,hostel_name:hostel_name},
			success : function(response){
				console.log(response);
				window.location.href = "single_hostel_rooms.php";
			   
			}
		});

	});




});