<!-- Start Bradcaump area -->
<div class="ht__bradcaump__area bg-image--6">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="bradcaump__inner text-center">
                    <h2 class="bradcaump-title">Product View</h2>
                    <nav class="bradcaump-content">
                        <a class="breadcrumb_item" href="index.php?v=home">Home</a>
                        <span class="brd-separetor">/</span>
                        <span class="breadcrumb_item active">Laptop</span>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Bradcaump area -->

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="section__title text-center py-5 ">
                <h2 class="title__be--2">All <span class="color--theme"><?php echo $_GET['n']; ?></span></h2>
                <p>There are many variations of passages of Lorem Ipsum available, but the majority have
                    suffered lebmid alteration in some ledmid form</p>
            </div>
            <div class="row">
                <?php 
                    $sqlsub = $om->View("sub_category","*","", ['category_id'=>$_GET['catid']]);
                    while($d2 = $sqlsub->fetch_object()){
                        $subcat = $d2->id;
                        $sqlpro = $om->View("product","*","",['sub_category_id'=>$subcat]);
                        while($d = $sqlpro->fetch_object()){
                            $id = $d->id;
                            $title = $d->title;
                            $price = $d->price;
                            ?>
                                <div class="col-md-3">
                                    <div class="single__product">
                                        <!-- Start Single Product -->
                                        <div class="">
                                            <div class="product product__style--3">
                                                <div class="product__thumb arimg">
                                                <?php 
                                                    if (file_exists("images/products/{$d->id}.{$d->ext_feature}")) {
                                                        echo "<img src='images/products/{$d->id}.{$d->ext_feature}' alt='product image' width='100'>";
                                                    }
                                                ?>
                                                    <a class="second__img animation1"
                                                        href="index.php?v=single-product&mmh=<?php echo $d->id?>">
                                                        <?php
                                                        if (file_exists("images/products/{$d->id}.{$d->ext_feature}")) {
                                                        echo "<img src='images/products/{$d->id}.{$d->ext_feature}' alt='product image'
                                                            width='100'>";
                                                        }
                                                        ?>
                                                    </a>
                                                    <div class="hot__box">
                                                        <span class="hot-label">BEST SALLER</span>
                                                    </div>
                                                </div>
                                                <div class="product__content content--center">
                                                    <h4><a href="#"><?php echo $title?></a></h4>
                                                    <ul class="prize d-flex">
                                                        <li><?php echo $price ?></li>
                                                    </ul>
                                                    <div class="action">
                                                        <div class="actions_inner">
                                                            <ul class="add_to_links">
                                                                <li><a class="cart" href="cart.html"><i class="bi bi-shopping-bag4"></i></a>
                                                                <li><a class="wishlist" href="wishlist.html"><i class="bi bi-shopping-cart-full"></i></a></li>
                                                                <li><a class="compare" href="#"><i class="bi bi-heart-beat"></i></a></li>
                                                                <li><a data-toggle="modal" title="Quick View" class="quickview modal-view detail-link" data-target="#a<?php echo $id ?>" ><i class="bi bi-search"></i></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="product__hover--content">
                                                        <ul class="rating d-flex">
                                                            <li class="on"><i class="fa fa-star-o"></i></li>
                                                            <li class="on"><i class="fa fa-star-o"></i></li>
                                                            <li class="on"><i class="fa fa-star-o"></i></li>
                                                            <li><i class="fa fa-star-o"></i></li>
                                                            <li><i class="fa fa-star-o"></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                        }                        
                    }
                ?>
            </div>
        </div>
    </div>
</div>