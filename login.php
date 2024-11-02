<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Work | Login</title>
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
      integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
      crossorigin="anonymous" referrerpolicy="no-referrer" />
      <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.0/dist/tailwind.min.css" rel="stylesheet">
      <script src="https://cdn.tailwindcss.com"></script>
           <!-- link with fontawesome -->
           <link
           rel="stylesheet"
           data-purpose="Layout StyleSheet"
           title="Web Awesome"
           href="/css/app-wa-54e7be3a62ca9b7580d7f8c669f59e74.css?vsn=d"
         />
     
         <link
           rel="stylesheet"
           href="https://site-assets.fontawesome.com/releases/v6.6.0/css/all.css"
         />
     
         <link
           rel="stylesheet"
           href="https://site-assets.fontawesome.com/releases/v6.6.0/css/sharp-duotone-solid.css"
         />
     
         <link
           rel="stylesheet"
           href="https://site-assets.fontawesome.com/releases/v6.6.0/css/sharp-thin.css"
         />
     
         <link
           rel="stylesheet"
           href="https://site-assets.fontawesome.com/releases/v6.6.0/css/sharp-solid.css"
         />
     
         <link
           rel="stylesheet"
           href="https://site-assets.fontawesome.com/releases/v6.6.0/css/sharp-regular.css"
         />
     
         <link
           rel="stylesheet"
           href="https://site-assets.fontawesome.com/releases/v6.6.0/css/sharp-light.css"
         />
</head>
<body>
    <div class="login-container">
        <div class="login-form">
<<<<<<< HEAD:login.php
            <h2>Login</h2>
            <form action="login_user.php" method="POST">
=======
            <!-- <h2>Sign up</h2> -->
             <div class="w-full flex justify-center mb-5"><img src="images/logo-light.5273b2fd.png" alt="" width="150px"></div>
            <form action="index.html">
                <div class="input-group">
                    <label for="username">User name</label>
                    <input type="text" id="username" placeholder="Enter username" required>
                </div>
                <div class="input-group">
                    <label for="number">Number</label>
                    <input type="tel" id="number" placeholder="Enter number" required>
                </div>
>>>>>>> 11e25f250ff725cf8228e5210dd5b02df667cbb0:signup.html
                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" placeholder="Enter your email" required>
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="Enter your password" required>
                </div>
                <div class="input-group">
                    <button type="submit" class="login-btn">Login</button>
                </div>
                <div class="extra-links">
                    
                    <!-- <p>Don't have an account? <a href="register.php">Sign Up</a></p> -->
                </div>
            </form>
        </div>
    </div>

    <?php
    session_start();  // Ensure the session is started

    // Display email-specific alert
    if (isset($_SESSION['error_email'])) {
        echo '<script>alert("' . $_SESSION['error_email'] . '");</script>';
        unset($_SESSION['error_email']);  // Clear the session variable
    }

    // Display password-specific alert
    if (isset($_SESSION['error_password'])) {
        echo '<script>alert("' . $_SESSION['error_password'] . '");</script>';
        unset($_SESSION['error_password']);  // Clear the session variable
    }
    ?>
  
</body>
</html>