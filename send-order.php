<?php 
session_start();
 include $_SERVER['DOCUMENT_ROOT'].'/hotel-work/config/config.php';

 include $_SERVER['DOCUMENT_ROOT'].'/hotel-work/functions.php';

 include $_SERVER['DOCUMENT_ROOT'].'/hotel-work/inc/authentication.php';

 $user_id = $_SESSION["id"];

?>
<?php
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send order</title>
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
<form action="send-order2.php" method="POST" class="">
    <div class="" style="height: 100vh;">
        <div class="flex items-center py-5 px-3">
            <a href="order.html" class="p-2"><i class="fa-solid fa-chevron-left"></i></a>
        </div>
        <div class="fixed bottom-0 mx-auto px-5 w-full mb-5">
            <h3 class="mb-5 font-semibold">Order details</h3>
            <div class="text-center p-2 border rounded-lg mb-2 text-xs text-gray-700">
                <h3 class="mb-1 text-black font-bold" style="font-size: 16px;"><?php echo $record['hotel_name']; ?> </h3>
                <p class="mb-1 text-gray-600" style="font-size: 14px;">Profit $ 5</p>
                <p class="mb-1 text-gray-600" style="font-size: 14px;">Commission <?php echo $_SESSION["credit"]; ?>%</p>
            </div>
            <div class="flex items-center justify-between p-2 border rounded-lg mb-2 text-xs text-gray-700">
                <p class="text-sm">Price</p>
                <p class="text-sm">$<?php echo $record['price']; ?></p>
            </div>
            <div class="flex items-center justify-between p-2 border rounded-lg mb-2 text-xs text-gray-700">
                <p class="text-sm">Quantity</p>
                <p class="text-sm"><?php echo $record['room_quantity']; ?> </p>
            </div>
            <div class="flex items-center justify-between p-2 border rounded-lg mb-2 text-xs text-gray-700">
                <p class="text-sm">Paid Price</p>
                <p class="text-sm">$<?php echo $record['price']; ?></p>
            </div>
            <div class="flex items-center justify-between border rounded-lg mb-2 text-xs text-gray-700">
                <p class="px-2 text-sm" style="width: fit-content;">Hotel reviews</p>
                <p class="px-2 text-lg text-yellow-500">★★★★★</p>
            </div>

            
            <input type="hidden" name="hotel_name" value="<?php echo $record['hotel_name']; ?>">
            <input type="hidden" name="price" value="<?php echo $record['price']; ?>">
            <input type="hidden" name="room_quantity" value="<?php echo $record['room_quantity']; ?>">
              <input type="submit" value="Send" class="bg-blue-500 rounded-lg text-white w-full py-1">
            </form>
        </div>
    </div>
</body>
</html>