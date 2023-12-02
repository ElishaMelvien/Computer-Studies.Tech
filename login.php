<?php
session_start();

$host = "localhost";
$username = "root";
$password = "";
$database = "computerstudies";

// Establish a connection to the MySQL database
$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) { 
    die("Connection failed: " . $conn->connect_error);
}

$errorMsg = "";
$errorOccurred = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    
    if (empty($username) || empty($password)) {
        $errorMsg = "Invalid Username and Password!";
        $errorOccurred = true;
    } else {
        // Check in the admin table
        $admin_sql = "SELECT id, username, password, role FROM admin WHERE username = ? LIMIT 1";
        $admin_stmt = $conn->prepare($admin_sql);
        $admin_stmt->bind_param("s", $username);
        $admin_stmt->execute();
        $admin_result = $admin_stmt->get_result();

        // Check in the user table if not found in the admin table
        if ($admin_result->num_rows === 0) {
            $user_sql = "SELECT id, username, password, role FROM users WHERE username = ? LIMIT 1";
            $user_stmt = $conn->prepare($user_sql);
            $user_stmt->bind_param("s", $username);
            $user_stmt->execute();
            $user_result = $user_stmt->get_result();

            if ($user_result->num_rows === 1) {
                $user = $user_result->fetch_assoc();

                if (password_verify($password, $user["password"])) {
                    $_SESSION["username"] = $username;
                    $_SESSION["role"] = $user["role"];

                    if ($user["role"] === 'admin') {
                        header("Location: admin/includes/dashboard.php");
                    } elseif ($user["role"] === 'user') {
                        header("Location: user/dashboard.php");
                    } else {
                        // Handle other roles or unknown roles here
                    }
                    exit;
                } else {
                    
                    $errorMsg = "Incorrect password.";
                    $errorOccurred = true;
                }
            } else {
                $errorMsg =  "User not found.";
                $errorOccurred = true;
            }
        } else {
            // Admin login successful
            $admin = $admin_result->fetch_assoc();

            if (password_verify($password, $admin["password"])) {
                $_SESSION["username"] = $username;
                $_SESSION["role"] = $admin["role"];

                if ($admin["role"] === 'admin') {
                    header("Location: admin/includes/dashboard.php");
                } elseif ($admin["role"] === 'user') {
                    header("Location: admin/PastPapers/view.php");
                } else {
                    // Handle other roles or unknown roles here
                }
                exit;
            } else {
                $errorMsg = "Incorrect password!";
                $errorOccurred = true;
            }
        }
    }
}

if (isset($_SESSION["username"])) {
    if ($_SESSION["role"] === 'admin') {
        header("Location: admin/includes/dashboard.php");
    } elseif ($_SESSION["role"] === 'user') {
        header("Location: admin/PastPapers/view.php");
    } else {
        // Handle other roles or unknown roles here
        // such as Instructor
    }

    

    exit;
}
?>










<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title> Login</title>

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="C:\Users\User\Desktop\Computer Studies.Tech\css\style.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">

    <style>
        @keyframes blink {
            0% { opacity: 5 }
            50% { opacity: 4; }
            100% { opacity: 7; }
        }

        .blink {
            animation: blink 1.2s infinite;
        }
    </style>






</head>

<body>
    <main>
        <div class="container">
            <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                            <div class="d-flex justify-content-center py-4">
                                <a href="index.html" class="logo d-flex align-items-center w-auto">
                                  <img src="assets/img/logo.png" alt="">
                                  <span class="d-none d-lg-block">ComputerStudies.Tech</span>

                                </a>

                                
                            </div><!-- End Logo -->
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4"> Login to Your Account</h5>

                                        <p class="text-center small">Enter your username & password to login</p>
                                    </div>
                                    <?php if ($errorOccurred && !empty($errorMsg)): ?>
            <div class="alert alert-danger mt-3 blink">
                <?php echo $errorMsg; ?>
            </div>
        <?php endif; ?>
                                   
 
                                    
                                    <!-- Update the form action to point to your PHP login code -->
                                    <form action="login.php" method="post" class="row g-3 needs-validation" novalidate>

                                        <div class="col-12">
                                            <label for="yourUsername" class="form-label">Username</label>
                                            <div class="input-group has-validation">
                                                <input type="text" name="username" class="form-control" id="yourUsername" required>
                                                <div class="invalid-feedback">Please enter your username.</div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label for="yourPassword" class="form-label">Password</label>
                                            <input type="password" name="password" class="form-control" id="yourPassword" required>
                                            <div class="invalid-feedback">Please enter your password!</div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                                                <label class="form-check-label" for="rememberMe">Remember me</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button class="btn btn-primary w-100" type="submit">Login</button>
                                        </div>
                                        <div class="col-12">
                                            <p class="small mb-0">Don't have an account? <a href="register.php">Create an account</a></p>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main><!-- End #main -->
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    <!-- Add your JS scripts here -->
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Other JS scripts here -->
</body>
