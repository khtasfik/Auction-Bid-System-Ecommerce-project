<?php
session_start();
date_default_timezone_set('Asia/Dhaka');
require "../models/ourModel.php";

if ($_SERVER['REQUEST_METHOD']=='POST') {
    $om = new ourModel();

    $adc_data = [
        'amount' => $_POST['withdrawal'],
        'date' => date("Y-m-d H:i:s") 
    ];

    $results = $om->insert("admin_ac",$adc_data);
    $sql = $om->dbRaw("select sum(admin_ac.amount) as amount from admin_ac");
        if($sql->num_rows > 0){
            $d = $sql->fetch_object();
           echo $amount = $d->amount;

        }
        
}
?>