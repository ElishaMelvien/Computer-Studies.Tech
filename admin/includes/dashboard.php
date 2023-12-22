

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

<?php
  $coursesCountQuery = "SELECT COUNT(*) as courses_count FROM courses";
  $coursesResult = $conn->query($coursesCountQuery);
  $coursesCount = $coursesResult->fetch_assoc()['courses_count'];
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
                      <h6><?php echo "" . $coursesCount;?></h6>
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
              <button id="generateReportBtn" class="btn btn-primary mt-3">Generate Reports</button>
            </div><!-- End Reports -->
            
     


<script>
  document.getElementById('generateReportBtn').addEventListener('click', function () {
    // Use AJAX to call the generateReport.php file
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'generateReports.php', true);
    xhr.responseType = 'blob'; // Set the response type to blob
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4) {
            if (xhr.status == 200) {
                // Report generated successfully
                var blob = new Blob([xhr.response], { type: 'application/pdf' });
                var link = document.createElement('a');
                link.href = window.URL.createObjectURL(blob);
                link.download = 'report.pdf';
                link.click();
            } else {
                // Report generation failed
                alert('Error generating PDF Report!');
            }
        }
    };
    xhr.send();
});

  

</script>


 
   
  </main>






<script>
  $(document).on('click', '#loadPastPapers', function() {
    $('#main').load('../PastPapers/upload_form.php', function() {
        
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>

    $(document).on('click', '#Quiz', function () {
        // Load the quiz form dynamically into the main section
        $('#main').load('quiz_form.php', function () {
            // Add event listeners or perform other actions after the content is loaded
            // For example, reattach your form submission logic here
            $(document).on('submit', '#quizForm', function (e) {
                e.preventDefault();

                // Serialize the form data
                var formData = new FormData(this);

                // Submit the form data using AJAX
                $.ajax({
                    url: 'quiz_upload.php', // Correct relative path
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        // Check if the response contains the success message
                        if (response.includes("Quiz submitted successfully!")) {
                            // Show SweetAlert success message
                            Swal.fire({
                                icon: 'success',
                                title: 'Quiz Submitted!',
                                text: 'Quiz submitted successfully!',
                            });

                            // Insert the success message dynamically with a specific class
                            $('#main').html('<div class="alert alert-success">' + response + '</div>');
                        } else {
                            // Show SweetAlert error message
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'Failed to submit quiz. Please try again.',
                            });

                            // Handle other responses or errors
                            $('#main').html(response);
                        }
                    },
                    error: function (xhr, status, error) {
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

<script>
  $(document).on('click', '#loadCourses', function() {
    $('#main').load('../courses/course_form.php', function() {
        // Add event listeners or perform other actions after the content is loaded
        // For example, reattach your form submission logic here
        $(document).on('submit', '#courseform', function(e) {
            e.preventDefault();

            // Serialize the form data
            var formData = new FormData(this);

            // Submit the form data using AJAX
            $.ajax({
                url: '../courses/upload_course.php', // Correct relative path
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    // Check if the response contains the success message
                    if (response.includes("Course uploaded successfully!")) {
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