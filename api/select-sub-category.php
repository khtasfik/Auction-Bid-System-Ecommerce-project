<?php
    require "../models/ourModel.php";
    if ($_SERVER['REQUEST_METHOD']=='POST') {
        $om = new ourModel();
        $where =[
            'category_id' => $_POST['category'],
        ];
        
        $results = $om->View("sub_category", "*", "", $where);
        if ($results->num_rows > 0) {
            $html="";
            while ($d = $results->fetch_object()) {
                $html .= "<option value='{$d->id}'>{$d->name}</option>";     
            }
            echo $html;
        }
        else{
            echo"<option value='0'>No sub-category avilable</option>";
        }
    }
?>