<?php include "./views/admin/dashboard_left.php"?>
<div class="col-lg-9 col-12 order-1 order-lg-2">
  <div class="row">
    <div class="col-lg-12">
      <h3 class="wedget__title">Edit Slider</h3>
      <div class="mb-3">
        <a class="btn btn-primary" href="index.php?a=slider-new">New</a>
        <a class="btn btn-success" href="index.php?a=slider-view">View</a>
      </div>

<!------------------
 start right part
------------------>


    <?php 
        if ($_SERVER['REQUEST_METHOD']=='POST') {
            $msg = "";
            if ($_POST['product_id'] < 1) {
                $msg.="Product Name Required <br>";
            }
            if ($_FILES['picture']['name']=="") {
                $msg.=" Picture Required <br>";
            }
            
            if ($msg=="") {
                $results = $om->View("slider", "*", "", array("id" => $_GET['mmh']));
                        while ($result = $results->fetch_object()) {
                            $old_ext = $result->picture;
                        }

                        if ($_FILES['picture']['name']) {
                            $extension = pathinfo($_FILES['picture']['name']);
                            $ext = strtolower($extension['extension']);
                            if ($ext !='jpg' && $ext !='jpeg' && $ext !='gif' && $ext !='png' ) {
                                $ext = $old_ext;
                            }
                            else{
                                if (file_exists("images/sliders/{$_GET['mmh']}.{$old_ext}")) {
                                    unlink("images/sliders/{$_GET['mmh']}.{$old_ext}");
                                }
                                move_uploaded_file($_FILES['picture']['tmp_name'], "images/sliders/{$_GET['mmh']}.{$ext}"); 
                            }
                        }
                        else{
                            $ext = $old_ext;
                        }
                $data = [
                    'product_id' => $_POST['product_id'],
                    'picture' => $ext
                ];
                if($om->update("slider", $data, array("id"=>$_GET['mmh']))){
                    echo "<script>window.location='index.php?a=slider-view&edit=Edit'</script>";
                }
                else{
                    ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>slider already exists</strong>
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
            $results = $om->View("slider", "*", "", array("id" => $_GET['mmh']));
            while ($result = $results->fetch_object()) {
        ?>
            <form action="" method="post" enctype="multipart/form-data">        
                <div class="account__form">
                    <div class="input__box">
                        <label for="sub_cat_id">Product Title<span class="required">*</span></label>
                        <select id="sub_cat_id"  name="product_id" class="form-control">
                            <option value="0">Choose...</option>
                            <?php 
                                $order = array("id", "asc");
                                $select = "id, title";
                                $cuid = $om->View("product",$select, $order);
                                while($d = $cuid->fetch_object()){
                                       if($d->id == $result->product_id){
                                        echo "<option value='$d->id' selected>{$d->title}</option>";
                                    }
                                    else{
                                    echo "<option value='$d->id'>{$d->title}</option>";
                                } 
                            }                           
                            ?>
                        </select>
                    </div>                    
                    <div class="input__box">
                        <label for="reg_img">Picture<span class="required">*</span></label>
                        <input type="file" class="input-text" name="picture" id="reg_img" value="" />
                         <?php
                        if (file_exists("images/sliders/{$result->id}.{$result->picture}")) {
                            echo "<td><img id='blah' src='images/sliders/{$result->id}.{$result->picture}' alt='' width='80'></td>";
                        }
                    ?>
                    </div>
                   
                   <div class=""> <button class="btn btn-primary">Save</button></div>
                </div>
            </form>
        <?php 
		}
	?>
<!-- end right part -->

      

</div>
</div>
</div>
</div>
</div>
</div>
        <!-- End dashboard_left Page -->