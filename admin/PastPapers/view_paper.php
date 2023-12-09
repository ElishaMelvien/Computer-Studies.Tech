<?php
include "config.php";

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
            $papers[] = [
                'course' => $row['course'],
                'Paper_Year' => $row['Paper_Year'],
                'paper_path' => $row['paper_path']
            ];
        }
    }

    echo json_encode($papers);
} else {
    echo json_encode([]);
}

$stmt->close();
$conn->close();
?>
