<?php
session_start();

include $_SERVER['DOCUMENT_ROOT'].'/hotel-work/config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'];
    $recharge_amount = $_POST['recharge_amount'];
    $transaction_id = $_POST['transaction_id'];
    $receiver_name = $_POST['receiver_name'];
    $sender_name = $_POST['sender_name'];
    $target_dir = "admin/assets/images/screenshots/";

    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    // Check if the screenshot file is uploaded
    if (isset($_FILES['screenshot']) && $_FILES['screenshot']['error'] === UPLOAD_ERR_OK) {
        $screenshot_file = $_FILES['screenshot'];
        $target_file = $target_dir . basename($screenshot_file['name']);
        $upload_ok = true;

        // Check if file is an actual image
        $check = getimagesize($screenshot_file['tmp_name']);
        if ($check === false) {
            echo "File is not an image.";
            $upload_ok = false;
        }

        if ($upload_ok && move_uploaded_file($screenshot_file['tmp_name'], $target_file)) {
            $sql = "INSERT INTO recharges (user_id, recharge_amount, transaction_id, receiver_name, sender_name, screenshot, status) VALUES (?, ?, ?, ?, ?, ?, ?)";

            if ($stmt = $conn->prepare($sql)) {
                $status = 'pending';
                $stmt->bind_param("iisssss", $user_id, $recharge_amount, $transaction_id, $receiver_name, $sender_name, $target_file, $status);

                if ($stmt->execute()) {

                    header("Location: top-up-balance.php");
                    exit();

                } else {
                    echo "Error: " . $stmt->error;
                }

                $stmt->close();
            }
        } else {
            echo "There was an error uploading your screenshot.";
        }
    } else {
        // Debugging information for troubleshooting
        echo "Upload error: ";
        if (isset($_FILES['screenshot']['error'])) {
            switch ($_FILES['screenshot']['error']) {
                case UPLOAD_ERR_INI_SIZE:
                    echo "The uploaded file exceeds the upload_max_filesize directive in php.ini.";
                    break;
                case UPLOAD_ERR_FORM_SIZE:
                    echo "The uploaded file exceeds the MAX_FILE_SIZE directive specified in the HTML form.";
                    break;
                case UPLOAD_ERR_PARTIAL:
                    echo "The uploaded file was only partially uploaded.";
                    break;
                case UPLOAD_ERR_NO_FILE:
                    echo "No file was uploaded.";
                    break;
                default:
                    echo "Unknown error occurred.";
            }
        } else {
            echo "File array not set.";
        }
    }

    $conn->close();
}
?>