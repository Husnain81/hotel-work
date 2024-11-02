<?php include 'inc/header.php' ?>

    <div class="login-container">
        <div class="login-form">
            <h2>Add Agent</h2>
            <form action="add_agent.php" method="POST">
                <div class="input-group">
                    <label for="name">Name</label>
                    <input type="name" name="name" id="name" placeholder="Enter name" required>
                </div>
                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" placeholder="Enter email" required>
                </div>
                <div class="input-group">
                    <label for="role">Role</label>
                    <input type="role" name="role" id="role" placeholder="Enter role" required>
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="Enter password" required>
                </div>
                <div class="input-group">
                    <button type="submit" class="login-btn">Add Agent</button>
                </div>
            </form>
        </div>
    </div>
    
</body>
</html>