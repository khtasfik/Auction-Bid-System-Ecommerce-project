		 <?php
		   $myScript = [
		    "assets/js/jsMini/bid-price-check.js"
		  ];
		?>
		<!-- Start Bradcaump area -->
        <div class="ht__bradcaump__area bg-image--4">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="bradcaump__inner text-center">
                        	<h2 class="bradcaump-title">Shop Single</h2>
                            <nav class="bradcaump-content">
                              <a class="breadcrumb_item" href="index.php?v=home">Home</a>
                              <span class="brd-separetor">/</span>
                              <span class="breadcrumb_item active">Shop Single</span>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area -->
        <!-- Start main Content -->
        <div class="maincontent bg--white pt--80 pb--55">
        	<div class="container">
        		<div class="row">
        			<div class="col-lg-12 col-12">
        				<?php
					      $data = $om->View("product","*","", ['id'=>$_GET['mmh']]);
					      $d = $data->fetch_object();
							$id = $d->id;
							$title = $d->title;
							$price = $d->price;
							$subcat = $d->sub_category_id;
							$sortdes = $d->sortdes;
							$start_time = $d->start_time;
							$ext_feature = $d->ext_feature;
					   ?>
        				<div class="wn__single__product">
        					<div class="row">
        						<div class="col-lg-5 col-12">
        							<div class="wn__fotorama__wrapper">
	        							<div class="fotorama wn__fotorama__action" data-nav="thumbs">
	        								<a href=""><?php echo "<img src='images/products/$id.$ext_feature' alt=''>";?></a>
											<?php
												$pic_data = $om->View('pictures','*','',['product_id' => $_GET['mmh']]);
												while($picD = $pic_data->fetch_object()){
													$picid = $picD->id;
													$ext = $picD->ext;
													echo "<a href=''><img src='images/products/$picid.$ext' alt=''></a>";
												}
											?>
	        							</div>
        							</div>
        						</div>
        						<div class="col-lg-7 col-12">
        							<div class="product__info__main">
        								<h1><?php echo $title; ?></h1>              
              							<input type="hidden" name="pid" value="<?php echo $_GET['mmh'] ?>">
        								<div class="product-reviews-summary d-flex">
        									<ul class="rating-summary d-flex">
    											<li><i class="zmdi zmdi-star-outline"></i></li>
    											<li><i class="zmdi zmdi-star-outline"></i></li>
    											<li><i class="zmdi zmdi-star-outline"></i></li>
    											<li class="off"><i class="zmdi zmdi-star-outline"></i></li>
    											<li class="off"><i class="zmdi zmdi-star-outline"></i></li>
        									</ul>
        								</div>
        								<div class="price-box">
        									<span><?php echo $price; ?></span>
        								</div>
										<div class="product__overview">
        									<p><?php echo $sortdes?></p>
        								</div>
        								<div id="bidsuccess" class="alert alert-success alert-dismissible fade show" role="alert">
						                	<strong>Your bid has been successfully completed</strong>
											<button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true">&times;</span>
						                	</button>
						            	</div>
										<?php 
											$nobid = $om->View("bid_product","*");
											$nod = $nobid->fetch_object();
											$nobid_id = $nod->product_id;
											if($start_time < date("Y-m-d H:i:s")) {
												$sql = $om->dbRaw("SELECT bid_product.product_id as cid,bid_product.bid_price as bprice, customer.name as cname FROM bid_product, customer, product WHERE product.id = {$_GET['mmh']} AND bid_product.product_id = product.id AND bid_product.customers_id = customer.id  ORDER BY bid_price DESC LIMIT 1 ");
												if($sql->num_rows > 0){
													$d = $sql->fetch_object();
													?>
														<div class="bid_start_area bid_onwer_area text-white">
															<div class="row p-4">
																<div class="col-md-12">
																	<h5 class="text-center">Bid Winner Name : <?php echo $d->cname?></h5>
																</div>
																<div class="col-md-12">
																	<h5 class="text-center">Bid Winning Price : Tk. <?php echo $d->bprice?>.00</h5>
																</div>
																<?php															
																	if((isset($_SESSION['name']) && $_SESSION['name'] == $d->cname)){
																		$obj = $om->View("order_details","*","",['product_id'=>$_GET['mmh']]);
																		if($obj->num_rows > 0){
																			?>
																			<div class="col-md-12">
																				<h4 class="text-center artext">You Have Already Placed order.</h4>
																			</div>
																			<?php
																		}else{
																			?>
																				<div class="col-md-12">
																					<a class="btn bid_button shipping_address" href="index.php?c=checkout&pid=<?php echo $d->cid?>&bprice=<?php echo $d->bprice?>">Shipping Address</a>
																				</div>
																			<?php
																		}
																	}									
																?>
															</div> 
														</div>
													<?php
												}
												else{
													?>
														<h4 class="text-center artext">Bidding timed out! Please wait time will be extended.</h4>
													<?php													
												}
											}
											// BID-END TIME ELSE
											else{
												if(isset($_SESSION['status']) && $_SESSION['status']==3){
													?>
														<div class="bid_start_area">
														<!-- bid form  -->
															<div class="col-md-12">												
																<form action="" method="post">                      
																	<div class="form-row p-4 text-white">
																		<div class="col-md-12">
																			<div id="home_timer">
																				<span>Time Left : </span>
																				<div class="t_Days"></div>
																				<div class="t_Hour"></div>
																				<div class="t_Minutes"></div>
																				<div class="t_Seconds"></div>
																			</div>
																		</div>
																		<div class="col-md-3">
																			<label>Starting bid:</label>
																		</div>
																		<div class="col-md-5">
																			<label>
																				<h3>
																					<?php
																						$hightk = $price;
																						$order = ['bid_price','desc'];
																						$where = ['product_id'=>$_GET['mmh']];
																						$highest_bid = $om->View('bid_product','*',$order,$where);
																						if($highest_bid->num_rows > 0){
																							while($bidd = $highest_bid->fetch_object()){ 
																								$hightk = $bidd->bid_price; 
																								break;
																							}
																						}
																						echo "Tk <span id='min_bid'>$hightk</span>";
																					?>
																				</h3>
																			</label>
																		</div>
																		<div class="col-md-4">                         
																			<span id="bid_count"> 
																				<?php
																					$sql = $om->View("bid_product","*","",['product_id' => $_GET['mmh']]); 
																					$count = mysqli_num_rows($sql);
																					echo "[ $count bids ]";
																				?>
																			</span>
																		</div>
																		<div class="col-md-3"></div>
																		<div class="col-md-5">
																			<input type="number" class="form-control" name="bid_price">
																			<p class="error alert alert-danger">Too short price</p>     
																		</div>
																		<div class="col-md-4">
																			<input type="submit" name="submit_bid" value="Place bid" class="btn btn-primary">
																		</div>
																	</div>
																</form>	
															</div>
														</div>
													<?php
												}
												// BID TIME START ELSE
												else{
													?>
														<div class="box-tocart d-flex">
														<div class="addtocart__actions">
															<!-- <button class="tocart" type="submit" title="Add to Cart">Add to Cart</button> -->
														</div>
														<div class="bid_model_area">
														    <div class="m-t-10">
														        <h5>Please! Login First to see bid time & bid product</h5><br>
														    </div>
															<!-- Modal start  -->
															<!-- Button trigger modal -->
															<button type="button" class="btn btn-primary bid_button" data-toggle="modal" data-target="#bidModel">
																Place Bid
															</button>                   

															<!-- Modal -->
															<div class="modal fade" id="bidModel" tabindex="-1" role="dialog" aria-labelledby="bidModelTitle" aria-hidden="true">
																<div class="modal-dialog modal-dialog-centered" role="document">
																	<div class="modal-content">
																	<div class="modal-header">
																		<h5 class="modal-title" id="exampleModalLongTitle">Login</h5>
																		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																			<span aria-hidden="true">&times;</span>
																		</button>
																	</div>
																	<div class="modal-body">
																		<section class="my_account_area bg--white">
																			<div class="container">
																				<div class="row">
																				<div class="col-12">
																					<div class="my__account__wrapper">
																						<?php
																							if ($_SERVER['REQUEST_METHOD']=='POST') {
																							$msg = "";
																							if ($_POST['admin_email']=="") {
																								$msg.="Email Reauired <br>";
																							}
																							if ($_POST['admin_password']=="") {
																								$msg.="Password Reauired <br>";
																							}
																							if ($_POST['status']=="") {
																								$msg.="Status Reauired <br>";
																							}
																							if ($msg=="") {
																								$datalogin = [
																									"email" => $_POST['admin_email'],
																									"status" => $_POST['status'],
																									"password" => md5($_POST['admin_password'])
																								];
																								$results = $om->View("admin", "*", "", $datalogin);
																								$seller_results = $om->View("seller", "*", "", $datalogin);
																								$costomer_results = $om->View("customer", "*", "", $datalogin);
																								if ($results->num_rows > 0 OR $costomer_results->num_rows > 0 OR $seller_results->num_rows > 0 ) {
																									while ($datalogin = $results->fetch_object() OR $datalogin = $costomer_results->fetch_object() OR $datalogin = $seller_results->fetch_object()) {
																										$_SESSION['id'] = $datalogin->id;
																										$_SESSION['email'] = $datalogin->email;
																										$_SESSION['name'] = $datalogin->name;
																										$_SESSION['status'] = $_POST['status'];
																										if(isset($_SESSION['id'])){
																										echo "<script>window.location='".$url."'</script>";
																										}
																									}
																								}
																								else{
																									?>
																										<div class="alert alert-danger alert-dismissible fade show" role="alert">
																										<strong>Email or Password Not Match</strong>
																										<button type="button" class="close" data-dismiss="alert" aria-label="Close">
																											<span aria-hidden="true">&times;</span>
																										</button>
																										</div>
																									<?php
																								}

																							}
																							else{
																								echo $msg;
																							}
																							}
																						?>
																						<form action="" method="post">
																							<div class="account__form">
																							<div class="input__box">
																								<label>Username or email address<span>*</span></label>
																								<input type="text" name="admin_email">
																							</div>
																							<div class="input__box">
																								<label>Password<span>*</span></label>
																								<input type="password" name="admin_password">
																							</div>
																							<div class="input__box d-none">
																								<label>User Type
																								<span>*</span></label>
																								<select name="status" id="">
																									<option value="3">Customer</option>
																								</select>
																							</div>
																							<div class="form__btn">
																								<button>Login</button>
																								<button><a class="" href="index.php?v=customer-new">Create Account</a></button>
																							</div>																							
																							</div>
																						</form>
																					</div>
																				</div>
																				</div>
																			</div> 
																		</section>
																	</div>
																	</div>
																</div>
															</div>
															<!-- Modal End  -->
														</div>
														</div>
													<?php
												}												
											}
										?>

											<!-- History Start  -->

					<div class="row">
						<div class="col-md-12 animate-box" data-animate-effect="fadeInLeft">
							<div class="fancy-collapse-panel">
								<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
									<div class="panel panel-default">
									    <div class="panel-heading" role="tab" id="headingOne">
									        <h4 class="panel-title">
									            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Bid History
									            </a>
									        </h4>
									    </div>
									    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
									         <div class="panel-body">
									            <div class="row">
										      		<div class="col-md-12">

												<table>
										      			<tr>
														  <th>Name</th>
														  <th>Bid Price</th>
														  </tr>
													  <?php 
													$sql = $om->dbRaw("SELECT
													bid_product.bid_price AS bprice,
													customer.name AS cusname
												FROM
													bid_product,
													customer,
													product
												WHERE
													product.id = {$_GET['mmh']} AND bid_product.product_id = product.id AND bid_product.customers_id = customer.id GROUP BY bprice ORDER BY bprice DESC LIMIT 5");
													while($history = $sql->fetch_object()){
														$hid = $history->cusname;
														$bid = $history->bprice;
													
												?>
														  <tr>
														  	<th><?php echo $hid; ?></th>
															  <th><?php echo $bid; } ?> TK</th>
														  </tr>
														  </table>
										      		</div>
										      		
										      	</div>
									         </div>
									    </div>
									</div>
								</div>
							</div>
						</div>
					</div>
				

											<!-- History End  -->
										
										<div class="product_meta">
											<span class="posted_in">Categories:
												<?php 
													$sql = $om->dbRaw("SELECT category.id as catid, category.name as catname, sub_category.name as subname FROM product, sub_category, category WHERE product.id = {$_GET['mmh']} AND product.sub_category_id = sub_category.id AND sub_category.category_id = category.id");
													$d2 = $sql->fetch_object();
												$catid = $d2->catid;
												?>
												<a href="index.php?v=category/product_category&catId=<?php echo $d2->catid?>"><?php echo $d2->catname?></a>,
												<span><?php echo $d2->subname?></span>
											</span>
											</div>
											<div class="product-share">
											<ul>
												<li class="categories-title">Share :</li>
												<li> <a href="#"><i class="icon-social-twitter icons"></i></a> </li>
												<li> <a href="#"><i class="icon-social-tumblr icons"></i></a>  </li>
												<li> <a href="#"><i class="icon-social-facebook icons"></i></a> </li>
												<li> <a href="#"><i class="icon-social-linkedin icons"></i></a> </li>
											</ul>
											</div>
										</div>
        							</div>
        						</div>
        					</div>
							<div class="product__info__detailed">
								<div class="pro_details_nav nav justify-content-start" role="tablist">
									<a class="nav-item nav-link active" data-toggle="tab" href="#nav-details" role="tab">Details</a>
									<a class="nav-item nav-link" data-toggle="tab" href="#nav-review" role="tab">Reviews</a>
								</div>
								<div class="tab__container">
									<!-- Start Single Tab Content -->
									<div class="pro__tab_label tab-pane fade show active" id="nav-details" role="tabpanel">
										<div class="description__attribute">
											<?php
												$fopen = fopen("assets/text/product/$id.txt", "r");
												$fread = fread($fopen, filesize("assets/text/product/$id.txt"));
												fclose($fopen);
												echo "<p>$fread</p>";
											?>
										</div>
									</div>
									<!-- End Single Tab Content -->
									<!-- Start Single Tab Content -->
									<div class="pro__tab_label tab-pane fade" id="nav-review" role="tabpanel">
										<div class="review__attribute">
											<h1>Customer Reviews</h1>
											<h2>Hastech</h2>
											<div class="review__ratings__type d-flex">
												<div class="review-ratings">
													<div class="rating-summary d-flex">
														<span>Quality</span>
														<ul class="rating d-flex">
															<li><i class="zmdi zmdi-star"></i></li>
															<li><i class="zmdi zmdi-star"></i></li>
															<li><i class="zmdi zmdi-star"></i></li>
															<li class="off"><i class="zmdi zmdi-star"></i></li>
															<li class="off"><i class="zmdi zmdi-star"></i></li>
														</ul>
													</div>
													<div class="rating-summary d-flex">
														<span>Price</span>
														<ul class="rating d-flex">
															<li><i class="zmdi zmdi-star"></i></li>
															<li><i class="zmdi zmdi-star"></i></li>
															<li><i class="zmdi zmdi-star"></i></li>
															<li class="off"><i class="zmdi zmdi-star"></i></li>
															<li class="off"><i class="zmdi zmdi-star"></i></li>
														</ul>
													</div>
													<div class="rating-summary d-flex">
														<span>value</span>
														<ul class="rating d-flex">
															<li><i class="zmdi zmdi-star"></i></li>
															<li><i class="zmdi zmdi-star"></i></li>
															<li><i class="zmdi zmdi-star"></i></li>
															<li class="off"><i class="zmdi zmdi-star"></i></li>
															<li class="off"><i class="zmdi zmdi-star"></i></li>
														</ul>
													</div>
												</div>
												<div class="review-content">
													<p>Hastech</p>
													<p>Review by Hastech</p>
													<p>Posted on 11/6/2018</p>
												</div>
											</div>
										</div>
										<div class="review-fieldset">
											<h2>You're reviewing:</h2>
											<h3>Chaz Kangeroo Hoodie</h3>
											<div class="review-field-ratings">
												<div class="product-review-table">
													<div class="review-field-rating d-flex">
														<span>Quality</span>
														<ul class="rating d-flex">
															<li class="off"><i class="zmdi zmdi-star"></i></li>
															<li class="off"><i class="zmdi zmdi-star"></i></li>
															<li class="off"><i class="zmdi zmdi-star"></i></li>
															<li class="off"><i class="zmdi zmdi-star"></i></li>
															<li class="off"><i class="zmdi zmdi-star"></i></li>
														</ul>
													</div>
													<div class="review-field-rating d-flex">
														<span>Price</span>
														<ul class="rating d-flex">
															<li class="off"><i class="zmdi zmdi-star"></i></li>
															<li class="off"><i class="zmdi zmdi-star"></i></li>
															<li class="off"><i class="zmdi zmdi-star"></i></li>
															<li class="off"><i class="zmdi zmdi-star"></i></li>
															<li class="off"><i class="zmdi zmdi-star"></i></li>
														</ul>
													</div>
													<div class="review-field-rating d-flex">
														<span>Value</span>
														<ul class="rating d-flex">
															<li class="off"><i class="zmdi zmdi-star"></i></li>
															<li class="off"><i class="zmdi zmdi-star"></i></li>
															<li class="off"><i class="zmdi zmdi-star"></i></li>
															<li class="off"><i class="zmdi zmdi-star"></i></li>
															<li class="off"><i class="zmdi zmdi-star"></i></li>
														</ul>
													</div>
												</div>
											</div>
											<div class="review_form_field">
												<div class="input__box">
													<span>Nickname</span>
													<input id="nickname_field" type="text" name="nickname">
												</div>
												<div class="input__box">
													<span>Summary</span>
													<input id="summery_field" type="text" name="summery">
												</div>
												<div class="input__box">
													<span>Review</span>
													<textarea name="review"></textarea>
												</div>
												<div class="review-form-actions">
													<button>Submit Review</button>
												</div>
											</div>
										</div>
									</div>
									<!-- End Single Tab Content -->
								</div>
							</div>
							<div class="wn__related__product pt--80 pb--50">
								<div class="section__title text-center">
									<h2 class="title__be--2">Related Products</h2>
								</div>
								<div class="row mt--60">
									<div class="productcategory__slide--2 arrows_style owl-carousel owl-theme">
										<?php 
											$sql = $om->dbRaw("select product.* from product, sub_category where product.id != {$_GET['mmh']} and product.sub_category_id = sub_category.id and sub_category.category_id = $catid  order by rand() limit 5");
											while($d = $sql->fetch_object()){
											?>
											<!-- Start Single Product -->
												<div class="product product__style--3 col-lg-4 col-md-4 col-sm-6 col-12">
													<div class="product__thumb">
														<a class="first__img" href="">
														<?php 
															echo "<img src='images/products/{$d->id}.{$d->ext_feature}' alt='product image' width='100'>";
														?>
														</a>
														<a class="second__img animation1" href="index.php?v=single-product&mmh=<?php echo $d->id?>">
														<?php 
															echo "<img src='images/products/{$d->id}.{$d->ext_feature}' alt='product image' width='100'>";
														?>
														</a>
														<div class="hot__box">
														<span class="hot-label">BEST SALLER</span>
														</div>
													</div>
													<div class="product__content content--center">
														<h4><a href="single-product.html"><?php echo $d->title?></a></h4>
														<ul class="prize d-flex">
														<li><?php echo $d->price ?></li>
														</ul>
														<div class="action">
														<div class="actions_inner">
															<ul class="add_to_links">
																<li><a class="cart" href="cart.html"><i class="bi bi-shopping-bag4"></i></a></li>
																<li><a class="wishlist" href="wishlist.html"><i class="bi bi-shopping-cart-full"></i></a></li>
																<li><a class="compare" href="#"><i class="bi bi-heart-beat"></i></a></li>
																<li><a data-toggle="modal" title="Quick View" class="quickview modal-view detail-link" data-target="#a<?php echo $d->id ?>" ><i class="bi bi-search"></i></a></li>
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
									</div>
								</div>
							</div>
        				</div>
        			</div>
        		</div>
        	</div>
        <!-- End main Content -->
		<!-- Start Search Popup -->
		<div class="box-search-content search_active block-bg close__top">
			<form id="search_mini_form--2" class="minisearch" action="#">
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
	

	</div>
	<!-- //Main wrapper -->

	<script>
	    var countDownDate = new Date("<?php echo $start_time; ?>").toLocaleString("en-US", { timeZone: "Asia/Dhaka" });
	    countDownDate = new Date(countDownDate);
	    var add_zero_for_single = function (v) {
	      if (parseInt(v) < 10) {
	        return "0" + v;
	      } else {
	        return v;
	      }
	    }

	    // Update the count down every 1 second
	    var x = setInterval(function () {

	      // Get today's date and time
	      var now = new Date().getTime();

	      // Find the distance between now and the count down date
	      var distance = countDownDate - now;
	      // Time calculations for days, hours, minutes and seconds
	      var days = Math.floor(distance / (1000 * 60 * 60 * 24));
	      var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
	      var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
	      var seconds = Math.floor((distance % (1000 * 60)) / 1000);

	      // Output the result in an element with id="demo"
	      $("#home_timer .t_Days").html(languageNumber(add_zero_for_single(days)));
	      $("#home_timer .t_Hour").html(languageNumber(add_zero_for_single(hours)));
	      $("#home_timer .t_Minutes").html(languageNumber(add_zero_for_single(minutes)));
	      $("#home_timer .t_Seconds").html(languageNumber(add_zero_for_single(seconds)));

	      // If the count down is over, write some text 
	      if (distance < 0) {
	        clearInterval(x);
	        $("#home_timer").html("");
	      }
	    }, 1000);

	    function languageNumber(data) {
	      data = data.toString();
	      return data;
	    }

  </script>


