<?php include 'inc/header.php' ?>

<?php include 'inc/authentication.php' ?>

<form action="topup.php" method="POST" enctype="multipart/form-data" id="topup_form">
  <input type="hidden" name="user_id" value="<?php echo $_SESSION['id'];?>">
<div class=" mx-auto p-4 bg-card rounded-lg">
  <div class="flex justify-between items-center gap-3">
    <a href="index.php"><i class="fa-regular fa-arrow-left"></i></a>
    <h2 class="text-xl font-semibold text-foreground">Top up your balance</h2>
    <a href=""></a>
  </div>

  <label class="block mt-4 text-muted-foreground">Account Number</label>
  <div class="flex items-center p-4 bg-white dark:bg-card rounded-lg shadow-md gap-2" style="border-radius: 20px;border: 1px solid rgb(163, 163, 163);margin: 20px 0px 4px 0px;justify-content: space-between;">
    <a>
      <i class="fa-solid fa-money-check" style="font-size: 22px;color: blue;"></i>
      <span class="text-lg text-muted-foreground" id="number">03060267456</span>
    </a>
    <button type="button" class="bg-primary text-primary-foreground rounded-full p-2 hover:bg-primary/80">
      <i class="fa-regular fa-clipboard" id="copyButton" style="font-size: 22px;color: blue;"></i>
    </button>
  </div>
  <p style="margin-left: 10px; font-size:smaller">Copy the number and send payment to this account and top up the balance. </p>

  <label class="block mt-4 text-muted-foreground">Transaction ID</label>
  <input type="text" name="transaction_id" id="" class="mt-1 p-2 border border-zinc-300 rounded w-full" />

  <label class="block mt-4 text-muted-foreground">Receiver Name</label>
  <input type="text" name="receiver_name" id="" class="mt-1 p-2 border border-zinc-300 rounded w-full" />

  <label class="block mt-4 text-muted-foreground">Replenishment amount</label>
  <input type="text" name="recharge_amount" id="amount" value="500" class="mt-1 p-2 border border-zinc-300 rounded w-full" />

  <label class="block mt-4 text-muted-foreground">Sender Name</label>
  <input type="text" name="sender_name" id="" class="mt-1 p-2 border border-zinc-300 rounded w-full" />

  <label class="block mt-4 text-muted-foreground">Screenshot</label>
  <input type="file" id="screenshot" name="screenshot" accept="image/*" class="mt-1 p-2 border border-zinc-300 rounded w-full" />

  
</form>

  <p class="mt-2 text-muted-foreground"><b>Account balance: $ 0.00<b></p>
  
  <h3 class="mt-4 text-lg font-medium text-foreground">Quick Select</h3>
  <div class="grid grid-cols-2 gap-2 mt-2">
    <button type="button" class="p-4 border border-transparent rounded-lg" onclick="selectAmount(100)" style="background-color: #ebebeb;">$ 100.00</button>
    <button type="button" class="p-4 border border-transparent rounded-lg" onclick="selectAmount(200)" style="background-color: #ebebeb;">$ 200.00</button>
    <button type="button" class="p-4 border border-transparent rounded-lg" onclick="selectAmount(500)" style="background-color: #ebebeb;">$ 500.00</button>
    <button type="button" class="p-4 border border-transparent rounded-lg" onclick="selectAmount(1000)" style="background-color: #ebebeb;">$ 1,000.00</button>
    <button type="button" class="p-4 border border-transparent rounded-lg" onclick="selectAmount(5000)" style="background-color: #ebebeb;">$ 5,000.00</button>
  </div>
  <button type="button" id="submitBtn" class="mt-4 w-full bg-primary text-white p-2 rounded-lg" style="background: blue;">Recharge</button>
</div>


<script>
  function selectAmount(amount) {
    event.preventDefault(); // Prevents form submission on quick select button clicks
    document.getElementById('amount').value = amount;
    const buttons = document.querySelectorAll('.grid button');
    buttons.forEach(button => {
      button.classList.remove('border-blue-500');
    });
    event.target.classList.add('border-blue-500');
  }
</script>

<script>
  const copyButton = document.getElementById('copyButton');
  const number = document.getElementById('number').textContent;

  copyButton.addEventListener('click', () => {
    navigator.clipboard.writeText(number).then(() => {
      alert('Number copied to clipboard!');
    }).catch(err => {
      console.error('Failed to copy text: ', err);
    });
  });
</script>


<script>
  // Get the button and form elements
  const submitButton = document.getElementById('submitBtn');
  const form = document.getElementById('topup_form');

  // Add event listener to the button
  submitButton.addEventListener('click', function () {
    // Trigger form submission
    form.submit();
  });
</script>

</body>
</html>