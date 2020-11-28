<?php include "./views/seller/dashboard_left.php";
    $myScript = [
        "assets/js/jsMini/select-sub-category.js"
    ];
?>
<div class="col-lg-9 col-12 order-1 order-lg-2">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="wedget__title">Add Product</h3>
            <div class="mb-3">
                <a class="btn btn-primary" href="index.php?s=product-new">New</a>
                <a class="btn btn-success" href="index.php?s=product-view">View</a>
            </div>

            <!------------------
 start right part
------------------>


            <?php 
        if ($_SERVER['REQUEST_METHOD']=='POST') {         
            $msg = "";
            if ($_POST['title']=="") {
                $msg.="Title Required <br>";
            }
            if ($_POST['price']=="") {
                $msg.="Price Required <br>";
            }
            if ($_POST['vat']=="") {
                $msg.="Vat Required <br>";
            }
            if ($_POST['discount']=="") {
                $msg.="Discount Required <br>";
            }
            if ($_POST['category'] <1 ) {
                $msg.="Category Name Required <br>";
            }
            if ($_POST['sub_category_id'] <1 ) {
                $msg.="Sub-Category-Name Required <br>";
            }
            if ($_POST['location']=="") {
                $msg.="Location Required <br>";
            }
            if ($_POST['feature']=="") {
                $msg.="feature Required <br>";
            }
            if ($_FILES['picture']['name']=="") {
                $msg.=" Picture Required <br>";
            }

            if ($msg=="") {               

                $data = [
                    'title' => $_POST['title'], 
                    'price' => $_POST['price'],
                    'vat' => $_POST['vat'],
                    'discount' => $_POST['discount'],
                    'sub_category_id' => $_POST['sub_category_id'],
                    'location' => $_POST['location'],
                    'feature' => $_POST['feature'],
                    'upload_id' => $_SESSION['status'],
                    // 'picture' => $ext
                ];
                if ($om->insert("product", $data)) {
                    $pid = $om->Id;
                    
                // Image upload Start 
                $pictures = $_FILES['picture'];
                // print_r($pictures);
                // die();
                    if ($pictures) {
                        for ($i=0; $i < count($pictures['name']); $i++) {
                            $temp_arr = [
                              'name' => $pictures['name'][$i],  
                              'type' => $pictures['type'][$i],  
                              'tmp_name' => $pictures['tmp_name'][$i],  
                              'error' => $pictures['error'][$i],  
                              'size' => $pictures['size'][$i],  
                            ]; 
                            
                // print_r($temp_arr);                           
                            $ext = "";
                            if ($temp_arr['name']) {
                                $exten = pathinfo($temp_arr['name']);
                                $ext = strtolower($exten['extension']);
                                if ($ext !='jpg' && $ext !='jpeg' && $ext !='gif' && $ext !='png' ) {
                                    $ext = "";
                                }                             
                            }
                            
                            if ($ext) {
                               $picImg = [
                                    "product_id" =>$pid,
                                    "ext" => $ext
                                ];
                                if ($om->insert("pictures", $picImg)) {
                                    if($ext){
                                        move_uploaded_file($temp_arr['tmp_name'], "images/products/{$om->Id}.{$ext}");
                                    }   
                                }
                            }
                        }
                    };
                    //  echo ($temp_arr['name']);
             // Image upload End             
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
                <strong>product already exists</strong>
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

            <!-- vat calculation jq -->
            <script>
            $(document).ready(function() {
                $("#reg_price").keyup(function() {
                    $a = parseInt($("#reg_price").val());
                    $b = $a * 10 / 100;
                    $("#reg_vat").attr("value", $b);
                });
            });
            </script>
            <!-- vat calculation jq -->

            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-row account__form">
                    <div class="col-md-6 input__box">
                        <label for="reg_name">Product Title <span class="required">*</span></label>
                        <input type="text" class="input-text" name="title" id="reg_name" value="" />
                    </div>
                    <div class="col-md-6 input__box">
                        <label for="reg_price">Product Price <span class="required">*</span></label>
                        <input type="text" class="input-text" name="price" id="reg_price" value="" />
                    </div>
                    <div class="col-md-6 input__box">
                        <label for="reg_vat">product Vat <span class="required">*</span></label>
                        <input type="text" class="input-text" name="vat" id="reg_vat" value="0" />
                    </div>
                    <div class="col-md-6 input__box">
                        <label for="reg_discount">Product Discount <span class="required">*</span></label>
                        <input type="text" class="input-text" name="discount" id="reg_discount" value="" />
                    </div>
                    <div class="col-md-6 input__box">
                        <label for="cat_id">Category Name <span class="required">*</span></label>
                        <select id="cat_id" name="category" class="form-control">
                            <option value="0">Choose category</option>
                            <?php 
                            $order = array("name", "asc");
                            $select = "id, name";
                            $results = $om->View("category",$select, $order);
                            while($d = $results->fetch_object()){
                                echo "<option value='$d->id'>{$d->name}</option>";
                             }
                        ?>
                        </select>
                    </div>
                    <div class="col-md-6 input__box">
                        <label for="sub_cat_id">Sub-Category Name <span class="required">*</span></label>
                        <select id="sub_cat_id" name="sub_category_id" class="form-control">
                            <option value="0">Choose category first</option>

                        </select>
                    </div>
                    <div class="col-md-6 input__box">
                        <label for="reg_feature">Product Feature <span class="required">*</span></label>
                        <div class="ar form-control">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="feature" value="1" id="radio">
                                <label class="form-check-label" for="radio">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" checked type="radio" name="feature" value="2"
                                    id="radio2">
                                <label class="form-check-label" for="radio2">No</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 input__box">
                        <label for="reg_location">Location<span class="required">*</span></label>
                        <input type="text" class="input-text" name="location" id="reg_location" value="" />
                    </div>
                    <div class="col-md-6 input__box">
                        <label for="reg_img">Picture<span class="required">*</span></label>
                        <input type="file" class="input-text" name="picture[]" multiple id="reg_img" value="" />
                        <img src="" id="blah" width="80" />
                    </div>
                    <div class="col-md-12">
                        <button class="btn btn-primary">Add</button>
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