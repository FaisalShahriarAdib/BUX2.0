<?php
if (!isset($_SESSION)) {
    session_start();
}
define('TITLE', 'Add');
define('PAGE', 'Add');
include('./adminInclude/header.php'); 
include_once('../dbConnection.php');

if (isset($_SESSION['is_login'])) {
    $stuEmail = $_SESSION['stuLogEmail'];
} else {
    echo "<script> location.href='../index.php'; </script>";
}
?>
<?php
if (isset($_POST['submit'])) {
    $question_number = $_POST['question_number'];
    $question_text = $_POST['question_text'];
    $correct_choice =$_POST['correct_choice'];
    // choices array
    $choices = array();
    $choices[1] = $_POST['choice1'];
    $choices[2] = $_POST['choice2'];
    $choices[3] = $_POST['choice3'];
    $choices[4] = $_POST['choice4'];
    $correct_choice = $_POST['correct_choice']; // Retrieve the correct choice

    // question query
    $query = "INSERT INTO questions (question_number, text) VALUES ('$question_number', '$question_text')";
    $insert_row = $conn->query($query);

    if ($insert_row) {
        foreach ($choices as $choice => $value) {
            if ($value != '') {
                $is_correct = ($correct_choice == $choice) ? 1 : 0; // Check if it's the correct choice

                // choice query
                $query = "INSERT INTO choices (question_number, is_correct, text) VALUES ('$question_number', '$is_correct', '$value')";
                $insert_row = $conn->query($query);
                if (!$insert_row) {
                    die('error : ');
                }
            }
        }
        $msg = 'Question has been added'; // Add semicolon at the end of the statement
    }
}
//get total questions
$query = "SELECT * FROM questions";
$questions = $conn->query($query);
$total = $questions->num_rows;
$next = $total+1;

?>

<link rel="stylesheet" href="../css/quizstyle.css">

<body>
    <main>
        <div class="container">
            <h2 style="margin-top: 20px;"> ADD QUESTION</h2>
            <?php
            if (isset($msg)) {
                echo '<p>' . $msg . '</p>'; // Add semicolon at the end
            }
            ?>
            <form method="post" action="add.php">
            <p>
                    <label>Question Number</label>
                    <input type="number" value="<?php echo $next; ?>" name="question_number" />
                </p>
                <p>
                    <label>Question Text</label>
                    <input type="text" name="question_text" />
                </p>
                <p>
                    <label>Choice #1</label>
                    <input type="text" name="choice1" />
                </p> 
                <p>
                    <label>Choice #2</label>
                    <input type="text" name="choice2" />
                </p> 
                <p>
                    <label>Choice #3</label>
                    <input type="text" name="choice3" />
                </p> 
                <p>
                    <label>Choice #4</label>
                    <input type="text" name="choice4" />
                </p> 
                <p>
                    <label>Correct Choice Number:</label>
                    <input type="number" name="correct_choice" />
                </p> 
                    
                <p>
                    <input type="submit" class="btn btn-primary" name="submit" value="Submit" />
                </p>
            </form>
        </div>
    </main>
</body>

<?php
include('./AdminInclude/footer.php');
?>
