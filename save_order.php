<?php
session_start();

include $_SERVER['DOCUMENT_ROOT'].'/hotel-work/config/config.php';
include $_SERVER['DOCUMENT_ROOT'].'/hotel-work/functions.php';
include $_SERVER['DOCUMENT_ROOT'].'/hotel-work/inc/authentication.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Step 1: Capture form inputs
    $user_id = $_POST['user_id'];
    $room_id = $_POST['room_id'];
    $commission_rate = $_POST['credit'];  // Commission rate passed from form

    // Step 2: Fetch user details
    $user_query = "SELECT total_balance, today_commission, total_commission FROM users WHERE id = ?";
    $stmt = $conn->prepare($user_query);
    if (!$stmt) {
        echo "Failed to prepare statement for user details: " . $conn->error;
        exit;
    }
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $user_result = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    if (!$user_result) {
        echo "User not found.";
        exit;
    }

    // Store user details in variables
    $total_balance = $user_result['total_balance'];
    $today_commission = $user_result['today_commission'];
    $total_commission = $user_result['total_commission'];

    // Step 3: Fetch the room price
    $room_query = "SELECT price FROM hotel_rooms WHERE id = ?";
    $stmt = $conn->prepare($room_query);
    if (!$stmt) {
        echo "Failed to prepare statement for room price: " . $conn->error;
        exit;
    }
    $stmt->bind_param("i", $room_id);
    $stmt->execute();
    $room_result = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    if (!$room_result) {
        echo "Room not found.";
        exit;
    }

    $price = $room_result['price'];

    // Check if the user has enough balance
    // if ($total_balance < $price) {
    //     echo "Insufficient balance to book this room.";
    //     exit;
    // }

    // Step 4: Fetch user's order count
    $order_count_query = "SELECT COUNT(*) AS order_count FROM orders WHERE user_id = ?";
    $stmt = $conn->prepare($order_count_query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $order_count_result = $stmt->get_result()->fetch_assoc();
    $order_count = $order_count_result['order_count'];
    $stmt->close();

    // Step 5: Get admin's threshold and assigned product_id from luxury_orders
    $threshold_query = "SELECT order_id, product_id FROM luxury_orders WHERE user_id = ?";
    $stmt = $conn->prepare($threshold_query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $threshold_result = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    $admin_threshold = isset($threshold_result['order_id']) ? $threshold_result['order_id'] : null;
    $admin_product_id = isset($threshold_result['product_id']) ? $threshold_result['product_id'] : null;

    // Step 6: Calculate commission
    $commission_amount = $price * ($commission_rate / 100);

    // Step 7: Determine whether to add or deduct the commission amount from the balance
    if ($admin_threshold !== null && $order_count >= $admin_threshold && $room_id == $admin_product_id) {
        // User is at or above the threshold and using the assigned luxury order, deduct commission
        $new_total_balance = $total_balance - $price - $commission_amount;
    } else {
        // Add commission to balance
        $new_total_balance = $total_balance + $commission_amount;
    }

    $new_today_commission = $today_commission + $commission_amount;
    $new_total_commission = $total_commission + $commission_amount;

    // Step 8: Update the user's balance and commission
    $update_user_query = "UPDATE users SET today_commission = ?, total_commission = ?, total_balance = ? WHERE id = ?";
    $stmt = $conn->prepare($update_user_query);
    if (!$stmt) {
        echo "Failed to prepare statement for updating user data: " . $conn->error;
        exit;
    }
    $stmt->bind_param("dddi", $new_today_commission, $new_total_commission, $new_total_balance, $user_id);

    if (!$stmt->execute()) {
        echo "Error updating user balance and commission: " . $stmt->error;
        exit;
    }
    $stmt->close();

    // Step 9: Insert the order into the orders table
    $insert_order_query = "INSERT INTO orders (user_id, product_id) VALUES (?, ?)";
    $stmt = $conn->prepare($insert_order_query);
    if (!$stmt) {
        echo "Failed to prepare statement for inserting order: " . $conn->error;
        exit;
    }

    $stmt->bind_param("ii", $user_id, $room_id);

    if ($stmt->execute()) {
        echo "Order placed successfully.";
        header("Location: order.php"); // Redirect to order page after success
        exit;
    } else {
        echo "Error placing order: " . $stmt->error;
    }
    $stmt->close();
}

// Close the database connection
$conn->close();
?>
