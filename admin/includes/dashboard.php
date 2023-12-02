

<?php include('header.php'); ?>

<?php include('sidebar.php'); ?>


<!-- Reports -->
<!-- Counts the number of Users in the system-->
<?php 
   $previous_UserCount = 2;
   $userCountQuery = "SELECT COUNT(*) as user_count FROM users";
   $userResult = $conn->query($userCountQuery);
   $userCount = $userResult->fetch_assoc()['user_count'];

   $User_increase = $userCount - $previous_UserCount;
   $percentage = ($User_increase / $previous_UserCount) * 10;

   ?>

<!-- Number of Admins in the system-->
<?php 
$adminCountQuery = "SELECT COUNT(*) as admin_count FROM admin WHERE id = 1";
$adminResult = $conn->query($adminCountQuery);
$adminCount = $adminResult->fetch_assoc()['admin_count'];

?>

<!-- Number of past Papers in the system-->
<?php
   $previousCount = 40;
   $papersCountQuery = "SELECT COUNT(*) as papers_count FROM past_papers";
   $papersResult = $conn->query($papersCountQuery);
   $papersCount = $papersResult->fetch_assoc()['papers_count'];

   $increase = $papersCount - $previousCount;
   $percentageIncrease = ($increase / $previousCount) * 100;
?>


<!-- Number of Books in the system-->
<?php $booksCountQuery = "SELECT COUNT(*) as books_count FROM books";
   $booksResult = $conn->query($booksCountQuery);
   $booksCount = $booksResult->fetch_assoc()['books_count'];
?>



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

    <section class="section dashboard">
      <div class="row">


      
        <!-- Left side columns -->
        <div class="col-lg-8">
          <div class="row">
            <!-- End Users card Card -->
            <div class="col-xxl-4 col-xl-12">

              <div class="card info-card customers-card">

                

                <div class="card-body">
                  <h5 class="card-title">Users<span>| This Year</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?Php echo "users: " . $userCount;
?></h6>
                      <span class="text-danger small pt-1 fw-bold"><?php echo number_format($percentage) . '%'; ?></span> <span class="text-muted small pt-2 ps-1">increase</span>

                    </div>
                  </div>

                </div>
              </div>

            </div><!-- End User's Card -->


          

              <!-- Past Papers -->
              <div class="col-xxl-4 col-md-6">
              <div class="card info-card revenue-card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">Today</a></li>
                    <li><a class="dropdown-item" href="#">This Month</a></li>
                    <li><a class="dropdown-item" href="#">This Year</a></li>
                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Past Papers<span>| Total</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="ri-file-copy-fill
"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php echo "" . $papersCount;
                      ?>
                      </h6>
                      <span class="text-success small pt-1 fw-bold"> <?php echo number_format($percentageIncrease) . '%'; ?></span> <span class="text-muted small pt-2 ps-1">increase</span>
                      

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Past Papers Card -->


              <!-- Admin Card -->
              <div class="col-xxl-4 col-md-6">
              <div class="card info-card revenue-card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">Today</a></li>
                    <li><a class="dropdown-item" href="#">This Month</a></li>
                    <li><a class="dropdown-item" href="#">This Year</a></li>
                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Admin <span>| Total</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="ri-admin-fill"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php echo " " . $adminCount; ?></h6>
                      

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Admin Card -->


              <!-- Books -->
              <div class="col-xxl-4 col-md-6">
              <div class="card info-card revenue-card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">Today</a></li>
                    <li><a class="dropdown-item" href="#">This Month</a></li>
                    <li><a class="dropdown-item" href="#">This Year</a></li>
                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Books<span>| Total</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="ri-book-2-fill"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php echo "" . $booksCount;?></h6>
                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End of Book card-->


            <!-- Books -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card revenue-card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">Today</a></li>
                    <li><a class="dropdown-item" href="#">This Month</a></li>
                    <li><a class="dropdown-item" href="#">This Year</a></li>
                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Courses<span>| Total</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-film"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php echo "" . $booksCount;?></h6>
                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End of Book card-->



            <!-- Reports -->
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Reports <span></span></h5>

                  <!-- Line Chart -->
                  <div id="reportsChart"></div>

                  <script>
                    document.addEventListener("DOMContentLoaded", () => {
                      new ApexCharts(document.querySelector("#reportsChart"), {
                        series: [{
                          name: 'Users',
                          data: [31, 40, 28, 51, 42, 82, 56],
                        }, {
                          name: 'Past Papers',
                          data: [11, 32, 45, 32, 34, 52, 41]
                        }, {
                          name: 'Books',
                          data: [15, 11, 32, 18, 9, 24, 11]
                        }],
                        chart: {
                          height: 350,
                          type: 'area',
                          toolbar: {
                            show: false
                          },
                        },
                        markers: {
                          size: 4
                        },
                        colors: ['#4154f1', '#2eca6a', '#ff771d'],
                        fill: {
                          type: "gradient",
                          gradient: {
                            shadeIntensity: 1,
                            opacityFrom: 0.3,
                            opacityTo: 0.4,
                            stops: [0, 90, 100]
                          }
                        },
                        dataLabels: {
                          enabled: false
                        },
                        stroke: {
                          curve: 'smooth',
                          width: 2
                        },
                        xaxis: {
                          type: 'datetime',
                          categories: ["2018-09-19T00:00:00.000Z", "2018-09-19T01:30:00.000Z", "2018-09-19T02:30:00.000Z", "2018-09-19T03:30:00.000Z", "2018-09-19T04:30:00.000Z", "2018-09-19T05:30:00.000Z", "2018-09-19T06:30:00.000Z"]
                        },
                        tooltip: {
                          x: {
                            format: 'dd/MM/yy HH:mm'
                          },
                        }
                      }).render();
                    });
                  </script>
                  <!-- End Line Chart -->

                </div>

              </div>
            </div><!-- End Reports -->

            
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
                <label for="courseName">Course Name:</label>
                <input type="text" class="form-control" name="courseName" required>
            </div>

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
                <label for="coursePdfFile">Upload Course Material PDF:</label>
                <input type="file" class="form-control-file" name="coursePdfFile" accept=".pdf" required>
                <small class="form-text text-muted">Upload a PDF file for course material.</small>
            </div>

            <div class="form-group">
                <label for="courseImage">Upload Course Image (JPEG, PNG, GIF):</label>
                <input type="file" class="form-control-file" name="courseImage" accept=".jpeg, .jpg, .png, .gif" required>
                <small class="form-text text-muted">Upload an image for the course.</small>
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





 
   
  </main>






