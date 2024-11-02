<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Work | Register</title>
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
          integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.0/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <div class="signup-container">
        <div class="login-form">
            <h2>Sign up</h2>
            <form action="" method="POST">
                <div class="input-group">
                    <label for="reference_code">Reference Code</label>
                    <input type="text" name="invited_code" id="invited_code" value="" placeholder="Invite code" readonly>
                </div>
                <div class="input-group">
                    <label for="username">User name</label>
                    <input type="text" name="username" id="username" placeholder="Enter username" required>
                </div>
                <div class="input-group">
                    <label for="number">Number</label>
                    <input type="tel" name="number" id="number" placeholder="Enter number" required>
                </div>
                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" placeholder="Enter email" required>
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="Enter password" required>
                </div>
                <div class="input-group">
                    <label for="password">Confirm Password</label>
                    <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm password" required>
                </div>
                <input type="hidden" name="redirect_url" value="index.php">
                <div class="input-group">
                    <button type="submit" class="login-btn">Register</button>
                </div>
                <div class="extra-links">
                    <p>I have an account? <a href="login.php">Login</a></p>
                </div>
            </form>
        </div>
    </div>

    <?php
    session_start();  // Start session to use session variables

    // Display alert if session variable is set
    if (isset($_SESSION['already_account'])) {
        echo '<script>alert("' . $_SESSION['already_account'] . '");</script>';
        unset($_SESSION['already_account']);  // Unset the session variable after showing alert
    }
    ?>

    <script>
        // Function to get the invite code from the URL
        function getInviteCode() {
            const urlParams = new URLSearchParams(window.location.search);
            return urlParams.get('invite');  // 'invite' is the query parameter key
        }

        // Get the invite code from the URL
        const inviteCode = getInviteCode();

        // If an invite code is present, fill the reference code field
        if (inviteCode) {
            document.getElementById('invited_code').value = inviteCode;
        }
    </script>
</body>
</html>
