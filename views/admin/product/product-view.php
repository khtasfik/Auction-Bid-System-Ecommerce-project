<?php include "./views/admin/dashboard_left.php"?>

<div class="col-lg-9 col-12 order-1 order-lg-2">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="wedget__title">View Product</h3>
            <div class="mb-3">
                <a class="btn btn-primary" href="index.php?a=product-new">New</a>
                <a class="btn btn-success" href="index.php?a=product-view">View</a>
                <a class="btn btn-warning" href="index.php?a=product-sale">Report</a>
            </div>
            <!------------------
 start right part
------------------>
            <div class="account__form">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <tr class="bg-info color--white">
                            <th>Sl</th>
                            <th>Title</th>
                            <th>Price</th>
                            <th>Vat</th>
                            <th>Discount</th>
                            <th>SubCategory</th>
                            <th>Location</th>
                            <th>Feature</th>
                            <th>Picture</th>
                            <th>Status</th>
                            <th>Status</th>
                        </tr>
                        <?php 
    if(isset($_GET['del'])){
      ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong><?php echo $_GET['del']?> Successfully</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <?php
    }
    else if(isset($_GET['edit'])){
      ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong><?php echo $_GET['edit']?> Successfully</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <?php
    }
     
   
    $rel = [
      "sub_category.id" => "product.sub_category_id",
    ];      
    $data = $om->View('product,sub_category', 'product.*, sub_category.name as cname', ['id', 'asc'], "", $rel);
    if ($data->num_rows > 0) {
        $count = 0;
          while($d = $data->fetch_object()) {
            $count++;
            echo "<tr>";
            echo "<td>{$count}</td>";
            echo "<td>{$d->title}</td>";
            echo "<td>{$d->price}</td>";
            echo "<td>{$d->vat}</td>";
            echo "<td>{$d->discount}</td>";
            echo "<td>{$d->cname}</td>";
            echo "<td>{$d->location}</td>";
            if ($d->feature==1) {
              echo "<td>Yes</td>"; 
            }
            else if ($d->feature==2) {
              echo "<td>No</td>"; 
            }
            if (file_exists("images/products/{$d->id}.{$d->ext_feature}")) {
              echo "<td><img src='images/products/{$d->id}.{$d->ext_feature}' alt='' width='100'></td>";
            }
            echo "<td>
              <a class='text-white btn btn-warning' href='index.php?a=product-edit&mmh={$d->id}'>Edit</a>
            </td>";
            echo "<td>
              <a class='text-white btn btn-danger' href='index.php?a=product-delete&mmh={$d->id}'onclick=\"return confirm('Are you sure you want to delete this item?');\">Delete</a>
            </td>";
            echo "</tr>";
        }
    } 
       
    ?>

                    </table>
                </div>


            </div>

            <!-- end right part -->



        </div>
    </div>
</div>
</div>
</div>
</div>
<!-- End dashboard_left Page -->