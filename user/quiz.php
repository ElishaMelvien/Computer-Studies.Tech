<!-- database Connection -->
<?php
include 'config.php';

// Fetch questions from the database
// Fetch questions from the database
$sql = "SELECT qno, question, ans1, ans2, ans3, ans4, correct_answer FROM questions";
$questions_result = $conn->query($sql);

$questions = array();

if ($questions_result->num_rows > 0) {
    while ($row = $questions_result->fetch_assoc()) {
        $question = array(
            "question" => array($row['qno'] . ". " . $row['question']),
            "answers" => array(
                array("text" => $row['ans1'], "correct" => $row['correct_answer'] == 1),
                array("text" => $row['ans2'], "correct" => $row['correct_answer'] == 2),
                array("text" => $row['ans3'], "correct" => $row['correct_answer'] == 3),
                array("text" => $row['ans4'], "correct" => $row['correct_answer'] == 4)
            )
        );
        array_push($questions, $question);
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
    <!-- link css -->
    <link rel="stylesheet" href="styles.css">
    <!-- box icon -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <div class="app">
        <h1>Question</h1>
        <div class="quiz">
            <h2 id="question">Your Question is here</h2>
            <div id="answer-buttons">
                <button class="btn">Answer1</button>
                <button class="btn">Answer2</button>
                <button class="btn">Answer3</button>
                <button class="btn">Answer4</button>
            </div>
            <button id="next-btn">Next</button>

            <p id="timer">Time Left: <span id="countdown"></span> S</p>

            <!-- User Details Form -->
            <form action="insert.php" id="myForm" method="post" style="display: none;">
                <h2 style="margin-top: 20px;">User Details</h2>

                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required style="margin-left: 120px;"><br><br>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required style="margin-left: 120px;"><br><br>

                <label for="number">Mobile Phone Number:</label>
                <input type="number" id="number" name="number" required style="margin-left: 10px;"><br><br>

                <label for="email">Current Workplace:</label>
                <input type="text" id="work" name="work" required style="margin-left: 35px;"><br><br>

                <input type="submit" value="Submit" class="submit" style="
                        background: #001e4d;
                        color: #fff;
                        font-weight: 200;
                        font-size: 12px;
                        width: 150px;
                        border: 0;
                        padding: 10px;
                        margin: 20px auto 0;
                        border-radius: 5px;
                        cursor: pointer;">
            </form>
            <!-- End User Details Form -->

        </div>
    </div>

    <!-- JavaScript -->
    <script>
        const questions = <?php echo json_encode($questions); ?>;
        const questionElement = document.getElementById("question");
        const answerButtons = document.getElementById("answer-buttons");
        const nextButton = document.getElementById("next-btn");
        const timerElement = document.getElementById("timer");
        const countdownElement = document.getElementById("countdown");
        let currentQuestionIndex = 0;
        let score = 0;
        let timeLeft = 600;

        let timerInterval;

        // start the timer
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

        // stop the timer
        function stopTimer() {
            clearInterval(timerInterval);
        }

        // hide the Next button
        function hideNextButton() {
            nextButton.style.display = "none";
        }

        // hide the submit button
        function hideSubmitButton() {
            submitButton.style.display = "none";
        }

        // show the Next button
        function showNextButton() {
            nextButton.style.display = "block";
        }

        // show the Submit button
        function showSubmitButton() {
            submitButton.style.display = "block";
        }

        // show a question
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

        // reset the answer buttons
        function resetState() {
            while (answerButtons.firstChild) {
                answerButtons.removeChild(answerButtons.firstChild);
            }
            countdownElement.textContent = timeLeft;
        }

        // handle answer selection
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

        // handle next question
        function handleNextButtonClick() {
            currentQuestionIndex++;
            if (currentQuestionIndex < questions.length) {
                showQuestion();
            } else {
                showScore();
                showSubmitButton();
            }
        }

        // show the final score
        function showScore() {
            resetState();
            questionElement.innerHTML = `Your score: ${score} out of ${questions.length * 5}`;
            hideNextButton();
        }

        // start the quiz
        function startQuiz() {
            currentQuestionIndex = 0;
            score = 0;
            showQuestion();
        }

        // quiz start
        startQuiz();

        // Event listener for the Next button
        nextButton.addEventListener("click", handleNextButtonClick);

        // Details form

        document.addEventListener("DOMContentLoaded", function () {

            const myForm = document.getElementById("myForm");
            const submitButton = document.getElementById("submit-btn");

            submitButton.addEventListener("click", function () {
                if (myForm.style.display === "none" || myForm.style.display === "") {
                    myForm.style.display = "block";
                    hideSubmitButton();
                } else {
                    myForm.style.display = "none";
                }
            });
        });

    </script>
</body>

</html>
