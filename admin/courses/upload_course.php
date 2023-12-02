<?php
// Database connection
include 'config.php';

// Check connection


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    // Handle form data
    $courseName = $_POST["courseName"];
    $courseTitle = $_POST["courseTitle"];
    $courseDescription = $_POST["courseDescription"];
    $courseLink = $_POST["courseLink"];
    $duration = $_POST["duration"];
    $courseContent = $_POST["courseContent"];

    // Handle file uploads
    $targetPdfDir = "course_pdfs/";
    $targetImageDir = "course_images/";

    $targetPdfFile = $targetPdfDir . basename($_FILES["coursePdfFile"]["name"]);
    $targetImageFile = $targetImageDir . basename($_FILES["courseImage"]["name"]);

    // Upload PDF
    if (move_uploaded_file($_FILES["coursePdfFile"]["tmp_name"], $targetPdfFile)) {
        // Upload image
        if (move_uploaded_file($_FILES["courseImage"]["tmp_name"], $targetImageFile)) {
            // Insert data into the database
            $sql = "INSERT INTO courses (course_name, title, description, link, duration, content, pdf_link, image_path)
                    VALUES ('$courseName', '$courseTitle', '$courseDescription', '$courseLink', '$duration', '$courseContent', '$targetPdfFile', '$targetImageFile')";

            if ($conn->query($sql) === TRUE) {
                echo "Course uploaded successfully.";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Sorry, there was an error uploading the image file.";
        }
    } else {
        echo "Sorry, there was an error uploading the PDF file.";
    }
}

// Close the database connection
$conn->close();
?>
