<?php
if (!isset($_SESSION)) { 
    session_start(); 
}
define('TITLE', 'leaderboard');
define('PAGE', 'leaderboard');
include('./stuInclude/header.php'); 
include_once('../dbConnection.php');

if (isset($_SESSION['is_login'])) {
    $stuEmail = $_SESSION['stuLogEmail'];
} else {
    echo "<script> location.href='../index.php'; </script>";
}
?>
<div class="mx-5 mt-5 text-center">
    <!-- Table -->
    <p class="bg-dark text-white p-2">Quiz Leaderboard</p>

    <?php
    // Fetch top scores and related student information from quiz_scores table
    $select_query = "SELECT stu_id, stu_name, score FROM quiz_scores ORDER BY score DESC LIMIT 10"; // Change LIMIT to the number of top scores you want to display
    $result = $conn->query($select_query);

    if ($result->num_rows > 0) {
        // Display leaderboard table with inline styles for column widths
        echo '<table style="width: 300%;">';
        echo '<tr><th style="width: 10%;">Rank</th><th style="width: 30%;">Student_ID</th><th style="width: 40%;">Name</th><th style="width: 20%;">Score</th></tr>';

        $rank = 1;
        while ($row = $result->fetch_assoc()) {
            $stu_id = $row['stu_id'];
            $stu_name = $row['stu_name'];
            $score = $row['score'];

            // Display each row of leaderboard
            echo "<tr><td>$rank</td><td>$stu_id</td><td>$stu_name</td><td>$score</td></tr>";
            $rank++;
        }

        echo '</table>';
    } else {
        echo 'No scores available yet.';
    }
    ?>
</div>

<?php
include('./stuInclude/footer.php');
?>
