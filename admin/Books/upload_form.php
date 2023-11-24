<?php

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
    <title>Book Upload</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <style>
        /* Add your custom styles here */
        body {
            background-color: #f8f9fa;
            font-family: 'Open Sans', sans-serif;
        }

        form {
            max-width: 800px;
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
            background-color: #ff771d;
            color:#fff;
            cursor: pointer;
            border: none;
        }

        button:hover {
            background-color: #2eca6a;
        }

        .year-selected {
            background-color:#001f3f;
        }

        .alert-error {
    background-color: #f8d7da; /* Red background color */
    color: #721c24; /* Dark red text color */
    border: 1px solid #f5c6cb; /* Border color */
    padding: 15px; /* Padding for better visibility */
    border-radius: 4px; 
    margin-top: 10px;
}

.alert-success {
    background-color: #2eca6a; /* Green background color */
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
        <h1>Admin Uploads Books</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <!-- Form for Uploading Books -->
    <form id="bookForm" method="POST" enctype="multipart/form-data">
        <label for="academic_year">Academic Year</label>
        <select name="academic_year" onchange="populateCourses(this.value)">
            <option value="">Select Academic Year</option>
            <?php foreach ($years as $yearValue) { ?>
                <option value="<?php echo $yearValue; ?>"><?php echo $yearValue; ?></option>
            <?php } ?>
        </select>

        

        <label for="course">Course</label>
        <select name="course" id="courses">
            <!-- Courses will be populated dynamically -->
        </select>

        <label for="book">File</label>
        <input type="file" name="book" accept=".pdf" required>

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
