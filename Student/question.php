<?php
if (!isset($_SESSION)) {
    session_start();
}
define('TITLE', 'Quiz Questions');
define('PAGE', 'questions');
include('./stuInclude/header.php');
include_once('../dbConnection.php');


?>

<?php
//set question number
$number = (int) $_GET['n'];

//get total questions
$query = "SELECT * FROM questions";
$result = $conn->query($query);
$total = $result->num_rows;


//get question
$query = "SELECT * FROM questions WHERE question_number = $number";
$result = $conn->query($query);
$question = $result->fetch_assoc();

//get choices
$query = "SELECT * FROM choices WHERE question_number = $number";
$choices = $conn->query($query);

?>

<link rel="stylesheet" href="../css/quizstyle.css">
<body>
    <main>
        <div class="container">
            <h2 style="margin-top: 20px;">Test Your Knowledge</h2>
            <div class="current"> Question <?php echo $question['question_number']; ?> of <?php echo $total; ?></div>
            <p class="question">
                <?php echo $question['text']; ?>
            </p>
            <form method="post" action="process.php">
                <ul class="choices">
                    <?php while($row = $choices->fetch_assoc()): ?>
                        <li><input name="choice" type="radio" value="<?php echo $row['id']; ?>" /><?php echo $row['text']; ?></li>
                    <?php endwhile; ?>

                </ul>
                <input type="submit" class="btn btn-primary" value="Submit Answer" />
                <input type="hidden" name="number" value="<?php echo $number; ?>" />
            </form>
        </div> 
    </main>
</body>
<?php
include('./stuInclude/footer.php');
?>
