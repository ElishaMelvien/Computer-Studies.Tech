<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Assuming you have a function to sanitize and validate input data
    function sanitize_input($data) {
        // Implement your sanitization logic here
        // For example, you might use mysqli_real_escape_string or htmlspecialchars
        return $data;
    }

    $username = sanitize_input($_POST['username']);
    $email = sanitize_input($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password

    $id = $_POST['id'];

    // Update user in the database
    $sql = "UPDATE users SET username='$username', email='$email', password='$password' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "User updated successfully";
    } else {
        echo "Error updating user: " . $conn->error;
    }

    $conn->close();
} else {
    // Redirect or handle other cases if needed
}
?>
