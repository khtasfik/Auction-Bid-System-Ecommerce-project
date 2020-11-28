<?php
session_start();
require "../models/ourModel.php";

if ($_SERVER['REQUEST_METHOD']=='POST') {
    $om = new ourModel();
    $order = [
        'bid_price','desc'
    ];

    $bid_data = [
        'bid_price' => $_POST['bid_price'],
        'product_id' => $_POST['product_id'], 
        'customers_id' => $_SESSION['id']
    ];

    $results = $om->insert("bid_product",$bid_data,$order);
    $sql = $om->View("bid_product","*","",['product_id' =>$_POST['product_id']]); 
    $count = mysqli_num_rows($sql);
    echo "$count";
}
?>