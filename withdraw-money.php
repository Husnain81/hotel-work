<?php include 'inc/header.php' ?>

<?php include 'inc/authentication.php' ?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $withdraw_amount = $_POST["withdraw_amount"];
    $withdraw_method = $_POST["withdrawal_method"];
    $account_number = $_POST["account_number"];
    $accountant_name = $_POST["accountant_name"];
    $password = $_POST["password"]; // Get password from the form
    
    // Get the logged-in user's ID from session
    $user_id = $_SESSION["id"];

    // Verify the user's password
    $stmt = $conn->prepare("SELECT password FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        // Verify password (ensure to use password_verify if hashed)
        if ($row["password"] === $password) {  // Adjust this if passwords are hashed
            // Prepare to insert withdrawal data
            $stmt = $conn->prepare("INSERT INTO withdrawals (user_id, withdrawal_amount, withdrawal_method, account_number, accountant_name) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("issss", $user_id, $withdraw_amount, $withdraw_method, $account_number, $accountant_name);
            
            if ($stmt->execute()) {
                // Successfully inserted
                $_SESSION['success_message'] = "Withdrawal request submitted successfully!";
                header("Location: withdraw-money.php"); // Redirect after success
                exit;
            } else {
                // Insertion error
                $_SESSION['error_message'] = "Error submitting your request. Please try again.";
            }
        } else {
            // Incorrect password
            $_SESSION['error_message'] = "Incorrect password. Please try again.";
        }
    } else {
        // User not found
        $_SESSION['error_message'] = "User not found. Please log in again.";
    }

    $stmt->close();
    $conn->close(); // Close the connection
}
?>

    <div class="mx-auto p-6 bg-card rounded-lg">
        <div class="flex justify-between items-center gap-3 mb-3">
            <a href="index.php"><i class="fa-regular fa-arrow-left"></i></a>
            <h2 class="text-xl font-semibold text-foreground">Withdrawal of money</h2>
            <a href=""><i class="fa-regular fa-clipboard"></i></a>
        </div>
        <form action="withdraw-money.php" method="POST"> 
    <label class="block mb-2 text-blue-700" for="withdrawal-amount">Withdrawal amount</label>
    <input type="text" name="withdraw_amount" id="withdrawal-amount" class="w-full p-2 border border-border rounded-lg bg-input" placeholder="Enter amount" required />
    <p class="text-gray-800 text-xs mt-2">Account balance: <span class="font-semibold">0.00</span></p>
    
    <label class="block mt-4 mb-2 text-blue-700" for="withdrawal-method">Withdrawal method</label>
    <select name="withdrawal_method" id="withdrawal-method" class="w-full p-2 border border-border rounded-lg bg-input" required>
        <option value="Bank">Bank card</option>
        <option value="Debit Card">Debit card</option>
        <option value="Jazz Cash">Jazz Cash</option>
    </select>
    
    <label class="block mt-4 mb-2 text-blue-700" for="account-number">Account Number</label>
    <input type="text" name="account_number" id="account-number" class="w-full p-2 border border-border rounded-lg bg-input" placeholder="Enter account number" required />
    
    <label class="block mt-4 mb-2 text-blue-700" for="accountant-name">Accountant Name</label>
    <input type="text" name="accountant_name" id="accountant-name" class="w-full p-2 border border-border rounded-lg bg-input" placeholder="Enter account holder name" required />
    
    <label class="block mt-4 mb-2 text-blue-700" for="payment-password">Confirm password</label>
    <div class="relative">
        <input type="password" name="password" id="payment-password" class="w-full p-2 border border-border rounded-lg bg-input" placeholder="Enter password" required />
        <button id="show-password" type="button" class="absolute inset-y-0 right-0 px-3 flex items-center bg-transparent text-muted-foreground">
            <i class="fa-regular fa-eye-slash"></i>
        </button>
    </div>
    
    <button type="submit" class="mt-6 w-full bg-primary text-white p-2 rounded-lg hover:bg-primary/80" style="background: blue;">Confirm</button>
</form>
</div>
<?php
// Check for success message
if (isset($_SESSION['success_message'])) {
  echo "<script>alert('" . $_SESSION['success_message'] . "');</script>";
  unset($_SESSION['success_message']); // Clear the message after displaying
}

// Check for error message
if (isset($_SESSION['error_message'])) {
  echo "<script>alert('" . $_SESSION['error_message'] . "');</script>";
  unset($_SESSION['error_message']); // Clear the message after displaying
}
?>


<script>
  const showPasswordBtn = document.getElementById('show-password');
  const passwordInput = document.getElementById('payment-password');
  showPasswordBtn.addEventListener('click', () => {
      if (passwordInput.type === 'password') {
          passwordInput.type = 'text';
          showPasswordBtn.innerHTML = '<i class="fa-regular fa-eye"></i>';
      } else {
          passwordInput.type = 'password';
          showPasswordBtn.innerHTML = '<i class="fa-regular fa-eye-slash"></i>';
      }
  });
</script>

</body>
</html>