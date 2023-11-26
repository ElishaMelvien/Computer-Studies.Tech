<?php
include "config.php";
$years = [1, 2, 3];
$courseLists = [
    '1' => ['Programming I', 'Entrepreneurship', 'Statistics and Mathematics', 'Com Skills', 'Information Technology', 'Entrepreneurship', 'Foundation of Management', 'Computer Architecture'],
    '2' => ['Programming II', 'System Analysis and Design I', 'Database Technology', 'Operating Systems', 'Accounts', 'Quantitative Analysis'],
    '3' => ['Advanced Programming', 'Computer Networks', 'MIS', 'System Analysis and Design II'],
];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Past Papers</title>
    <!-- Include jQuery and DataTables CSS and JS -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
    <!-- Bootstrap theme CSS -->
   


    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>

    <style>
        /* Your CSS styles here */

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

        h1,
        h2 {
            font-family: 'Roboto', sans-serif;
        }

        p {
            font-family: 'Roboto', sans-serif;
        }

        /* Make the Paper_Year bold and set its color to blue */
        .paper-year {
            font-weight: bold;
            color: blue;
            /* Shiny blue color */
        }

        /* Bootstrap styling for DataTable elements */
        #papersTable_wrapper {
            margin-top: 20px;
        }

        #papersTable_length,
        #papersTable_filter {
            margin-bottom: 10px;
        }
    </style>
</head>

<body>

    <div class="container mt-5">

        <form method="GET" id="pastPapersForm">
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
                        // Initially selected year
                        $selectedYear = $_GET['year'];

                        // Define the course list array
                        $courseLists = [
                            '1' => ['Programming I', 'Entrepreneurship', 'Statistics and Mathematics', 'Communication Skills', 'Information Technology', 'Entrepreneurship', 'Foundation of Management', 'Computer Architecture'],
                            '2' => ['Programming II', 'System Analysis and Design I', 'Database Technology', 'Operating Systems', 'Accounts', 'Quantitative Analysis'],
                            '3' => ['Advanced Programming', 'Computer Networks', 'Management Information Systems', 'System Analysis and Design II'],
                        ];

                        // Initially selected course (if set)
                        $selectedCourse = $_GET['course'];

                        // Display courses for the selected year
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

    </div>

    <!-- Include local Bootstrap JS -->
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script>
    $(document).ready(function () {
        // DataTable initialization
        $('#papersTable').DataTable({
            "paging": true,
            "searching": true,
            "ordering": true
        });

        // Add change event listener to yearSelect
        $('#yearSelect').change(function () {
            var selectedYear = $(this).val();

            // Fetch and update courses based on the selected year
            if (selectedYear) {
                var courseSelect = $('#courseSelect');
                courseSelect.empty(); // Clear existing options

                // Add the default "All Courses" option
                courseSelect.append('<option value="">All Courses</option>');

                // Add courses based on the selected year
                <?php
                if (isset($courseLists)) {
                    echo "var courseLists = " . json_encode($courseLists) . ";\n";
                }
                ?>
                
                if (courseLists[selectedYear]) {
                    courseLists[selectedYear].forEach(function (course) {
                        courseSelect.append('<option value="' + course + '">' + course + '</option>');
                    });
                }
            }
        });

        <!-- Add submit event listener to pastPapersForm
        $(document).on('submit', '#pastPapersForm', function (e) {
            e.preventDefault();

            // Serialize the form data
            var formData = new FormData(this);

            // Submit the form data using AJAX
            $.ajax({
                url: 'PastPaper.php', // Adjust the URL to your processing logic
                type: 'GET', // Use GET or POST depending on your server-side logic
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    // Check if the response contains the success message
                    if (response.includes("<h2 class='mt-4'>Past Papers:</h2>")) {
                        // Append the past papers dynamically into the content area
                        $('#main').append(response);
                    } else {
                        // Handle other responses or errors
                        $('#main').append(response);
                    }
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>


    
</body>

</html>
