<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adoption Request Status</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .main {
            padding: 20px;
        }

        .head_1 {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        .view-status-btn {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 8px 16px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            cursor: pointer;
        }

        .view-status-btn:hover {
            background-color: #0056b3;
        }
        .nav-icon {
            position: absolute;
            top: 20px;
            right: 20px;
            color: grey;
        }
    </style>
</head>
<body>
    <div class="container main">
    <a href="menu.php" class="nav-icon">
                <i class="fas fa-home fa-2x"></i>
            </a>
        <div class="head">
            <p class="head_1">Adoption Request <span>Status</span></p>
        </div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Pet Name</th>
                    <th>Pet Image</th>
                    <th>View Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                
                include("db_conn.php");
      
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                $sql = "SELECT petListingTable.petName, petListingTable.image, adoptionRequestTable.status
                        FROM adoptionRequestTable
                        JOIN petListingTable ON adoptionRequestTable.petName = petListingTable.petName";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['petName'] . "</td>";
                        echo "<td><img src='" . $row['image'] . "' width='100' class='img-thumbnail'></td>";
                        echo "<td><button class='view-status-btn' data-toggle='modal' data-target='#statusModal' data-status='" . $row['status'] . "'>View Status</button></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>No adoption requests found.</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="statusModal" tabindex="-1" aria-labelledby="statusModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="statusModalLabel">Adoption Request Status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="statusMessage">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $('#statusModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var status = button.data('status');

            var statusMessage = document.getElementById("statusMessage");

            if (status === "Approved") {
                statusMessage.innerHTML = "Your adoption request has been approved!";
            } else if (status === "Rejected") {
                statusMessage.innerHTML = "Your adoption request has been rejected.";
            } else {
                statusMessage.innerHTML = "Your adoption request is currently " + status.toLowerCase() + ".";
            }
        });
    </script>
</body>
</html>
