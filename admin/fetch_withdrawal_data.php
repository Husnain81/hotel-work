<?php
header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hotel-work";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    echo json_encode(['error' => 'Connection failed: ' . $conn->connect_error]);
    exit();
}

$user_id = isset($_GET['user_id']) ? intval($_GET['user_id']) : null;

if ($user_id === null) {
    echo json_encode(['error' => 'user_id parameter is missing']);
    exit();
}

$query = "SELECT users.id, users.username, withdrawals.withdrawal_method, withdrawals.account_number, withdrawals.accountant_name
          FROM users
          INNER JOIN withdrawals ON users.id = withdrawals.user_id
          WHERE users.id = ?";
$stmt = $conn->prepare($query);

if ($stmt === false) {
    echo json_encode(['error' => 'Failed to prepare statement']);
    exit();
}

$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $data = $result->fetch_assoc();
    echo json_encode($data);
} else {
    echo json_encode(['error' => 'No data found for this user_id']);
}

$stmt->close();
$conn->close();
?>
