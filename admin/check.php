<?php

        $fileName = $_FILES['image']['name'];
        $fileNameAr= explode(".",$fileName);
        $extension = end($fileNameAr);
        $ext = strtolower($extension);

        $uniqueImageName = time()."_".$_FILES['image']['name'];
        if (move_uploaded_file($_FILES['image']['tmp_name'], "uploads/".$uniqueImageName)) {
            
            $query = "INSERT INTO `rooms`(`hostel_name` ) VALUES ( '$uniqueImageName')";

        }



        // $_FILES['image']['name']=$file;
		// $fileName = $_FILES['image']['name'];
		// $fileNameAr= explode(".",$fileName);
		// $extension = end($fileNameAr);
		// $ext = strtolower($extension);

		// if ($ext == "jpg" || $ext == "jpeg" || $ext == "png") {
			
		// 	//print_r($file['size']);

		// 	if ($_FILES['image']['size'] > (1024 * 2)) {
				
		// 		$uniqueImageName = time()."_".$_FILES['image']['name'];
		// 		if (move_uploaded_file($_FILES['image']['tmp_name'], "../uploaded-img/".$uniqueImageName)) {
					
		// 			$q = $this->con->query("INSERT INTO `rooms`(`hostel_name`, `seater`, `fee`, `cooking`, `room_image_1`,`space_availability`) VALUES ('$hostel_name', '$seater', '$fee', '$cooking', '$uniqueImageName', '$space_availability')");

		// 			if ($q) {
		// 				return ['status'=> 202, 'message'=> 'Room Added Successfully..!'];
		// 			}else{
		// 				return ['status'=> 303, 'message'=> 'Failed to run query'];
		// 			}

		// 		}else{
		// 			return ['status'=> 303, 'message'=> 'Failed to upload image'];
		// 		}

		// 	}else{
		// 		return ['status'=> 303, 'message'=> 'Large Image ,Max Size allowed 2MB'];
		// 	}

		// }else{
		// 	return ['status'=> 303, 'message'=> 'Invalid Image Format [Valid Formats : jpg, jpeg, png]'];
		// }

        