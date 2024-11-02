<?php
include 'inc/header.php';  // Include database connection

// Check if form data is submitted
if (isset($_POST['id'], $_POST['status'], $_POST['recharge_amount'], $_POST['user_id'])) {
    $rechargeId = $_POST['id'];
    $status = $_POST['status'];
    $rechargeAmount = $_POST['recharge_amount'];
    $userId = $_POST['user_id'];

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    try {
        // Begin transaction
        $conn->begin_transaction();

        // Update the recharge status in the recharges table
        $updateRecharge = $conn->prepare("UPDATE recharges SET status = ? WHERE id = ?");
        $updateRecharge->bind_param("si", $status, $rechargeId);
        $updateRecharge->execute();

        // Update the user's total balance only if the status is "Completed"
        if ($status === 'Completed') {
            $updateUserBalance = $conn->prepare("UPDATE users SET total_balance = total_balance + ? WHERE id = ?");
            $updateUserBalance->bind_param("di", $rechargeAmount, $userId);
            $updateUserBalance->execute();
        }

        // Commit transaction
        $conn->commit();

        echo "<script>
    Swal.fire({
        icon: 'success',
        title: 'Success',
        text: 'Recharge status and balance updated successfully.',
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

    // Close the prepared statements
    $updateRecharge->close();
    if (isset($updateUserBalance)) {
        $updateUserBalance->close();
    }
}


// Close the database connection only once at the very end
$conn->close();
?>