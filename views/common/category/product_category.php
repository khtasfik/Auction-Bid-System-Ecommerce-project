<?php 
    $myScript = [
        "assets/js/jsMini/product-sub-category.js"
    ];
?>

        <!-- Start Bradcaump area -->
        <div class="ht__bradcaump__area bg-image--6 arposition">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="bradcaump__inner text-center">
                        	<h2 class="bradcaump-title">Shop Grid</h2>
                            <nav class="bradcaump-content">
								<a class="breadcrumb_item" href="index.php?v=home">Home</a>
								<span class="brd-separetor">/</span>
								<span class="breadcrumb_item active">Category</span>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area -->
        <!-- Start Shop Page -->
        <div class="page-shop-sidebar left--sidebar bg--white section-padding--lg">
			<div class="container">
				<div class="row">
					<div class="col-lg-3 col-12 order-2 order-lg-1 md-mt-40 sm-mt-40">
						<div class="shop__sidebar">
							<aside class="wedget__categories poroduct--cat">
								<h3 class="wedget__title">Product Categories</h3>
								<ul>
								<?php 								
									$results = $om->dbRaw("SELECT category.*, (SELECT COUNT(product.id) from product, sub_category WHERE product.sub_category_id = sub_category.id AND sub_category.category_id = category.id) as total  
									from category");									
									while($d = $results->fetch_object()){									
										echo "<li><a href='index.php?v=category/product_category&catId=$d->id'> $d->name <span>({$d->total})</span></a></li>";								
									}								
								?>
								</ul>
        					</aside>
        				</div>
        			</div>
        			<div class="col-lg-9 col-12 order-1 order-lg-2">
        				<div class="row">
        					<div class="col-lg-12">
								<div class="shop__list__wrapper d-flex flex-wrap flex-md-nowrap justify-content-between">
									<div class="shop__list nav justify-content-center" role="tablist">
			                            <a class="nav-item nav-link active" data-toggle="tab" href="#nav-grid" role="tab"><i class="fa fa-th"></i></a>
			                            <a class="nav-item nav-link" data-toggle="tab" href="#nav-list" role="tab"><i class="fa fa-list"></i></a>
			                        </div>
			                        <?php 
			                        	$results = $om->dbRaw("SELECT COUNT(product.id) as count from product, sub_category WHERE product.sub_category_id = sub_category.id AND sub_category.category_id ={$_GET['catId']} ");	
			                        	$d = $results->fetch_object();
			                        ?>
			                        <p><?php echo "Showing 1 - $d->count of $d->count"; ?> results</p>
			                        <div class="orderby__wrapper">
			                        	<form action="" method="post">
			                        	<span>Sort By</span>
										<select name="sub_category" class="shot__byselect">
			                        		<option value="0">Default sorting</option>
											<?php 							
												$sqlsub = $om->View("sub_category","*","",['category_id'=>$_GET['catId']]);
												while($d2 = $sqlsub->fetch_object()){
												$subcat = $d2->name;
												$subcatid = $d2->id;
												echo "<option value='$subcatid'>{$subcat}</option>";
												};
												
											?>
			                        	</select>
										</form>
			                        </div>
		                        </div>
        					</div>
        				</div>
        				<div class="tab__container">
	        				<div class=" shop-grid tab-pane fade show active" id="nav-grid" role="tabpanel">
	        					<div class="row artest">
	        						<!-- Start Single Product -->
									<?php 
									$pretotal = $om->dbRaw("SELECT count(product.id) as pretotal FROM sub_category,product WHERE sub_category.category_id = {$_GET['catId']} AND sub_category.id = product.sub_category_id");	
									$per_page = 6;	
									$page = 1;
									// if(isset($_GET['page'])){
									// 	$page = $_GET['page'];
									// } 
									$start = ($per_page - 1) * $page;
									while($d = $pretotal->fetch_object()){
										$stotal = $d->pretotal;
									} 
									$sqlpro = $om->dbRaw("SELECT product.* FROM sub_category,product WHERE sub_category.category_id = {$_GET['catId']} AND sub_category.id = product.sub_category_id limit $per_page");
									while($d = $sqlpro->fetch_object()){
										$id = $d->id;
										$title = $d->title;
										$price = $d->price;
										?>										
										<!-- Start Single Product -->
										<div class="box-shadow product product__style--3 col-lg-4 col-md-4 col-sm-6 col-12">
											<div class="product__thumb">
											<a class="first__img" href="">
											<?php 
												if (file_exists("images/products/{$d->id}.{$d->ext_feature}")) {
													echo "<img src='images/products/{$d->id}.{$d->ext_feature}' alt='product image' width='100'>";
												}
											?>
											</a>
											<a class="second__img animation1"
												href="index.php?v=single-product&mmh=<?php echo $d->id?>"><?php
												if (file_exists("images/products/{$d->id}.{$d->ext_feature}")) {
												echo "<img src='images/products/{$d->id}.{$d->ext_feature}' alt='product image'
													width='100'>";
												}
												?>
											</a>
												<div class="hot__box color--2">
													<span class="hot-label">HOT</span>
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
														<li><a class="cart" href="#"><i class="bi bi-shopping-bag4"></i></a>
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
										<!-- End Single Product -->
										<?php
															
									}						
								?>
								</div>																
							<ul class="wn__pagination">
								<li><a href="#"><i class="zmdi zmdi-chevron-left"></i></a></li>
								<?php 
									$count = 1;
									for ($i=1; $i <= $stotal; $i+= $per_page) { 
										if($count == $page){
											echo "<li class=''><a class='active' href=''>{$count}</a></li>";									
										}
										else{
											echo "<li class=''><a href=''>{$count}</a></li>";
										}
										$count++;										
									}
								?>								
								<li><a href="#"><i class="zmdi zmdi-chevron-right"></i></a></li>
							</ul>
						</div>
						<div class="shop-grid tab-pane fade" id="nav-list" role="tabpanel">
							<div class="list__view__wrapper">
								<?php 		  
									$sqlsub = $om->View("sub_category","*","",['category_id'=>$_GET['catId']]);
									while($d2 = $sqlsub->fetch_object()){
										$subcat = $d2->id;
										$sqlpro = $om->View("product","*","",['sub_category_id'=>$subcat]);
										while($d = $sqlpro->fetch_object()){
											$id = $d->id;
											$title = $d->title;
											$price = $d->price;
											?>	
											<!-- Start Single Product -->
											<div class="border-box list__view mt--40">
											<div class="thumb">
												<a class="first__img" href="">
												<?php 
													if (file_exists("images/products/{$d->id}.{$d->ext_feature}")) {
														echo "<img src='images/products/{$d->id}.{$d->ext_feature}' alt='product image' width='100'>";
													}
												?>
												</a>
												<a class="second__img animation1"
													href="index.php?v=single-product&mmh=<?php echo $d->id?>"><?php
													if (file_exists("images/products/{$d->id}.{$d->ext_feature}")) {
													echo "<img src='images/products/{$d->id}.{$d->ext_feature}' alt='product image'
														width='100'>";
													}
													?>
												</a>
											</div>
											<div class="content">
												<h4><a href="index.php?v=single-product&mmh=<?php echo $d->id?>"><?php echo $title?></a></h4>
												<ul class="rating d-flex">
													<li class="on"><i class="fa fa-star-o"></i></li>
													<li class="on"><i class="fa fa-star-o"></i></li>
													<li class="on"><i class="fa fa-star-o"></i></li>
													<li class="on"><i class="fa fa-star-o"></i></li>
													<li><i class="fa fa-star-o"></i></li>
													<li><i class="fa fa-star-o"></i></li>
												</ul>
												<ul class="prize__box">
													<li><?php echo $price?></li>
												</ul>
												<p>
												<?php
													echo $d->sortdes;
													// $fopen = fopen("assets/text/product/$id.txt", "r");
													// $fread = fread($fopen, filesize("assets/text/product/$id.txt"));
													// fclose($fopen);
													// echo "<p>$fread</p>";
													?>
												</p>
												
												<ul class="cart__action d-flex">
													<!-- <li class="cart"><a href="index.php?v=single-product&mmh=<?php echo $d->id?>">Place Bid</a></li> -->
													<li class="wishlist">
													<input type="submit" name="submit_bid" value="Place bid" class="btn btn-primary">
													</li>
													<li class="wishlist"><a href="#"></a></li>
													<li class="compare"><a href="#"></a></li>
												</ul>
											</div>										

										</div>
										<!-- End Single Product -->
											<?php
										}
									}
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
        <!-- End Shop Page -->