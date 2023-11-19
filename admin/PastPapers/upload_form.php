<?php
include "config.php";

$years = [1, 2, 3];
$courseLists = [
    '1' => ['Programming I', 'Entrepreneurship', 'Statistics and Mathematics', 'Com Skills', 'Information Technology', 'Entrepreneurship', 'Foundation of Management', 'Computer Architecture'],
    '2' => ['Programming II', 'System Analysis and Design I', 'Database Technology', 'Operating Systems', 'Accounts', 'Quantitative Analysis'],
    '3' => ['Advanced Programming', 'Computer Networks', 'MIS', 'System Analysis and Design II'],
];
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Past Paper Upload</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">

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
            font-size: 18px; 
        }

        select, input, button {
            width: 100%;
            padding: 12px; 
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px; 
        }

        button {
            background-color: #4154f1;
            color:#fff;
            cursor: pointer;
            border: none;
        }

        button:hover {
            background-color: #0056b3;
        }

        .year-selected {
            background-color:#001f3f;

        }

        .alert-success {
    background-color: #d4edda; /* Green background color */
    color: #155724; /* Dark green text color */
    border: 1px solid #c3e6cb; /* Border color */
    padding: 15px; /* Padding for better visibility */
    border-radius: 4px; 
    margin-top: 10px; 
}



    </style>
</head>
<body>

    <?php if (isset($uploadMessage)) { ?>
        <div>
            <?php echo $uploadMessage; ?>
        </div>
    <?php } ?>

    


    <div class="pagetitle">
      <h1>Admin_Uploads PastPapers</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <!-- Form for Uploading Past Papers -->
    <form id="pastPaperForm" method="POST" enctype="multipart/form-data">
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
