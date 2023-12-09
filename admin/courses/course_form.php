<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Course Upload</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <style>
        #imagePreview {
            max-width: 100%;
            height: auto;
            max-height: 200px;
            margin-top: 10px;
            display: none;
        }
        .custom-file-label::after {
            content: "Choose file";
        }

        .custom-file-input:lang(en)~.custom-file-label::after {
            content: "Browse";
        }
    </style>
</head>
<body>

<div class="pagetitle">
    <h1>Admin_Uploads Course</h1>
    <nav>
      
    </nav>
</div><!-- End Page Title -->

<div class="container">
    <form action="../courses/upload_course.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="courseTitle">Course Title:</label>
            <input type="text" class="form-control" name="courseTitle" required>
        </div>

        <div class="form-group">
            <label for="courseImage">Course Image (JPEG, PNG, GIF):</label>
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="courseImage" name="courseImage" accept=".jpeg, .jpg, .png, .gif" onchange="previewImage(this)" required>
                <label class="custom-file-label" for="courseImage">Choose file</label>
            </div>
            <img id="imagePreview" src="#" alt="Course Image Preview">
        </div>
        
        <div class="form-group">
            <label for="courseDescription">Course Description:</label>
            <textarea class="form-control" name="courseDescription" rows="5" required></textarea>
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
            <label for="courseMaterial">Course Material (PDF, DOC):</label>
            <input type="file" class="form-control-file" name="courseMaterial" accept=".pdf, .doc, .docx" required>
        </div>

        <button type="submit" class="btn btn-primary" name="submit">Upload Course</button>
    </form>
</div>

<!-- Bootstrap JS (optional, for certain features) -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<!-- JavaScript to preview selected image -->
<script>
    function previewImage(input) {
        var file = input.files[0];
        var imagePreview = document.getElementById('imagePreview');

        if (file) {
            var reader = new FileReader();
            reader.onload = function (e) {
                imagePreview.src = e.target.result;
                imagePreview.style.display = 'block';
            }
            reader.readAsDataURL(file);
        } else {
            imagePreview.style.display = 'none';
        }
    }
</script>

</body>
</html>
