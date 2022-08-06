
/**
MOST IMPO JS FILE
This file communicate with two pages that is home.php,singel_hostel_rooms.php
it sends requests to folder "php_classes/bookings.php" AND action.php
some of the key booking_btn fuctionality and logics starts here.
**/


$(document).ready(function(){
//fuction for loading rooms in request is sent to action.php 
loadRooms();
function loadRooms(){
$.ajax({
			url : 'action.php',
			method : 'POST',
			data : {Get_Rooms:1},
			success : function(response){
                $("#display_rooms").html(response);
			}
		});
}
//function for success modal for home page each time u visit the home page
login_success_message();
function login_success_message(){
	$.ajax({
			url : 'action.php',
			method : 'POST',
			data : {Get_Name:1},
			success : function(response){
                $(".message").html(response);
                $('#success_modal').modal('show');
			}
		});
}



//loading more rooms on the page "LOAD MORE" button
 var loadCount = 6;
 $("#load_more_btn").on("click", function(e){
    	e.preventDefault();
          loadCount = loadCount + 3;
            $.ajax({
			url : 'action.php',
			method : "POST",
			data : {Load_More:1,loadCount:loadCount},
			beforeSend:function(){
					$('#load_more_btn').attr('disabled', 'disabled');
					$('#load_more_btn').val('Loading..');
				},
			success : function(response){
				console.log(response);
			    $('#load_more_btn').val('LOAD MORE');
                $('#load_more_btn').attr('disabled', false);
                $("#display_rooms").html(response);
			}
		});

	});

 
/**
  MAIN PURPOSE OF THE SYSTEM
  This is the backbone of the application all the booking fuctionality is done below
  Coding is good go sydney..!!
 **/
 //shows the comfimation modal to enter the date ie starting date 

$("body").delegate(".booking_btn","click",function(){
	$('#comfirm_booking_form')[0].reset();
    var booking_btn = $(this).parent();
    var room_id = booking_btn.find(".booking_btn").attr("room_id");
    var fee = booking_btn.find(".booking_btn").attr("fee");
    $('#fee').val(fee);
    $("input[name='room_id']").val(room_id);
    $("#comfirm_modal").modal('show');

    $(function(){
            $('#startDate, #daysNumber').keyup(function(){

               var startDate = new Date($("#startDate").val() || 0);
               var daysNumber = parseFloat($('#daysNumber').val() || 0);
               var newFee = daysNumber*fee;
             
               var newDate = new Date(startDate);
               newDate.setDate(newDate.getDate() + daysNumber);
               
               var string = newDate.getDate()+"-"+(newDate.getMonth() +1) +"-"+newDate.getFullYear();

               $('#newDate').val(string);
               $('#newFee').val(newFee);

            });
         });
   

});



//comfirm booking btn this finishes the booking 
$("#comfirm_booking_btn").on("click", function(e){
	e.preventDefault();

		$.ajax({
			url : './php_classes/bookings.php',
			method : "POST",
			data : $("#comfirm_booking_form").serialize(),
			beforeSend:function(){
					$('#btn_loader').show();
					$('#comfirm_booking_btn').hide();
				},
			success : function(response){
				console.log(response);
				var resp = $.parseJSON(response);
				if (resp.status == 202) {
					$(".message").html('<div class="alert alert-success text-center"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> <b>'+resp.message+'</b></div>');
					$("#comfirm_booking_form").trigger("reset");
					$('#comfirm_modal').modal('hide');
					$('#success_modal').modal('show');
				}else if(resp.status == 303){
					$(".message_2").html('<div class="alert alert-danger text-center"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> <b>'+resp.message+'</b></div>');
					}
			  $('#comfirm_booking_btn').show();
              $('#btn_loader').hide();
			}
		});

	});

//fuction to get student booking that he/she has booked
get_student_bookings();
function get_student_bookings(){
	$.ajax({
			url : 'action.php',
			method : 'POST',
			data : {get_student_bookings:1},
			success : function(response){
				var resp = $.parseJSON(response);

				var brandHTML = '';
                var payment_status='';
				$.each(resp, function(index, value){
					if(value.payment_status=='PAID'){
						 payment_status='<span class="badge badge-success">PAID</span>';
					}else{
					     payment_status='<span class="badge badge-warning">NOT PAID</span>';
					}
					brandHTML += '<tr>'+
									'<td><img  height="100" src="admin/uploaded-img/'+value.room_image_1+'"></td>'+
									'<td>'+value.new_fee+'</td>'+
									'<td>'+payment_status+'</td>'+
									'<td>'+value.payment_number+'</td>'+
									'<td><a booking_id="'+value.booking_id+'" class="btn btn-sm btn-warning view_booking"><i class="fa fa-eye"></i></a></td>'+
								'</tr>';
				});

				$("#display_list").html(brandHTML);

			}
		})
}

//viewing the  bookings using eye_btn
$(document.body).on('click', '.view_booking', function(){

		var booking_id = $(this).attr('booking_id');

		$.ajax({
			url : 'action.php',
			method : 'POST',
			data : {viewing_booking:1,booking_id:booking_id},
			success : function(response){
                $("#view_booking").html(response);
                $("#view_bookings_modal").modal('show');
			}
		});
});	

//deleting bookings
$(document.body).on('click', '.delete_booking', function(){

		var booking_id = $(this).attr('booking_id');
		var room_id = $(this).attr('room_id');
        if (confirm("Are you sure you want to delete your booking?")) {
			$.ajax({
				url : 'action.php',
				method : 'POST',
				data : {delete_booking:1, booking_id:booking_id, room_id:room_id},
				success : function(response){
				console.log(response);
				var resp = $.parseJSON(response);
                   if (resp.status == 202) {
					get_student_bookings();
					$(".messageC").html('<div class="alert alert-success text-center"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> <b>'+resp.message+'</b></div>');
				}else if(resp.status == 303){
					get_student_bookings();
					$(".messageC").html('<div class="alert alert-danger text-center"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> <b>'+resp.message+'</b></div>');
				}

				}
			});
		}else{
			get_student_bookings();
			alert('Cancelled');
		}
   });

/*
Hi function tunaitumia kuangalia kama number alizo upload user zina match 
na alizo upload admin 
*/
check_if_receipt_number_match();
function check_if_receipt_number_match(){
	$.ajax({
			url : './php_classes/bookings.php',
			method : 'POST',
			data : {check_if_receipt_number_match:1},
			success : function(response){
               console.log(response);
			}
		});

}



});
