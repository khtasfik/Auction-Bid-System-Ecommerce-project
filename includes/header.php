<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php echo (isset($title))?$title:"Home Page"?></title>


    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content="<?php echo $_SERVER['REQUEST_SCHEME'] . "://".$_SERVER['SERVER_NAME'].dirname($_SERVER["REQUEST_URI"].'?').'/'; ?>"
        name="url">
    <!-- Favicons -->
    <link rel="shortcut icon" href="assets/images/khicon.png">
    <link rel="apple-touch-icon" href="assets/images/khicon.png">

    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,500,600,600i,700,800,900&display=swap" rel="stylesheet">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/plugins.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <!-- Cusom css -->
    <link rel="stylesheet" href="assets/css/custom.css">
    <link rel="stylesheet" href="assets/css/jquery-ui-timepicker-addon.css">

    <!-- Modernizer js -->
    <script src="assets/js/vendor/modernizr-3.5.0.min.js"></script>
    <script src="assets/js/vendor/jquery-3.2.1.min.js"></script>
</head>

<body>

    <!-- Main wrapper -->
    <div class="wrapper" id="wrapper">
        <!-- Header -->
        <header id="wn__header" class="header__area header__absolute sticky__header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-6 col-lg-2">
                        <div class="logo">
                            <a href="index.php?home">
                                <img src="assets/images/logo/khti.png" alt="logo images" width="56">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-8 d-none d-lg-block">
                        <nav class="mainmenu__nav">
                            <ul class="meninmenu d-flex justify-content-start">
                                <li class="drop"><a href="index.php?v=home">Home</a></li>
                                <li class="drop"><a href="index.php?v=category/product_category&catId=16">Shop</a></li>
                                <li class="drop"><a href="index.php?v=laptop&catid=18&n=Mobile">Mobile</a></li>
                                <li class="drop"><a href="index.php?v=laptop&catid=16&n=Laptop">Laptop</a></li>
                                <li class="drop"><a href="index.php?v=laptop&catid=19&n=camera">Camera</a></li>
                                <!-- <li class="drop"><a href="index.php?v=blog">Blog</a></li> -->
                                <li><a href="index.php?v=contact">Contact</a></li>
                                <?php
									if(isset($_SESSION['status']) && $_SESSION['status'] == 1){
										echo '<li class="background-success"><a href="index.php?a=dashboard">Dashboard</a></li>';
									}									
								?>
                            </ul>
                        </nav>
                    </div>
                    <div class="col-md-6 col-sm-6 col-6 col-lg-2">
                        <ul class="header__sidebar__right d-flex justify-content-end align-items-center">
                            <li class="shop_search"><a class="search__active" href="#"></a></li>
                            <li class="wishlist"><a href="#"></a></li>
                            <li class="shopcart"><a class="cartbox_active" href="#">
                                <?php
                                    if(isset($_SESSION['id'])){
                                        $sql = $om->dbRaw("SELECT bid_product.* FROM bid_product, order_details WHERE bid_product.product_id != order_details.product_id AND bid_product.customers_id = {$_SESSION['id']}  GROUP BY bid_product.product_id");
                                        if($sql->num_rows > 0){
                                            $pcount = 0;
                                            while($d = $sql->fetch_object()){
                                                $pcount++;                                            
                                            }
                                            echo"<span class='product_qun'>$pcount</span></a>";
                                        }
                                        else{
                                            echo"<span class='product_qun'>0</span></a>";
                                        }
                                    }
                                    else{
                                        echo"<span class='product_qun'>0</span></a>";
                                    }
                                ?>
                            
                                <!-- Start Shopping Cart -->
                                <div class="block-minicart minicart__active">
                                    <div class="minicart-content-wrapper">
                                        <div class="micart__close">
                                            <span>close</span>
                                        </div> 
                                        <div class="single__items noborder">                                   
                                        <?php
                                            if(isset($_SESSION['id'])){
                                                $sql = $om->dbRaw("SELECT product.* FROM product, bid_product, order_details WHERE product.id = bid_product.product_id AND bid_product.product_id != order_details.product_id AND bid_product.customers_id = {$_SESSION['id']}  GROUP BY bid_product.product_id");
                                                if($sql->num_rows > 0){
                                                    
                                                    while($d = $sql->fetch_object()){
                                                        ?>
                                                            <div class="miniproduct">
                                                                <div class="item01 d-flex">
                                                                    <div class="thumb">
                                                                        <a href="index.php?v=single-product&mmh=<?php echo $d->id?>">
                                                                        <?php echo "<img src='images/products/{$d->id}.{$d->ext_feature}' alt='product image' width='100'>";?>  
                                                                        </a>
                                                                    </div>
                                                                    <div class="content">
                                                                        <h6><a href="index.php?v=single-product&mmh=<?php echo $d->id?>"><?php echo $d->title?></a></h6>
                                                                        <span class="prize">Tk. <?php echo $d->price?></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php
                                                    }
                                                }
                                            }                                           
                                            
                                        ?>
                                        </div>
                                        <!-- <div class="mini_action cart mt-0">
                                            <a class="cart__btn" href="#"><b>Go to Checkout</b></a>
                                        </div> -->
                                    </div>
                                </div>
                                <!-- End Shopping Cart -->
                            </li>
                            <li class="setting__bar__icon">
                                <a class="setting__active" href="#"></a>
                                <div class="searchbar__content setting__block">
                                    <div class="content-inner">
                                        <div class="switcher-currency">
                                            <strong class="label switcher-label">
                                                <?php
												if(isset($_SESSION['id'])){
													echo '<span>Welcome '. $_SESSION['name'].'</span>';
												}
												else{
													echo '<span>My Account</span>';	
												}
											?>
                                            </strong>
                                            <div class="switcher-options">
                                                <div class="switcher-currency-trigger">
                                                    <div class="setting__menu">
                                                        <!-- <span><a href="#">My Account</a></span> -->
                                                        <!-- <span><a href="#">My Wishlist</a></span> -->
                                                        <?php
															if(isset($_SESSION['status']) && $_SESSION['status']==1){
                                                                echo '<span><a href="index.php?v=create_account">Create Admin</a></span>';
																echo "<span><a href='index.php?v=logout'onclick=\"return confirm('Are you sure you want to Log out?');\">Log Out</a><span>";
																
															}
															else if(isset($_SESSION['status']) && $_SESSION['status']==2){
                                                                echo '<span><a href="index.php?s=dashboard">My account</a></span>';
																echo "<span><a href='index.php?v=logout'onclick=\"return confirm('Are you sure you want to Log out?');\">Log Out</a><span>";
																
															}
															else if(isset($_SESSION['status']) && $_SESSION['status']==3){
                                                                echo '<span><a href="index.php?c=dashboard">My account</a></span>';
																echo "<span><a href='index.php?v=logout'onclick=\"return confirm('Are you sure you want to Log out?');\">Log Out</a><span>";
																
															}
															else if(isset($_SESSION['id'])){
																echo "<span><a href='index.php?v=logout'onclick=\"return confirm('Are you sure you want to Log out?');\">Log Out</a><span>";
															}
															else{
																echo '<span><a href="index.php?v=login">Log In</a></span>';
																echo '<span><a href="index.php?v=seller-new">Create seller account</a></span>';
																echo '<span><a href="index.php?v=customer-new">Create customer account</a></span>';
															}
														?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- Start Mobile Menu -->
                <div class="row d-none">
                    <div class="col-lg-12 d-none">
                        <nav class="mobilemenu__nav">
                            <ul class="meninmenu">
                                <li class="drop"><a href="index.php?v=home">Home</a></li>
                                <li class="drop"><a href="index.php?v=category/product_category&catId=16">Shop</a></li>
                                <li class="drop"><a href="index.php?v=pages">Pages</a></li>
                                <li class="drop"><a href="index.php?v=phone">Mobile</a></li>
                                <li class="drop"><a href="index.php?v=pages">Laptop</a></li>
                                <li class="drop"><a href="index.php?v=pages">Desktop</a></li>
                                <li class="drop"><a href="index.php?v=blog">Blog</a></li>
                                <li><a href="index.php?v=contact">Contact</a></li>
                                <?php
                                    if(isset($_SESSION['status']) && $_SESSION['status'] == 1){
                                        echo '<li class="background-success"><a href="index.php?a=dashboard">Dashboard</a></li>';
                                    }									
                                ?>                                
                            </ul>
                        </nav>
                    </div>
                </div>
                <!-- End Mobile Menu -->
                <div class="mobile-menu d-block d-lg-none">
                </div>
                <!-- Mobile Menu -->
            </div>
        </header>
        <!-- //Header -->
        <!-- Start Search Popup -->
        <div class="brown--color box-search-content search_active block-bg close__top">
            <form id="search_mini_form" class="minisearch" action="#">
                <div class="field__search">
                    <input type="text" placeholder="Search entire store here...">
                    <div class="action">
                        <a href="#"><i class="zmdi zmdi-search"></i></a>
                    </div>
                </div>
            </form>
            <div class="close__wrap">
                <span>close</span>
            </div>
        </div>
        <!-- End Search Popup -->