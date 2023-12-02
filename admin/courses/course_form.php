<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Course Upload</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2 class="mt-5">Upload Course</h2>
        <form action="upload_course.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="courseTitle">Course Title:</label>
                <input type="text" class="form-control" name="courseTitle" required>
            </div>

            <div class="form-group">
                <label for="courseDescription">Course Description:</label>
                <textarea class="form-control" name="courseDescription" rows="5" required></textarea>
            </div>

            <div class="form-group">
                <label for="courseLink">Read More Link:</label>
                <input type="text" class="form-control" name="courseLink" required>
            </div>

            <div class="form-group">
                <label for="duration">Duration:</label>
                <input type="text" class="form-control" name="duration" required>
            </div>

            <div class="form-group">
                <label for="courseContent">Course Content:</label>
                <textarea class="form-control" name="courseContent" rows="5" required></textarea>
            </div>

            <div class="form-group">
                <label for="coursePdfLink">Course Material PDF Link:</label>
                <input type="url" class="form-control" name="coursePdfLink" placeholder="https://example.com/course-material.pdf" required>
            </div>

            <div class="form-group">
                <label for="courseImage">Course Image (JPEG, PNG, GIF):</label>
                <input type="file" class="form-control-file" name="courseImage" accept=".jpeg, .jpg, .png, .gif" required>
            </div>

            <button type="submit" class="btn btn-primary" name="submit">Upload Course</button>
        </form>
    </div>

    <!-- Bootstrap JS (optional, for certain features) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
