<?php
include_once('config.php');

$conn = new DBConnect();

function get_balance($conn) {
    $balance = $conn->getConnection()->query('SELECT amount FROM balance')->fetch();
    return $balance['amount'];
}

function get_transactions($conn) {
    $results = $conn->getConnection()->query('SELECT expense, income, timestamp FROM history')->fetchAll();
    return $results;
}

function transaction($conn, $expense = 0.00, $income = 0.00) {
    $stmt = $conn->getConnection()->prepare("INSERT INTO history (expense, income) VALUES(:expense, :income)");
    $stmt->execute(['expense'=>$expense, 'income'=>$income]);
    $balance = get_balance($conn);
    $balance -= $expense;
    $balance += $income;
    $stmt = $conn->getConnection()->prepare("UPDATE balance SET amount=:balance");
    $stmt->execute(['balance'=>$balance]);
}

if($_POST['expense'] > 0) {
    transaction($conn, $_POST['expense'], 0.00);
}
if($_POST['income'] > 0) {
    transaction($conn, 0.00, $_POST['income']);
}
$balance = get_balance($conn);
$transactions = get_transactions($conn);

include_once('template.php');
