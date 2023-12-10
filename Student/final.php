<?php
if(!isset($_SESSION)){ 
  session_start(); 
}
define('TITLE', 'Final');
define('PAGE', 'Final');
include('./stuInclude/header.php'); 
include('../dbConnection.php');

 if(isset($_SESSION['is_login'])){
  $stuEmail = $_SESSION['stuLogEmail'];
 } else {
  echo "<script> location.href='../index.php'; </script>";
 }

 ?>
<body>
    <main>
        <div class= "container">
            <h2 style="margin-top: 20px;"> You're Done</h2>
                <p>congratulations! You have completed the test</p>
                <p>Final Score: <?php echo $_SESSION['score']; ?></p>
                <a href="leaderboard.php" class="start">Leaderboard</a>
            
        </div>
</body>      


 <?php
include('./stuInclude/footer.php'); 
?>