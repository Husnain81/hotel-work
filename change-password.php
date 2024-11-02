<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Work | Change Password</title>
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
<<<<<<< HEAD:change-password.php
            <h2>Change Password</h2>
            <form action="update-password.php" method="POST">
                <input type="hidden" value="<?php echo $_SESSION['id'] ?>">
=======
            <!-- <h2>Login</h2> -->
            <div class="w-full flex justify-center mb-5"><img src="images/logo-light.5273b2fd.png" alt="" width="150px"></div>
            <form action="index.html">
>>>>>>> 11e25f250ff725cf8228e5210dd5b02df667cbb0:login.html
                <div class="input-group">
                    <label for="password">Old Password</label>
                    <input type="password" name="old_password" id="password" placeholder="Enter old password" required>
                </div>
                <div class="input-group">
                    <label for="password">New Password</label>
                    <input type="password" name="new_password" id="password" placeholder="Enter new password" required>
                </div>
                <div class="input-group">
                    <button type="submit" class="login-btn">Update Password</button>
                </div>
                <div class="extra-links">
                    
                </div>
            </form>
        </div>
    </div>
</body>
</html>