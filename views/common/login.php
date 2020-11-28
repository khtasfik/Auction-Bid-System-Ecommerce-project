        <!-- Start Bradcaump area -->
        <div class="ht__bradcaump__area bg-image--6 arposition">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="bradcaump__inner text-center">
                            <h2 class="bradcaump-title">My Account</h2>
                            <nav class="bradcaump-content">
                                <a class="breadcrumb_item" href="index.php?v=home">Home</a>
                                <span class="brd-separetor">/</span>
                                <span class="breadcrumb_item active">Log In</span>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area -->
        <!-- Start My Account Area -->
        <section class="my_account_area pt--80 pb--55 bg--white">
            <div class="container">
                <div class="row">
                    <div class="offset-3 col-lg-6 col-12">
                        <div class="my__account__wrapper">
                            <h3 class="account__title">Login</h3>
                            
                            <p><strong>Admin:</strong> admin@gmail.com <strong>pass:</strong> 12345</p>
                            <p><strong>Seller:</strong> seller@gmail.com <strong>pass:</strong> 123</p>
                            <p><strong>Customer:</strong> tanzila@gmail.com <strong>pass:</strong> 12345678</p>

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
										$data = [
											"email" => $_POST['admin_email'],
											"status" => $_POST['status'],
											"password" => md5($_POST['admin_password'])
										];						

										$results = $om->View("admin", "*", "", $data);
										$seller_results = $om->View("seller", "*", "", $data);
										$costomer_results = $om->View("customer", "*", "", $data);
										if ($results->num_rows > 0 OR $costomer_results->num_rows > 0 OR $seller_results->num_rows > 0 ) {
											
											while ($data = $results->fetch_object() OR $data = $costomer_results->fetch_object() OR $data = $seller_results->fetch_object()) {
												$_SESSION['id'] = $data->id;
												$_SESSION['email'] = $data->email;
												$_SESSION['name'] = $data->name;
												$_SESSION['status'] = $_POST['status'];
											
												if(isset($_SESSION['status']) && $_SESSION['status'] == 1){
													echo "<script>window.location='index.php?a=dashboard';</script>";
												}
												else if(isset($_SESSION['status']) && $_SESSION['status'] == 2){
													echo "<script>window.location='index.php?s=dashboard';</script>";
												}
												else if(isset($_SESSION['status']) && $_SESSION['status'] == 3){
													echo "<script>window.location='index.php?c=dashboard';</script>";
												}
												else{echo "<script>window.location='index.php?v=home';</script>";
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
                                        <label>Username or email address <span>*</span></label>
                                        <input type="text" name="admin_email">
                                    </div>
                                    <div class="input__box">
                                        <label>Password<span>*</span></label>
                                        <input type="password" name="admin_password">
                                    </div>
                                    <div class="input__box">
                                        <label>User Type<span>*</span></label>
                                        <select name="status" id="">
                                            <option value="1">Admin</option>
                                            <option value="2">Seller</option>
                                            <option value="3">Customer</option>
                                        </select>
                                    </div>
                                    <div class="form__btn">
                                        <button>Login</button>
                                        <label class="label-for-checkbox">
                                            <input id="rememberme" class="input-checkbox" name="rememberme"
                                                value="forever" type="checkbox">
                                            <span>Remember me</span>
                                        </label>
                                    </div>
                                    <a class="forget_pass" href="#">Lost your password?</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End My Account Area -->