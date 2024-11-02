<?php
session_start();
include 'inc/header.php'; // Ensure the session is started

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Check if the email exists in the users table
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Check if the user is active
        if ($row["is_active"] == 1) {
            // Verify the password for the user
            if ($row["password"] === $password) { // Plain text verification (consider hashing passwords)
                // Set session variables
                $_SESSION["id"] = $row["id"];
                $_SESSION["profile_photo"] = $row["profile_photo"];
                $_SESSION["username"] = $row["username"];
                $_SESSION["ref_code"] = $row["ref_code"];
                $_SESSION["credit"] = $row["credit"];
                $_SESSION["member_level"] = $row["member_level"];
                $_SESSION["total_balance"] = $row["total_balance"];
                $_SESSION["today_commission"] = $row["today_commission"];
                $_SESSION["total_commission"] = $row["total_commission"];

                header("Location: index.php");
                exit;
            } else {
                $_SESSION['error_password'] = "Incorrect password";
                header("Location: login.php");
                exit;
            }
        } else {
            $_SESSION['error_email'] = "Your account is inactive. Please contact support.";
            header("Location: login.php");
            exit;
        }
    } else {
        // Check if the email exists in the admin_credentials table
        $stmt = $conn->prepare("SELECT * FROM admin_credentials WHERE credential_email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            // Verify the password for admin
            if ($row["password"] === $password) { 
                // Set session variables for an admin
                $_SESSION["id"] = $row["id"];
                $_SESSION["name"] = $row["name"]; 
                $_SESSION["credential_email"] = $row["credential_email"];
                $_SESSION["role"] = "admin"; // Mark as admin

                // Redirect to admin dashboard
                header("Location: admin/index.php");
                exit;
            } else {
                $_SESSION['error_password'] = "Incorrect password";
                header("Location: login.php");
                exit;
            }
        } else {
            $_SESSION['error_email'] = "Email is wrong";
            header("Location: login.php");
            exit;
        }
    }

    $stmt->close();
}
?>
