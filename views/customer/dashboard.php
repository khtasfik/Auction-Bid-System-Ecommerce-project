<?php require "dashboard_left.php"?>
<div class="col-lg-9 col-12 order-1 order-lg-2">
    <div class="row">
        <div class="col-lg-12">
            <div class="my__account__wrapper">
                <h3 class="wedget__title">Your Account Info</h3>
                <div class="account__form">
                    <div class="table-responsive">
                        <table class="table table-striped">
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
                            
                            $where = [
                            "customer.id" => $_SESSION['id'],
                            ]; 
                            $rel = [
                            "city.id" => "customer.city_id",
                            "country.id" => "city.country_id",
                            ];       
                            $data = $om->View('customer,city,country', 'customer.*, city.name as cname, country.name as cuname', ['id', 'asc'], $where, $rel);
                            if ($data->num_rows > 0) {
                                $count = 0;
                                while($d = $data->fetch_object()) {
                                    echo "<tr><th>Name</th>";
                                    echo "<td>{$d->name}</td></tr>";
                                    echo "<tr><th>Email</th>";
                                    echo "<td>{$d->email}</td></tr>";
                                    echo "<tr><th>Contact No</th>";
                                    echo "<td>{$d->contact_no}</td></tr>";
                                    echo "<tr><th>Gender</th>";
                                    if ($d->gender==1) {
                                        echo "<td>Male</td>"; 
                                        }
                                        else if ($d->gender==2) {
                                        echo "<td>Female</td></tr>"; 
                                        }
                                    echo "<tr><th>Address</th>";
                                    echo "<td>{$d->address}</td></tr>";
                                    echo "<tr><th>City</th>";
                                    echo "<td>{$d->cname}</td></tr>";
                                    echo "<tr><th>Country</th>";
                                    echo "<td>{$d->cuname}</td></tr>";
                                }
                            } 
                            
                            ?>
                        </tbody>

                    </table>
                    </div>


                </div>

            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
<!-- End dashboard Page -->