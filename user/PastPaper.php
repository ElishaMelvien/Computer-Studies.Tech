<?php
include "config.php";

?>

<!DOCTYPE html>
<html>
<head>
    <title> Past Papers</title>
    
    <!-- Include Google Fonts (Roboto) -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Add custom CSS for smaller buttons and inline display -->
    <style>
        .course-info {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .btn-sm {
            font-size: 0.75rem;
        }
        
        .download-button {
            background-color: orange;
            color: white;
            border: none;
            margin-right:8px ;
            font-size: 15px;
        }
        .download-button:hover {
            background-color: orange; 
            color: white; 
            
        }
        /* Apply the "Roboto" font to specific elements */
        body {
            font-family: 'Roboto', sans-serif;
        }
        h1, h2 {
            font-family: 'Roboto', sans-serif;
        }
        p {
            font-family: 'Roboto', sans-serif;
        }
        /* Make the Paper_Year bold and set its color to blue */
        .paper-year {
            font-weight: bold;
            color: blue; /* Shiny blue color */
        }
    </style>
    
</head>
<body>

    <div class="container mt-5">
        

        <form method="GET">
            <div class="row g-3">
                <div class="col-md-4">
                    <label for="year" class="form-label">Select Year:</label>
                    <select name="year" id="yearSelect" class="form-select">
                        <option value="">Select Academic Year</option>
                        <?php
                        $years = [1, 2, 3];

                        foreach ($years as $year) {
                            $selected = ($year == $_GET['year']) ? "selected" : "";
                            echo "<option value='$year' $selected>$year</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="course" class="form-label">Select Course:</label>
                    <select name="course" id="courseSelect" class="form-select">
                        <option value="">All Courses</option>
                        <?php
                        $selectedYear = $_GET['year'];
                        $selectedCourse = $_GET['course'];

                        // Define the course list array
                        $courseLists = [
                            '1' => ['Programming I', 'Entrepreneurship', 'Statistics and Mathematics', 'Communication Skills', 'Information Technology', 'Entrepreneurship', 'Foundation of Management', 'Computer Architecture'],
                            '2' => ['Programming II', 'System Analysis and Design I', 'Database Technology', 'Operating Systems', 'Accounts', 'Quantitative Analysis'],
                            '3' => ['Advanced Programming', 'Computer Networks', 'Management Information Systems', 'System Analysis and Design II'],
                        ];

                        if ($selectedYear && isset($courseLists[$selectedYear])) {
                            foreach ($courseLists[$selectedYear] as $course) {
                                $selected = ($course == $selectedCourse) ? "selected" : "";
                                echo "<option value='$course' $selected>$course</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label" style="visibility: hidden;">Hidden Label</label>
                    <button type="submit" class="btn btn-primary form-control">Show Papers</button>
                </div>
            </div>
        </form>

        <?php
        if ($selectedYear && $selectedCourse) {
            // Fetch papers based on selected year and course
            $sql = "SELECT * FROM past_papers WHERE year = ? AND course = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("is", $selectedYear, $selectedCourse);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                echo "<h2 class='mt-4'>Past Papers:</h2>";
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='mb-3 course-info'>";
                    echo "<div class='col-md-4'>";
                    // Display the course name and bold blue Paper_Year
                    echo "<p>{$row['course']} <span class='paper-year'>{$row['Paper_Year']}</span></p>";
                    echo "</div>";
                    echo "<div class='col-md-4'>";
                    // Display "View" button with blue hover effect
                    echo "<a href='{$row['paper_path']}' class='btn btn-primary btn-sm' target='_blank'>View</a> ";
                    // Display "Download" button in orange with white text
                    echo "<a href='{$row['paper_path']}' class='btn btn-warning btn-sm download-button' download>Download</a>";
                    echo "</div>";
                    echo "</div>";
                }
            } else {
                echo "<p>No papers available for the selected year and course.</p>";
            }
            $stmt->close();
        } elseif ($selectedYear || $selectedCourse) {
            echo "<p>No papers available for the selected year and course.</p>";
        }
        ?>
    </div>

    <!-- Include Bootstrap JS and dependencies -->
    <script src="bootstrap/js/jquery.min.js"></script>
    <script src="bootstrap/js/popper.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- Your JavaScript code here -->
</body>
</html>
