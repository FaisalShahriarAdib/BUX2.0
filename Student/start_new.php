<?php
session_start();

// Reset or unset session variables related to the quiz
unset($_SESSION['score']); // Reset score variable
// Other session variables related to the quiz can also be reset here

// Redirect to the quiz starting page or wherever appropriate
header("Location: leaderboard.php");
exit();
?>
