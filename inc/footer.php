<?php
$current_page = basename($_SERVER['REQUEST_URI']);
?>

<div id="footer-menu">
    <div class="footer-row">
        <a href="index.php">
            <div class="footer-columns">
                <i class="fa-solid fa-house <?php echo ($current_page == 'index.php') ? 'active' : ''; ?>"></i>
                <p class="<?php echo ($current_page == 'index.php') ? 'active' : ''; ?>">House</p>
            </div>
        </a>
        <a href="bookings.php">
            <div class="footer-columns">
                <i class="fa-solid fa-box <?php echo ($current_page == 'bookings.php') ? 'active' : ''; ?>"></i>
                <p class="<?php echo ($current_page == 'bookings.php') ? 'active' : ''; ?>">Bookings</p>
            </div>
        </a>
        <a href="order.php">
            <div class="footer-columns">
                <i class="fa-solid fa-grid-2 <?php echo ($current_page == 'order.php') ? 'active' : ''; ?>"></i>
                <p class="<?php echo ($current_page == 'order.php') ? 'active' : ''; ?>">Order</p>
            </div>
        </a>
        <a href="support.php">
            <div class="footer-columns">
                <i class="fa-solid fa-message <?php echo ($current_page == 'support.php') ? 'active' : ''; ?>"></i>
                <p class="<?php echo ($current_page == 'support.php') ? 'active' : ''; ?>">Support</p>
            </div>
        </a>
        <a href="profile.php">
            <div class="footer-columns">
                <i class="fa-solid fa-user <?php echo ($current_page == 'profile.php') ? 'active' : ''; ?>"></i>
                <p class="<?php echo ($current_page == 'profile.php') ? 'active' : ''; ?>">Profile</p>
            </div>
        </a>
    </div>
</div>

<script src="../js/profile-image.js"></script>

</body>
</html>
