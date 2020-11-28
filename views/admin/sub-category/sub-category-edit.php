<?php include "./views/admin/dashboard_left.php"?>
<div class="col-lg-9 col-12 order-1 order-lg-2">
  <div class="row">
    <div class="col-lg-12">
      <h3 class="wedget__title">Edit Sub-category</h3>
      <div class="mb-3">
        <a class="btn btn-primary" href="index.php?a=sub-category-new">New</a>
        <a class="btn btn-success" href="index.php?a=sub-category-view">View</a>
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
            if ($_POST['category_id']=="") {
                $msg.="Category Name Required <br>";
            }
            
            if ($msg=="") {             
                $data = [
                    'name' => $_POST['name'], 
                    'category_id' => $_POST['category_id']
                ];
                if($om->update("sub_category", $data, array("id"=>$_GET['mmh']))){
                    echo "<script>window.location='index.php?a=sub-category-view&edit=Edit'</script>";
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
            $results = $om->View("sub_category", "*", "", array("id" => $_GET['mmh']));
            while ($result = $results->fetch_object()) {
                ?>
        <form action="" method="post" enctype="multipart/form-data">
        
            <div class="account__form">
                <div class="input__box">
                    <label for="reg_name">sub-category Name <span class="required">*</span></label>
                    <input type="text" class="input-text" name="name" id="reg_name" value="<?php echo $result->name ?>" />
                </div>
                <div class="input__box">
                    <label for="category_id">Category Name <span class="required">*</span></label>
                    <select id="category_id"  name="category_id" class="form-control">
                        <option value="0">Choose...</option>
                        <?php 
                            $order = array("name", "asc");
                            $select = "id, name";
                            $cuid = $om->View("category",$select, $order);
                            while($d = $cuid->fetch_object()){
                                if($d->id == $result->category_id){
                                    echo "<option value='$d->id' selected>{$d->name}</option>";
                                }
                                else{
                                echo "<option value='$d->id'>{$d->name}</option>";
                            }        
                        }          
                        ?>
                    </select>
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