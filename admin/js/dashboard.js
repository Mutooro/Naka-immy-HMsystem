$(document).ready(function(){

	 get_bookings();
	function get_bookings(){
		$.ajax({
			url : './php_classes/dashboard.php',
			method : 'POST',
			data : {get_bookings:1},
			success : function(response){
            $("#display_1").html(response);
			}
		})
		
	}
	 get_hostels();
	function get_hostels(){
		$.ajax({
			url : '/php_classes/dashboard.php',
			method : 'POST',
			data : {get_hostels:1},
			success : function(response){
				console.log(response);
            $("#display_2").html(response);
			}
		})
		
	}
	 get_rooms();
	function get_rooms(){
		$.ajax({
			url : './php_classes/dashboard.php',
			method : 'POST',
			data : {get_rooms:1},
			success : function(response){
				console.log(response);
             $("#display_3").html(response);
			}
		})
		
	}
	 get_students();
	function get_students(){
		$.ajax({
			url : './php_classes/dashboard.php',
			method : 'POST',
			data : {get_students:1},
			success : function(response){
			$("#display_4").html(response);
			}
		})
		
	}
});	
