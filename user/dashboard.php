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
            include 'display_papers.php';
            
            // Include the logic for handling past paper data
            include 'PastPaper.php';
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
    $(document).on('click', '#loadPastPapers', function() {
      // Assuming the form is in display_papers.php
      $('#main').load('display_papers.php', function() {
        // Add event listeners or perform other actions after the content is loaded
        // For example, reattach your form submission logic here
        $(document).on('submit', '#pastPapersForm', function(e) {
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
            success: function(response) {
              // Check if the response contains the success message
              if (response.includes("<h2 class='mt-4'>Past Papers:</h2>")) {
                // Insert the past papers dynamically into the content area
                $('#main').html(response);
              } else {
                // Handle other responses or errors
                $('#main').html(response);
              }
            },
            error: function(xhr, status, error) {
              console.error(xhr.responseText);
            }
          });
        });
      });
    });
  });
</script>






<?php include('footer.php'); ?>
