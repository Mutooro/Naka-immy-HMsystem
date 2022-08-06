$(document).ready(function(){
// load hostel list on hostels.php
	$.ajax({
			url : 'action.php',
			method : 'POST',
			data : {get_hostel_contacts:1},
			success : function(response){
				var resp = $.parseJSON(response);

				var brandHTML = '';

				$.each(resp, function(index, value){
					brandHTML += '<tr>'+
									'<td>'+ value.name+'</td>'+
									'<td>'+value.call_number_1+'  or  '+value.call_number+'</td>'+
								'</tr>';
				});

				$("#display_list").html(brandHTML);

			}
		});
	});
