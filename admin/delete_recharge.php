<?php
include 'inc/header.php';
// Delete button handling
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
        $deleteWithdrawal = $conn->prepare("DELETE FROM recharges WHERE id = ?");
        $deleteWithdrawal->bind_param("i", $withdrawalId);
        $deleteWithdrawal->execute();

        // Commit transaction
        $conn->commit();

        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Deleted',
                text: 'Recharge Request deleted successfully.',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'recharge-list.php';
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
                    window.location.href = 'recharge-list.php';
                }
            });
        </script>";
    }

    // Close the prepared statement
    $deleteWithdrawal->close();
}
$conn->close();
