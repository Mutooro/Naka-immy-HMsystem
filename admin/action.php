<?php

require_once('pdf_libs/pdf.php');
include_once('../config/db.php');



if(isset($_POST["generate_booking_pdf_btn"])){
$output = '
     <style>

        table{
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }
        td, th{
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        tr:nth-child(even){
            background-color: #dddddd;
        }
        h2,p{
            color: green;
        }
        </style>
        <h2 align="center">HOSTEL BOOKING SYSTEM</h2>
        <p align="left">Bookings list:</p>
            <table cellspacing="0">
                  <tr>
                    <th>Payment number</th>
                    <th>Amount paid</th>
                    <th>Payment Status</th>
                    <th>Reg Number</th>
                    <th>Number of Days Paid</th>
                    <th>Starting Date</th>
                    <th>Ending Date</th>
                    <th>Transaction Reference</th>
                  </tr>';

    $q = "SELECT booking_id, student_reg_no, new_fee, payment_status, days_number, start_date, end_date, payment_number, TransactionReference FROM bookings";

    $run_query = mysqli_query($con,$q) or die(mysqli_error($con));
    if(mysqli_num_rows($run_query) > 0){
        while($row = mysqli_fetch_array($run_query)){
            $output.='
            <tr>
               <td>'.$row['payment_number'].'</td>
               <td>'.$row['new_fee'].'</td>
               <td>'.$row['payment_status'].'</td>
               <td>'.$row['student_reg_no'].'</td>
               <td>'.$row['days_number'].'</td>
               <td>'.$row['start_date'].'</td>
               <td>'.$row['end_date'].'</td>
               <td>'.$row['TransactionReference'].'</td>
             </tr>  ';
         }
        $output .='</table>';
    }


    $pdf = new Pdf();

    $file_name = 'Bookings List.pdf';

    $pdf->loadHtml($output);

    $pdf->setPaper('A4', 'landscape');

    $pdf->render();

    $pdf->stream($file_name, array("Attachment" => false));

    exit(0);

}

if(isset($_POST["generate_student_pdf_btn"])){
$output = '
     <style>

        table{
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }
        td, th{
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        tr:nth-child(even){
            background-color: #dddddd;
        }
        h2,p{
            color: green;
        }
        </style>
        <h2 align="center">HOSTEL BOOKING SYSTEM</h2>
        <p align="left">Registered student list:</p>
            <table cellspacing="0">
                  <tr>
                    <th>First name</th>
                    <th>Last name</th>
                    <th>Gender</th>
                    <th>Student phone No:</th>
                    <th>Address</th>
                    <th>Course</th>
                    <th>Emmergence No:</th>
                    <th>Father Name</th>
                    <th>Place</th>
                    <th>Occupation</th>
                    <th>Phone No: 1</th>
                    <th>Phone No: 2</th>
                    <th>Email</th>
                  </tr>';

    $q = "SELECT*FROM student_tbl";

    $run_query = mysqli_query($con,$q) or die(mysqli_error($con));
    if(mysqli_num_rows($run_query) > 0){
        while($row = mysqli_fetch_array($run_query)){
            $output.='
            <tr>
               <td>'.$row['f_name'].'</td>
               <td>'.$row['l_name'].'</td>
               <td>'.$row['gender'].'</td>
               <td>'.$row['student_no'].'</td>
               <td>'.$row['address'].'</td>
               <td>'.$row['course'].'</td>
               <td>'.$row['emmercence_no'].'</td>
               <td>'.$row['father_names'].'</td>
               <td>'.$row['place'].'</td>
               <td>'.$row['occupation'].'</td>
               <td>'.$row['phone_1'].'</td>
               <td>'.$row['phone_2'].'</td>
               <td>'.$row['email'].'</td>
             </tr>  ';
         }
        $output .='</table>';
    }


    $pdf = new Pdf();

    $file_name = 'Student List.pdf';

    $pdf->loadHtml($output);

    $pdf->setPaper('A3', 'landscape');

    $pdf->render();

    $pdf->stream($file_name, array("Attachment" => false));

    exit(0);

}

if(isset($_POST["download_csv_bookings_list"])){

  // Fetch records from database 
$q = "SELECT * FROM bookings ORDER BY booking_id ASC"; 
 $run_query = mysqli_query($con,$q) or die(mysqli_error($con));
    if(mysqli_num_rows($run_query) > 0){
    $delimiter = ","; 
    $filename = "Bookings List.csv"; 
     
    // Create a file pointer 
    $f = fopen('php://memory', 'w'); 
     
    // Set column headers 
    $fields = array('ID', 'Reg No.', 'Amount', 'Status', 'No. of Days', 'Starting Date', 'Ending Date', 'Payment No.', 'TransactionReference'); 
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
}


if(isset($_POST["download_csv_student_list"])){

  // Fetch records from database 
$q = "SELECT * FROM student_tbl"; 
 $run_query = mysqli_query($con,$q) or die(mysqli_error($con));
    if(mysqli_num_rows($run_query) > 0){
    $delimiter = ","; 
    $filename = "Students List.csv"; 
     
    // Create a file pointer 
    $f = fopen('php://memory', 'w'); 
     
    // Set column headers 
    $fields = array('First name', 'Last name', 'Gender', 'Student NO.', 'Address', 'Student Reg NO.', 'Course', 'Emmergence NO.', 'Father names', 'Place', 'Occupation', 'Phone 1', 'Phone 2', 'Email'); 
 fputcsv($f, $fields, $delimiter); 
     
    // Output each row of the data, format line as csv and write to file pointer 
    while($row = mysqli_fetch_array($run_query)){ 
        $lineData = array($row['f_name'], $row['l_name'], $row['gender'], $row['student_no'], $row['address'], $row['student_reg_no'], $row['course'], $row['emmercence_no'], $row['father_names'], $row['place'], $row['occupation'], $row['phone_1'], $row['phone_2'], $row['email']); 
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
}

if(isset($_POST["download_excel_student_list"])){

$sql = "SELECT*FROM `student_tbl`";  
$setRec = mysqli_query($con, $sql);  
$columnHeader = '';
$columnHeader = 'First name'. "\t" .'Last name'. "\t" .'Gender'. "\t" .'Student NO.'. "\t" .'Address'. "\t" .'Student Reg NO.'. "\t" .'Course'. "\t" .'Emmergence NO.'. "\t" .'Father names'. "\t" .'Place'. "\t" .'Occupation'. "\t" .'Phone 1'. "\t" .'Phone 2'. "\t" .'Email';
$setData = '';  
  while ($rec = mysqli_fetch_row($setRec)) {  
    $rowData = '';  
    foreach ($rec as $value) {  
        $value = '"' . $value . '"' . "\t";  
        $rowData .= $value;  
    }  
    $setData .= trim($rowData) . "\n";  
}  
  
header("Content-type: application/octet-stream");  
header("Content-Disposition: attachment; filename=Student List.xls");  
header("Pragma: no-cache");  
header("Expires: 0");  

  echo ucwords($columnHeader) . "\n" . $setData . "\n";
}

if(isset($_POST["download_excel_bookings_list"])){

$sql = "SELECT*FROM `student_tbl`";  
$setRec = mysqli_query($con, $sql);  
$columnHeader = '';
$columnHeader = 'ID'."\t".'Reg No.'."\t".'Amount'."\t".'Status'."\t".'No. of Days'."\t".'Starting Date'."\t".'Ending Date'."\t".'Payment No.'."\t".'TransactionReference';
$setData = '';  
  while ($rec = mysqli_fetch_row($setRec)) {  
    $rowData = '';  
    foreach ($rec as $value) {  
        $value = '"' . $value . '"' . "\t";  
        $rowData .= $value;  
    }  
    $setData .= trim($rowData) . "\n";  
}  
  
header("Content-type: application/octet-stream");  
header("Content-Disposition: attachment; filename=Bookings List.xls");  
header("Pragma: no-cache");  
header("Expires: 0");  

  echo ucwords($columnHeader) . "\n" . $setData . "\n";
}
 ?>