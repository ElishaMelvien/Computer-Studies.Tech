<?php
include 'config.php';

// Fetch users from the database
$sql = "SELECT * FROM users";
$result = $conn->query($sql);

// Check if there are any rows in the result
if ($result->num_rows > 0) {
    echo '<!DOCTYPE html>
    <html lang="en">
    <head>
        
        
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        
        <!-- DataTables CSS -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    </head>
    <body>';

    echo '<div class="pagetitle">';
    echo '<h1>ComputerStudies.Tech</h1>';
    echo '</div>';

    echo '<section class="section">';
    echo '<div class="container">';
    
    // Output DataTable template
    echo '<table class="table datatable" id="usersTable">';
    echo '<thead style="background-color: white;">';
    echo '<tr>';
    echo '<th scope="col">Id</th>';
    echo '<th scope="col">Username</th>';
    echo '<th scope="col">Email</th>';
    echo '<th scope="col">Role</th>';
    echo '<th scope="col">Actions</th>'; 
    echo '</tr>';
    echo '</thead>';
    
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . htmlspecialchars($row['id']) . '</td>';
        echo '<td>' . htmlspecialchars($row['username']) . '</td>';
        echo '<td>' . htmlspecialchars($row['email']) . '</td>';
        echo '<td>' . htmlspecialchars($row['role']) . '</td>';
        echo '<td>';
        echo '<button class="btn btn-primary btn-sm editBtn" data-id="' . htmlspecialchars($row['id']) . '">Edit</button>';
        echo '<span class="ml-2"></span>';
        echo '<button class="btn btn-danger btn-sm delete-btn" data-userid="' . htmlspecialchars($row['id']) . '">Delete</button>';
        echo '</td>';
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
    
    // Edit Modal
    echo '<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit User Form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editForm" action="update_user.php" method="post">
                        <div class="form-group">
                            <label for="inputUsername">Username:</label>
                            <input type="text" class="form-control" id="inputUsername" name="username">
                        </div>
                        <div class="form-group">
                            <label for="inputEmail">Email:</label>
                            <input type="email" class="form-control" id="inputEmail" name="email">
                        </div>
                        <div class="form-group">
                            <label for="inputPassword">Password:</label>
                            <input type="password" class="form-control" id="inputPassword" name="password">
                        </div>
                        <input type="hidden" name="id" id="inputId">
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>';

    echo '</div>';
    echo '</section>';

    // JavaScript
    echo '<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>';
    echo '<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>';
    echo '<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>';
    echo '<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>';
    
    echo '<script>
        $(document).ready(function () {
            var table = $("#usersTable").DataTable();

            // Handle edit button click
            $("#usersTable").on("click", ".editBtn", function () {
                var id = $(this).data("id");
                var data = table.row($(this).closest("tr")).data();

                // Populate the edit modal with the selected user data
                $("#inputUsername").val(data[1]);
                $("#inputEmail").val(data[2]);
                $("#inputId").val(id);

                // Show the edit modal
                $("#editModal").modal("show");
            });

            // Handle form submission using AJAX
            $("#editForm").submit(function (e) {
                e.preventDefault();

                // Prepare form data
                var formData = {
                    username: $("#inputUsername").val(),
                    email: $("#inputEmail").val(),
                    password: $("#inputPassword").val(),
                    id: $("#inputId").val(),
                };

                // Perform AJAX form submission
                $.ajax({
                    type: "POST",
                    url: "update_user.php",
                    data: formData,
                    success: function (response) {
                        // Close the modal
                        $("#editModal").modal("hide");

                        // Show the update message here (you can customize this part based on your needs)
                        alert(response);
                    },
                    error: function (error) {
                        // Handle errors if needed
                        console.log("Error:", error);
                    },
                });
            });
        });
    </script>';

    echo '</body>
    </html>';
} else {
    echo 'No users found.';
}

$conn->close();
?>
