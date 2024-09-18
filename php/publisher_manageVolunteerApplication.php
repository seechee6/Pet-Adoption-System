<?php include("db_conn.php"); 
function approveRequest($conn, $id) {
    // Update the request status to "Approved"
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "UPDATE volunteerApplicationTable SET status = 'Approved' WHERE id = $id";
        if ($conn->query($sql) === TRUE) {
            // Get the petName from the approved request
            $getTitleQuery = "SELECT title FROM volunteerApplicationTable WHERE id = $id";
            $result = $conn->query($getTitleQuery);
            $row = $result->fetch_assoc();
            $title = $row['title'];
    
            // Update the pet listing status to "Adopted" in the petListingTable
                 echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Success!',
                text: 'Volunteer application approved succesfully.',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        });
      </script>";
        } else {
            
            echo "<script>
            Swal.fire({
                title: 'Error!',
                text: 'Error: " .$sql."<br>". $conn->error . "',
                icon: 'error',
                confirmButtonText: 'OK'
            });
          </script>";
        }
    } else {
        echo "<script>
        Swal.fire({
            title: 'Error!',
            text: 'Invalid request',
            icon: 'error',
            confirmButtonText: 'OK'
        });
      </script>";
    }
}



function rejectRequest($conn, $id) {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    
        // Update the request status to "Rejected" in the database
        $sql = "UPDATE volunteerApplicationTable SET status = 'Rejected' WHERE id = $id";
    
        if ($conn->query($sql) === TRUE) {
            echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Success!',
                    text: 'Volunteer application rejected succesfully.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            });
          </script>";
        } else {
            echo "<script>
            Swal.fire({
                title: 'Error!',
                text: 'Error: " .$sql."<br>". $conn->error . "',
                icon: 'error',
                confirmButtonText: 'OK'
            });
          </script>";
        }
    } else {
        echo "<script>
        Swal.fire({
            title: 'Error!',
            text: 'Invalid request',
            icon: 'error',
            confirmButtonText: 'OK'
        });
      </script>";
    }
}
$message = '';
if (isset($_GET['action']) && isset($_GET['id'])) {
    $id = $_GET['id'];
    $action = $_GET['action'];

    if ($action == 'approve') {
        $message = approveRequest($conn, $id);
    } elseif ($action == 'reject') {
        $message = rejectRequest($conn, $id);
    } else {
        $message = "<div class='alert alert-danger'>Invalid action.</div>";
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Volunteer Application</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .table-container {
            margin-top: 50px;
        }
        .table th, .table td {
            vertical-align: middle;
        }
        .btn {
            margin-right: 5px;
        }
        .icon-top-right {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 24px;
            color: grey;
        }
    </style>
</head>
<body>
<div class="container table-container">
    <h2 class="mb-4">Volunteer Applications</h2>
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Job title</th>
                    <th>Volunteer Name</th>
                    <th>Volunteer Email</th>
                    <th>Volunteer Address</th>
                    <th>Volunteer Phone</th>
                    <th>Volunteer experience</th>
                    <th>Reasons to become volunteer</th>
                    <th>Apply Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM volunteerApplicationTable";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['title'] . "</td>";
                        echo "<td>" . $row['volunteerName'] . "</td>";
                        echo "<td>" . $row['volunteerEmail'] . "</td>";
                        echo "<td>" . $row['volunteerAddress'] . "</td>";
                        echo "<td>" . $row['volunteerPhone'] . "</td>";
                        echo "<td>" . $row['experienced'] . "</td>";
                        echo "<td>" . $row['reasons'] . "</td>";
                        echo "<td>" . $row['applyDate'] . "</td>";
                        echo "<td>"; if ($row['status'] === 'Approved') {
                            echo "Approved";
                        } elseif ($row['status'] === 'Rejected') {
                            echo "Rejected";
                        } else {
                            echo "Pending";
                        }
                        echo "</td>";

                        echo "<td>";
                        if ($row['status'] === 'Approved') {
                            echo "<button class='btn btn-success btn-sm' disabled>Approved</button>";
                        } elseif ($row['status'] === 'Rejected') {
                            echo "<button class='btn btn-secondary btn-sm' disabled>Rejected</button>";
                        } else {
                            echo "<a href='?action=approve&id=" . $row['id'] . "' class='btn btn-primary btn-sm'>Approve</a>";
                            echo "<a href='?action=reject&id=" . $row['id'] .   "' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to reject this application?\")'>Reject</a>";
                        };
                           echo   "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='9' class='text-center'>No application found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<a class="icon-top-right" href="menu.php">
    <i class="fas fa-home fa-2x"></i>
            </a>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<?php $conn->close(); ?>
</body>
</html>
