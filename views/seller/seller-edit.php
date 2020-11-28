<?php include "./views/seller/dashboard_left.php"?>
<div class="col-lg-9 col-12 order-1 order-lg-2">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="wedget__title">Edit Profile</h3>
            <div class="mb-3">
                <!-- <a class="btn btn-primary" href="index.php?c=seller-new">New</a> -->
                <!-- <a class="btn btn-success" href="index.php?c=seller-view">View</a> -->
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
            if ($_POST['contact_no']=="") {
                $msg.="Contact No Required <br>";
            }
            if (isset($_POST['gender']) < 1) {
                $msg.="Gender Required <br>";
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
                $results = $om->View("seller", "*","", array("id" => $_SESSION['id']));
                    while ($result = $results->fetch_object()) {

                    }                        
                    $data = [
                        'name' => $_POST['name'], 
                        'email' => $_POST['email'],
                        'contact_no' => $_POST['contact_no'],
                        'gender' => $_POST['gender'],
                        'address' => $_POST['address'],
                        'city_id' => $_POST['city_id']
                    ];
                if($om->update("seller", $data,array("id" => $_SESSION['id']))){
                    echo "<script>window.location='index.php?s=seller-view&edit=Update'</script>";
                }
                else{
                    ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>seller already exists</strong>
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
            <?php 
            $where = [
                "seller.id" => $_SESSION['id'],
                ];

            $results = $om->View("seller", "*", "", $where);
            while ($result = $results->fetch_object()) {
        ?>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-row account__form">
                    <div class="col-md-6 input__box">
                        <label for="name">seller Name <span class="required">*</span></label>
                        <input type="text" class="input-text" name="name" id="name"
                            value="<?php echo $result->name?>" />
                    </div>
                    <div class="col-md-6 input__box">
                        <label for="email">Email <span class="required">*</span></label>
                        <input type="text" class="input-text" name="email" id="email"
                            value="<?php echo $result->email?>" />
                        <span class="err_em text-danger"></span>
                    </div>
                    <div class="col-md-6 input__box">
                        <label for="contact_no">Contact_no <span class="required">*</span></label>
                        <input type="text" class="input-text" name="contact_no" id="contact_no"
                            value="<?php echo $result->contact_no?>" />
                    </div>
                    <div class="col-md-3 input__box">
                        <label for="">Gender<span class="required">*</span></label>
                        <?php 
                        if ($result->gender == 1){
                            ?><div class="ar form-control">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" checked type="radio" name="gender" value="1" id="radio">
                                <label class="form-check-label" for="radio">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" value="2" id="radio2">
                                <label class="form-check-label" for="radio2">No</label>
                            </div>
                        </div>
                        <?php
                        } 
                        else if ($result->gender == 2){
                            ?><div class="ar form-control">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" value="1" id="radio">
                                <label class="form-check-label" for="radio">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" checked type="radio" name="gender" value="2"
                                    id="radio2">
                                <label class="form-check-label" for="radio2">No</label>
                            </div>
                        </div>
                        <?php
                        } 
                    ?>
                    </div>

                    <div class="col-md-12 col-md-6 input__box">
                        <label for="address">Address<span class="required">*</span></label>
                        <textarea class="form-control" name="address"
                            id="address"><?php echo $result->address ?></textarea>
                    </div>

                    <div class="col-md-6 input__box">
                        <label for="city_id">Country Name<span class="required">*</span></label>
                        <select id="count_id" name="country" class="form-control">
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

                    <div class="col-md-6 input__box">
                        <label for="city_id">City Name<span class="required">*</span></label>
                        <select id="city_id" name="city_id" class="form-control">
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
                    <div class="col-md-12">
                        <button class="btn btn-primary">Update</button>
                    </div>
                </div>
            </form>
            <?php 
		}
	?>
            <!-- end right part -->
            <script>
            $("document").ready(function() {

                // check reg-email script
                $("input[name='email']").keyup(function() {
                    var email = $(this).val();
                    if (validateEmail(email)) {
                        $.ajax({
                            type: 'post',
                            url: $("meta[name='url']").attr('content') +
                                'api/seller-email-check.php',
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
                            url: $("meta[name='url']").attr('content') + 'api/select-city.php',
                            data: {
                                'country': country
                            },
                            success: function(mofiz) {
                                $("select[name='city_id']").html(mofiz);
                            }
                        });


                    } else {
                        $("select[name='city_id']").html("<option>Choose country first</option>");
                    }
                });

            })
            </script>


        </div>
    </div>
</div>
</div>
</div>
</div>
<!-- End dashboard_left Page -->