<?php

class Controller {
    public static $conn;
    public static $balance;
    public static $transaction_list;

    private $transactions;

    public function __construct() {
        $this->init();
    }

    private function init() {
        self::$conn = new DBConnect();
        $this->transactions = new Transactions();

        if(isset($_POST['expense']) && $_POST['expense'] > 0) {
            $this->transactions->process_update($_POST['expense'], 0.00);
        }
        if(isset($_POST['income']) && $_POST['income'] > 0) {
            $this->transactions->process_update(0.00, $_POST['income']);
        }

        self::$balance = $this->transactions->get_balance();
        self::$transaction_list = $this->transactions->get_transaction_list();

        $template = new Template();
        $template->get_page();
    }
}