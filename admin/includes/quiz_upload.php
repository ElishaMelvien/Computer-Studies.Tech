<?php
session_start();
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection details
    $hostname = "localhost"; 
    $username = "root";
    $password = "";
    $database = "computerstudies";

    // Create connection
    $conn = new mysqli($hostname, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get form data
    $course = mysqli_real_escape_string($conn, $_POST['course']); // Sanitize input

    // Use a transaction for data integrity
    $conn->begin_transaction();

    try {
        // Insert data into the 'quiz' table
        $quizInsertQuery = "INSERT INTO quiz (course) VALUES ('$course')";
        if ($conn->query($quizInsertQuery) === FALSE) {
            throw new Exception("Error inserting into quiz table: " . $conn->error);
        }

        $quiz_id = $conn->insert_id;

        // Insert questions into the 'questions' table
        for ($i = 0; $i < count($_POST['question']); $i++) {
            $question_text = mysqli_real_escape_string($conn, $_POST['question'][$i]); // Sanitize input
            $ans1 = mysqli_real_escape_string($conn, $_POST['ans1'][$i]);
            $ans2 = mysqli_real_escape_string($conn, $_POST['ans2'][$i]);
            $ans3 = mysqli_real_escape_string($conn, $_POST['ans3'][$i]);
            $ans4 = mysqli_real_escape_string($conn, $_POST['ans4'][$i]);
            $correct_answer = mysqli_real_escape_string($conn, $_POST['correct_answer'][$i]);

            $questionInsertQuery = "INSERT INTO questions (quiz_id, question_text, ans1, ans2, ans3, ans4, correct_answer) VALUES
                                    ('$quiz_id', '$question_text', '$ans1', '$ans2', '$ans3', '$ans4', '$correct_answer')";
            if ($conn->query($questionInsertQuery) === FALSE) {
                throw new Exception("Error inserting into questions table: " . $conn->error);
            }
        }

        // Commit the transaction
        $conn->commit();

        $_SESSION['Msg'] = "Quiz uploaded successfully!"; // Set the success message in the session variable
    } catch (Exception $e) {
        // Rollback the transaction on error
        $conn->rollback();
        echo "Error: " . $e->getMessage();
    }

    // Close connection
    $conn->close();
} else {
    // Redirect if the form is not submitted
    header("Location: admin_panel.php");
    exit();
}
?>
