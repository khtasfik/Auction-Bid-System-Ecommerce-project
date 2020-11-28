<?php include "./views/seller/dashboard_left.php"?>
<div class="col-lg-9 col-12 order-1 order-lg-2">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="wedget__title">Edit Category</h3>
            <div class="mb-3">
                <a class="btn btn-primary" href="index.php?s=category-new">New</a>
                <a class="btn btn-success" href="index.php?s=category-view">View</a>
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
                if ($_POST['name']=="") {
                    $msg.="Name Required <br>";
                }                           
                $data = [
                    'name' => $_POST['name'], 
                ];
                if($om->update("category", $data, array("id"=>$_GET['mmh']))){
                    echo "<script>window.location='index.php?s=category-view&edit=Edit'</script>";
                }
                else{
                    echo "error";
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
            $results = $om->View("category", "*", "", array("id" => $_GET['mmh']));
            while ($result = $results->fetch_object()) {
                ?>
            <form action="" method="post" enctype="multipart/form-data">

                <div class="account__form">
                    <div class="input__box">
                        <label for="reg_name">Category Name <span class="required">*</span></label>
                        <input type="text" class="input-text" name="name" id="reg_name"
                            value="<?php echo $result->name ?>" />
                    </div>
                    <button class="btn btn-primary">Save</button>
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