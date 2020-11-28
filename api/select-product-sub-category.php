<?php
    require "../models/ourModel.php";
    if ($_SERVER['REQUEST_METHOD']=='POST') {
        $om = new ourModel();
        $where =[
            'sub_category_id' => $_POST['sub_category_id'],
        ];
        
        $results = $om->View("product", "*", "", $where);
        if ($results->num_rows > 0) {
            $html="";
            while ($d = $results->fetch_object()) {
                $title = $d->title;
                $price = $d->price;
                $id = $d->id;
                $html .= "
                
                <div class='box-shadow product product__style--3 col-lg-4 col-md-4 col-sm-6 col-12'>
                <div class='product__thumb'>
                    <a class='first__img' href=''><img src='images/products/{$d->id}.{$d->ext_feature}' alt='product image' width='100'></a>
                    <a class='second__img animation1'href='index.php?v=single-product&mmh=$d->id'><img src='images/products/{$d->id}.{$d->ext_feature}' alt='product image'width='100'></a>
                <div class='hot__box color--2'>
                    <span class='hot-label'>HOT</span>
                </div>
                </div>
                <div class='product__content content--center'>
                    <h4><a href='index.php?v=single-product&mmh=$d->id'>$title</a></h4>
                    <ul class='prize d-flex'>
                        <li>$price</li>
                        <!-- <li class='old_prize'>$35.00</li> -->
                    </ul>
                    <div class='action'>
                        <div class='actions_inner'>
                            <ul class='add_to_links'>
                                <li><a class='cart' href='cart.html'><i class='bi bi-shopping-bag4'></i></a>
                                    <li><a class='wishlist' href='wishlist.html'><i class='bi bi-shopping-cart-full'></i></a></li>
                                    <li><a class='compare' href='#'><i class='bi bi-heart-beat'></i></a></li>
                                    <li><a data-toggle='modal' title='Quick View' class='quickview modal-view detail-link' data-target='#a$id' ><i class='bi bi-search'></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class='product__hover--content'>
                            <ul class='rating d-flex'>
                                <li class='on'><i class='fa fa-star-o'></i></li>
                                <li class='on'><i class='fa fa-star-o'></i></li>
                                <li class='on'><i class='fa fa-star-o'></i></li>
                                <li><i class='fa fa-star-o'></i></li>
                                <li><i class='fa fa-star-o'></i></li>
                            </ul>
                        </div>
                    </div>                
                    </div>                
                ";     
            }
            echo $html;
        }
        else{
            echo"No Product Available";
        }
    }
?>