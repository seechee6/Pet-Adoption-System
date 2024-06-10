<?php  
session_start();

// Unset session when logout
session_unset();

//Destroy session when logout
session_destroy();

// After session is destroyed, redirect to public.html
header("Location: public.html");
?>