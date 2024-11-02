<?php include 'inc/header.php' ?>

<?php include 'inc/authentication.php' ?>

<?php 
  $user_id = $_SESSION['id'];

  $order_count_query = " SELECT orders.*, hotel_rooms.* 
    FROM orders 
    JOIN hotel_rooms ON orders.product_id = hotel_rooms.id 
    WHERE orders.user_id = ?";
  $stmt = $conn->prepare($order_count_query);
  $stmt->bind_param("i", $user_id);
  $stmt->execute();
  $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
  
  
?>

  
    <div class="bg-background p-6 rounded-lg shadow-md" style="height:100vh;">
        <div class="flex justify-between mb-20">
          <div class="flex gap-2 justify-between w-full ">
            <!-- <button class="bg-primary text-white px-3 py-2 rounded-lg text-sm" style="background-color: blue;">All</button>
            <button class="bg-muted text-muted-foreground px-3 py-2 rounded-lg text-sm" style="background-color:#ebebeb;">Expectation</button>
            <button class="bg-muted text-muted-foreground px-3 py-2 rounded-lg text-sm" style="background-color:#ebebeb;">Completed</button> -->
          </div>
        </div>
         <!-- Member List Section -->
    <div class="container mx-auto  bg-white p-6 rounded-lg shadow">
      <h1 class="text-2xl font-semibold mb-4 ">Booking List</h1>



      <!-- Scrollable Member Table -->
      <div id="scrollable-data" style="height:300px;overflow:auto;">
        <div class="scrollable-table">
          <table class="min-w-full bg-white border-collapse border border-gray-300">
            <thead class="sticky top-0">
              <tr class="bg-gray-100">
                <th class="border border-gray-300 p-2">Booking No.</th>
                <th class="border border-gray-300 p-2">Hotel Name</th>
                <th class="border border-gray-300 p-2">Room Price</th>
                 <th class="border border-gray-300 p-2">Time</th>
                <!-- <th class="border border-gray-300 p-2">Member Level</th>
                <th class="border border-gray-300 p-2">Balance</th>
                <th class="border border-gray-300 p-2">Superior ID</th>
                <th class="border border-gray-300 p-2">Number of subordinate members</th>
                <th class="border border-gray-300 p-2">Maximum amount of daily statements</th>
                <th class="border border-gray-300 p-2">Today’s order quantity</th> -->
                
                
                <!-- <th class="border border-gray-300 p-2 sticky" id="operate">Operate</th> Fixed column -->
              </tr>
            </thead>
            <tbody>
              <?php 
              $serial = 1;
              foreach ($result as $row) {  ?>
              <tr>
                <td class="border border-gray-300 p-2 text-center"><?php echo $serial++; ?></td>
                <td class="border border-gray-300 p-2 text-center"><?php echo $row['hotel_name']?></td>
                <td class="border border-gray-300 p-2 text-center"><?php echo $row['price']?></td>
                 <td class="border border-gray-300 p-2 text-center"><?php echo $row['time']?> </td>
                <!-- <td class="border border-gray-300 p-2 text-center">VIP1</td>
                <td class="border border-gray-300 p-2 text-center">-27,335.11</td>
                <td class="border border-gray-300 p-2 text-center">94</td>
                <td class="border border-gray-300 p-2 text-center">0</td>
                <td class="border border-gray-300 p-2 text-center">30</td>
                <td class="border border-gray-300 p-2 text-center">15</td> -->

                
                <!-- <td class="border border-gray-300 p-2 text-center sticky space-y-2" id="operate-btns">
                  <button id="edit-btn" class="bg-gray-200 px-2 py-1 rounded text-sm">Edit</button>
                  <a href="continues-orders.html" class="py-1"><button class="bg-blue-500 text-white px-2 py-1 rounded text-sm">Continuous orders</button></a>
                  <button id="system-increase-decrease-btn" class="bg-blue-500 text-white px-2 py-1 rounded text-sm">System increase or deduction</button>
                  <button id="withdrawl-method-btn" class="bg-gray-200 px-2 py-1 rounded text-sm">Withdrawal method</button>
                  <button id="reset-transaction-count-btn" class="bg-yellow-400 text-white px-2 py-1 rounded text-sm">Reset transaction count</button>
                  <button class="bg-orange-500 text-white px-2 py-1 rounded text-sm">Disable</button>
                  <button id="confirm-delete-btn" class="bg-red-500 text-white px-2 py-1 rounded text-sm">Delete</button>
                </td> -->
              </tr>
              <?php   }

            $stmt->close(); ?>
              <!-- Add more rows here if needed -->
            </tbody>
          </table>
        </div>
      </div>
    </div>
        <!-- <div class="flex flex-col items-center ">
          <img aria-hidden="true" alt="No data illustration" src="https://openui.fly.dev/openui/200x200.svg?text=📄" class="mb-4" width="100px"/>
          <span class="text-muted-foreground text-sm">Sorry, you don't have any data yet.</span>
        </div> -->
      </div>

<?php include 'inc/footer.php' ?>
