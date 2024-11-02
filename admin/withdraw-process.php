<?php
include 'inc/header.php';  // Include database connection

// Check if form data is submitted
if (isset($_POST['id'], $_POST['status'], $_POST['withdrawal_amount'], $_POST['user_id'])) {
    $withdrawalId = $_POST['id'];
    $status = $_POST['status'];
    $withdrawalAmount = $_POST['withdrawal_amount'];
    $userId = $_POST['user_id'];

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    try {
        // Begin transaction
        $conn->begin_transaction();

        // Update the withdrawal status in the withdrawals table
        $updateWithdrawal = $conn->prepare("UPDATE withdrawals SET withdrawal_status = ? WHERE id = ?");
        $updateWithdrawal->bind_param("si", $status, $withdrawalId);
        $updateWithdrawal->execute();

        // Deduct the amount from the user's total balance only if the status is "Completed"
        if ($status === 'Approved') {
            $updateUserBalance = $conn->prepare("UPDATE users SET total_balance = total_balance - ? WHERE id = ?");
            $updateUserBalance->bind_param("di", $withdrawalAmount, $userId);
            $updateUserBalance->execute();
        }

        // Commit transaction
        $conn->commit();

        // Show success alert
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'Withdrawal status and balance updated successfully.',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'withdraw-list.php';
                }
            });
        </script>";
    } catch (Exception $e) {
        $conn->rollback();
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '" . $e->getMessage() . "',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'withdraw-list.php';
                }
            });
        </script>";
    }

    // Close the prepared statements and the database connection
    $updateWithdrawal->close();
    if (isset($updateUserBalance)) {
        $updateUserBalance->close();
    }
    $conn->close();
} else {
    // If data is invalid, show a warning alert
    echo "<script>
        Swal.fire({
            icon: 'warning',
            title: 'Warning',
            text: 'Invalid data provided.',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'withdraw-list.php';
            }
        });
    </script>";
}

?>
