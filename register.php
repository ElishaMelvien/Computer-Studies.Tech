<?php
session_start();
$host = "localhost";
$username = "root";
$password = "";
$database = "computerstudies";

// Connection to the database
$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Sanitize and retrieve the submitted username, email, and password
    $username = $conn->real_escape_string($_POST["username"]);
    $email = $conn->real_escape_string($_POST["email"]);
    $password = $conn->real_escape_string($_POST["password"]);
    


    // Hash the password before storing it in the database
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // check if the username already exists
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Username already exists
        $error = "Username is already taken.";
    } else {
        // Insert the new user into the database
        $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";
        if ($conn->query($sql) === TRUE) {
            // Successful registration
            $_SESSION["message"] = "Registration successful. You can now log in.";
            header("Location: login.php"); // Replace "login.php" with your login page
            exit;
        } else {
            // Error inserting the user into the database
            $error = "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Register </title>
</head>

<body>
    <?php if (isset($error)) : ?>
        <p><?php echo $error; ?></p>
    <?php endif; ?>
    <form action="register.php" method="post">
        
    </form>
</body>

</html>
