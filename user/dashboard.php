<?php include('header.php'); ?>

<?php include('sidebar.php'); ?>


<main id="main" class="main">
   <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

   <div id="content">
    <?php
    // Check if the 'page' parameter is set in the URL
    $page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';

    // Load the corresponding content based on the 'page' parameter
    switch ($page) {
        case 'dashboard':
            // Include content specific to the dashboard page here if needed
            break;
        case 'courses':
            include 'courses.php'; // File for displaying courses
            break;
        case 'loadPastPapers':
            // Include the form for displaying past papers
            include 'pastpaper.php';
            
            break;
        case 'books':
            // Adjust the include path based on your folder structure
            include '../admin/Books/view_books.php'; // File for displaying books
            break;
        case 'logout':
            header('Location: ../logout.php'); // Redirect to the logout page
            exit();
        default:
            include 'pages/dashboard.php'; // Default to dashboard if 'page' is not recognized
    }
    ?>
</div>




</main>


<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function() {
        // Event listener for the form submission
        $("#pastPapersForm").submit(function(event) {
            // Prevent the default form submission behavior
            event.preventDefault();

            // Serialize form data
            var formData = $(this).serialize();

            // Send an AJAX request
            $.ajax({
                type: "GET",
                url: "PastPaper.php", // Same page
                data: formData,
                success: function(response) {
                    // Clear existing results
                    $("#main").html("");  // Update the main container by replacing its content
                    $("#main").html(response);
                },
                error: function(error) {
                    console.log("Error:", error);
                }
            });
        });
    });
</script>











<?php include('footer.php'); ?>
