<?php
include "config.php";
set_time_limit(60); // Set to the desired time limit in seconds\

$selectedYear = isset($_GET['year']) ? $_GET['year'] : null;
$selectedCourse = isset($_GET['course']) ? $_GET['course'] : null;

error_log("Selected Year: " . $selectedYear);
error_log("Selected Course: " . $selectedCourse);


$selectedYear = $_GET['year'] ?? null;
$selectedCourse = $_GET['course'] ?? null;

if ($selectedYear && $selectedCourse) {
    // Fetch papers based on selected year and course
    $sql = "SELECT * FROM past_papers WHERE year = ? AND course = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $selectedYear, $selectedCourse);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<h2 class='mt-4'>Past Papers:</h2>";
        echo "<table id='papersTable' class='table table-bordered table-hover responsive'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>Course</th>";
        echo "<th>Paper Year</th>";
        echo "<th>Action</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$row['course']}</td>";
            echo "<td>{$row['Paper_Year']}</td>";
            echo "<td>";
            echo "<a href='{$row['paper_path']}' class='btn btn-primary btn-sm' target='_blank'>View</a> ";
            echo "<a href='{$row['paper_path']}' class='btn btn-warning btn-sm download-button' download>Download</a>";
            echo "</td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
    } else {
        echo "<p>No papers available for the selected year and course.</p>";
    }
    $stmt->close();
} elseif ($selectedYear || $selectedCourse) {
    echo "<p>No papers available for the selected year and course.</p>";
}
?>