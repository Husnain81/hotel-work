<?php
// Start the session for the admin dashboard if not started

session_start();

// Clear all session variables
session_unset();

// Destroy the session
session_destroy();

// Redirect to the admin login page
header("Location: login.php");
exit;
?>