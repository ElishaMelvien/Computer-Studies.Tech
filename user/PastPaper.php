<!DOCTYPE html>
<html>
<head>
    <title>View Past Papers</title>
    
    <!-- Include Google Fonts (Roboto) -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">
    <!-- Add custom CSS for smaller buttons and inline display -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>

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
            margin-right: 8px;
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

        .past-papers-form {
            padding: 4rem;
        }
        h1{
            color:blue;
        }
    </style>
</head>
<body>

    <div class="past-papers-form">
    <h1>Past Papers</h1>

        <div class="row g-3">
            <div class="col-md-4">
                <label for="year" class="form-label">Select Year:</label>
                <select name="year" id="yearSelect" class="form-select">
                    <option value="">Select Academic Year</option>
                    <?php
                    include "config.php"; // Include the database configuration

                    $years = [1, 2, 3]; // Add the years 1, 2, and 3 to the array

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
            <!-- Remove the following div and its content -->
            <!-- <div class="col-md-2">
                <label class="form-label" style="visibility: hidden;">Hidden Label</label>
                <button type="button" id="showPapersButton" class="btn btn-primary form-control">Show Papers</button>
            </div> -->
        </div>

        <!-- DataTable to display the past papers -->
        <table id="pastPapersTable" class="display">
            <thead>
                <tr>
                    <th>Course</th>
                    <th>Paper Year</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // PHP code to fetch and display past papers goes here
                ?>
            </tbody>
        </table>

    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var yearSelect = document.getElementById("yearSelect");
            var courseSelect = document.getElementById("courseSelect");

            var courseLists = {
                '1': ['Programming I', 'Entrepreneurship', 'Statistics and Mathematics', 'Communication Skills', 'Information Technology', 'Entrepreneurship', 'Foundation of Management', 'Computer Architecture'],
                '2': ['Programming II', 'System Analysis and Design I', 'Database Technology', 'Operating Systems', 'Accounts', 'Quantitative Analysis'],
                '3': ['Advanced Programming', 'Computer Networks', 'Management Information Systems', 'System Analysis and Design II'],
            };

            // DataTable configuration
            var dataTable = $('#pastPapersTable').DataTable({
                searching: false,
                lengthChange: false,
                ordering: false,
                info: false,
                paging: false
            });

            function updateCourses() {
                var selectedYear = yearSelect.value;
                courseSelect.innerHTML = "";

                var allCoursesOption = document.createElement("option");
                allCoursesOption.value = "";
                allCoursesOption.textContent = "All Courses";
                courseSelect.appendChild(allCoursesOption);

                if (selectedYear && courseLists[selectedYear]) {
                    courseLists[selectedYear].forEach(function (course) {
                        var option = document.createElement("option");
                        option.value = course;
                        option.textContent = course;
                        courseSelect.appendChild(option);
                    });
                }
            }

            function fetchAndDisplayPapers() {
                var selectedYear = yearSelect.value;
                var selectedCourse = courseSelect.value;

                // Clear previous DataTable entries
                dataTable.clear().draw();

                if (selectedYear && selectedCourse) {
                    // AJAX request to fetch papers from the server
                    $.ajax({
                        url: 'fetch_pastpaper.php', // Replace with the actual path to your server-side script
                        type: 'GET',
                        data: { year: selectedYear, course: selectedCourse },
                        dataType: 'json',
                        success: function (papers) {
                            displayPapers(papers);
                        },
                        error: function () {
                            // Display an error message
                            console.error("Error fetching papers from the server.");
                        }
                    });
                }
            }

            function displayPapers(papers) {
                if (papers.length > 0) {
                    papers.forEach(function (row) {
                        // Add a new row to the DataTable
                        dataTable.row.add([
                            row.course,
                            row.Paper_Year,
                            "<a href='../admin/PastPapers/" + row.paper_path + "' class='btn btn-primary btn-sm' target='_blank'>View</a>&nbsp;" +
                            "<a href='../admin/PastPapers/" + row.paper_path + "' class='btn btn-warning btn-sm download-button' style='color: white;' download>Download</a>"

                        ]).draw();
                    });
                } else {
                    // Display a message in case no papers are available
                    console.warn("No papers available for the selected year and course.");
                }
            }

            yearSelect.addEventListener("change", function () {
                updateCourses();
                fetchAndDisplayPapers();
            });

            courseSelect.addEventListener("change", function () {
                fetchAndDisplayPapers();
            });

            // Initial call to populate courses based on the default selected year
            updateCourses();
        });
    </script>

</body>
</html>
