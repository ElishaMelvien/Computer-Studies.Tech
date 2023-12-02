<?php
// Include the database configuration
include "config.php";

// Ensure that the year and course parameters are set
if (isset($_GET['year']) && isset($_GET['course'])) {
    $selectedYear = $_GET['year'];
    $selectedCourse = $_GET['course'];

    // Fetch papers based on selected year and course
    $sql = "SELECT * FROM past_papers WHERE year = ? AND course = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $selectedYear, $selectedCourse);
    $stmt->execute();
    $result = $stmt->get_result();

    $papers = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Add each paper entry to the papers array
            $papers[] = [
                'course' => $row['course'],
                'Paper_Year' => $row['Paper_Year'],
                'paper_path' => $row['paper_path']
            ];
        }
    }

    // Return the papers as JSON
    echo json_encode($papers);
} else {
    // Handle the case where the parameters are not set
    echo json_encode([]);
}

// Close the database connection
$stmt->close();
$conn->close();
?>
