<?php include 'inc/header.php' ?>

<?php include 'inc/authentication.php' ?>

<?php include 'inc/bg-header.php';  ?>

<?php

// Check if the success message exists
if (isset($_SESSION['password_change_success'])) {
    echo '<script>alert("' . $_SESSION['password_change_success'] . '");</script>';
    // Unset the session variable after displaying the message
    unset($_SESSION['password_change_success']);
}

$tbl_name = 'users';
$user = fetch_profile_pic($tbl_name);

?>

  <div class="bg-background p-6 rounded-lg shadow-md">
    <div class="flex items-center mb-4 justify-between">
      <div class="flex items-center justify-between">
        <input type="hidden" name="user_id" id="userIdInput" value="<?php echo $_SESSION["id"]; ?>"> <!-- Set the user ID dynamically -->
        <input type="file" id="profileImageInput" accept="image/*" style="display: none;">
        <label for="profileImageInput">
            <?php if (!empty($user['profile_photo'])) ?>
                <img src="<?php echo $user['profile_photo']; ?>" alt="" class="w-12 h-12 rounded-full mr-3 cursor-pointer photoprofile">
        </label>
        <div class="">
          <h2 class=" font-semibold"><?php echo $_SESSION["username"]; ?></h2>
          <p class="text-muted-foreground text-sm">ID: <?php echo $_SESSION["ref_code"]; ?></p>
        </div>
      </div>
      <p class="text-muted-foreground text-sm">Credit: <?php echo $_SESSION["credit"]; ?>%</p>
    </div>
    <div class="grid grid-cols-2 gap-4 mb-6">
      <div class="bg-blue-100 p-4 rounded-lg">
        <h3 class="font-semibold">Account Balance</h3>
        <p class="">$ <?php echo $user['total_balance']; ?></p>
      </div>
      <div class="bg-green-100 p-4 rounded-lg">
        <h3 class="font-semibold">Today's Commission</h3>
        <p class="">$ <?php echo $user['today_commission']; ?></p>
      </div>
      <div class="bg-purple-100 p-4 rounded-lg">
        <h3 class="font-semibold">Total Commission</h3>
        <p class="">$ <?php echo $user['total_commission']; ?></p>
      </div>
    </div>
    <div class="bg-pink-100 p-4 rounded-lg mb-4">
      <h3 class="font-semibold">Invite Friends</h3>
      <p class="text-muted-foreground">Invite your friends to get rewards</p>
      
      <!-- Button to share invite code via WhatsApp -->
      <button id="whatsapp-invite-btn" class="bg-green-500 text-white px-4 py-2 rounded-lg mt-4">Invite via WhatsApp</button>
    </div>
    <ul class="space-y-2">
      
      <li>
        <a href="top-up-balance.php">
          <button class="w-full text-left p-2 rounded-lg bg-secondary text-secondary-foreground hover:bg-secondary/80 bg-green-100">Top up balance</button>
        </a>
      </li>

      <li>
        <a href="withdraw-money.php">
          <button class="w-full text-left p-2 rounded-lg bg-secondary text-secondary-foreground hover:bg-secondary/80 bg-green-100">Withdrawal of money</button>
        </a>
      </li>

      <li>
        <a href="bank-card.php">
          <button class="w-full text-left p-2 rounded-lg bg-secondary text-secondary-foreground hover:bg-secondary/80 bg-green-100">Bank card</button>
        </a>
      </li>
      <li>
        <a href="change-password.php">
          <button class="w-full text-left p-2 rounded-lg bg-secondary text-secondary-foreground hover:bg-secondary/80 bg-green-100">Change password</button>
        </a>
      </li>
      
      <li>
        <a href="about-us.php">
          <button class="w-full text-left p-2 rounded-lg bg-secondary text-secondary-foreground hover:bg-secondary/80 bg-green-100">About Us</button>
        </a>
      </li>
    </ul>
    <div class="mt-4">
      <form action="logout.php">
        <button type="submit"class="w-full p-2 rounded-lg bg-destructive text-white hover:bg-destructive/80 bg-red-700">Log out</button>
      </form>
    </div>
  </div>



  <script>
    // Fetch the user's invite code (this should be dynamically retrieved from your backend)
    var inviteCode = "<?php echo $_SESSION["ref_code"]; ?>";

    // Define the base URL of the registration page (modify this URL based on your site's structure)
    var websiteURL = "https://http://naraishkumar.freewebhostmost.com/register.php?invite=" + inviteCode;

    // Event listener for the WhatsApp bu qtton click
    document.getElementById("whatsapp-invite-btn").addEventListener("click", function() {
        var message = "Hey! Join this amazing site using my invite code: " + inviteCode + 
                      ". Click here to sign up: " + websiteURL;

        // Generate WhatsApp share URL
        var whatsappURL = "https://wa.me?text=" + encodeURIComponent(message);

        // Redirect to WhatsApp with the message
        window.open(whatsappURL, '_blank');
    });
</script>



<script>
      document.getElementById('profileImageInput').addEventListener('change', function() {
    const file = this.files[0];
    if (!file) return;

    // Get the user ID from the hidden input field
    const userId = document.getElementById('userIdInput').value;

    // Send the file and user ID to the PHP backend
    const formData = new FormData();
    formData.append('profileImage', file);
    formData.append('user_id', userId);

    fetch('upload.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(result => {
        console.log(result);
        if (result.includes("Profile photo updated successfully")) {
            document.querySelector('photoprofile').src = URL.createObjectURL(file);
        } else {
            alert("Failed to update profile image.");
        }
    })
    .catch(error => console.error('Error uploading image:', error));
});

</script>
  <?php include 'inc/footer.php' ?>
