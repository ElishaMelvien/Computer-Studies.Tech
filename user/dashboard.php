

<?php include('header.php'); ?>

<?php include('sidebar.php'); ?>


<main id="main" class="main">
<div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->





    <?php
    
    // Check if the 'page' parameter is set
    if (isset($_GET['page'])) {
        $page = $_GET['page'];

        // Use a switch statement to include the corresponding content based on the 'page' parameter
        switch ($page) {
            case 'courses':
                include('courses.php');
                break;
            case 'loadPastPapers':
                include('../admin/PastPapers/view.php');
                break;
            case 'books':
                include('pages/books.php');
                break;
            case 'quiz':
                include('pages/quiz.php');
                break;
            case 'home':
                include('pages/home.php');
                break;
            case 'profile':
                include('pages/profile.php');
                break;
            // Add more cases for other pages if needed
            default:
                //include('pages/default.php');
        }
    } else {
        // If 'page' parameter is not set, include a default content
       // include('pages/default.php');
    }
    ?>




    


  
  
  


 
   
  </main>
  
        

    







</script>














<?php include('footer.php'); ?>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
  

</body>

</html>





