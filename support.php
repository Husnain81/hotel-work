<?php include 'inc/header.php' ?>

<?php include 'inc/authentication.php' ?>


<?php include 'inc/bg-header.php' ?>

    <div style="height: 100vh;">
        <div class="flex items-center p-4 bg-white dark:bg-card rounded-lg shadow-md gap-2" style="border-radius: 20px;border: 1px solid rgb(163, 163, 163);margin: 20px;justify-content: space-between;">
           <a href="" id="telegram-contact">
            <i class="fa-brands fa-telegram" style="font-size: 22px;color: blue;"></i>
            <span class="text-lg text-muted-foreground">Telegram</span>
           </a>
            <!-- <input type="text" style="border:2px solid rgba(128, 128, 128, 0.479); width: -webkit-fill-available;outline-color:gray;border-radius: 4px;"> -->
            <a href="https://t.me/abc" target="_blank">
              <button class="bg-primary text-primary-foreground rounded-full p-2 hover:bg-primary/80">
                  <i class="fa-solid fa-arrow-right" style="font-size: 22px;color: blue;"></i>
              </button>
          </a>
        </div>  
    </div>

    <?php include 'inc/footer.php' ?>
