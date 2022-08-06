$(document).ready(function(){
 //logout
	$("#logout_btn").on("click", function(e){
    	e.preventDefault();
            $.ajax({
			url : '../php_classes/login_student_admin.php',
			method : "POST",
			data : {logout_admin_btn:1},
			success : function(response){
               window.location.href = "index.php";
			}
		});

	});

});