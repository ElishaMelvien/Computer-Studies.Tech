<?php
include 'config.php';

$years = [1, 2, 3];
$courseLists = [
    '1' => ['Programming I', 'Entrepreneurship', 'Statistics and Mathematics', 'Com Skills', 'Information Technology', 'Entrepreneurship', 'Foundation of Management', 'Computer Architecture'],
    '2' => ['Programming II', 'System Analysis and Design I', 'Database Technology', 'Operating Systems', 'Accounts', 'Quantitative Analysis'],
    '3' => ['Advanced Programming', 'Computer Networks', 'MIS', 'System Analysis and Design II'],
];

// Set the base path for file downloads
$basePath = '../admin/Books/Uploads/';

// Fetch distinct academic years from the database
function getDistinctYears() {
    global $conn, $years;

    // If the academic years are predefined, return them
    if (!empty($years)) {
        return $years;
    }

    $sql = "SELECT DISTINCT academic_year FROM books";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("Error in SQL query: " . mysqli_error($conn));
    }

    $distinctYears = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $distinctYears[] = $row['academic_year'];
    }

    return $distinctYears;
}

// Fetch books based on selected academic year and course
function getBooksFromDB($academicYear, $course) {
    global $conn;

    $sql = "SELECT * FROM books WHERE academic_year = ? AND course = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ss", $academicYear, $course);
        $stmt->execute();

        $result = $stmt->get_result();

        if (!$result) {
            die("Error in SQL query: " . $stmt->error);
        }

        $books = array();
        while ($row = $result->fetch_assoc()) {
            $books[] = $row;
        }

        $stmt->close();
        return $books;
    } else {
        die("Error in SQL query: " . $conn->error);
    }
}

$distinctYears = getDistinctYears();
?>

<style>
    h2{
        color:blue;
    }


</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Books</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <div class="container mt-5">
        <h2 class="mb-4">View Books</h2>

        <!-- Form for selecting academic year and course -->
        <form method="POST" id="filterForm">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="academic_year">Select Academic Year:</label>
                    <select class="form-control" name="academic_year" id="academic_year">
                        <?php foreach ($distinctYears as $year) { ?>
                            <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="form-group col-md-6">
                    <label for="course">Select Course:</label>
                    <select class="form-control" name="course" id="course">
                        <!-- Courses will be populated dynamically -->
                    </select>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Filter</button>
        </form>

        <!-- Display books in a data table -->
        <table class="table mt-4">
            <thead>
                <tr>
                    <th>Book Title</th>
                    <th>Academic Year</th>
                    <th>Course</th>
                    <th>Download Link</th>
                </tr>
            </thead>

            <tbody>
                <!-- Display books dynamically here -->
                <?php
                $academicYear = $_POST['academic_year'] ?? '';
                $course = $_POST['course'] ?? '';

                $filteredBooks = getBooksFromDB($academicYear, $course);

                foreach ($filteredBooks as $book) { ?>
                    <tr>
                        <td><?php echo isset($book['book_title']) ? $book['book_title'] : 'N/A'; ?></td>
                        <td><?php echo isset($book['academic_year']) ? $book['academic_year'] : 'N/A'; ?></td>
                        <td><?php echo isset($book['course']) ? $book['course'] : 'N/A'; ?></td>
                        <!-- Assuming the 'file_path' column contains the path to the uploaded PDF file -->
                        <td>

                        <?php
                        if (isset($book['file_path'])) {
                            $fileName = basename($book['file_path']);
                            $downloadLink = $basePath . $fileName;
                            echo '<a href="' . $downloadLink . '" target="_blank">Download</a>';
                        } else {
                            echo 'N/A';
                        }
                        ?>

                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        // Populate courses based on the selected academic year
        function populateCourses(year) {
            var coursesDropdown = document.getElementById("course");
            coursesDropdown.innerHTML = '';

            if (year !== "") {
                var courseList = <?php echo json_encode($courseLists); ?>;
                var courses = courseList[year];

                courses.forEach(function (course) {
                    var option = document.createElement("option");
                    option.value = course;
                    option.text = course;
                    coursesDropdown.appendChild(option);
                });
            }
        }

        // Event listener for changes in the academic year dropdown
        document.getElementById("academic_year").addEventListener("change", function () {
            var selectedYear = this.value;
            populateCourses(selectedYear);
        });

        // Initial population of courses based on the default academic year (if any)
        var defaultYear = document.getElementById("academic_year").value;
        populateCourses(defaultYear);
    </script>
</body>
</html>
