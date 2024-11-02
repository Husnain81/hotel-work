<?php include 'inc/header.php' ?>
<?php include 'inc/sidebar.php' ?>
<?php include 'functions.php' ?>



<!-- RIGHT_CONTAINER -->
<div class="main-container">
    <?php include 'inc/nav.php' ?>

    <!-- Navigation Tabs -->
    <div class="bg-white shadow-sm p-4">
        <div class="container mx-auto flex items-center space-x-4">
            <button class="px-4 py-2 bg-blue-500 text-white rounded-md"><a href="index.php">Home</a></button>
            <button class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md"><a href="withdraw-list.php"> Withdrawal List </a><a href="index.php"
                    class="fa-regular fa-xmark"></a></button>
        </div>
    </div>

    <div class="container mx-auto bg-white shadow-md rounded-lg p-6">
        <h2 class="text-2xl font-semibold mb-6">Withdrawal List</h2>

        <form method="get" action="withdraw-list.php" class="flex flex-wrap gap-4 mb-6">
            <div class="flex flex-wrap gap-4 mb-6">
                <input type="text" placeholder="Member account" name="member_account"
                    class="flex-grow border border-gray-300 rounded-lg px-4 py-2">

                <select class="border border-gray-300 rounded-lg px-4 py-2" name="status">
                    <option value="">Select Status</option>
                    <option value="Approved">Approved</option>
                    <option value="Pending">Pending</option>
                    <option value="Rejected">Rejected</option>

                </select>
                <div class="border border-gray-300 rounded-lg flex px-2 items-center">
                    <label for="" class="font-bold">Withdrawal Date</label>
                    <input type="date" class="px-4 py-2" name="withdrawal_time">
                </div>

                <button type="submit" class="bg-blue-500 text-white rounded-lg px-6 py-2 hover:bg-blue-600">Search</button>
            </div>
        </form>

        <!-- Table -->
        <div class="overflow-x-auto" id="scrollable-data">
            <table class="min-w-full bg-white border border-gray-300">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="py-3 px-4 text-left border">ID</th>
                        <th class="py-3 px-4 text-left border">Member Name</th>
                        <th class="py-3 px-4 text-left border">Withdrawal Method</th>
                        <th class="py-3 px-4 text-left border">Total Balance</th>
                        <th class="py-3 px-4 text-left border">Withdrawal amount</th>
                        <th class="py-3 px-4 text-left border">Account Number</th>
                        <th class="py-3 px-4 text-left border">Account Title</th>
                        <th class="py-3 px-4 text-left border">Status</th>
                        <th class="py-3 px-4 text-left border">Withdrawal Time</th>
                        <th class="py-3 px-4 text-left border">Operator</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    $search_fields = [];

                    // Capture search inputs from the form
                    if (!empty($_GET['member_account'])) {
                        $search_fields['u.username'] = $_GET['member_account'];
                    }
                    if (!empty($_GET['status'])) {
                        $search_fields['w.withdrawal_status'] = $_GET['status'];
                    }
                    if (!empty($_GET['withdrawal_time'])) {
                        // If you're using datetime, ensure that you are comparing correctly
                        $search_fields['w.withdrawal_time'] = $_GET['withdrawal_time']; // This assumes you're using the DATE() function in your SQL query.
                    }

                    // Table name with join query
                    $tbl_name = 'withdrawals';


                    $users = get_withdrawals($tbl_name, $search_fields);


                    $total_pages = $_SESSION['total_pages'] ?? 1;
                    $page = $_GET['page'] ?? 1;

                    if (!empty($users)) {
                        foreach ($users as $withdrawal) {
                            $id = $withdrawal['withdrawal_id'] ?? 'N/A';
                            $username = $withdrawal['member_account'] ?? 'Unknown';
                            $account_number = $withdrawal['account_number'] ?? 'N/A';
                            $method = $withdrawal['method'] ?? 'N/A';
                            $total_balance = $withdrawal['total_balance'] ?? 'N/A';
                            $withdrawal_amount = $withdrawal['withdrawal_amount'] ?? 'N/A';
                            $account_title = $withdrawal['account_title'] ?? 'N/A';
                            $account_number = $withdrawal['account_number'] ?? 'N/A';
                            $withdrawal_status = $withdrawal['status'] ?? 'N/A';
                            $withdrawal_time = $withdrawal['withdrawal_time'] ?? 'N/A';

                    ?>
                            <tr>
                                <td class="py-3 px-4 border"><?php echo htmlspecialchars($id); ?></td>
                                <td class="py-3 px-4 border"><?php echo htmlspecialchars($username); ?></td>
                                <td class="py-3 px-4 border"><?php echo htmlspecialchars($method); ?></td>
                                <td class="py-3 px-4 border">$<?php echo htmlspecialchars($total_balance); ?></td>
                                <td class="py-3 px-4 border">$<?php echo htmlspecialchars($withdrawal_amount); ?></td>
                                <td class="py-3 px-4 border"><?php echo htmlspecialchars($account_number); ?></td>

                                <td class="py-3 px-4 border"><?php echo htmlspecialchars($account_title); ?></td>
                                <td class="py-3 px-4 border"><?php echo htmlspecialchars($withdrawal_status); ?></td>
                                <td class="py-3 px-4 border"><?php echo htmlspecialchars($withdrawal_time); ?></td>
                                <td class="py-3 px-4 border" id="operate" style="background-color: #fff;">
                                    <form action="withdraw-process.php" method="POST" style="display:inline;">
                                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                                        <input type="hidden" name="withdrawal_amount" value="<?php echo $withdrawal_amount; ?>">
                                        <input type="hidden" name="user_id" value="<?php echo $withdrawal['user_id']; ?>">
                                        <input type="hidden" name="status" value="Approved">
                                        <button type="submit" class="bg-green-500 text-white rounded-lg px-4 py-1 ml-2">Success</button>
                                    </form>

                                    <form action="withdraw-process.php" method="POST" style="display:inline;">
                                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                                        <input type="hidden" name="withdrawal_amount" value="<?php echo $withdrawal_amount; ?>">
                                        <input type="hidden" name="user_id" value="<?php echo $withdrawal['user_id']; ?>">
                                        <input type="hidden" name="status" value="Rejected">
                                        <button type="submit" class="bg-yellow-500 text-white rounded-lg px-4 py-1 ml-2">Fail</button>
                                    </form>
                                    <form action='delete_withdrawal.php' method='POST' style='display:inline;'>
                                        <input type='hidden' name='id' value="<?php echo $id; ?>">
                                        <button type='submit' class="bg-red-500 text-white rounded-lg px-4 py-1 ml-2 mt-2" onclick='return confirm("Are you sure you want to delete this withdrawal Request?");'>Delete</button>
                                    </form>

                                </td>
                            </tr>
                    <?php
                        }
                    } else {
                        echo "<tr><td colspan='7' class='text-center'>No results found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
            <nav>
                <ul class="pagination">
                    <?php
                    for ($i = 1; $i <= $total_pages; $i++) {
                        echo "<li class='page-item " . ($i == $page ? "active" : "") . "'><a class='page-link' href='withdraw-list.php?page=" . $i . "'>" . $i . "</a></li>";
                    }
                    ?>
                </ul>
            </nav>
        </div>
    </div>
</div>
<script src="assets/js/main.js"></script>
</body>

</html>