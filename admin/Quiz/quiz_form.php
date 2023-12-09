<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <!-- Bootstrap CSS link -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Roboto font link -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }

        .admin-panel {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }
        .header-image {
            max-width: 100px;
            height: auto;
            margin: 0 auto 10px;
            display: block;
        }
        
        label {
            font-weight: bold;
            margin-top: 10px;
        }

        textarea {
            resize: vertical;
        }
        .question-group {
        position: absolute;
        left: -9999px;
    }

    .question-group.active {
        position: static; /* Bring the active question group back into the layout flow */
    }
        
       

        .progress-text {
            margin-top: 10px;
        }

        .btn-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        button {
            margin-top: 20px;
        }
        h2{
            color:blue;
            text-align: center;
        }
    </style>
</head>

<body>
<img src="images/trophy.png" alt="Header Image" class="header-image">

    <div class="admin-panel">
        <h2 class="mb-4">Quiz Upload</h2>
        
        <form action="quiz_upload.php" method="post" onsubmit="submitQuiz()">
        
        
            <div class="form-group">
            
                <label for="course">Course:</label>
                <select id="course" name="course" class="form-control" required>
                    <?php
                    $courseLists = [
                        'Programming I', 'Entrepreneurship', 'Statistics and Mathematics',
                        'Com Skills', 'Information Technology', 'Entrepreneurship',
                        'Foundation of Management', 'Computer Architecture', 'Programming II',
                        'System Analysis and Design I', 'Database Technology', 'Operating Systems',
                        'Accounts', 'Quantitative Analysis', 'Advanced Programming',
                        'Computer Networks', 'MIS', 'System Analysis and Design II'
                    ];

                    foreach ($courseLists as $course) {
                        echo "<option value='$course'>$course</option>";
                    }
                    ?>
                </select>
            </div>

            <?php
            // Display 20 question groups
            for ($i = 1; $i <= 19; $i++) {
                echo "<div class='question-group " . ($i === 1 ? 'active' : '') . "'>";
                echo "<div class='form-group'>";
                echo "<label for='question$i'>Question $i:</label>";
                echo "<textarea id='question$i' name='question[]' rows='4' class='form-control' required></textarea>";
                echo "</div>";

                echo "<div class='form-group'>";
                echo "<label for='ans1$i'>Answer 1:</label>";
                echo "<input type='text' id='ans1$i' name='ans1[]' class='form-control' required>";
                echo "</div>";

                echo "<div class='form-group'>";
                echo "<label for='ans2$i'>Answer 2:</label>";
                echo "<input type='text' id='ans2$i' name='ans2[]' class='form-control' required>";
                echo "</div>";

                echo "<div class='form-group'>";
                echo "<label for='ans3$i'>Answer 3:</label>";
                echo "<input type='text' id='ans3$i' name='ans3[]' class='form-control' required>";
                echo "</div>";

                echo "<div class='form-group'>";
                echo "<label for='ans4$i'>Answer 4:</label>";
                echo "<input type='text' id='ans4$i' name='ans4[]' class='form-control' required>";
                echo "</div>";

                echo "<div class='form-group'>";
                echo "<label for='correct_answer$i'>Correct Answer (1-4):</label>";
                echo "<input type='number' id='correct_answer$i' name='correct_answer[]' class='form-control' min='1' max='4' required>";
                echo "</div>";
                echo "</div>";
            }
            ?>

            <div class="btn-container">
                <div class="progress-text" id="progressText">Question 1 / 20</div>
                <button type="button" class="btn btn-primary" onclick="showNextQuestion()">Next</button>
                <button type="submit" class="btn btn-success" id="uploadButton" style="display: none;" onclick="submitQuiz()">Submit Quiz</button>
            </div>
        </form>
    </div>

    <script>
    let currentQuestion = 1;
    const totalQuestions = 20;

    function showNextQuestion() {
        const activeQuestionGroup = document.querySelector('.question-group.active');
        const nextQuestionGroup = activeQuestionGroup.nextElementSibling;

        if (nextQuestionGroup) {
            activeQuestionGroup.classList.remove('active');
            nextQuestionGroup.classList.add('active');
            currentQuestion++;
            updateProgressText();
        }

        if (currentQuestion === totalQuestions) {
            document.getElementById('uploadButton').style.display = 'block';
        }
    }

    function updateProgressText() {
        document.getElementById('progressText').innerText = `Question ${currentQuestion} / ${totalQuestions}`;
    }

    function submitQuiz() {
        // Trigger form submission
        document.querySelector('form').submit();
    }
</script>




</body>

</html>
