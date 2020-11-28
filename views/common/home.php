        <!-- Start Slider area -->
        <div class="slider-area brown__nav slider--15 slide__activation slide__arrow01 owl-carousel owl-theme">
            <!-- Start Single Slide -->
            <div class="slide animation__style10 bg-image--1 fullscreen align__center--left">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="slider__content">
                                <div class="contentbox">
                                    <h2><span>Entertainment </span></h2>
                                    <h2>Made <span>Easy </span></h2>
                                    <h2>From <span>Here </span></h2>
                                    <a class="shopbtn" href="#">Bid now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Single Slide -->
            <!-- Start Single Slide -->
            <div class="slide animation__style10 bg-image--7 fullscreen align__center--left">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="slider__content">
                                <div class="contentbox">
                                    <h2>Buy <span>Your </span></h2>
                                    <h2>Favourite <span>Electronics</span></h2>
                                    <h2>Products From <span>Here </span></h2>
                                    <a class="shopbtn" href="#">Bid now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Single Slide -->
            <!-- Start Single Slide -->
            <div class="slide animation__style10 bg-image--6 fullscreen align__center--left">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="slider__content">
                                <div class="contentbox">
                                    <h2>Buy <span>Your </span></h2>
                                    <h2>Favourite <span>Electronics</span></h2>
                                    <h2>Products From <span>Here </span></h2>
                                    <a class="shopbtn" href="#">Bid now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Single Slide -->
        </div>
        <!-- End Slider area -->
        <!-- Start BEst Seller Area -->
        <section class="wn__product__area brown--color pt--80  pb--30">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section__title text-center">
                            <h2 class="title__be--2">New <span class="color--theme">Products</span></h2>
                            <p>There are many variations of new products is available here, but if you get
                            your best products from here then bid first.</p>
                        </div>
                    </div>
                </div>
                <!-- Start Single Tab Content -->
                <div class="furniture--4 border--round arrows_style owl-carousel owl-theme row mt--50">
                    <?php
                    $data = $om->View('product', '*',["rand","()"]);
                        while($d = $data->fetch_object()) {                            
                            $id = $d->id;
                            $title = $d->title;
                            $price = $d->price;
                            ?>
                    <div class="product product__style--3">
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="product__thumb">
                                <a class="first__img" href="">
                                <?php 
                                   echo "<img src='images/products/{$d->id}.{$d->ext_feature}' alt='product image' width='100'>";
                                ?>
                                </a>
                                <a class="second__img animation1"
                                    href="index.php?v=single-product&mmh=<?php echo $d->id?>">
                                    <?php
                                    echo "<img src='images/products/{$d->id}.{$d->ext_feature}' alt='product image'
                                        width='100'>";
                                    ?>
                                </a>
                                <div class="hot__box">
                                    <span class="hot-label">BEST SALLER</span>
                                </div>
                            </div>
                            <div class="product__content content--center">
                                <h4><a href="index.php?v=single-product&mmh=<?php echo $d->id?>"><?php echo $title?></a></h4>
                                <ul class="prize d-flex">
                                    <li><?php echo $price?></li>
                                    <!-- <li class="old_prize">$35.00</li> -->
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
                <?php
                    }
                ?>
                    <!-- Start Single Product -->
                </div>
                <!-- End Single Tab Content -->
            </div>
        </section>       

        <!-- Start NEwsletter Area -->
        <section class="wn__newsletter__area bg-image--2">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 offset-lg-5 col-md-12 col-12 ptb--150">
                        <div class="section__title text-center">
                            <h2>Stay With Us</h2>
                        </div>
                        <div class="newsletter__block text-center">
                            <p>Subscribe to our newsletters now and stay up-to-date with new collections, the latest
                                lookbooks and exclusive offers.</p>
                            <form action="#">
                                <div class="newsletter__box">
                                    <input type="email" placeholder="Enter your e-mail">
                                    <button>Subscribe</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Start Best Seller Area -->
        <section class="wn__bestseller__area bg--white pt--80  pb--30">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section__title text-center">
                            <h2 class="title__be--2">All <span class="color--theme">Products</span></h2>
                            <p>There are many variations of passages of Lorem Ipsum available, but the majority have
                                suffered lebmid alteration in some ledmid form</p>
                        </div>
                    </div>
                </div>
                <div class="row mt--50">
                    <div class="col-md-12 col-lg-12 col-sm-12">
                        <div class="product__nav nav justify-content-center" role="tablist">
                            <a class="nav-item nav-link active" data-toggle="tab" href="#nav-all" role="tab">ALL</a>
                            <a class="nav-item nav-link" data-toggle="tab" href="#laptop"
                                role="tab">Laptop</a>
                            <a class="nav-item nav-link" data-toggle="tab" href="#mobile"
                                role="tab">Mobile</a>
                            <a class="nav-item nav-link" data-toggle="tab" href="#tablet" role="tab">Tablet</a>
                            <a class="nav-item nav-link" data-toggle="tab" href="#camera" role="tab">Camera</a>
                        </div>
                    </div>
                </div>
                <div class="tab__container mt--60">
                    <div class="row single__tab tab-pane fade show active" id="nav-all" role="tabpanel">
                        <?php
                            $data = $om->View('product', '*',['rand','()'],"","",8);
                            while($d = $data->fetch_object()) {                                
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
                        ?>
                    </div>
                    <!-- End All Single Tab Content -->
                    <!-- Start Laptop Tab Content -->
                    <div class="row single__tab tab-pane fade" id="laptop" role="tabpanel">
                        <?php 
                            $sqlsub = $om->View("sub_category","*","",['category_id'=>'16']);
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
                    <!-- Start mobile Tab Content -->
                    <div class="row single__tab tab-pane fade" id="mobile" role="tabpanel">
                        <?php 
                            $sqlsub = $om->View("sub_category","*","",['category_id'=>'18']);
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
                                                    echo "<img src='images/products/{$d->id}.{$d->ext_feature}' alt='product image' width='100'>";
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
                    <!-- Start tablet Tab Content -->
                    <div class="row single__tab tab-pane fade" id="tablet" role="tabpanel">
                        <?php 
                            $sqlsub = $om->View("sub_category","*","",['category_id'=>'20']);
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
                    <!-- Start camera Tab Content -->
                    <div class="row single__tab tab-pane fade" id="camera" role="tabpanel">
                        <?php 
                            $sqlsub = $om->View("sub_category","*","",['category_id'=>'19']);
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
                    <!-- End Single Tab Content -->
                </div>
            </div>
        </section>
        <!-- Start BEst Seller Area -->
        <!-- Start Recent Post Area -->
        <section class="wn__recent__post bg--gray ptb--80">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section__title text-center">
                            <h2 class="title__be--2">Our <span class="color--theme">Blog</span></h2>
                            <p>There are many variations of passages of Lorem Ipsum available, but the majority have
                                suffered lebmid alteration in some ledmid form</p>
                        </div>
                    </div>
                </div>
                <div class="row mt--50">
                    <div class="col-md-6 col-lg-4 col-sm-12">
                        <div class="post__itam">
                            <div class="content">
                                <h3><a href="blog-details.html">International activities of the Frankfurt Book </a></h3>
                                <p>We are proud to announce the very first the edition of the frankfurt news.We are
                                    proud to announce the very first of edition of the fault frankfurt news for us.</p>
                                <div class="post__time">
                                    <span class="day">Dec 06, 18</span>
                                    <div class="post-meta">
                                        <ul>
                                            <li><a href="#"><i class="bi bi-love"></i>72</a></li>
                                            <li><a href="#"><i class="bi bi-chat-bubble"></i>27</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 col-sm-12">
                        <div class="post__itam">
                            <div class="content">
                                <h3><a href="blog-details.html">Reading has a signficant info number of benefits</a>
                                </h3>
                                <p>Find all the information you need to ensure your experience.Find all the information
                                    you need to ensure your experience . Find all the information you of.</p>
                                <div class="post__time">
                                    <span class="day">Mar 08, 18</span>
                                    <div class="post-meta">
                                        <ul>
                                            <li><a href="#"><i class="bi bi-love"></i>72</a></li>
                                            <li><a href="#"><i class="bi bi-chat-bubble"></i>27</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 col-sm-12">
                        <div class="post__itam">
                            <div class="content">
                                <h3><a href="blog-details.html">The London Book Fair is to be packed with exciting </a>
                                </h3>
                                <p>The London Book Fair is the global area inon marketplace for rights negotiation.The
                                    year London Book Fair is the global area inon forg marketplace for rights.</p>
                                <div class="post__time">
                                    <span class="day">Nov 11, 18</span>
                                    <div class="post-meta">
                                        <ul>
                                            <li><a href="#"><i class="bi bi-love"></i>72</a></li>
                                            <li><a href="#"><i class="bi bi-chat-bubble"></i>27</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Recent Post Area -->
        <!-- Best Sale Area -->
        <section class="best-seel-area pt--80 pb--60">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section__title text-center pb--50">
                            <h2 class="title__be--2">Best <span class="color--theme">Seller </span></h2>
                            <p>There are many variations of new products is available here, but if you get
                            your best products now then bid first.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="slider center">
            <?php
                $data = $om->dbRaw("select product.* FROM product,order_details WHERE product.id = order_details.product_id order by rand()");
                while($d = $data->fetch_object()) {                            
                    $id = $d->id;
                    $title = $d->title;
                    $price = $d->price;
                    ?>
                        <div class="product product__style--3">
                            <div class="product__thumb">
                                <a class="first__img" href="">
                                    <?php 
                                    echo "<img src='images/products/{$d->id}.{$d->ext_feature}' alt='product image' width='100'>";
                                    ?>
                                </a>
                            </div>
                            <div class="product__content content--center">
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
                    <?php
                }
           ?>
                <!-- Single product start -->
                
                <!-- Single product end -->
               
            </div>
        </section>
        <!-- Best Sale Area Area -->

