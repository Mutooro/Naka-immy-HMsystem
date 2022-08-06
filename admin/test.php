<?php

require_once('pdf_libs/pdf.php');
include_once('../config/db.php');


// Fetch records from database 
$q = "SELECT * FROM bookings ORDER BY booking_id ASC"; 
 $run_query = mysqli_query($con,$q) or die(mysqli_error($con));
    if(mysqli_num_rows($run_query) > 0){
    $delimiter = ","; 
    $filename = "test.xls"; 
     
    // Create a file pointer 
    $f = fopen('php://memory', 'w'); 
     
    // Set column headers 
    $fields = array('ID', 'Reg No.', 'Amount', 'Status', 'No. of Days', 'Starting Date', 'Ending Date', 'Payment No.', 'Transaction Reference'); 
 fputcsv($f, $fields, $delimiter); 
     
    // Output each row of the data, format line as csv and write to file pointer 
    while($row = mysqli_fetch_array($run_query)){ 
        $lineData = array($row['booking_id'], $row['student_reg_no'], $row['new_fee'], $row['payment_status'], $row['days_number'], $row['start_date'], $row['end_date'], $row['payment_number'], $row['TransactionReference']); 
        fputcsv($f, $lineData, $delimiter); 
    } 
     
    // Move back to beginning of file 
    fseek($f, 0); 
     
    // Set headers to download file rather than displayed 
    header('Content-Type: text/xls'); 
    header('Content-Disposition: attachment; filename="' . $filename . '";'); 
     
    //output all remaining data on a file pointer 
    fpassthru($f); 
} 


 ?>