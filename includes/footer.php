		<!-- Footer Area -->
		<footer id="wn__footer" class="footer__area bg__cat--8 brown--color">
		    <div class="footer-static-top">
		        <div class="container">
		            <div class="row">
		                <div class="col-lg-12">
		                    <div class="footer__widget footer__menu">
		                        <div class="ft__logo">
		                            <a href="index.php?v=home">
		                                <img src="assets/images/logo/khti.png" alt="logo" width="66">
		                            </a>
		                            <p>There are many variations of passages of Lorem Ipsum available, but the majority have
		                                suffered duskam alteration variations of passages</p>
		                        </div>
		                        <div class="footer__content">
		                            <ul class="social__net social__net--2 d-flex justify-content-center">
		                                <li><a href="#"><i class="bi bi-facebook"></i></a></li>
		                                <li><a href="#"><i class="bi bi-google"></i></a></li>
		                                <li><a href="#"><i class="bi bi-twitter"></i></a></li>
		                                <li><a href="#"><i class="bi bi-linkedin"></i></a></li>
		                                <li><a href="#"><i class="bi bi-youtube"></i></a></li>
		                            </ul>
		                            <ul class="mainmenu d-flex justify-content-center">
		                                <li><a href="index.php?v=category/product_category&catId=16">Trending</a></li>
		                                <li><a href="index.php?v=category/product_category&catId=16">Best Seller</a></li>
		                                <li><a href="index.php?v=category/product_category&catId=16">All Product</a></li>
		                                <li><a href="#">Blog</a></li>
		                                <li><a href="index.php?v=contact">Contact</a></li>
		                            </ul>
		                        </div>
		                    </div>
		                </div>
		            </div>
		        </div>
		    </div>
		    <div class="copyright__wrapper">
		        <div class="container">
		            <div class="row">
		                <div class="col-lg-6 col-md-6 col-sm-12">
		                    <div class="copyright">
		                        <div class="copy__right__inner text-left">
		                            <p>Copyright <i class="fa fa-copyright"></i> <a href="#">coderas@d.com</a> All Rights Reserved</p>
		                        </div>
		                    </div>
		                </div>
		                <div class="col-lg-6 col-md-6 col-sm-12">
		                    <div class="payment text-right">
		                        <img src="assets/images/icons/payment.png" alt="" />
		                    </div>
		                </div>
		            </div>
		        </div>
		    </div>
		</footer>
		<!-- //Footer Area -->
		<!-- QUICKVIEW PRODUCT -->
        <?php 
            $sql = $om->View('product', '*');
            while($d = $sql->fetch_object()) {                
                $id = $d->id;
                $title = $d->title;
                $price = $d->price;
                $sortdes = $d->sortdes;
            ?>
    
            <div id="quickview-wrapper">
                <div class="modal fade" id="a<?php echo $id ?>" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal__container" role="document">
                        <div class="modal-content">
                            <div class="modal-header modal__header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <div class="modal-product">
                                    <!-- Start product images -->
                                    <div class="product-images">
                                        <div class="main-image images">
                                            <?php 
                                                if (file_exists("images/products/{$d->id}.{$d->ext_feature}")) {
                                                    echo "<img src='images/products/{$d->id}.{$d->ext_feature}' alt=''>";
                                                }
                                            ?>
                                        </div>
                                    </div>
                                    <!-- end product images -->
                                    <div class="product-info">
                                        <h1><?php echo $title ?></h1>
                                        <div class="rating__and__review">
                                            <ul class="rating">
                                                <li><span class="ti-star"></span></li>
                                                <li><span class="ti-star"></span></li>
                                                <li><span class="ti-star"></span></li>
                                                <li><span class="ti-star"></span></li>
                                                <li><span class="ti-star"></span></li>
                                            </ul>
                                            <div class="review">
                                                <a href="#">4 customer reviews</a>
                                            </div>
                                        </div>
                                        <div class="price-box-3">
                                            <div class="s-price-box">
                                                <span class="new-price">Tk. <?php echo $price ?></span>
                                            </div>
                                        </div>
                                        <div class="quick-desc">
                                        <?php echo $sortdes ?>
                                        </div>
                                        <div class="social-sharing">
                                            <div class="widget widget_socialsharing_widget">
                                                <h3 class="widget-title-modal">Share this product</h3>
                                                <ul class="social__net social__net--2 d-flex justify-content-start">
                                                    <li class="facebook"><a href="#" class="rss social-icon"><i
                                                                class="zmdi zmdi-rss"></i></a></li>
                                                    <li class="linkedin"><a href="#" class="linkedin social-icon"><i
                                                                class="zmdi zmdi-linkedin"></i></a></li>
                                                    <li class="pinterest"><a href="#" class="pinterest social-icon"><i
                                                                class="zmdi zmdi-pinterest"></i></a></li>
                                                    <li class="tumblr"><a href="#" class="tumblr social-icon"><i
                                                                class="zmdi zmdi-tumblr"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>                
                        </div>
                    </div>
                </div>
            </div>
            <?php
                };                    
            ?>
		
		<!-- END QUICKVIEW PRODUCT -->
		
		</div>
		<!-- //Main wrapper -->

		<!-- JS Files -->
		<script src="assets/js/popper.min.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
		<script src="assets/js/plugins.js"></script>
		<script src="assets/js/active.js"></script>
        <script>
            $("document").ready(function () {
                'use strict';
                var printBtn = $('.print-btn');
                printBtn.click(function () {
                    window.print();
                });
            });
        </script>

		<?php
			if(isset($myScript)){
				foreach($myScript as $value){
					echo "<script src='{$value}'></script>";
				}
			}
		?>


		</body>

		</html>