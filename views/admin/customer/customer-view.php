<?php include "./views/admin/dashboard_left.php"?>

<div class="col-lg-9 col-12 order-1 order-lg-2">
  <div class="row">
    <div class="col-lg-12">
      <h3 class="wedget__title">View Customer</h3>
      <div class="mb-3">
        <a class="btn btn-primary" href="index.php?a=customer-new">New</a>
        <a class="btn btn-success" href="index.php?a=customer-view">View</a>
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
      <th scope="col">Name</th>
      <th scope="col">Contact No</th>
      <th scope="col">Gender</th>
      <th scope="col">Age</th>
      <th scope="col">Address</th>
      <th scope="col">City Name</th>
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
      "city.id" => "customer.city_id",
    ];       
    $data = $om->View('customer,city', 'customer.*, city.name as cname', ['id', 'asc'], "", $rel);
    if ($data->num_rows > 0) {
        $count = 0;
          while($d = $data->fetch_object()) {
            $count++;
            echo "<tr>";
            echo "<td width=5>{$count}</td>";
            echo "<td>{$d->name}</td>";
            echo "<td>{$d->email}</td>";
            echo "<td>{$d->contact_no}</td>";
            if ($d->gender==1) {
              echo "<td>Male</td>"; 
            }
            else if ($d->gender==2) {
              echo "<td>Female</td>"; 
            }
            echo "<td>{$d->address}</td>";
            echo "<td>{$d->cname}</td>";  
            echo "<td width=10>
              <a class='text-white btn btn-warning' href='index.php?a=customer-edit&mmh={$d->id}'>Edit</a>
            </td>";
            echo "<td width=10>
              <a class='text-white btn btn-danger' href='index.php?a=customer-delete&mmh={$d->id}'onclick=\"return confirm('Are you sure you want to delete this item?');\">Delete</a>
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