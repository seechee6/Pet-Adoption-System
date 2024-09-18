<?php
include("db_conn.php");


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve the volunteer job ID from the URL parameter
$id = $_GET['id'];

// Retrieve the volunteer job data from the database
$sql = "SELECT * FROM volunteerTable WHERE id = $id";
$result = $conn->query($sql);

// Check if the job exists
if ($result->num_rows > 0) {
    $volunteerData = $result->fetch_assoc();
} else {
    echo "Job not found.";
    exit;
}

// Handle form submission for updating the job listing
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $requirements = $_POST['requirements'];
    $description = $_POST['description'];
    $date= $_POST['date'];

    // Handle image upload
    $image = $volunteerData['image'];
    $target_dir = __DIR__ . "/uploads/";
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0755, true);
    }
    $upload_dir = "uploads/"; 
    $target_file = $upload_dir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));


    if (!empty($_FILES["image"]["name"])) {
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

        if ($_FILES["image"]["size"] > 5000000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

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

    // Update the volunteer job in the database
    $sql = "UPDATE volunteerTable SET title = '$title', description = '$description', requirements = '$requirements', date= '$date',image = '$image' WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: 'Success!',
                        text: 'Job updated successfully.',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = 'admin_manageVolunteerJob.php';
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
    <title>Edit job</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
 
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="container">
        <h1 class="my-4">Edit Job</h1>

        <!-- Form to edit the volunteer job -->
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $id; ?>" class="mb-4" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" id="title" name="title" class="form-control" value="<?php echo $volunteerData['title']; ?>" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description:</label>
                <input type="text" id="description" name="description" class="form-control" value="<?php echo $volunteerData['description']; ?>" required>
            </div>

            <div class="mb-3">
                <label for="requirements" class="form-label">Requirements:</label>
                <input type="text" id="requirements" name="requirements" class="form-control" value="<?php echo $volunteerData['requirements']; ?>" required>
            </div>

            <div class="mb-3">
                <label for="date" class="form-label">Date:</label>
                <input type="date" id="date" name="date" class="form-control" value="<?php echo $volunteerData['date']; ?>" required>
            </div>

        
            <div class="mb-3">
                <label for="image" class="form-label">Image:</label>
                <input type="file" id="image" name="image" class="form-control">
                <small class="form-text text-muted">Leave this field blank to keep the existing image.</small>
                <img src="<?php echo $volunteerData['image']; ?>" alt="Current Image" class="img-thumbnail mt-2" width="200">
            </div>

            <input type="submit" value="Update Job" class="btn btn-primary">
        </form>
    </div>

    <?php
    $conn->close();
    ?>
</body>
</html>