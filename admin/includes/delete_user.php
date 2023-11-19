<?php
include 'config.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    if (isset($_POST['userId'])) {
        
        $userId = $_POST['userId'];
        
        $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
        $stmt->bind_param("i", $userId); 

        
        if ($stmt->execute()) {
            echo 'User deleted successfully';
        } else {
            echo 'Error deleting user: ' . $stmt->error;
        }

        
        $stmt->close();
    } else {
        echo 'User ID not provided';
    }
} else {
    echo 'Invalid request method';
}


$conn->close();
?>
