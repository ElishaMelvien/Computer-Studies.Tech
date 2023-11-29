<?php
include 'config.php';

// Fetch users from the database
$sql = "SELECT * FROM users";
$result = $conn->query($sql);

// Check if there are any rows in the result
if ($result->num_rows > 0) {
    
    echo '<div class="pagetitle">';
    echo '<h1>ComputerStudies.Tech</h1>';
    echo '</div>';

    echo '<section class="section">';
    echo '<div class="row">';
    echo '<div class="col-lg-12">';
    echo '<div class="card">';
    echo '<div class="card-body">';
    echo '<h5 class="card-title">Users</h5>';
    echo '<p></p>';

    // Output DataTable template
    echo '<table class="table datatable" id="usersTable">';
    echo '<thead class="thead-dark" style="background: linear-gradient(to bottom, #1a1a1a, #000000); color: #fff;">';
    echo '<tr>';
    echo '<th scope="col">Id</th>';
    echo '<th scope="col">Username</th>';
    echo '<th scope="col">Email</th>';
    echo '<th scope="col">Role</th>';
    echo '<th scope="col">Actions</th>'; 
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';
  

    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row['id'] . '</td>';
        echo '<td>' . $row['username'] . '</td>';
        echo '<td>' . $row['email'] . '</td>';
        echo '<td>' . $row['role'] . '</td>';
        echo '<td>';
        echo '<a href="edit.php?id=' . $row['id'] . '" class="btn btn-info btn-sm mr-2 edit-btn text-white">Edit</a>';
        echo '<button class="btn btn-danger btn-sm delete-btn" data-userid="' . $row['id'] . '">Delete</button>';
        echo '</td>';
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
    
    // Close the card-body, card, and col-lg-12 divs
    echo '</div></div></div>';

    // Close the row and section divs
    echo '</div></section>';
} else {
    echo 'No users found.';
}

$conn->close();
?>
