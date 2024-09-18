<?php
include("db_conn.php");


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission for adding a new pet
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $petName = $_POST['petName'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $species = $_POST['species'];
    $description = $_POST['description'];
    $status = $_POST['status'];


    $target_dir = __DIR__ . "/uploads/";
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0755, true);
    }
    $upload_dir = "uploads/"; 
    $target_file = $upload_dir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

   
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                <strong>Error!</strong> File is not an image.
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
              </div>";
        $uploadOk = 0;
    }


    if (file_exists($target_file)) {
        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                <strong>Error!</strong> Sorry, file already exists.
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
              </div>";
        $uploadOk = 0;
    }

    if ($_FILES["image"]["size"] > 5000000) {
        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                <strong>Error!</strong> Sorry, your file is too large.
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
              </div>";
        $uploadOk = 0;
    }


    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                <strong>Error!</strong> Sorry, only JPG, JPEG, PNG & GIF files are allowed.
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
              </div>";
        $uploadOk = 0;
    }


    if ($uploadOk == 0) {
        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                <strong>Error!</strong> Sorry, your file was not uploaded.
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
              </div>";
    } else {
    
        if (move_uploaded_file($_FILES["image"]["tmp_name"], __DIR__ . "/" . $target_file)) {
            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                    <strong>Success!</strong> The file " . basename($_FILES["image"]["name"]) . " has been uploaded.
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                  </div>";

            // Insert the new pet entry into the database
            $sql = "INSERT INTO petListingTable (petName, age, gender, species, description, status, image) VALUES ('$petName', '$age', '$gender', '$species', '$description', '$status', '$target_file')";
            if ($conn->query($sql) === TRUE) {
                echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: 'Success!',
                        text: 'Pet entry added successfully.',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
                });
              </script>";
            } 
        } else {
            echo "<script>
                Swal.fire({
                    title: 'Error!',
                    text: 'Error adding new pet record: " . $conn->error . "',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
              </script>";
        }
    }
}

// Handle pet entry deletion
if (isset($_GET['delete'])) {
    $petId = $_GET['delete'];

    // Delete the pet entry from the database
    $sql = "DELETE FROM petListingTable WHERE id = $petId";
    if ($conn->query($sql) === TRUE) {
        echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Success!',
                text: 'Pet entry deleted successfully.',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        });
      </script>";
    } else {
        echo "<script>
        Swal.fire({
            title: 'Error!',
            text: 'Error delete pet record: " . $conn->error . "',
            icon: 'error',
            confirmButtonText: 'OK'
        });
      </script>";
    }
}

// Handle pet entry edit
if (isset($_GET['edit'])) {
    $petId = $_GET['edit'];
    header("Location:admin_editPetListing.php?id=$petId");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin - Pet Listing</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
       .nav-icon {
            position: absolute;
            top: 20px;
            right: 20px;
            color: grey;
        }
    </style>
</head>
<body>
    <div class="container">
   
   <!-- Navigation Icon -->
   <a href="menu.php" class="nav-icon">
            <i class="fas fa-home fa-2x"></i>
        </a>
        <!-- Form to add a new pet entry -->
        <h2>Add New Pet</h2>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" class="mb-4" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="petName" class="form-label">Pet Name:</label>
                <input type="text" id="petName" name="petName" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="age" class="form-label">Age:</label>
                <input type="text" id="age" name="age" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="gender" class="form-label">Gender:</label>
                <input type="text" id="gender" name="gender" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="species" class="form-label">Species:</label>
                <input type="text" id="species" name="species" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description:</label>
                <textarea id="description" name="description" class="form-control" required></textarea>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status:</label>
                <input type="text" id="status" name="status" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Image:</label>
                <input type="file" id="image" name="image" class="form-control" required>
            </div>

            <input type="submit" value="Add Pet" class="btn btn-primary">
        </form>

        <!-- Table to display existing pet entries -->
        <h2>Pet Listing</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Pet Name</th>
                    <th>Age</th>
                    <th>Gender</th>
                    <th>Species</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Retrieve the pet data from the database
                $sql = "SELECT * FROM petListingTable";
                $result = $conn->query($sql);

                // Loop through the result set and display each pet entry
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['petName'] . "</td>";
                        echo "<td>" . $row['age'] . "</td>";
                        echo "<td>" . $row['gender'] . "</td>";
                        echo "<td>" . $row['species'] . "</td>";
                        echo "<td>" . $row['description'] . "</td>";
                        echo "<td>" . $row['status'] . "</td>";
                        echo "<td><img src='" . $row['image'] . "' width='100' class='img-thumbnail'></td>";
                        echo "<td>
                                <a href='?edit=" . $row['id'] . "' class='btn btn-primary btn-sm me-2'>Edit</a>
                                <a href='?delete=" . $row['id'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this pet entry?\")'>Delete</a>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='8' class='text-center'>No pet entries found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <?php
    $conn->close();
    ?>
</body>
</html>