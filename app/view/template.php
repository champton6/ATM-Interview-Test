<?php

class Template {

    public function get_page () {
        ob_start();
        ?>
        <html>

        <head>
            <title>ATM Test</title>
            <style>
                .center {
                    text-align: center;
                    margin:auto;
                }
            </style>
        </head>

        <body>
            <div class="center">
                <h1>Current Balance: $<?= Controller::$balance; ?></h1>
            </div>
            <div class="center">
                <form method="post" action="<?= $_SERVER['PHP_SELF']; ?>">
                    <table align="center"><tr>
                        <td>Income Amount:</td>
                        <td>$ <input type="input" name="income" placeholder="0.00" size="5"/></td>
                    </tr><tr>
                        <td>Expense Amount:</td>
                        <td>$ <input type="input" name="expense" placeholder="0.00" size="5"/></td>
                    </tr></table>
                    <input type="submit" value="Add Transaction" />
                </form>
            </div>
            <div class="center">
                <h3>Transaction History</h3>
            </div>
            <?php if (count(Controller::$transaction_list) < 1) : ?>
                <div class="center">
                    No Transactions at this time.
                </div>
            <?php else : ?>
                <table class="center">
                    <tr>
                        <th>Expense</th>
                        <th>Income</th>
                        <th>Transaction&nbsp;Time</th>
                    </tr>
                    <?php foreach (Controller::$transaction_list as $transaction) { ?>
                        <tr>
                            <td>$<?= $transaction['expense']; ?></td>
                            <td>$<?= $transaction['income']; ?></td>
                            <td><?= $transaction['timestamp']; ?></td>
                        </tr>
                    <?php } ?>
                </table>
            <?php endif; ?>
        </body>

        </html>
        <?php
        ob_end_flush();
    }

}