<?php
include("db_conn.php");
function approveRequest($conn, $id) {
    // Update the request status to "Approved"
    $sql = "UPDATE adoptionRequestTable SET status = 'Approved' WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        $getPetNameQuery = "SELECT petName FROM adoptionRequestTable WHERE id = $id";
        $result = $conn->query($getPetNameQuery);
        $row = $result->fetch_assoc();
        $petName = $row['petName'];

        // Update the pet listing status to "Adopted"
        $updatePetListingQuery = "UPDATE petListingTable SET status = 'Adopted' WHERE petName = '$petName'";
        if ($conn->query($updatePetListingQuery) === TRUE) {
            echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Success!',
                text: 'Adoption request approved successfully. {$petName} is successfully adopted.',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        });
      </script>";
        } else {
            return "<div class='alert alert-danger'>Error updating pet listing status: " . $conn->error . "</div>";
        }
    } else {
        return "<div class='alert alert-danger'>Error: " . $sql . "<br>" . $conn->error . "</div>";
    }
}
function rejectRequest($conn, $id) {
    $sql = "UPDATE adoptionRequestTable SET status = 'Rejected' WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        $getPetNameQuery = "SELECT petName FROM adoptionRequestTable WHERE id = $id";
        $result = $conn->query($getPetNameQuery);
        $row = $result->fetch_assoc();
        $petName = $row['petName'];
        $updatePetListingQuery = "UPDATE petListingTable SET status = 'Available' WHERE petName = '$petName'";
        if ($conn->query($updatePetListingQuery) === TRUE) {
            echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Success!',
                text: 'Adoption request rejected successfully. {$petName} is available.',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        });
      </script>";
        } else {
            return "<div class='alert alert-danger'>Error updating pet listing status: " . $conn->error . "</div>";
        }
    } else {
        return "<div class='alert alert-danger'>Error: " . $sql . "<br>" . $conn->error . "</div>";
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
    <title>Adoption Request</title>
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
    <h2 class="mb-4">Adoption Request</h2>
    <?php echo $message; ?>
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Pet Name</th>
                    <th>Adopter Name</th>
                    <th>Adopter Email</th>
                    <th>Adopter Address</th>
                    <th>Adopter Phone</th>
                    <th>Adopted Pets Before</th>
                    <th>Reasons to adopt</th>
                    <th>Request Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM adoptionRequestTable";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['petName'] . "</td>";
                        echo "<td>" . $row['adopterName'] . "</td>";
                        echo "<td>" . $row['adopterEmail'] . "</td>";
                        echo "<td>" . $row['adopterAddress'] . "</td>";
                        echo "<td>" . $row['adopterPhone'] . "</td>";
                        echo "<td>" . $row['ownedPetsBefore'] . "</td>";
                        echo "<td>" . $row['reasons'] . "</td>";
                        echo "<td>" . $row['requestDate'] . "</td>";
                        echo "<td>" . ($row['status'] === 'Approved' ? 'Approved' : ($row['status'] === 'Rejected' ? 'Rejected' : 'Pending')) . "</td>";
                        echo "<td>";
                        if ($row['status'] === 'Approved') {
                            echo "<button class='btn btn-success btn-sm' disabled>Approved</button>";
                        } elseif ($row['status'] === 'Rejected') {
                            echo "<button class='btn btn-secondary btn-sm' disabled>Rejected</button>";
                        } else {
                            echo "<a href='?action=approve&id=" . $row['id'] . "' class='btn btn-primary btn-sm'>Approve</a>";
                            echo "<a href='?action=reject&id=" . $row['id'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to reject this request?\")'>Reject</a>";
                        }
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='10' class='text-center'>No adoption requests.</td></tr>";
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
</body>
</html>

<?php $conn->close(); ?>
