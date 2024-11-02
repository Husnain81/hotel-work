<?php
include 'inc/header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $password = ($_POST['password']); // Encrypt the password

    // Insert the data into the database
    $sql = "INSERT INTO admin_credentials (name, credential_email, role, password) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ssss", $name, $email, $role, $password);
        
        if ($stmt->execute()) {
            // Redirect to index.php with a success message in the session

            $_SESSION['message'] = "Agent added successfully!";
            header("Location: index.php");
            exit(); // Prevent further code execution after redirection
        } else {
            echo "<script>alert('Error: " . $stmt->error . "');</script>";
        }
        
        $stmt->close();
    } else {
        echo "<script>alert('Error: " . $conn->error . "');</script>";
    }

    $conn->close();
} else {
    echo "<script>alert('Invalid request.');</script>";
}
?>
