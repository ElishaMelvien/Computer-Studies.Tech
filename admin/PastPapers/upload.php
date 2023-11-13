<?php
include "config.php";



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





</body>
</html>
