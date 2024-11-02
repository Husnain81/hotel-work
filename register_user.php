<?php
include 'inc/header.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $number = $_POST["number"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];
    $invited_code = $_POST["invited_code"]; // Referral code from the form input
    $credit = 1;
    $member_level = "VIP1";

    // Check if the user already exists in the database by email or phone number
    $checkQuery = "SELECT * FROM users WHERE email = '$email' OR number = '$number'";
    $checkResult = $conn->query($checkQuery);

    if ($checkResult->num_rows > 0) {
        // If the user exists, set session variable for alert and redirect back to register page
        $_SESSION['already_account'] = "You already have an account!";
        header("Location: register.php"); // Redirect to register page
        exit;
    } else {
        // Generate a random 8-digit referral code for the new user
        $ref_code = mt_rand(10000000, 99999999);

        // Insert new user data into the database
        $query = "INSERT INTO users (username, number, email, password, confirm_password, ref_code, invited_code, credit, member_level) 
                  VALUES ('$username', '$number', '$email', '$password', '$confirm_password', '$ref_code', '$invited_code', $credit, $member_level)";

        $result = $conn->query($query);

        if ($result) {
            // Registration successful, redirect to login page
            header("Location: index.php");
            exit;
        } else {
            $error = "Registration failed";
        }
    }
}
?>
