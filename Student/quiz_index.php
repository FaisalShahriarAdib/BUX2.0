<?php
if(!isset($_SESSION)){ 
  session_start(); 
}
define('TITLE', 'quiz index');
define('PAGE', 'index');
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


}



    // Query to check if the student has already submitted the quiz
$check_query = "SELECT * FROM quiz_scores WHERE stu_id = $stuId";
$check_result = $conn->query($check_query);

if ($check_result->num_rows > 0) {
        // Student has already submitted the quiz
    echo '<p style="margin-top: 30px; font-size: 28px;">You have already submitted the quiz. You cannot retake it.</p>';
    include('./stuInclude/footer.php');
    exit; // Stop further execution
}


// If the student hasn't taken the quiz, proceed to display quiz information
$query = "SELECT * FROM questions";
$results = $conn->query($query);
$total = $results->num_rows;
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>QUIZ</title>
    <link rel="stylesheet" href="../css/quizstyle.css">
</head>
<body>
    <main>
        <div class="container">
            <h2 style="margin-top: 20px;">Test Your Knowledge</h2>
            <p>This is a multiple-choice quiz</p>
            <ul>
                <li><strong>Number of Questions: </strong><?php echo $total; ?></li>
                <li><strong>Type: </strong>Multiple Choice</li>
                <li><strong>Estimated Time: </strong><?php echo $total * .5; ?> Minutes</li>
            </ul>
            <a href="question.php?n=1" class="btn btn-primary">Start Quiz</a>
        </div>
    </main>
</body>
</html>

<?php
include('./stuInclude/footer.php');
?>
