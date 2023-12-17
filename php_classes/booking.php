<?php
session_start();

class Booking
{
    private $con;

    function __construct()
    {
        include("../admin/php_classes/database.php");
        $db = new Database();
        $this->con = $db->connect();
    }

    public function confirmBooking($room_id, $student_reg_no, $start_date, $days_number)
    {
        // Validate inputs (you may need more validation depending on your requirements)
        if (empty($room_id) || empty($student_reg_no) || empty($start_date) || empty($days_number)) {
            return ['status' => 303, 'message' => 'Please fill in all required fields.'];
        }

        // Check room availability
        $q = $this->con->query("SELECT space_availability, fee FROM rooms WHERE room_id = '$room_id'");
        if ($q->num_rows > 0) {
            $row = $q->fetch_assoc();
            $space_availability = $row['space_availability'];
            $fee = $row['fee'];

            if ($space_availability > 0) {
                // Room is available, proceed with booking

                // Calculate fee (you may have a more complex fee calculation)
                $new_fee = $fee * $days_number;

                // Update database to decrease space availability
                $space_availability--;

                $this->con->query("UPDATE rooms SET space_availability = '$space_availability' WHERE room_id = '$room_id'");

                // Insert booking record
                $q = $this->con->query("INSERT INTO bookings (room_id, student_reg_no, fee, start_date, days_number)
                                       VALUES ('$room_id', '$student_reg_no', '$new_fee', '$start_date', '$days_number')");

                if ($q) {
                    return ['status' => 202, 'message' => 'Booking confirmed successfully.'];
                } else {
                    return ['status' => 303, 'message' => 'Failed to insert booking record.'];
                }
            } else {
                return ['status' => 303, 'message' => 'No available space in this room.'];
            }
        } else {
            return ['status' => 303, 'message' => 'Invalid room ID.'];
        }
    }
}

if (isset($_POST['confirm_booking'])) {
    extract($_POST);

    if (!empty($room_id) && !empty($start_date) && !empty($days_number)) {
        $student_reg_no = $_SESSION['student_reg_no'];
        $booking = new Booking();
        $result = $booking->confirmBooking($room_id, $student_reg_no, $start_date, $days_number);
        echo json_encode($result);
        exit();
    } else {
        echo json_encode(['status' => 303, 'message' => 'Empty fields.']);
        exit();
    }
}
?>
