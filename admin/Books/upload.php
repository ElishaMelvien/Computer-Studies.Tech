<?php
include "config.php";

$years = [1, 2, 3];
$courseLists = [
    '1' => ['Programming I', 'Entrepreneurship', 'Statistics and Mathematics', 'Com Skills', 'Information Technology', 'Entrepreneurship', 'Foundation of Management', 'Computer Architecture'],
    '2' => ['Programming II', 'System Analysis and Design I', 'Database Technology', 'Operating Systems', 'Accounts', 'Quantitative Analysis'],
    '3' => ['Advanced Programming', 'Computer Networks', 'MIS', 'System Analysis and Design II'],
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $academicYear = $_POST['academic_year'];
    $course = $_POST['course'];

    if ($_FILES["book"]["error"] == UPLOAD_ERR_OK) {
        $targetDir = "uploads/";
        $fileName = basename($_FILES["book"]["name"]);
        $targetPath = $targetDir . $fileName;

        if (file_exists($targetPath)) {
            $uploadMessage = '<div class="alert-success">File already exists.</div>';
        } else {
            if (move_uploaded_file($_FILES["book"]["tmp_name"], $targetPath)) {
                $sql = "INSERT INTO books (academic_year, course, file_path) VALUES (?, ?, ?)";
                $stmt = $conn->prepare($sql);

                if ($stmt) {
                    $stmt->bind_param("sss", $academicYear, $course, $targetPath);

                    if ($stmt->execute()) {
                        // Set the success message
                        $uploadMessage = '<div class="alert-success">Book uploaded and record inserted into the database successfully!</div>';
                    } else {
                        $uploadMessage = '<div class="alert-error">Error inserting record into the database: ' . $stmt->error . '</div>';
                    }
                } else {
                    $uploadMessage = '<div class="alert-error">Error in SQL query: ' . $conn->error . '</div>';
                }

                $stmt->close();
            } else {
                $uploadMessage = '<div class="alert-error">Error uploading file: Move operation failed.</div>';
            }
        }
    } else {
        $uploadMessage = '<div class="alert-error">Error uploading file: ' . $_FILES["book"]["error"] . '</div>';
    }

    // Echo the success or failure message
    echo $uploadMessage;
}
?>
