<?php include "./views/seller/dashboard_left.php"?>

<div class="col-lg-9 col-12 order-1 order-lg-2">
    <div class="row">
        <div class="col-lg-9">
            <h3 class="wedget__title">View Sub-category</h3>
            <div class="mb-3">
                <a class="btn btn-primary" href="index.php?s=sub-category-new">New</a>
                <a class="btn btn-success" href="index.php?s=sub-category-view">View</a>
            </div>
            <!------------------
 start right part
------------------>
            <div class="account__form">
                <table class="table table-hover">
                    <thead>
                        <tr class="bg-info color--white">
                            <th scope="col">Sl</th>
                            <th scope="col">Category</th>
                            <th scope="col">Sub-category</th>
                            <th scope="col">Status</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
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
      "category.id" => "sub_category.category_id",
    ];       
    $data = $om->View('sub_category,category', 'sub_category.*, category.name as cname', ['id', 'asc'], "", $rel);
    if ($data->num_rows > 0) {
        $count = 0;
        while($d = $data->fetch_object()) {
            $count++;
            $cat = ucfirst($d->name);
            echo "<tr>";
            echo "<td width=5>{$count}</td>";
            echo "<td>{$d->cname}</td>";
            echo "<td>{$cat}</td>";
            echo "<td width=10>
                    <a class='text-white btn btn-warning' href='index.php?s=sub-category-edit&mmh={$d->id}'>Edit</a>
                </td>";
            echo "<td width=10>
                    <a class='text-white btn btn-danger' href='index.php?s=sub-category-delete&mmh={$d->id}'onclick=\"return confirm('Are you sure you want to delete this item?');\">Delete</a>
                </td>";
            echo "</tr>";
        }
    } 
       
    ?>
                    </tbody>
                </table>


            </div>

            <!-- end right part -->



        </div>
    </div>
</div>
</div>
</div>
</div>
<!-- End dashboard_left Page -->