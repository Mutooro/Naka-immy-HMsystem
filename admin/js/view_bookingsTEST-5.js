$(document).ready(function(){


get_bookings_list();
function get_bookings_list(){
	$.ajax({
			url : './php_classes/view_booking.php',
			method : 'POST',
			data : {get_bookings_list:1},
			success : function(response){
				console.log(response);
				var resp = $.parseJSON(response);
                var brandHTML = '';
                var payment_status='';
                $.each(resp.message, function(index, value){
                	if(value.payment_status=='PAID'){
						 payment_status='<span class="badge badge-success">PAID</span>';
					}
					brandHTML += '<tr>'+
									'<td>'+value.payment_number+'</td>'+
									'<td>'+value.new_fee+'</td>'+
									'<td>'+payment_status+'</td>'+
									'<td>'+value.student_reg_no+'</td>'+
									'<td><a booking_id="'+value.booking_id+'" class="btn btn-sm btn-info view_data"><i class="fa fa-eye"></i></a>'+
								'</tr>';
				});

     		$("#display").html(brandHTML);

			}
		})
}

$(document.body).on("click", ".view_data", function(){

		var booking_id = $(this).attr("booking_id");  
           $.ajax({  
                url:"./php_classes/view_booking.php",  
                method:"POST",  
                data:{view_data:1,booking_id:booking_id},  
                success:function(response){ 
                     $('#display_bookings').html(response);  
                     $('#view_bookings_modal').modal("show");  
                }  
           }); 
});

 $("#download_csv").on("click", function(e){
    	e.preventDefault();
            $.ajax({
			url : './php_classes/view_booking.php',
			method : "POST",
			data : {download_csv:1},
			success : function(response){
				console.log(response);

							}
		});

	});



});

