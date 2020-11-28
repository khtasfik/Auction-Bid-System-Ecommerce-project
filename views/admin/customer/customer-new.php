<?php include "./views/admin/dashboard_left.php";
    $myScript = [
        "assets/js/jsMini/customer-email-check.js"
    ];
?>
<div class="col-lg-9 col-12 order-1 order-lg-2">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="wedget__title">Add customer</h3>
            <div class="mb-3">
                <a class="btn btn-primary" href="index.php?a=customer-new">New</a>
                <a class="btn btn-success" href="index.php?a=customer-view">View</a>
            </div>

            <!------------------
 start right part
------------------>


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
                   ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Add Successfully</strong>
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

            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-row  account__form">
                    <div class="col-md-6 input__box">
                        <label for="name">Customer Name <span class="required">*</span></label>
                        <input type="text" class="input-text" name="name" id="name" value="" />
                    </div>
                    <div class="col-md-6 input__box">
                        <label for="email">Email <span class="required">*</span></label>
                        <input type="text" class="input-text" name="email" id="email" value="" />
                        <span class="err_em text-danger"></span>
                    </div>
                    <div class="col-md-6 input__box">
                        <label for="password">Password <span class="required">*</span></label>
                        <input type="password" class="input-text" name="password" id="password" />
                    </div>
                    <div class="col-md-6 input__box">
                        <label for="re_password">Re_password <span class="required">*</span></label>
                        <input type="password" class="input-text" name="re_password" id="re_password" value="" />
                    </div>
                    <div class="col-md-4 input__box">
                        <label for="contact_no">Contact No <span class="required">*</span></label>
                        <input type="text" class="input-text" name="contact_no" id="contact_no" value="" />
                    </div>
                    <div class="col-md-4 input__box">
                        <label for="reg_feature">Gender<span class="required">*</span></label>
                        <div class="ar form-control">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" value="1" id="radio">
                                <label class="form-check-label" for="radio">Male</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" value="2" id="radio2">
                                <label class="form-check-label" for="radio2">Female</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 input__box">
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
                    <div class="col-md-12 input__box">
                        <label for="address">Address<span class="required">*</span></label>
                        <textarea class="form-control" name="address" id="address" value=""></textarea>
                        <!-- <input type="text" class="input-text" name="address" id="address" value="" /> -->
                    </div>
                    <div class="col-md-6 input__box">
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
                    <div class="col-md-6 input__box">
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


        </div>
    </div>
</div>
</div>
</div>
</div>
<!-- End dashboard_left Page -->