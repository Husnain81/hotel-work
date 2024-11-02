<?php  session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Info</title>
    <link rel="stylesheet" href="dashboard.css">
     <!-- link with fontawesome -->
     <script src="https://cdn.tailwindcss.com"></script>
     <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.0/dist/tailwind.min.css" rel="stylesheet">
     <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
   <!-- google fonts -->
   <link rel="preconnect" href="https://fonts.googleapis.com" />
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
   <link
     href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap"
     rel="stylesheet"
   />
</head>
<body>

    <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-card rounded-lg shadow-lg p-6 max-w-md w-full bg-white">
          <h2 class="text-lg font-semibold text-foreground mb-4">Basic Information</h2>
          <div class="mb-4">
            <label class="block text-muted-foreground">Agent Name</label>
            <p class="bg-muted text-muted-foreground p-2 rounded border border-border"><?php echo $_SESSION["name"]; ?></p>
          </div>
          <div class="mb-4">
            <label class="block text-muted-foreground">Agent Email</label>
            <p class="bg-muted text-muted-foreground p-2 rounded border border-border"><?php echo $_SESSION["credential_email"]; ?></p>
          </div>
          <div class="mb-4">
            <label class="block text-muted-foreground">Agent Password</label>
            <p class="bg-muted text-muted-foreground p-2 rounded border border-border"><?php echo $_SESSION["password"]; ?></p>
          </div>
          
          <div class="mb-4">
            <label class="block text-muted-foreground">Creation time</label>
            <p class="bg-muted text-muted-foreground p-2 rounded border border-border">2024-10-25 10:21:11</p>
          </div>
          <div class="flex justify-end">
            <a href="index.php"><button class="bg-blue-500 text-white hover:bg-destructive/80 p-2 rounded">Cancel</button></a>
          </div>
        </div>
      </div>
    <script src="main.js"></script>
</body>
</html>