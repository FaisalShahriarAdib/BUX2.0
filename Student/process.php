<?php
if(!isset($_SESSION)){ 
  session_start(); 
}
define('TITLE', 'Process');
define('PAGE', 'process');
include('./stuInclude/header.php'); 
include_once('../dbConnection.php');

 if(isset($_SESSION['is_login'])){
  $stuEmail = $_SESSION['stuLogEmail'];
 } else {
  echo "<script> location.href='../index.php'; </script>";
 }

 $sql = "SELECT * FROM student WHERE stu_email='$stuEmail'";
 $result = $conn->query($sql);
 if($result->num_rows == 1){
 $row = $result->fetch_assoc();
 $stuId = $row["stu_id"];
 $stuName = $row["stu_name"]; 

}
?>

<?php
if (!isset($_SESSION['score']) || $_SESSION['score'] === 0) {
    $_SESSION['score'] = 0;
}

if($_POST){
    $number = $_POST['number'];
    $selected_choice = $_POST['choice'];
    $next = $number+1;

    //get total questions
    $query = "SELECT * FROM questions";
    $result = $conn->query($query);
    $total = $result->num_rows;


    //get correct choice
    $query = "SELECT * FROM choices WHERE question_number = $number AND is_correct=1";
    $result = $conn->query($query);
    $row = $result->fetch_assoc();
    $correct_choice = $row['id'];

    //compare
    if($correct_choice == $selected_choice){
        $_SESSION['score']++;
    }

    //cheak if last question
    if ($number == $total) {
      
        $score = $_SESSION['score']; // Get the final score
    
        // Insert the score, student ID, and name into the new table
        $insert_query = "INSERT INTO quiz_scores (stu_id, stu_name, score) VALUES ('$stuId','$stuName', '$score')";
        $result=$conn->query($insert_query);
    

    
        header("Location: final.php");
        exit();
    } else {
        header("Location: question.php?n=".$next);
    }



}
?>

<?php
include('./stuInclude/footer.php');
?>
