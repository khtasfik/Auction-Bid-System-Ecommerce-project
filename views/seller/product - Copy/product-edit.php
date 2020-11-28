<?php include "./views/seller/dashboard_left.php"?>
<div class="col-lg-9 col-12 order-1 order-lg-2">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="wedget__title">Edit Product</h3>
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
            if ($_POST['sub_category_id']=="") {
                $msg.="Sub-Category-id Required <br>";
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
                $results = $om->View("product", "*", "", array("id" => $_GET['mmh']));
                        while ($result = $results->fetch_object()) {
                            $old_ext = $result->upload_id;
                        }

                        if ($_FILES['picture']['name']) {
                            $extension = pathinfo($_FILES['picture']['name']);
                            $ext = strtolower($extension['extension']);
                            if ($ext !='jpg' && $ext !='jpeg' && $ext !='gif' && $ext !='png' ) {
                                $ext = $old_ext;
                            }
                            else{
                                if (file_exists("images/products/{$_GET['mmh']}.{$old_ext}")) {
                                    unlink("images/products/{$_GET['mmh']}.{$old_ext}");
                                }
                                move_uploaded_file($_FILES['picture']['tmp_name'], "images/products/{$_GET['mmh']}.{$ext}"); 
                            }
                        }
                        else{
                            $ext = $old_ext;
                        }
                $data = [
                    'title' => $_POST['title'], 
                    'price' => $_POST['price'],
                    'vat' => $_POST['vat'],
                    'discount' => $_POST['discount'],
                    'sub_category_id' => $_POST['sub_category_id'],
                    'location' => $_POST['location'],
                    'feature' => $_POST['feature'],
                    'ext_feature' => $ext
                ];
                if($om->update("product", $data, array("id"=>$_GET['mmh']))){
                    echo "<script>window.location='index.php?s=product-view&edit=Edit'</script>";
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
            <?php 
            $results = $om->View("product", "*", "", array("id" => $_GET['mmh']));
            while ($result = $results->fetch_object()) {
        ?>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-row account__form">
                    <div class="col-md-6 input__box">
                        <label for="reg_name">product Title <span class="required">*</span></label>
                        <input type="text" class="input-text" name="title" id="reg_name"
                            value="<?php echo $result->title ?>" />
                    </div>
                    <div class="col-md-6 input__box">
                        <label for="reg_price">product Price <span class="required">*</span></label>
                        <input type="text" class="input-text" name="price" id="reg_price"
                            value="<?php echo $result->price ?>" />
                    </div>
                    <div class="col-md-6 input__box">
                        <label for="reg_vat">product Vat <span class="required">*</span></label>
                        <input type="text" class="input-text" name="vat" id="reg_vat"
                            value="<?php echo $result->vat ?>" />
                    </div>
                    <div class="col-md-6 input__box">
                        <label for="reg_discount">product Discount <span class="required">*</span></label>
                        <input type="text" class="input-text" name="discount" id="reg_discount"
                            value="<?php echo $result->discount ?>" />
                    </div>
                    <div class="col-md-6 col-md-6 input__box">
                        <label for="cat_id">Category Name <span class="required">*</span></label>
                        <select id="cat_id" name="category" class="form-control">
                            <option value="0">Choose category</option>
                            <?php 
                            $order = array("name", "asc");
                            $select = "id,category_id";
                            $subcat = $om->View("sub_category",$select, $order);
                            while($d = $subcat->fetch_object()){
                                if ($d->id==$result->sub_category_id) {
                                    $order = array("name", "asc");
                                    $select = "id, name";
                                    $catgry = $om->View("category",$select, $order);
                                    while($dd = $catgry->fetch_object()){
                                        if ($dd->id == $d->category_id) {
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
                    <div class="col-md-6 col-md-6 input__box">
                        <label for="sub_cat_id">Sub-Category Name <span class="required">*</span></label>
                        <select id="sub_cat_id" name="sub_category_id" class="form-control">
                            <option value="0">Choose category first</option>
                            <?php 
                                $order = array("name", "asc");
                                $select = "id, name";
                                $cuid = $om->View("sub_category",$select, $order);
                                while($d = $cuid->fetch_object()){
                                       if($d->id == $result->sub_category_id){
                                        echo "<option value='$d->id' selected>{$d->name}</option>";
                                    }
                                    else{
                                    echo "<option value='$d->id'>{$d->name}</option>";
                                } 
                            }                           
                            ?>
                        </select>
                    </div>

                    <div class="col-md-6 input__box">
                        <label for="reg_location">Location<span class="required">*</span></label>
                        <input type="text" class="input-text" name="location" id="reg_location"
                            value="<?php echo $result->location ?>" />
                    </div>
                    <div class="col-md-6 input__box">
                        <label for="reg_feature">Product Feature <span class="required">*</span></label>
                        <div class="ar form-control">
                            <?php 
                        if ($result->feature == 1){
                            ?>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" checked type="radio" name="feature" value="1"
                                    id="radio">
                                <label class="form-check-label" for="radio">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="feature" value="2" id="radio2">
                                <label class="form-check-label" for="radio2">No</label>
                            </div>
                            <?php
                        } 
                        else if ($result->feature == 2){
                            ?>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="feature" value="1" id="radio">
                                <label class="form-check-label" for="radio">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" checked type="radio" name="feature" value="2"
                                    id="radio2">
                                <label class="form-check-label" for="radio2">No</label>
                            </div>
                            <?php
                        } 
                    ?>
                        </div>
                    </div>
                    <div class="col-md-6 input__box">
                        <label for="reg_img">Picture<span class="required">*</span></label>
                        <input type="file" class="input-text" name="picture" id="reg_img" value="" />
                        <?php
                        if (file_exists("images/products/{$result->id}.{$result->ext_feature}")) {
                            echo "<td><img id='blah' src='images/products/{$result->id}.{$result->ext_feature}' alt='' width='80'></td>";
                        }
                    ?>
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

                // choose sub-category script
                $("select[name='category']").change(function() {
                    var category = parseInt($(this).val());
                    if (category > 0) {
                        $.ajax({
                            type: 'post',
                            url: $("meta[name='url']").attr('content') +
                                'api/select-sub-category.php',
                            data: {
                                'category': category
                            },
                            success: function(mofiz) {
                                $("select[name='sub_category_id']").html(mofiz);
                            }
                        });


                    } else {
                        $("select[name='sub_category_id']").html(
                            "<option>Choose category first</option>");
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