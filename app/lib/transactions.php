<?php

class Transactions {

    public function get_balance () {
        $balance = Controller::$conn->getConnection()->query('SELECT amount FROM balance')->fetch();
        return $balance['amount'];
    }

    public static function get_transaction_list () {
        $results = Controller::$conn->getConnection()->query('SELECT expense, income, timestamp FROM history')->fetchAll();
        return $results;
    }

    public function process_update ($expense = 0.00, $income = 0.00) {
        $this->save($expense, $income);
    }
    
    private function save ($expense, $income) {
        $stmt = Controller::$conn->getConnection()->prepare("INSERT INTO history (expense, income) VALUES(:expense, :income)");
        $stmt->execute(['expense'=>$expense, 'income'=>$income]);
        $balance = self::get_balance();
        $balance -= $expense;
        $balance += $income;
        $stmt = Controller::$conn->getConnection()->prepare("UPDATE balance SET amount=:balance");
        $stmt->execute(['balance'=>$balance]);
    }

}