$(document).ready(function(){

//code for fetching data
fetchData();
function fetchData(){
   $('#datatableid').DataTable({
      'processing': true,
      'serverSide': true,
      'serverMethod': 'post',
      'ajax': {
          'url':'php_classes/student.php',
          'data': {load_all_students:1}
      },
      'columns': [
         { data: 'f_name' },
      { data: 'l_name' },
      { data: 'gender' },
      { data: 'student_no' },
      { data: 'address' },
      { data: 'student_reg_no' },
      { data: 'course' },
      { data: 'emmercence_no' },
      { data: 'father_names' },
      { data: 'place' },
      { data: 'occupation' },
      { data: 'phone_1' },
      { data: 'phone_2' },
      { data: 'email' },
      ]
   });
}

//for loading student lists
fetchStudentAdded();
function fetchStudentAdded(){
	  $('#fetchStudentAddedTable').DataTable({
      'processing': true,
      'serverSide': true,
      'serverMethod': 'post',
      'ajax': {
          'url':'php_classes/student.php',
          'data': {fetchStudentAdded:1}
      },
      'columns': [
      { data: 'student_reg_no' },
      { data: 'Year' },
      { defaultContent: '<a id="delete" class="btn btn-sm btn-danger delete-data"><i class="fas fa-trash-alt"></i></a>' },
      ]
   });  

}

//deleting data

$('.delete-data').on('click',function(){

         $tr = $(this).closest('tr');

         var data = $tr.children("td").map(function(){
          return $(this).text();
         }).get();

         console.log(data);

      });

    $("#add_student_btn").on("click", function(e){
    	e.preventDefault();
            $.ajax({
			url : './php_classes/student.php',
			method : "POST",
			data : $("#add_student_form").serialize(),
			beforeSend:function(){
					$('#add_student_btn').attr('disabled', 'disabled');
					$('#add_student_btn').val('Loading..');
				},
			success : function(response){
				console.log(response);
				var resp = $.parseJSON(response);
				if (resp.status == 202) {
					$(".message").html('<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> <b>'+resp.message+'.!</b></div>');
					$("#add_student_form").trigger("reset");
					$('#add_student').modal('hide');
				}else if(resp.status == 303){
					$(".message_2").html('<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> <b>'+resp.message+'.!</b></div>');
				}
			  $('#add_student_btn').val('save');
              $('#add_student_btn').attr('disabled', false);
			}
		});

	});


	$("#add_student_CSV_btn").on("click", function(e){
    	e.preventDefault();
            $.ajax({
			url : './php_classes/student.php',
			method : "POST",
			data : new FormData($("#add_student_CSV_form")[0]),
			contentType : false,
			cache : false,
			processData : false,
			beforeSend:function(){
					$('#add_student_CSV_btn').attr('disabled', 'disabled');
					$('#add_student_CSV_btn').val('Loading..');
				},
			success : function(response){
				console.log(response);
				var resp = $.parseJSON(response);
				if (resp.status == 202) {
					getData();
					$(".message").html('<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> <b>'+resp.message+'.!</b></div>');
					$("#add_student_CSV_form").trigger("reset");
					$('#add_student_CSV_modal').modal('hide');
				}else if(resp.status == 303){
					$(".message_2").html('<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> <b>'+resp.message+'.!</b></div>');
				}
			  $('#add_student_CSV_btn').val('save');
              $('#add_student_CSV_btn').attr('disabled', false);
			}
		});

	});


});
