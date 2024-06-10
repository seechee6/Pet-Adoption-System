<?php 
   session_start();
   //Check your session with isset function. If null/false, stay on login page. If true, redirect to home.php
   if(!isset($_SESSION['username']) && !isset($_SESSION['id'])) {
      ?>

<!DOCTYPE html>

<html>

<head>
    <title>Login Page</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">

</head>

<body>
    <div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh;">
        <!--Left side-->
        <div class="row background align-items-center justify-content-between" style="flex-wrap: nowrap;">
            <div class="welcome-section col-lg-5 col-md-12 text-center p-3 m-auto">
                <h1 style="font-weight: 800; padding-bottom: 20px;">Pet Adoption System</h1>
                <img src="../img/kitten.png" style="width: 25%; padding-bottom: 25px;">
                <h1 style="font-weight: 500;">Welcome</h1>
                <p style="padding-top: 45px;">New User? <a href="#"><br>REGISTER HERE</a></p>
            </div>

            <!--Right side-->
            <div class="login-section col-lg-6 col-md-12 p-3">
                <form class=" form border shadow p-3 rounded" action="check-login.php" method="post"
                    style="width: 450px; height: 80vh; background-color: pink;">
                    <h1 class="text-center p-3">LOGIN</h1>
                    <?php if (isset($_GET['error'])) { ?>
                    <div class="alert alert-danger" role="alert">
                        <?=$_GET['error']?>
                    </div>
                <?php } ?>

                    <div class="mb-3">
                        <label for="username" class="form-label">User name</label>
                        <input type="text" class="form-control" name="username" id="username">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="password">
                    </div>
                    <div class="mb-1">
                        <label class="form-label">Select User Type:</label>
                    </div>
                    <select class="form-select mb-3" name="role" aria-label="Default select example">
                        <option selected value="adopter">Adopter</option>
                        <option value="shelters">Shelter</option>
                        <option value="admin">Admin</option>
                        <option value="volunteer">Volunteer</option>
                    </select>

                    <button type="submit" class="btn btn-primary " style="align-items:center !important">LOGIN</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>

<?php }else{
	header("Location: home.php");
}