

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

<script type="text/javascript" src="datatable/datatables.min.js"></script>
<link rel="stylesheet" type="text/css" href="datatable/datatables.min.css">


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