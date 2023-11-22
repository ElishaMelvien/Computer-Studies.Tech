

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




  
  


</script>


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
                
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });
});


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