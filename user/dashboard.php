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
                include 'PastPaper.php';
                break;

        case 'quiz':
                    
                include 'quiz.php';
                break;
        
                
            break;
        case 'books':
            
            include '../admin/Books/view_books.php'; 
            break;
        case 'logout':
            header('Location: ../logout.php'); 
            exit();
        default:
            include 'pages/dashboard.php'; 
    }
    ?>
</div>




</main>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>


<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


<?php include('footer.php'); ?>
