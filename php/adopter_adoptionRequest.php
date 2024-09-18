<?php
include("db_conn.php");

if ($conn->connect_error) {
    die(json_encode(["status" => "error", "message" => "Connection failed: " . $conn->connect_error]));
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize input data
    $petName = $conn->real_escape_string($_POST['petName']);
    $adopterName = $conn->real_escape_string($_POST['adopterName']);
    $adopterEmail = $conn->real_escape_string($_POST['adopterEmail']);
    $adopterPhone = $conn->real_escape_string($_POST['adopterPhone']);
    $adopterAddress = $conn->real_escape_string($_POST['adopterAddress']);
    $ownedPetsBefore = $conn->real_escape_string($_POST['ownedPetsBefore']);
    $reasons = $conn->real_escape_string($_POST['reasons']);

    if ($ownedPetsBefore !== 'yes' && $ownedPetsBefore !== 'no') {
        echo json_encode(["status" => "error", "message" => "Invalid value for owned pets before."]);
        exit;
    }

    $sql = "INSERT INTO adoptionRequestTable (petName, adopterName, adopterEmail, adopterPhone, adopterAddress, ownedPetsBefore, reasons) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssss", $petName, $adopterName, $adopterEmail, $adopterPhone, $adopterAddress, $ownedPetsBefore, $reasons);

    // Execute the statement
    if ($stmt->execute()) {
        // Update the pet listing status to "Pending"
        $updateSQL = "UPDATE petListingTable SET status = 'Pending' WHERE petName = '$petName'";
        if ($conn->query($updateSQL) === TRUE) {
            echo json_encode(["status" => "success", "message" => "Adoption request submitted successfully!"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Error updating pet listing status: " . $conn->error]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Error: " . $stmt->error]);
    }
    $stmt->close();
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request method."]);
}


$conn->close();
?>