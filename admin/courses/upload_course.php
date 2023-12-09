<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection code
    $hostname = "localhost"; 
    $username = "root";
    $password = "";
    $database = "computerstudies";

    $conn = new mysqli($hostname, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind the SQL statement
    $stmt = $conn->prepare("INSERT INTO courses (title, description, duration, content, pdf_link, image_path) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $title, $description, $duration, $content, $pdf_link, $image_path);

    // Get form data
    $title = $_POST["courseTitle"];
    $description = $_POST["courseDescription"];
    $duration = $_POST["duration"];
    $content = $_POST["courseContent"];

    // Upload course image
    $target_dir = "images/";

    // Create the "uploads" directory if it doesn't exist
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0755, true);
    }

    $target_file = $target_dir . basename($_FILES["courseImage"]["name"]);

    // Check if the file already exists, and handle accordingly
    if (file_exists($target_file)) {
        // Handle the situation where the file already exists (e.g., append a timestamp)
        $timestamp = time();
        $target_file = $target_dir . $timestamp . '_' . basename($_FILES["courseImage"]["name"]);
    }

    move_uploaded_file($_FILES["courseImage"]["tmp_name"], $target_file);

    $image_path = $target_file;

    // Upload course PDF
    $pdf_target_dir = "uploads/";

    if (!file_exists($pdf_target_dir)) {
        mkdir($pdf_target_dir, 0755, true);
    }

    $pdf_target_file = $pdf_target_dir . basename($_FILES["courseMaterial"]["name"]);

    if (file_exists($pdf_target_file)) {
        $timestamp = time();
        $pdf_target_file = $pdf_target_dir . $timestamp . '_' . basename($_FILES["courseMaterial"]["name"]);
    }

    move_uploaded_file($_FILES["courseMaterial"]["tmp_name"], $pdf_target_file);

    $pdf_link = $pdf_target_file;

    // Execute the SQL statement
    if ($stmt->execute()) {
        echo "Course uploaded successfully";
    } else {
        echo "Error uploading course: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
