        <!-- Start Bradcaump area -->
        <div class="ht__bradcaump__area bg-image--6">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="bradcaump__inner text-center">
                            <h2 class="bradcaump-title">Create Account</h2>
                            <nav class="bradcaump-content">
                                <a class="breadcrumb_item" href="index.php?v=home">Home</a>
                                <span class="brd-separetor">/</span>
                                <span class="breadcrumb_item active">Register</span>
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
                    <div class="offset-2 col-lg-8 col-12">
                        <div class="my__account__wrapper">
                            <h3 class="account__title">Register your account</h3>
                            <?php 
                                if ($_SERVER['REQUEST_METHOD']=='POST') {
                                    $msg = "";
                                    if ($_POST['name']=="") {
                                        $msg.="Name Required <br>";
                                    }
                                    if ($_POST['email']=="") {
                                        $msg.="Email Required <br>";
                                    }
                                    if ($_POST['password']=="") {
                                        $msg.="password Required <br>";
                                    }
                                    if ($_POST['re_password'] != $_POST['password']) {
                                        $msg.="Password Not Match<br>";
                                    }
                                    if ($_POST['contact_no']=="") {
                                        $msg.="Contact No Required <br>";
                                    }
                                    if (isset($_POST['gender']) < 1) {
                                        $msg.="Gender Required <br>";
                                    }
                                    if ($_POST['age'] < 1) {
                                        $msg.="Age Required <br>";
                                    }
                                    if ($_POST['address']=="") {
                                        $msg.="Address Required <br>";
                                    }
                                    if ($_POST['country'] < 1) {
                                        $msg.="Country Name Required <br>";
                                    }
                                    if ($_POST['city_id'] < 1) {
                                        $msg.="City Name Required <br>";
                                    }

                                    if ($msg=="") {
                                        $data = [
                                            'name' => $_POST['name'], 
                                            'email' => $_POST['email'],
                                            'password' => md5($_POST['password']),
                                            'contact_no' => $_POST['contact_no'],
                                            'gender' => $_POST['gender'],
                                            'age' => $_POST['age'],
                                            'address' => $_POST['address'],
                                            'city_id' => $_POST['city_id']
                                        ];
                                        if ($om->insert("customer", $data)) { 
                                            echo "<script>window.location='index.php?v=home';</script>"                   
                                        ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Registration Successfully</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <?php
                            }   
                            else{
                                ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>customer already exists</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <?php
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
                            <form action="" method="post" id="validate_form" enctype="multipart/form-data">
                                <div class="form-row  account__form">
                                    <div class="col-md-6 form-group has-feedback has-error">
                                        <label for="name">Customer Name <span class="required">*</span></label>
                                        <input type="text" class="form-control" name="name" id="name" value="" />
                                        <span class="err_nm text-danger"></span>
                                        <span class="all_msg text-danger"></span>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="email">Email <span class="required">*</span></label>
                                        <input type="text" class="form-control" name="email" id="email" value="" />
                                        <span class="err_em text-danger"></span>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="password">Password <span class="required">*</span></label>
                                        <input type="password" class="form-control" name="password" id="password" />
                                        <span class="err_pass text-danger"></span>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="re_password">Re_password <span class="required">*</span></label>
                                        <input type="password" class="form-control" name="re_password" id="re_password"
                                            value="" />
                                        <span class="err_re_pass text-danger"></span>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="contact_no">Contact No <span class="required">*</span></label>
                                        <input type="text" class="form-control" name="contact_no" id="contact_no"
                                            value="" />
                                        <span class="err_con text-danger"></span>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="reg_feature">Gender<span class="required">*</span></label>
                                        <div class="ar form-control">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="gender" value="1"
                                                    id="radio">
                                                <label class="form-check-label" for="radio">Male</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="gender" value="2"
                                                    id="radio2">
                                                <label class="form-check-label" for="radio2">Female</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="age">Age<span class="required">*</span></label>
                                        <select id="age" name="age" class="form-control">
                                            <option value="0">Choose...</option>
                                            <?php 
                                            for ($i=16; $i < 60; $i+=5) { 
                                                $n = $i+4;
                                            echo "<option value='$i'>$i - $n &nbsp;Years</option>";                               
                                            }
                                        ?>
                                        </select>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label for="address">Address<span class="required">*</span></label>
                                        <textarea class="form-control" name="address" id="address" value=""></textarea>
                                        <span class="err_adr text-danger"></span>
                                        <!-- <input type="text" class="form-control" name="address" id="address" value="" /> -->
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="count_id">Country Name<span class="required">*</span></label>
                                        <select id="count_id" name="country" class="form-control">
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
                                    <div class="col-md-6 form-group">
                                        <label for="city_id">City Name<span class="required">*</span></label>
                                        <select id="city_id" name="city_id" class="form-control">
                                            <option value="0">Choose Country First</option>

                                        </select>
                                    </div>
                                    <div class="col-md-12">
                                        <button class="btn btn-primary">Register</button>
                                    </div>
                                </div>
                            </form>
                            <!-- end right part -->
                            <script>
                            $("document").ready(function() {

                                $("#name").focusout(function() {
                                    name_length = $(this).val().length;
                                    if (name_length < 4 || name_length > 20) {
                                        $(".err_nm").text("Should be between 4-20 characters.");
                                    }
                                });
                                $("#name").focus(function() {
                                    $(".err_nm").text("");
                                });

                                $("#address").focusout(function() {
                                    name_length = $(this).val().length;
                                    if (name_length < 10) {
                                        $(".err_adr").text("At least 10 characters.");
                                    }
                                });
                                $("#address").focus(function() {
                                    $(".err_adr").text("");
                                });

                                $("#email").focusout(function() {
                                    if ($(this).val == "") {
                                        $(".err_em").text("valid");
                                    }
                                });
                                $("#email").focus(function() {
                                    $(".err_em").text("");
                                });

                                $("#password").focusout(function() {
                                    password_length = $(this).val().length;
                                    if (password_length < 8) {
                                        $(".err_pass").text("At least 8 characters.");
                                    }
                                });
                                $("#password").focus(function() {
                                    $(".err_pass").text("");
                                });

                                $("#re_password").focusout(function() {
                                    if ($("#password").val() != $("#re_password").val()) {
                                        $(".err_re_pass").text("Password not match");
                                    }
                                });
                                $("#re_password").focus(function() {
                                    $(".err_re_pass").text("");
                                });

                                $("#contact_no").focusout(function() {
                                    var numchk = new RegExp("^[0-9]*$");
                                    contact_length = $(this).val().length;
                                    if (!numchk.test($("#contact_no").val())) {
                                        $(".err_con").text("Value not numeric");
                                    } else if (contact_length != 11) {
                                        $(".err_con").text("There must be 11 numbers");
                                    }
                                });
                                $("#contact_no").focus(function() {
                                    $(".err_con").text("");
                                });


                                // check reg-email script
                                $("input[name='email']").keyup(function() {
                                    var email = $(this).val();
                                    if (validateEmail(email)) {
                                        $.ajax({
                                            type: 'post',
                                            url: $("meta[name='url']").attr('content') +
                                                'api/email-check.php',
                                            data: {
                                                'email': email
                                            },
                                            success: function(mofiz) {
                                                $(".err_em").text(mofiz);
                                            }
                                        });
                                    } else {
                                        $(".err_em").text("");
                                    }

                                });
                                // email check function 
                                function validateEmail(email) {
                                    var re =
                                        /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                                    return re.test(String(email).toLowerCase());
                                }

                                // choose city script
                                $("select[name='country']").change(function() {
                                    var country = parseInt($(this).val());
                                    if (country > 0) {
                                        $.ajax({
                                            type: 'post',
                                            url: $("meta[name='url']").attr('content') +
                                                'api/select-city.php',
                                            data: {
                                                'country': country
                                            },
                                            success: function(mofiz) {
                                                $("select[name='city_id']").html(mofiz);
                                            }
                                        });


                                    } else {
                                        $("select[name='city_id']").html(
                                            "<option>Choose country first</option>");
                                    }
                                });

                            })
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End My Account Area -->