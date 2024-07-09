<html>

<head>
    <title>ATM Test</title>
    <style>
        .center {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="center">
        <h1>Current Balance: $<?php echo $balance; ?></h1>
    </div>
    <div class="center">
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            Expense Amount: $<input type="input" name="expense" placeholder="0.00" />&nbsp;&nbsp;
            Income Amount: $<input type="input" name="income" placeholder="0.00" />
            <input type="submit" value="Add Transaction" />
        </form>
    </div>
    <div class="center">
        <h3>Transaction History</h3>
    </div>
    <?php if (count($transactions) < 1) : ?>
        No Transactions at this time.
    <?php else : ?>
        <table class="center">
            <tr>
                <th>Expense</th>
                <th>Income</th>
                <th>Transaction&nbsp;Time</th>
            </tr>
            <?php foreach ($transactions as $transaction) : ?>
                <tr>
                    <td>$<?= $transaction['expense']; ?></td>
                    <td>$<?= $transaction['income']; ?></td>
                    <td><?= $transaction['timestamp']; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</body>

</html>