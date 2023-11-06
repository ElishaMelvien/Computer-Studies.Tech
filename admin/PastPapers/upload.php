<?php
include "config.php";

$years = [1, 2, 3];
$courseLists = [
    '1' => ['Programming I', 'Entrepreneurship', 'Statistics and Mathematics', 'Com Skills', 'Information Technology', 'Entrepreneurship', 'Foundation of Management', 'Computer Architecture'],
    '2' => ['Programming II', 'System Analysis and Design I', 'Database Technology', 'Operating Systems', 'Accounts', 'Quantitative Analysis'],
    '3' => ['Advanced Programming', 'Computer Networks', 'MIS', 'System Analysis and Design II'],
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $year = $_POST['year'];
    $paperYear = $_POST['Paper_Year'];
    $course = $_POST['course'];

    if ($_FILES["paper"]["error"] == UPLOAD_ERR_OK) {
        $targetDir = "uploads/";
        $fileName = basename($_FILES["paper"]["name"]);
        $targetPath = $targetDir . $fileName;

        if (file_exists($targetPath)) {
            $uploadMessage = "File already exists.";
        } else {
            if (move_uploaded_file($_FILES["paper"]["tmp_name"], $targetPath)) {
                $sql = "INSERT INTO past_papers (year, Paper_Year, course, paper_path) VALUES (?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);

                if ($stmt) {
                    $stmt->bind_param("ssss", $year, $paperYear, $course, $targetPath);

                    if ($stmt->execute()) {
                        $uploadMessage = "File uploaded and record inserted into the database successfully!";
                    } else {
                        $uploadMessage = "Error inserting record into the database: " . $stmt->error;
                    }
                } else {
                    $uploadMessage = "Error in SQL query: " . $conn->error;
                }

                $stmt->close();
            } else {
                $uploadMessage = "Error uploading file: Move operation failed.";
            }
        }
    } else {
        $uploadMessage = "Error uploading file: " . $_FILES["paper"]["error"];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Past Paper Upload</title>
    <!-- Link to Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">

    <!-- Add your CSS styles or link to Bootstrap if needed -->

    <style>
        /* Add your custom styles here */
        body {
            background-color: #f8f9fa;
            font-family: 'Open Sans', sans-serif;
        }

        form {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-size: 18px; /* Adjusted font size */
        }

        select, input, button {
            width: 100%;
            padding: 12px; /* Adjusted padding */
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px; /* Adjusted font size */
        }

        button {
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <?php if (isset($uploadMessage)) { ?>
        <div>
            <?php echo $uploadMessage; ?>
        </div>
    <?php } ?>

    <!-- Form for Uploading Past Papers -->
    <form method="POST" enctype="multipart/form-data">
        <label for="year">Academic Year</label>
        <select name="year" onchange="populateCourses(this.value)">
            <option value="">Select Academic Year</option>
            <?php foreach ($years as $year) { ?>
                <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
            <?php } ?>
        </select>

        <label for="Paper_Year">Paper Year</label>
        <input type="text" name="Paper_Year" placeholder="Enter Paper Year" required>

        <label for="course">Course</label>
        <select name="course" id="courses">
            <!-- Courses will be populated dynamically -->
        </select>

        <label for="paper">File</label>
        <input type="file" name="paper" accept=".pdf" required>

        <button type="submit">Upload</button>
    </form>

    <script>
        function populateCourses(year) {
            var coursesDropdown = document.getElementById("courses");
            coursesDropdown.innerHTML = '<option value="">Select Course</option>';

            if (year !== "") {
                var courseList = <?php echo json_encode($courseLists); ?>;
                var courses = courseList[year];

                courses.forEach(function (course) {
                    var option = document.createElement("option");
                    option.value = course;
                    option.text = course;
                    coursesDropdown.appendChild(option);
                });
            }
        }
    </script>

   

</body>
</html>
