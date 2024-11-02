<?php 
include 'inc/header.php';
include 'inc/authentication.php';

$user_id = $_SESSION["id"];

// Fetch user's order count
$order_count_query = "SELECT COUNT(*) AS order_count FROM orders WHERE user_id = ?"; 
$stmt = $conn->prepare($order_count_query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$order_count_result = $stmt->get_result()->fetch_assoc();
$order_count = $order_count_result['order_count']; 
$stmt->close();

// Get admin's threshold and assigned product_id
$threshold_query = "SELECT order_id, product_id FROM luxury_orders WHERE user_id = ?";
$stmt = $conn->prepare($threshold_query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$threshold_result = $stmt->get_result()->fetch_assoc();
$stmt->close();

// Set default values if no data is found
$admin_threshold = isset($threshold_result['order_id']) ? $threshold_result['order_id'] : null;
$admin_product_id = isset($threshold_result['product_id']) ? $threshold_result['product_id'] : null;

// Determine the room selection logic based on the order count and threshold
if ($admin_threshold === null || $order_count < $admin_threshold) {
    // User can pick any room within their balance
    $sql = "SELECT * FROM hotel_rooms WHERE price <= (SELECT total_balance FROM users WHERE id = ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $rooms = [];
    while ($row = $result->fetch_assoc()) {
        $rooms[] = $row;
    }
    $rooms_json = json_encode($rooms);
    $stmt->close();
} else if ($order_count == $admin_threshold) {
    // User is at the threshold, can only see the specific admin-assigned room
    $sql = "SELECT * FROM hotel_rooms WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $admin_product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $rooms = [];
    while ($row = $result->fetch_assoc()) {
        $rooms[] = $row;
    }
    $rooms_json = json_encode($rooms);
    $stmt->close();
} else {
    // User has crossed threshold; can freely choose any room within balance
    $sql = "SELECT * FROM hotel_rooms WHERE price <= (SELECT total_balance FROM users WHERE id = ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $rooms = [];
    while ($row = $result->fetch_assoc()) {
        $rooms[] = $row;
    }
    $rooms_json = json_encode($rooms);
    $stmt->close();
}
?>

<?php 
  $tbl_name = 'users';
  $user = fetch_profile_pic($tbl_name);
?>

  
        <div class="p-6 bg-background rounded-lg shadow-md" style="height: 100vh;">
            <div class="flex justify-between items-center mb-4">
              <h1 class="text-2xl font-bold text-primary"><?php echo $user["member_level"]; ?></h1>
              <div class="text-muted-foreground">
                <p>Credit: <span class="font-semibold"><?php echo $user["credit"]; ?>%</span></p>
                <!-- <p>Orders: <span class="font-semibold">50</span></p> -->
              </div>
            </div>
          
            <div class="flex items-center mb-4">
              <span class="text-accent mr-2">
                <img aria-hidden="true" alt="notification" src="https://openui.fly.dev/openui/24x24.svg?text=🔔" />
              </span>
              <h2 class="text-lg font-semibold">Commission details</h2>
            </div>
            
          
            <div class="grid grid-cols-2 gap-4 mb-4">
              <div class="p-4 bg-blue-100 rounded-lg">
                <p class="text-muted-foreground">Account balance</p>
                <p class="text-xl font-bold">$ <?php echo $user["total_balance"]; ?></p>
              </div>
              <div class="p-4 bg-green-100 rounded-lg">
                <p class="text-muted-foreground">Today's commission</p>
                <p class="text-xl font-bold">$ <?php echo $user["today_commission"]; ?> </p>
              </div>
            </div>
          
            <div class="grid grid-cols-2 gap-4 mb-4">
              <div class="p-4 bg-red-100 rounded-lg">
                <p class="text-muted-foreground">Total commission</p>
                <p class="text-xl font-bold">$ <?php echo $user["total_commission"]; ?></p>
              </div>
              <div class="p-4 bg-purple-100 rounded-lg">
                <p class="text-muted-foreground">Bookings</p>
                <p class="text-xl font-bold">0</p>
              </div>
            </div>
          
            <div class="grid grid-cols-2 gap-4 mb-4">
              <div class="p-4 bg-yellow-100 rounded-lg">
                <p class="text-muted-foreground">Booking limit for today</p>
                <p class="text-xl font-bold">30</p>
              </div>
              <div class="p-4 bg-white-300 rounded-lg">
                <!-- <p class="text-muted-foreground">Total achieved</p>
                <p class="text-xl font-bold">0</p> -->
              </div>
              
            </div>
          
            <button id="get-order-btn" class="w-full bg-blue-500 text-white text-sm text-primary-foreground p-2 rounded-lg hover:bg-primary/80">Get Order</button>


            <!-- Modal for displaying room details -->
            <form action="save_order.php" method="POST">
                <input type="hidden" name="credit" value="<?php echo $user["credit"]; ?>">
                <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                <input type="hidden" name="room_id" id="room-id-input">
                <div id="get-order-dropdown" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 hidden">
                    <div class="bg-card rounded-lg shadow-lg p-4 max-w-sm w-full bg-white mx-5">
                        <img id="room-image" alt="room" class="rounded-lg mb-4" style="width:100%;" />
                        <p id="room-id" class="mt-2"></p> 
                        <h2 id="room-name"></h2>
                        <h2 id="room-capacity"></h2>
                        <p id="room-price" class="mt-2"></p>
                        <button type="submit" class="mt-4 w-full bg-blue-500 text-white hover:bg-primary/80 py-2 rounded-lg">BOOK</button>
                    </div>
                </div>
            </form>

          </div>
          
          <script>
  const rooms = <?php echo $rooms_json; ?>;
  
  const getOrderBtn = document.getElementById('get-order-btn');
  const getOrderDropdown = document.getElementById('get-order-dropdown');
  const roomImage = document.getElementById('room-image');
  const roomCapacity = document.getElementById('room-capacity');
  const roomId = document.getElementById('room-id');
  const roomIdInput = document.getElementById('room-id-input');
  const roomName = document.getElementById('room-name');
  const roomPrice = document.getElementById('room-price');

  function showRandomRoom() {
    if (rooms.length === 0) {
      alert('No available rooms within your balance.');
      return;
    }

    const randomRoom = rooms[Math.floor(Math.random() * rooms.length)];
    roomImage.src = randomRoom.hotel_image;
    roomId.textContent = `${randomRoom.id}`;
    roomName.textContent = `${randomRoom.hotel_name}`;
    roomCapacity.textContent = `${randomRoom.capacity} guest | ${randomRoom.room_quantity} room`;
    roomPrice.textContent = `$ ${randomRoom.price} / ${randomRoom.time}`;
    roomIdInput.value = randomRoom.id;

    getOrderDropdown.classList.remove('hidden');
  }

  getOrderBtn.addEventListener('click', showRandomRoom);

  getOrderDropdown.addEventListener('click', function(event) {
    if (event.target === getOrderDropdown) {
      getOrderDropdown.classList.add('hidden');
    }
  });
</script>

<?php include 'inc/footer.php'; ?>