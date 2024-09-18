<!DOCTYPE html>
<html>
<head>
    <title>Menu</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
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
        <h1 class="my-4">Menu</h1>
        <h2>Admin</h2>

        <div class="list-group">
            <a href="admin_managePetListing.php" class="list-group-item list-group-item-action">Manage Pet Listings</a>
            <a href="admin_manageVolunteerJob.php" class="list-group-item list-group-item-action">Manage Volunteer Jobs</a>
            <a href="#" class="list-group-item list-group-item-action disabled">Another Section (Coming Soon)</a>
        </div>
    </div>



    <div class="container">
       <br>
        <h2>Adopter</h2>
    
        <div class="list-group">
        <a href="../public.html" class="list-group-item list-group-item-action">Home Page</a>
            <a href="adopter_viewPetListing.php" class="list-group-item list-group-item-action">View Pet Listings</a>
            <a href="adopter_viewRequestStatus.php" class="list-group-item list-group-item-action">Check adoption request status</a>
            <a href="adopter_viewVolunteerJob.php" class="list-group-item list-group-item-action">View Volunteer Jobs</a>
            <a href="adopter_viewApplicationStatus.php" class="list-group-item list-group-item-action">Check volunteer application status</a>
            <a href="#" class="list-group-item list-group-item-action disabled">Another Section (Coming Soon)</a>
        </div>
    </div>

    <div class="container">
<br>
        <h2>Publisher</h2>
    
        <div class="list-group">
          
        <a href="publisher_addPetListing.php" class="list-group-item list-group-item-action">Post pet listing</a>
            <a href="publisher_managePetListing.php" class="list-group-item list-group-item-action">Manage pet listing</a>
            <a href="publisher_manageAdoptionRequest.php" class="list-group-item list-group-item-action">Manage adoption requests</a>
            <a href="publisher_addVolunteerJob.php" class="list-group-item list-group-item-action">Post volunteer job</a>
            <a href="publisher_manageVolunteerJob.php" class="list-group-item list-group-item-action">Manage volunteer job</a>
            <a href="publisher_manageVolunteerApplication.php" class="list-group-item list-group-item-action">Manage volunteer applications</a>
            <a href="#" class="list-group-item list-group-item-action disabled">Another Section (Coming Soon)</a>
        </div>
    </div>
</body>
</html>
