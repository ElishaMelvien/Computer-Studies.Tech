<!-- database Connection -->
<?php
include 'config.php';

// Fetch questions from the database
$sql = "SELECT * FROM questions";
$questions_result = $conn->query($sql);

$questions = array();

if ($questions_result->num_rows > 0) {
    $questionNumber = 1; // Initialize question number
    while ($row = $questions_result->fetch_assoc()) {
        $question = array(
            "question" => array("{$questionNumber}. {$row['question_text']}"),
            "answers" => array(
                array("text" => $row['ans1'], "correct" => $row['correct_answer'] == 1),
                array("text" => $row['ans2'], "correct" => $row['correct_answer'] == 2),
                array("text" => $row['ans3'], "correct" => $row['correct_answer'] == 3),
                array("text" => $row['ans4'], "correct" => $row['correct_answer'] == 4)
            )
        );
        array_push($questions, $question);
        $questionNumber++; // Increment question number
    }
}

$conn->close();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Assessment</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZwT" crossorigin="anonymous">
    <!-- box icon -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        body {
            background-color: #f8f9fa;
        }

        .app {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 20px;
            max-width: 800px;
            text-align: center;
        }

        .quiz {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        #answer-buttons {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-top: 10px;
            margin-bottom: 20px;
        }

        .btn {
            width: 150%;
            padding: 10px;
            text-align: left;
            border: 1px solid #ccc;
            cursor: pointer;
            background-color: #fff;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: grey;
        }

        .btn.correct {
            background-color: #4CAF50;
            color: white;
        }

        .btn.incorrect {
            background-color: #FF0000;
            color: white;
        }

        #next-btn {
            width: 10%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        #next-btn:hover {
            background-color: #0056b3;
        }

        #timer {
            margin-top: 10px;
            font-size: 18px;
            color:blue;
        }
    h1{
        color:blue;
    }
    #logo {
            width: 60px; /* Adjust the width as needed */
            height: auto;
            margin-top: -10px; /* Adjust the margin to position it */
        }
    </style>
</head>
<body>
    <div class="app">
    <img id="logo" src="img/trophy.png" alt="Logo">
        <h1 class="mb-4">Online Assessment</h1>
        <div class="quiz">
            <h2 id="question">Your Question is here</h2>
            <div id="answer-buttons" class="vertical">
            </div>
            <button id="next-btn" style="display: none;">Next</button>

            <p id="timer">Time Left: <span id="countdown"></span> S</p>
        </div>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


    <!-- JavaScript -->
    <script>
        const questions = <?php echo json_encode($questions); ?>;
        const questionElement = document.getElementById("question");
        const answerButtons = document.getElementById("answer-buttons");
        const nextButton = document.getElementById("next-btn");
        const submitButton = document.getElementById("submit-btn");
        const timerElement = document.getElementById("timer");
        const countdownElement = document.getElementById("countdown");
        let currentQuestionIndex = 0;
        let score = 0;
        let timeLeft = 60;

        let timerInterval;

        // Start the timer
        function startTimer() {
            timerInterval = setInterval(() => {
                timeLeft--;
                countdownElement.textContent = timeLeft;

                if (timeLeft === 0) {
                    clearInterval(timerInterval);
                    hideNextButton();
                    showSubmitButton();
                    showScore();
                }
            }, 1000);
        }

        // Stop the timer
        function stopTimer() {
            clearInterval(timerInterval);
        }

        // Hide the Next button
        function hideNextButton() {
            nextButton.style.display = "none";
        }

        // Hide the submit button
        function hideSubmitButton() {
            submitButton.style.display = "none";
        }

        // Show the Next button
        function showNextButton() {
            nextButton.style.display = "block";
        }

        // Show the Submit button
        function showSubmitButton() {
            submitButton.style.display = "block";
        }

        // Show a question
        function showQuestion() {
            resetState();
            const currentQuestion = questions[currentQuestionIndex];
            questionElement.innerHTML = currentQuestion.question;
            currentQuestion.answers.forEach((answer, index) => {
                const button = document.createElement("button");
                button.innerHTML = answer.text;
                button.classList.add("btn");
                button.addEventListener("click", () => selectAnswer(index));
                answerButtons.appendChild(button);
            });
            startTimer();
        }

        // Reset the answer buttons
        function resetState() {
            while (answerButtons.firstChild) {
                answerButtons.removeChild(answerButtons.firstChild);
            }
            countdownElement.textContent = timeLeft;
        }

        // Handle answer selection
        function selectAnswer(selectedIndex) {
            stopTimer(); // Stop the timer when an answer is selected
            const currentQuestion = questions[currentQuestionIndex];
            const isCorrect = currentQuestion.answers[selectedIndex].correct;
            if (isCorrect) {
                score = score + 5;
            }
            answerButtons.childNodes[selectedIndex].classList.add(isCorrect ? "correct" : "incorrect");
            answerButtons.childNodes.forEach((button) => (button.disabled = true));
            showNextButton();
        }

        // Handle next question
        function handleNextButtonClick() {
            currentQuestionIndex++;
            if (currentQuestionIndex < questions.length) {
                showQuestion();
            } else {
                showScore();
                showSubmitButton();
            }
        }

        // Show the final score
        function showScore() {
            resetState();
            questionElement.innerHTML = `Your score: ${score} out of ${questions.length * 5}`;
            hideNextButton();
        }

        // Start the quiz
        function startQuiz() {
            currentQuestionIndex = 0;
            score = 0;
            showQuestion();
        }

        // Quiz start
        startQuiz();

        // Event listener for the Next button
        nextButton.addEventListener("click", handleNextButtonClick);

        // Details form
        document.addEventListener("DOMContentLoaded", function () {
            const myForm = document.getElementById("myForm");

            submitButton.addEventListener("click", function () {
                if (myForm.style.display === "none" || myForm.style.display === "") {
                    myForm.style.display = "block";
                    hideSubmitButton()
                } else {
                    myForm.style.display = "none";
                }
            });
        });
    </script>
</body>
</html>
