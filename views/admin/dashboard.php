        <?php 
            require "dashboard_left.php";
        
            $myScript = [
                "assets/js/jsMini/email-check.js"
            ];
        ?>
        <div class="col-lg-9 col-12 order-1 order-lg-2">
            <div class="row">
                <div class="col-lg-12">
                    <div class="my__account__wrapper">
                        <h3 class="wedget__title">Create Account</h3>
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
                                        $msg.="Password Required <br>";
                                    }

                                    if ($msg=="") {
                                        $data = [
                                            'name' => $_POST['name'], 
                                            'email' => $_POST['email'], 
                                            'password' => md5($_POST['password']), 
                                        ];
                                        if ($om->insert("admin", $data)) {
                                            echo "Sign Up Successfully";
                                        }	
                                        else{
                                            echo "Email already exist";
                                        }
                                    }
                                    else{
                                        echo $msg;
                                    }
                                }
                            ?>

                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="account__form">
                                <div class="input__box">
                                    <label for="reg_name">Name <span class="required">*</span></label>
                                    <input type="text" class="input-text" name="name" id="reg_name" value="" />
                                </div>

                                <div class="input__box">
                                    <label for="reg_email">
                                        Email address <span class="required">*</span>
                                    </label>
                                    <input type="email" class="input-text" name="email" id="reg_email" value="" />
                                    <div class="err_em text-warning"></div>
                                </div>

                                <div class="input__box">
                                    <label for="reg_password">
                                        Password <span class="required">*</span>
                                    </label>
                                    <input type="password" class="input-text" name="password" id="reg_password" />
                                </div>

                                <div class="form__btn">
                                    <button>Create Admin</button>
                                </div>
                            </div>
                        </form </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>
        <!-- End dashboard Page -->