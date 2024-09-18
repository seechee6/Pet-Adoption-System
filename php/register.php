<?php
session_start();

$con = mysqli_connect('localhost', 'root', '', 'myProject')
    or die('Unable to connect: ' . mysqli_connect_error());

$success = false;

if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['register_password']) && isset($_POST['role'])) {
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = password_hash($_POST['register_password'], PASSWORD_DEFAULT);
    $role = mysqli_real_escape_string($con, $_POST['role']);

    $sql = "INSERT INTO user (username, email, password, role) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "ssss", $username, $email, $password, $role);

    if (mysqli_stmt_execute($stmt)) {
        $_SESSION["Login"] = "YES";
        $_SESSION['role'] = $role;
        $_SESSION['userid'] = mysqli_insert_id($con);
        $_SESSION['username'] = $username;

     
        header("Location: ../index.html?success=1");
    } else {
        header("Location: ../index.html?error=Registration failed");
        exit();
    }
}

// Return JSON response

?>