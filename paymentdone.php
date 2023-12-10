<?php 
include('./dbConnection.php');
session_start();
if(!isset($_SESSION['stuLogEmail'])) {
 echo "<script> location.href='loginorsignup.php'; </script>";
} else { 
 date_default_timezone_set('Asia/Kolkata');
 $date = date('d-m-y h:i:s');
 if(isset($_POST['ORDER_ID']) && isset($_POST['TXN_AMOUNT'])){
  $order_id = $_POST['ORDER_ID'];
  $stu_email = $_SESSION['stuLogEmail'];
  $course_id = $_SESSION['course_id'];
  $name = "SELECT stu_name FROM student WHERE stu_email = '$stu_email'";
  $nameResult = $conn->query($name);
  if ($nameResult->num_rows > 0) {
    $row = $nameResult->fetch_assoc();
    $stu_name = $row['stu_name'];
} else {
    $stu_name = "Not Found"; 
}
  $status = "Success";
  $respmsg = "Done";
  $amount = $_POST['TXN_AMOUNT'];
  $date = $date;
  $sql = "INSERT INTO courseorder(order_id, stu_email, course_id, status, respmsg, amount, order_date) VALUES ('$order_id', '$stu_email', '$course_id', '$status', '$respmsg', '$amount', '$date')";
   if($conn->query($sql) == TRUE){
    echo "<style>
    @media print{
			#print {
				display:none;
			}
		}
		@media print {
			#PrintButton {
				display: none;
			}
		}
    </style>";
    echo "<center><h2>Your payment was successful!</h2></center>";
    echo '<div style="margin-bottom: 40px;">
     <center><p><strong>Name:</strong> '.$stu_name.'</p></center>
		 <center><p><strong>Amount:</strong> '.$amount.'</p></center>
     <center><p><strong>Course id:</strong> '.$course_id.'</p></center>
     <center><p><strong>Date:</strong> '.$date.'</p></center>
		</div>';
    echo "<center>
    <button id='PrintButton' onclick='PrintPage()'>Print</button>
    <a href='http://localhost/test1/student/myCourse.php'><button>My Courses</button></a>
  </center>
  ";
    
   };
 } else {
 echo "<b>Transaction status is failure</b>" . "<br/>";
 }
}
?>
<script type="text/javascript">
   function PrintPage() {
     window.print();
   }
 </script> 
