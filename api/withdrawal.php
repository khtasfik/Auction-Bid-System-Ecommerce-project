<?php
session_start();
date_default_timezone_set('Asia/Dhaka');
require "../models/ourModel.php";

if ($_SERVER['REQUEST_METHOD']=='POST') {
    $om = new ourModel();

    $wid_data = [
        'amount' => $_POST['withdrawal'],
        'seller_id' => $_SESSION['id'], 
        'date' => date("Y-m-d H:i:s") 
    ];

    $results = $om->insert("payment_logs",$wid_data);
    $sql = $om->dbRaw("select sum(payment_logs.amount) as amount from payment_logs where seller_id = {$_SESSION['id']} ");
        if($sql->num_rows > 0){
            $d = $sql->fetch_object();
           echo $amount = $d->amount;

        }
        
}
?>