<?php
include("db_conn.php");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$petId = $_GET['id'];
$sql = "SELECT * FROM petListingTable WHERE id = $petId";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $petData = $result->fetch_assoc();
} else {
    echo "Pet not found.";
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $petId = $_GET['id'];
    $petName = $_POST['petName'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $species = $_POST['species'];
    $description = $_POST['description'];
    $status = $_POST['status'];
    $image = $petData['image']; 
    $target_dir = __DIR__ . "/uploads/";
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0755, true);
    }
    $upload_dir = "uploads/"; 
    $target_file = $upload_dir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if a new image file is uploaded
    if (!empty($_FILES["image"]["name"])) {
        // Check if image file is an actual image or fake image
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["image"]["size"] > 5000000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Limit file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

       
        if ($uploadOk == 1) {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], __DIR__ . "/" . $target_file)) {
                $image = $target_file;
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }

    // Update the pet listing in the database
    $sql = "UPDATE petListingTable SET petName = '$petName', age = '$age', gender = '$gender', species = '$species', description = '$description', status = '$status', image = '$image' WHERE id = $petId";
    if ($conn->query($sql) === TRUE) {
        echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: 'Success!',
                        text: 'Pet entry updated successfully.',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = 'admin_managePetListing.php';
                        }
                    });
                });
              </script>";
    } else {
        echo "<script>
                Swal.fire({
                    title: 'Error!',
                    text: 'Error updating record: " . $conn->error . "',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
              </script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Pet</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
 
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="container">
        <h1 class="my-4">Edit Pet</h1>

        <!-- Form to edit the pet entry -->
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $petId; ?>" class="mb-4" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="petName" class="form-label">Pet Name:</label>
                <input type="text" id="petName" name="petName" class="form-control" value="<?php echo $petData['petName']; ?>" required>
            </div>

            <div class="mb-3">
                <label for="age" class="form-label">Age:</label>
                <input type="text" id="age" name="age" class="form-control" value="<?php echo $petData['age']; ?>" required>
            </div>

            <div class="mb-3">
                <label for="gender" class="form-label">Gender:</label>
                <input type="text" id="gender" name="gender" class="form-control" value="<?php echo $petData['gender']; ?>" required>
            </div>

            <div class="mb-3">
                <label for="species" class="form-label">Species:</label>
                <input type="text" id="species" name="species" class="form-control" value="<?php echo $petData['species']; ?>" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description:</label>
                <textarea id="description" name="description" class="form-control" required><?php echo $petData['description']; ?></textarea>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status:</label>
                <input type="text" id="status" name="status" class="form-control" value="<?php echo $petData['status']; ?>" required>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Image:</label>
                <input type="file" id="image" name="image" class="form-control">
                <small class="form-text text-muted">Leave this field blank to keep the existing image.</small>
                <img src="<?php echo $petData['image']; ?>" alt="Current Image" class="img-thumbnail mt-2" width="200">
            </div>

            <input type="submit" value="Update Pet" class="btn btn-primary">
        </form>
    </div>

    <?php
 
    $conn->close();
    ?>
</body>
</html>