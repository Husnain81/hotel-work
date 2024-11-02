<?php
include 'inc/header.php';
// Delete button handling
// delete button  
if (isset($_POST['id'])) {
    $withdrawalId = $_POST['id'];

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    try {
        // Begin transaction
        $conn->begin_transaction();

        // Delete the withdrawal record from the withdrawals table
        $deleteWithdrawal = $conn->prepare("DELETE FROM withdrawals WHERE id = ?");
        $deleteWithdrawal->bind_param("i", $withdrawalId);
        $deleteWithdrawal->execute();

        // Commit transaction
        $conn->commit();

        // Show success alert
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Deleted',
                text: 'Withdrawal record deleted successfully.',
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

    // Close the prepared statement and the database connection
    $deleteWithdrawal->close();
    $conn->close();
} else {
    // If no ID is provided, show a warning alert
    echo "<script>
        Swal.fire({
            icon: 'warning',
            title: 'Warning',
            text: 'No ID provided for deletion.',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'withdraw-list.php';
            }
        });
    </script>";
}

