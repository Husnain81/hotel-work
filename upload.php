<?php
session_start();

if (!isset($_SESSION['id'])) {
    die("User ID is not set in session.");
}

include $_SERVER['DOCUMENT_ROOT'].'/hotel-work/config/config.php';

// Check if a file has been uploaded
if (isset($_FILES['profileImage'])) {
    $file = $_FILES['profileImage'];

    // Check for errors
    if ($file['error'] === UPLOAD_ERR_OK) {
        // Validate file type (allow only image types)
        $fileType = mime_content_type($file['tmp_name']);
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];

        if (!in_array($fileType, $allowedTypes)) {
            echo "Invalid file type.";
            exit;
        }

        // Set the target directory
        $targetDir = "images/profile_pics/";

        // Ensure the target directory exists
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0755, true); // Create directory if it doesn't exist
        }

        // Use a unique name for the uploaded file to avoid overwriting
        $fileName = uniqid() . "_" . basename($file["name"]);
        $targetFilePath = $targetDir . $fileName;

        // Move the file to the target directory
        if (move_uploaded_file($file["tmp_name"], $targetFilePath)) {
            // Update the image path in the database
            if (isset($_SESSION["id"])) {
                $userId = $_SESSION["id"];
                
                // Prepare the SQL statement using ? placeholders for mysqli
                $sql = "UPDATE users SET profile_photo = ? WHERE id = ?";
                $stmt = $conn->prepare($sql);
                
                // Bind the parameters, "si" means string for $targetFilePath and integer for $userId
                $stmt->bind_param("si", $targetFilePath, $userId);

                // Execute and check for errors
                if ($stmt->execute()) {
                    echo "Profile photo updated successfully!";
                } else {
                    echo "Database update failed: " . $stmt->error;
                }
            } else {
                echo "User ID not found in session.";
            }
        } else {
            echo "File upload failed.";
        }
    } else {
        echo "Error during file upload: " . $file['error'];
    }
} else {
    echo "No file uploaded.";
}
?>