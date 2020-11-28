<?php include "./views/admin/dashboard_left.php"?>

<div class="col-lg-9 col-12 order-1 order-lg-2">
  <div class="row">
    <div class="col-lg-12">
      <h3 class="wedget__title">View Slider</h3>
      <div class="mb-3">
        <a class="btn btn-primary" href="index.php?a=slider-new">New</a>
        <a class="btn btn-success" href="index.php?a=slider-view">View</a>
      </div>
<!------------------
 start right part
------------------>
<div class="account__form">
<div class="table-responsive">
  <table class="table table-bordered">
  <thead>
    <tr  class="bg-info color--white">
      <th scope="col">Sl</th>
      <th scope="col">product Title</th>
      <th scope="col">Picture</th>
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
      "product.id" => "slider.product_id",
    ];       
    $data = $om->View('slider,product', 'slider.*, product.title as ctitle', ['id', 'asc'], "", $rel);
    if ($data->num_rows > 0) {
        $count = 0;
          while($d = $data->fetch_object()) {
            $count++;
            echo "<tr>";
            echo "<td width=5>{$count}</td>";
            echo "<td>{$d->ctitle}</td>";
            if (file_exists("images/sliders/{$d->id}.{$d->picture}")) {
              echo "<td><img src='images/sliders/{$d->id}.{$d->picture}' alt='' width='100'></td>";
            }
            echo "<td width=10>
              <a class='text-white btn btn-warning' href='index.php?a=slider-edit&mmh={$d->id}'>Edit</a>
            </td>";
            echo "<td width=10>
              <a class='text-white btn btn-danger' href='index.php?a=slider-delete&mmh={$d->id}'onclick=\"return confirm('Are you sure you want to delete this item?');\">Delete</a>
            </td>";
            echo "</tr>";
        }
    } 
       
    ?>
  </tbody>

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