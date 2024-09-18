<?php
include("db_conn.php");


if ($conn->connect_error) {
    die(json_encode(["status" => "error", "message" => "Connection failed: " . $conn->connect_error]));
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
    $title = $conn->real_escape_string($_POST['title']);
    $volunteerName = $conn->real_escape_string($_POST['volunteerName']);
    $volunteerEmail = $conn->real_escape_string($_POST['volunteerEmail']);
    $volunteerPhone = $conn->real_escape_string($_POST['volunteerPhone']);
    $volunteerAddress = $conn->real_escape_string($_POST['volunteerAddress']);
    $experienced= $conn->real_escape_string($_POST['experienced']);
    $reasons = $conn->real_escape_string($_POST['reasons']);

    if ($experienced!== 'yes' && $experienced !== 'no') {
        echo json_encode(["status" => "error", "message" => "Invalid value for volunteer experience."]);
        exit;
    }

    $sql = "INSERT INTO volunteerApplicationTable(title, volunteerName, volunteerEmail,volunteerPhone, volunteerAddress, experienced, reasons) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssss", $title, $volunteerName, $volunteerEmail, $volunteerPhone, $volunteerAddress, $experienced, $reasons);

    // Execute the statement
    if ($stmt->execute()) {
        $updateSQL = "UPDATE volunteerApplicationTable SET status = 'Pending' WHERE title = '$title'";
        if ($conn->query($updateSQL) === TRUE) {
            echo json_encode(["status" => "success", "message" => "Application submitted succesfully."]);
        } else {
            echo json_encode(["status" => "error", "message" => "Error updating pet listing status: " . $conn->error]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Error: " . $stmt->error]);
    }

    // Close statement
    $stmt->close();
} else {
    echo json_encode(["status" => "error", "message" => "Invalid submit method."]);
}

// Close connection
$conn->close();
?>