<script>
  $(document).on('click', '#loadPastPapers', function() {
    $('#main').load('../PastPapers/upload_form.php', function() {
        // Add event listeners or perform other actions after the content is loaded
        // For example, reattach your form submission logic here
        $(document).on('submit', '#pastPaperForm', function(e) {
            e.preventDefault();

            // Serialize the form data
            var formData = new FormData(this);

            // Submit the form data using AJAX
            $.ajax({
                url: '../PastPapers/upload.php',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    // Check if the response contains the success message
                    if (response.includes("File uploaded and record inserted into the database successfully!")) {
                        // Insert the success message dynamically with a specific class
                        $('#main').html('<div class="alert alert-success">' + response + '</div>');
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

 
</script>




<script>
    
    function loadDataTable() {
        $.ajax({
            url: 'Users.php',
            type: 'GET',
            dataType: 'html',
            success: function(data) {
                
                $('#main').html(data);

                // Initialize DataTables on your table
            

                // Add click event listener to delete buttons
                $('.delete-btn').on('click', function(e) {
                    e.preventDefault();
                    var userId = $(this).data('userid');
                    deleteRow(userId);
                });
            },
            error: function() {
                console.error('Error loading DataTable content');
            }
        });
    }

    // Function to delete a user row
    function deleteRow(userId) {
        $.ajax({
            url: 'delete_user.php', 
            type: 'POST',
            data: { userId: userId },
            success: function(response) {
                console.log(response);
                // Reload DataTable after deletion
                loadDataTable();
            },
            error: function() {
                console.error('Error deleting user');
            }
        });
    }

    $(document).ready(function() {
        // Add click event listener to the sidebar link
        $(document).on('click', '#loadDataTable', function(e) {
            e.preventDefault(); // Prevent the default link behavior
            // Load the DataTable dynamically when the link is clicked
            loadDataTable();
        });
    });
</script>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


<script>
    $(document).on('click', '#loadBooks', function() {
        $('#main').load('../Books/upload_form.php', function() {
            // Add event listeners or perform other actions after the content is loaded
            // For example, reattach your form submission logic here
            $(document).on('submit', '#bookForm', function(e) {
                e.preventDefault();

                // Serialize the form data
                var formData = new FormData(this);

                // Submit the form data using AJAX
                $.ajax({
                    url: '../Books/upload.php',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        // Check if the response contains the success message
                        if (response.includes("Book uploaded successfully!")) {
                            // Insert the success message dynamically with a specific class
                            $('#main').html('<div class="alert-success">' + response + '</div>');
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
</script>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>





<?php include('footer.php'); ?>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
<script type="text/javascript" src="datatable/datatables.min.js"></script>

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