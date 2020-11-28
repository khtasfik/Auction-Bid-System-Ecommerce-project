<?php
    require "../models/ourModel.php";
    if ($_SERVER['REQUEST_METHOD']=='POST') {
        $om = new ourModel();
        $where =[
            'email' => $_POST['email'],
        ];
        
        $results = $om->View("seller", "*", "", $where);
        if ($results->num_rows > 0) {
            echo" Email already used";
        }
    }
?>