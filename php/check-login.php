<?php
session_start();

$con = mysqli_connect('localhost', 'root', '', 'myProject')
    or die('Unable to connect: ' . mysqli_connect_error());

if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['role'])) {
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = $_POST['password'];
    $role = mysqli_real_escape_string($con, $_POST['role']);

    $sql = "SELECT * FROM user WHERE username = ? AND role = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $username, $role);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        if (password_verify($password, $row['password'])) {
            $_SESSION["Login"] = "YES";
            $_SESSION['role'] = $role;
            $_SESSION['userid'] = $row['id'];
            $_SESSION['username'] = $username;

            switch ($role) {
                case "adopter":
                    header("Location: ../public.html");
                    break;
                case "shelter":
                    header("Location: ../publisher-main.html");
                    break;
                case "admin":
                    header("Location: menu.php");
                    break;
                case "volunteer":
                    header("Location: ../volunteer-main.html");
                    break;
                default:
                    header("Location: login.html");
            }
            exit();
        }
        else {
            // Invalid password
            header("Location: ../index.html?error=1");
            exit();
        }
    } else {
        // Invalid username or role
        header("Location: ../index.html?error=1");
        exit();
    }
    }

    $_SESSION["Login"] = "NO";
    header("Location: index.html");
    exit();

?>