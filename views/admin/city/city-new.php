<?php include "./views/admin/dashboard_left.php"?>
<div class="col-lg-9 col-12 order-1 order-lg-2">
  <div class="row">
    <div class="col-lg-12">
      <h3 class="wedget__title">Add City</h3>
      <div class="mb-3">
        <a class="btn btn-primary" href="index.php?a=city-new">New</a>
        <a class="btn btn-success" href="index.php?a=city-view">View</a>
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
            if ($_POST['country_id']=="") {
                $msg.="Country Name Required <br>";
            }

            if ($msg=="") {
                $data = [
                    'name' => $_POST['name'], 
                    'country_id' => $_POST['country_id']
                ];
                if ($om->insert("city", $data)) {
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
                        <strong>city already exists</strong>
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
            <div class="account__form">
                <div class="input__box">
                    <label for="reg_name">city Name <span class="required">*</span></label>
                    <input type="text" class="input-text" name="name" id="reg_name" value="" />
                </div>
                <div class="input__box">
                    <label for="country_id">Country Name <span class="required">*</span></label>
                    <select id="country_id"  name="country_id" class="form-control">
                        <option value="0">Choose...</option>
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
                    <button class="btn btn-primary">Add</button>
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