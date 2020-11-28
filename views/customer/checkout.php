<?php	
    $myScript = [
        "assets/js/jsMini/customer-email-check.js"
    ];
?>
		<!-- Start Bradcaump area -->
        <div class="ht__bradcaump__area bg-image--4">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="bradcaump__inner text-center">
                        	<h2 class="bradcaump-title">Checkout</h2>
                            <nav class="bradcaump-content">
                              <a class="breadcrumb_item" href="index.php?v=home">Home</a>
                              <span class="brd-separetor">/</span>
                              <span class="breadcrumb_item active">Checkout</span>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area -->
        <!-- Start Checkout Area -->
        <section class="wn__checkout__area section-padding--lg bg__white">
        	<div class="container">
        		<div class="row">
        			<div class="col-lg-6 col-12">
        				<div class="customer_details">
        					<h3>Billing Details</h3>
							<?php
								if ($_SERVER['REQUEST_METHOD']=='POST') {
									$msg = "";
									if ($_POST['fname']=="") {
										$msg.="First Name Required <br>";
									}
									if ($_POST['lname']=="") {
										$msg.="Last Name Required <br>";
									}									
									if ($_POST['country'] < 1) {
										$msg.="Country Name Required <br>";
									}
									if ($_POST['city_id'] < 1) {
										$msg.="City Name Required <br>";
									}									
									if ($_POST['address']=="") {
										$msg.="Address Required <br>";
									}
									if ($_POST['postcode']=="") {
										$msg.="Post code Required <br>";
									}
									if ($_POST['contact']=="") {
										$msg.="Phone No Required <br>";
									}
									if ($_POST['email']=="") {
										$msg.="Email Required <br>";
									}
									if ($_POST['paymethod'] < 1) {
										$msg.="Payment method Required <br>";
									}
									if ($msg=="") {
										$results = $om->View("shipping", "*","", array("customers_id" => $_SESSION['id']));
										$result = $results->fetch_object();
										$data = [
											'fname' => $_POST['fname'], 
											'lname' => $_POST['lname'], 
											'city_id' => $_POST['city_id'],
											'address' => $_POST['address'],
											'postcode' => $_POST['postcode'],
											'contact' => $_POST['contact'],
											'customers_id' => $_SESSION['id'],
											'email' => $_POST['email']
										];
										if($om->update("shipping", $data,array("customers_id" => $_SESSION['id']))){
											echo "<script>window.location='index.php?c=customer-orders'</script>";
										}

										if ($om->insert("shipping", $data)) {
											$sid = $om->Id;
											$datapay = [
												'payment_method_id' => $_POST['paymethod'],
												'transaction_number' => $_POST['bkash'],
												'delivery_date' => date("Y-m-d", strtotime("+5 Day")),
												'shipping_id' => $sid		
											];											
											if($om->insert("orders", $datapay)){
												$oid = $om->Id;
												$orderdata = [
													'orders_id' => $oid,
													'product_id' => $_GET['pid'],
													'quentity' => '1',
													'price' => $_GET['bprice'],
													'vat' => $_POST['hvat'],
													'discount' =>$_POST['hdis'],
													'total' =>$_POST['htotal']
												];										
												$om->insert("order_details", $orderdata);
											}
											
											?>

											<div class="alert alert-success alert-dismissible fade show" role="alert">
												<strong>Order Successfully</strong>
												<button type="button" class="close" data-dismiss="alert" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<?php
											echo "<script>window.location='index.php?c=customer-orders'</script>";
											
										} 
									}
									else{
										?>
										<div class="alert alert-danger alert-dismissible fade show" role="alert">
											<strong><?php echo $msg;?></strong>
											<button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<?php
									}
								}
								
							?>
							<?php 
								$where = [
									"customers_id" => $_SESSION['id'],
									];
					
								$results = $om->View("shipping", "*", "", $where,"",1);
								if($results->num_rows >0){
									while ($result = $results->fetch_object()) {
										?>
										<form action="" method="post">
											<div class="customar__field">
												<div class="margin_between">
													<div class="input_box space_between">
														<label>First name <span>*</span></label>
														<input name="fname" type="text" value="<?php echo $result->fname?>">
													</div>
													<div class="input_box space_between">
														<label>Last name <span>*</span></label>
														<input name="lname" type="text" value="<?php echo $result->lname?>">
													</div>
												</div>
												<div class="input_box">
													<label>Country<span>*</span></label>
													<select  name="country" class="select__option">
													<option value="0">Choose Country</option>
													<?php 
														$order = array("name", "asc");
														$select = "id, name,country_id";
														$city = $om->View("city",$select, $order);
														while($d = $city->fetch_object()){
															if ($d->id==$result->city_id) {
																$order = array("name", "asc");
																$select = "id, name";
																$conty = $om->View("country",$select, $order);
																while($dd = $conty->fetch_object()){
																	if ($dd->id==$d->country_id) {
																		echo "<option selected value='$dd->id'>{$dd->name}</option>";
																	}
																	else{
																		echo "<option value='$dd->id'>{$dd->name}</option>";
																	}
																	
																}
															
															}
														}
													?>
													</select>
												</div>
												<div class="input_box">
													<label>District<span>*</span></label>
													<select name = "city_id" class="select__option">
														<option value="0">Choose Country First</option>
														<?php 
															$order = array("name", "asc");
															$select = "id, name";
															$cuid = $om->View("city",$select, $order);
															while($d = $cuid->fetch_object()){
																if($d->id == $result->city_id){
																	echo "<option value='$d->id' selected>{$d->name}</option>";
																}
																else{
																echo "<option value='$d->id'>{$d->name}</option>";
															} 
														}                           
														?>
													</select>
												</div>
												<div class="input_box">
													<label>Address <span>*</span></label>
													<input name="address" type="text" placeholder="Street address" value="<?php echo $result->address?>">
												</div>
												<div class="input_box">
													<label>Postcode / ZIP <span>*</span></label>
													<input name="postcode" type="number" value="<?php echo $result->postcode?>">
												</div>
												<div class="margin_between">
													<div class="input_box space_between">
														<label>Phone <span>*</span></label>
														<input name ="contact" type="text" value="<?php echo $result->contact?>">
													</div>
	
													<div class="input_box space_between">
														<label>Email address <span>*</span></label>
														<input name="email" type="email" value="<?php echo $result->email?>">
													</div>
												</div>
											</div>
										</div>
										<?php									
									}									
								}
								else{
									?>
										<form action="" method="post">
											<div class="customar__field">
												<div class="margin_between">
													<div class="input_box space_between">
														<label>First name <span>*</span></label>
														<input name="fname" type="text" value="">
													</div>
													<div class="input_box space_between">
														<label>Last name <span>*</span></label>
														<input name="lname" type="text" value="">
													</div>
												</div>
												<div class="input_box">
													<label>Country<span>*</span></label>
													<select  name="country" class="select__option">
													<option value="0">Choose Country</option>
													<?php 
														$order = array("name", "asc");
														$select = "id, name";
														$cuid = $om->View("country",$select, $order);
														while($d = $cuid->fetch_object()){
															echo "<option value='$d->id'>{$d->name}</option>";
															}
														?>
													</select>
												</div>
												<div class="input_box">
													<label>District<span>*</span></label>
													<select name = "city_id" class="select__option">
														<option value="0">Choose Country First</option>	
													</select>
												</div>
												<div class="input_box">
													<label>Address <span>*</span></label>
													<input name="address" type="text" placeholder="Street address" value="">
												</div>
												<div class="input_box">
													<label>Postcode / ZIP <span>*</span></label>
													<input name="postcode" type="number" value="">
												</div>
												<div class="margin_between">
													<div class="input_box space_between">
														<label>Phone <span>*</span></label>
														<input name ="contact" type="text" value="">
													</div>
	
													<div class="input_box space_between">
														<label>Email address <span>*</span></label>
														<input name="email" type="email" value="">
													</div>
												</div>
											</div>
										</div>
									<?php
								}
								
							?>
						</div>
						<div class="col-lg-6 col-12 md-mt-40 sm-mt-40">
							<div class="wn__order__box">
								<h3 class="onder__title">Your order</h3>
								<ul class="order__total">
									<li>Product</li>
									<li>Total</li>
								</ul>
								<ul class="order_product">
									<?php 
										$sql = $om->dbRaw("
										SELECT
										product.title,
										product.vat,
										product.discount,
										bid_product.bid_price as bprice
									FROM
										product,
										bid_product
									WHERE
										product.id = {$_GET['pid']} and
										bid_product.product_id = {$_GET['pid']}
										");
										$d = $sql->fetch_object();
									?>
									<input type="hidden" name="hvat" value="<?php echo $d->vat; ?>">						
									<input type="hidden" name="hdis" value="<?php echo $d->discount; ?>">					
									<li><?php echo $d->title; ?><span>Tk. <?php echo $_GET['bprice']; ?>.00</span></li>
									<li>Vat<span>Tk. <?php echo $vat = $_GET['bprice'] * $d->vat / 100; ?>.00</span></li>
								</ul>
								<ul class="shipping__method">
									<li>Subtotal <span>Tk. <?php echo $subtotal = $_GET['bprice'] + $vat; ?>.00</span></li> 
								</ul>
								<ul class="shipping__method">
									<li>Discount <span>Tk. <?php echo $discount = $_GET['bprice'] * $d->discount / 100; ?>.00</span></li> 
								</ul>
								<ul class="total__amount">
									<li>Order Total <span>Tk. <?php echo $total = $subtotal - $discount ?>.00</span></li>
								</ul>														
								<input type="hidden" name="htotal" value="<?php echo $total; ?>">	
							</div>
							
							<div id="accordion" class="checkout_accordion mt--30" role="tablist">
								<div class="input_box">
									<select id="payment" name="paymethod" class="select__option">
									<option value="0">Payment Method</option>
									<?php 
										$order = array("id", "asc");
										$select = "id, name";
										$cuid = $om->View("payment_method",$select, $order);
										while($d = $cuid->fetch_object()){
											echo "<option value='$d->id'>{$d->name}</option>";
											}
										?>
									</select>
								</div>
								<div class="input_box pt-3 bkash">
									<label class="text-danger"><B>Bkash Payment Number 01717 971 904</B></label>
									<input class="form-control" name="bkash" type="text" placeholder="Bkash Transaction Id">
								</div>
								<div class="input_box pt-3 rocket">
									<label class="text-danger"><B>Rocket Payment Number 01717 971 904</B></label>
									<input class="form-control" name="bkash" type="text" placeholder="Rocket Transaction Id">
								</div>	
								
								<div class="card mt-2">

                                <!-- form card cc payment -->
                    <div class="card card-outline-secondary">
                        <div class="card-body">
                            <!-- <h3 class="text-center">Credit Card Payment</h3>
                            <hr>
                            <div class="alert alert-info p-2 pb-3">
                                <a class="close font-weight-normal initialism" data-dismiss="alert" href="#"><samp>×</samp></a> 
                                CVC code is required.
                            </div> -->
                            <form class="form" role="form" autocomplete="off">
                                <div class="form-group">
                                    <label for="cc_name">Card Holder's Name</label>
                                    <input type="text" class="form-control" id="cc_name" pattern="\w+ \w+.*" title="First and last name" required="required">
                                </div>
                                <div class="form-group">
                                    <label>Card Number</label>
                                    <input type="text" class="form-control" autocomplete="off" maxlength="20" pattern="\d{16}" title="Credit card number" required="">
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-12">Card Exp. Date</label>
                                    <div class="col-md-4">
                                        <select class="form-control" name="cc_exp_mo" size="0">
                                            <option value="01">01</option>
                                            <option value="02">02</option>
                                            <option value="03">03</option>
                                            <option value="04">04</option>
                                            <option value="05">05</option>
                                            <option value="06">06</option>
                                            <option value="07">07</option>
                                            <option value="08">08</option>
                                            <option value="09">09</option>
                                            <option value="10">10</option>
                                            <option value="11">11</option>
                                            <option value="12">12</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <select class="form-control" name="cc_exp_yr" size="0">
                                            <option>2018</option>
                                            <option>2019</option>
                                            <option>2020</option>
                                            <option>2021</option>
                                            <option>2022</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" autocomplete="off" maxlength="3" pattern="\d{3}" title="Three digits at back of your card" required="" placeholder="CVC">
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-md-12">Amount</label>
                                </div>
                                <div class="form-inline">
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text">$</span></div>
                                        <input type="text" class="form-control text-right" id="exampleInputAmount" placeholder="39">
                                        <div class="input-group-append"><span class="input-group-text">.00</span></div>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <button type="reset" class="btn btn-default btn-lg btn-block">Cancel</button>
                                    </div>
                                    <div class="col-md-6">
                                        <button type="submit" class="btn btn-success btn-lg btn-block">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /form card cc payment -->

								</div>

								<input class="btn btn-info mt-3" type="submit" value="Submit">
							</div>
						</form>
        			</div>
        		</div>
        	</div>
        </section>
        <!-- End Checkout Area -->