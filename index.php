<?php include 'inc/header.php' ?>

<?php include 'inc/authentication.php' ?>

<div id="main">

  <?php include 'inc/bg-header.php' ?>

  <div id="header-container-main">
    <div id="header-container">
      <div class="top-up-balance">
        <a href="top-up-balance.php">
          <i class="fa-solid fa-wallet"></i>
          <p>Top up balance</p>
        </a>
      </div>
      <div class="withdraw">
        <a href="withdraw-money.php">
          <i class="fa-solid fa-circle-dollar-to-slot"></i>
          <p>Withdrawl Money</p>
        </a>
      </div>
      <div class="team">
        <a href="">
          <i class="fa-solid fa-circle-user"></i>
          <p>Team</p>
        </a>
      </div>
      <div class="invite-friends">
        <a href="invite-friends.php">
          <i class="fa-solid fa-gift"></i>
          <p>Invite friends</p>
        </a>
      </div>
    </div>
  </div>
  <div id="leader-board">
    <h3>Leader board</h3>
    <div class="leader-board-row">
      <?php
        $tbl_name = 'hotel_rooms';
        $hotels = get_records($tbl_name);
        if (!empty($hotels)) {
          foreach ($hotels as $hotel) {
      ?>
      <a>
        <div class="leader-board-columns">
          <div class="leader-board-img">
            <img src="<?php echo $hotel['hotel_image']; ?>" alt="">
          </div>
          <div class="leader-board-column-text">
            <h4><?php echo $hotel['hotel_name']; ?></h4>
            <div class="room-detail">
              <p><?php echo $hotel['capacity']; ?> Guest</p>|<p><?php echo $hotel['room_quantity']; ?> Room</p>
            </div>
            <div class="room-price">
              <p>$<?php echo $hotel['price']; ?></p>-<span><?php echo $hotel['time']; ?></span>
            </div>
          </div>
        </div>
      </a>
      <?php
        }
        } else {
          echo "<tr><td colspan='4'>0 results</td></tr>";
        }
      ?>
    </div>
    <div class="leader-board-vip-tickets">
      <div class="leader-board-vip-tickets-row">
        <div class="leader-board-vip-tickets-column">
          <div class="vip-tickets-column-img">
            <h4>VIP 1</h4><img src="images/vip1_img.17440603.png" alt="">
          </div>
          <p>Credit : 4.00%</p>
          <p>Order : 30</p>
        </div>
        <div class="leader-board-vip-tickets-column">
          <div class="vip-tickets-column-img">
            <h4>VIP 2</h4><img src="images/vip3_img.dbd4c55c.png" alt="">
          </div>
          <p>Credit : 5.00</p>
          <p>Order : 25</p>
        </div>
        <div class="leader-board-vip-tickets-column">
          <div class="vip-tickets-column-img">
            <h4>VIP 3</h4><img src="images/vip4_img.7b15e313.png" alt="">
          </div>
          <p>Credit : 6%.00</p>
          <p>Order : 35</p>
        </div>
        <div class="leader-board-vip-tickets-column">
          <div class="vip-tickets-column-img">
            <h4>VIP 4</h4><img src="images/vip4_img.7b15e313.png" alt="">
          </div>
          <p>Credit : 6%.00</p>
          <p>Order : 57</p>
        </div>
      </div>
    </div>
  </div>

  <!-- popular hotels -->
  <div id="popular-hotels">
    <?php
      $tbl_name = 'hotel_rooms';
      $hotels = get_records($tbl_name);
      if (!empty($hotels)) {
        foreach ($hotels as $hotel) { 
    ?>
    <a>
      <div class="popular-hotel-column">
        <img src="<?php echo $hotel['hotel_image']; ?>" alt="">
        <div class="popular-hotel-text">
          <div class="popular-hotel-text-name"><?php echo $hotel['hotel_name']; ?></div>
          <div class="popular-hotel-text-price">
            <p>$ <?php echo ' '. $hotel['price']; ?></p>-<span><?php echo $hotel['time']; ?></span>
          </div>
        </div>
        <div class="popular-hotel-detail">
          <p><?php echo $hotel['capacity']; ?> Guests</p> |
          <p><?php echo $hotel['room_quantity']; ?> Room</p>
        </div>
      </div>
    </a>
    <?php
      }
      } else {
        echo "<tr><td colspan='4'>0 results</td></tr>";
      }
    ?>

  </div>




</div>
<?php include 'inc/footer.php' ?>