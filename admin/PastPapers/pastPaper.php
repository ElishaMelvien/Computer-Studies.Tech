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

    // Check if a file is selected for upload
    if ($_FILES["paper"]["error"] == UPLOAD_ERR_OK) {
        $targetDir = "uploads/";
        $fileName = basename($_FILES["paper"]["name"]);
        $targetPath = $targetDir . $fileName;

        // Check if the file already exists
        if (file_exists($targetPath)) {
            $uploadMessage = "File already exists.";
        } else {
            // Move the uploaded file to the target directory
            if (move_uploaded_file($_FILES["paper"]["tmp_name"], $targetPath)) {
                // File uploaded successfully, now insert into the database
                $sql = "INSERT INTO papers (year, Paper_Year, course, paper_path) VALUES (?, ?, ?, ?)";
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
    <title>Admin Upload Past Papers</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h3 class="mb-0">Admin Upload Past Papers</h3>
            </div>
            <div class="card-body">
                <?php if (isset($uploadMessage)) { ?>
                    <div class="alert alert-info" role="alert">
                        <?php echo $uploadMessage; ?>
                    </div>
                <?php } ?>

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
                    option.text = course
