<?php
include "config.php";

$courseLists = [
    '1' => ['Programming I', 'Entrepreneurship', 'Statistics and Mathematics', 'Com Skills', 'Information Technology', 'Entrepreneurship', 'Foundation of Management', 'Computer Architecture'],
    '2' => ['Programming II', 'System Analysis and Design I', 'Database Technology', 'Operating Systems', 'Accounts', 'Quantitative Analysis'],
    '3' => ['Advanced Programming', 'Computer Networks', 'MIS', 'System Analysis and Design II'],
];

$years = [1, 2, 3];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $year = $_POST['year'];
    $paper_year = $_POST['Paper_Year'];
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
                    $stmt->bind_param("ssss", $year, $paper_year, $course, $targetPath);

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
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container-fluid {
            padding-left: 0;
            padding-right: 0;
        }

        #sidebar {
            min-width: 200px;
            max-width: 200px;
            height: 100vh;
            background-color: #343a40;
            color: #fff;
            transition: all 0.3s;
        }

        #sidebar a {
            padding: 10px 15px;
            text-decoration: none;
            font-size: 18px;
            color: #fff;
            display: block;
            transition: all 0.3s;
        }

        #sidebar a:hover {
            background-color: #007bff;
        }

        #content {
            width: 100%;
            padding: 15px;
            transition: all 0.3s;
        }

        .card-header {
            background-color: #007bff;
            color: #fff;
        }

        .card-body {
            background-color: #fff;
        }

        .form-control {
            margin-bottom: 10px;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
    </style>


</head>
<body>

    <div class="container-fluid">
        <div class="row">

            <!-- Sidebar -->
            <nav id="sidebar">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" data-toggle="modal" data-target="#uploadModal">
                                Past Papers
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                Profile
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                Quiz
                            </a>
                        </li>
                        <!-- Add more items as needed -->
                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <main id="content">
                

                <?php if (isset($uploadMessage)) { ?>
                    <div class="alert alert-info" role="alert">
                        <?php echo $uploadMessage; ?>
                    </div>
                <?php } ?>

                <!-- Modal for Uploading Past Papers -->
                <div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="uploadModalLabel">Upload Past Papers</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="year">Academic Year</label>
                                        <select name="year" class="form-control" onchange="populateCourses(this.value)">
                                            <option value="">Select Academic Year</option>
                                            <?php foreach ($years as $year) { ?>
                                                <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="Paper_Year">Paper Year</label>
                                        <input type="text" name="Paper_Year" class="form-control" placeholder="Enter Paper Year" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="course">Course</label>
                                        <select name="course" class="form-control" id="courses">
                                            <!-- Courses will be populated dynamically -->
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="paper">File</label>
                                        <input type="file" name="paper" class="form-control-file" accept=".pdf" required>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Upload</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
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
