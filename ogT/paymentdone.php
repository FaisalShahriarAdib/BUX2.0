<?php 
include('./dbConnection.php');
session_start();

if(!isset($_SESSION['stuLogEmail'])) {
    echo "<script> location.href='loginorsignup.php'; </script>";
    exit; // Add exit to stop executing further if not logged in
} else { 
    if (isset($_SESSION['course_id'])) {
        $order_id = "ORDS" . rand(10000, 99999999);
        $stu_email = $_SESSION['stuLogEmail'];
        $course_id = $_SESSION['course_id'];
        $status = "Success";
        $respmsg = "Done";
        $amount = "0"; // Set default amount as zero for enrollment
        $date = date('d-m-y h:i:s');

        $sql = "INSERT INTO courseorder(order_id, stu_email, course_id, status, respmsg, amount, order_date) 
                VALUES ('$order_id', '$stu_email', '$course_id', '$status', '$respmsg', '$amount', '$date')";

        if ($conn->query($sql) === TRUE) {
            echo "Redirecting to My Profile....";
            echo "<script> setTimeout(() => {
                window.location.href = './Student/myCourse.php';
            }, 1500); </script>";
        } else {
            echo "Failed to enroll in the course: " . $conn->error;
        }
    } else {
        echo "Course ID not set.";
    }
}
?>