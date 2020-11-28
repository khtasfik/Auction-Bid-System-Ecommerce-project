<?php include "./views/admin/dashboard_left.php"?>
<div class="col-lg-9 col-12 order-1 order-lg-2">
  <div class="row">
    <div class="col-lg-12">
      <h3 class="wedget__title">Add Country</h3>
      <div class="mb-3">
        <a class="btn btn-primary" href="index.php?a=country-new">New</a>
        <a class="btn btn-success" href="index.php?a=country-view">View</a>
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

            if ($msg=="") {
                $data = [
                    'name' => $_POST['name'], 
                ];
                if ($om->insert("country", $data)) {
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
                        <strong>country already exists</strong>
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
                    <label for="reg_name">country Name <span class="required">*</span></label>
                    <input type="text" class="input-text" name="name" id="reg_name" value="" />
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