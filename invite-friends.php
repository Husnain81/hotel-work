<?php include 'inc/header.php' ?>

<?php include 'inc/authentication.php' ?>

    <div class="p-6">
        <div class="flex justify-between items-center gap-3 mb-4">
            <a href="index.php"><i class="fa-regular fa-arrow-left"></i></a>
            <h2 class="text-xl font-semibold text-foreground">Invite friends</h2>
            <a href=""><i class="fa-regular fa-clipboard"></i></a>
           </div>
           <div class="flex flex-col items-center bg-card">
            <h2 class="text-xl text-center font-bold mb-4 text-blue-500">Invite your friends to <span class="text-primary">receive a reward</span></h2>
            <div class="bg-muted p-4 rounded-lg w-full text-center mb-4">
              <input id="promoLink" type="text" value="https://www.hiltonhotel.digital/register.php?invite=<?php echo $_SESSION["ref_code"]; ?>" class="w-full bg-gray-100 p-2 rounded border-0 focus:ring-0" readonly />
            </div>
            <button id="copyButton" class="border text-secondary-foreground hover:bg-secondary/80 p-2 rounded-lg text-sm">Copy Link</button>

          </div>
    </div>

    <script>
        const copyButton = document.getElementById('copyButton');
        const promoLink = document.getElementById('promoLink');
        copyButton.addEventListener('click', () => {
          promoLink.select();
          document.execCommand('copy');
          alert('Link copied to clipboard!');
        });
      </script>
      
</body>
</html>