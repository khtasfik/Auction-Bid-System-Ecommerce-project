<?php include "./views/seller/dashboard_left.php";
    $myScript = [
        "assets/js/jsMini/withdrawal.js",
    ];
?>
<div class="col-lg-9 col-12 order-1 order-lg-2">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="wedget__title">Add Product</h3>
            <div class="mb-3">
                <a class="btn btn-primary" href="index.php?s=product-new">New</a>
                <a class="btn btn-success" href="index.php?s=product-view">View</a>
                <a class="btn btn-warning text-white" href="index.php?s=product-sale">Report</a>
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
                        <th>Current Price</th>
                        <th>Bid Price</th>
                        <th>Commission</th>
                        <th>Total</th>
                    </tr>
                    <?php 
                        $ids = $_SESSION['id'];
                        $data = $om->dbRaw("SELECT product.*, order_details.total as bprice FROM product,order_details WHERE upload_id = $ids AND order_details.product_id = product.id");                                      
                        if ($data->num_rows > 0) {                       
                            $count = 0;
                            $totalPay = 0;
                            while($d = $data->fetch_object()) {
                                $bprice = round($d->bprice * 10/100); 
                                $payable = $d->bprice - $bprice; 
                                $count++;
                                echo "<tr>";
                                echo "<td>{$count}</td>";
                                echo "<td>{$d->title}</td>";
                                echo "<td>Tk. {$d->price}.00</td>";
                                echo "<td>Tk. {$d->bprice}.00</td>";                            
                                echo "<td>Tk. $bprice.00</td>";                           
                                echo "<td>Tk. $payable.00</td>";
                                $totalPay+= $payable;                           
                            }
                        }                        
                    ?>
                    <tr>
                        <th colspan="4">Total Balance</th>
                        <th class="text-right" colspan="2">Tk. <?php if(isset($totalPay)){echo $totalPay; }?>.00</th>
                    </tr>
                </table>
                </div>
            </div>
            <div class="account__form">
            <h3 class="text-center text-white p-2 mb-3 bg-success">Withdrawal Request</h3>
                <form action="" method="post">
                    <?php 
                        $sql = $om->dbRaw("SELECT sum(payment_logs.amount) as amount from payment_logs where seller_id = {$_SESSION['id']} ");
                        if($sql->num_rows > 0){
                            $d = $sql->fetch_object();
                            $amount = $d->amount;
                        }
                    ?>                    
                    <div id = "bidsuccess" class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Withdrawal Successfully</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="form-group row">
                        <input type="hidden" name="total" class="form-control-plaintext" id="withdrawal" value="<?php if(isset($totalPay)){echo $totalPay; }?>">
                        <label for="available" class="col-md-3 mb-2 col-form-label"><b>Available Balance</b></label>
                        <div class="col-md-3 mb-2">
                            <input type="text" name="avltk" readonly class="form-control-plaintext" id="available" value="
                                <?php 
                                    if(isset($totalPay,$amount)){ 
                                        echo $totalPay - $amount;
                                    }
                                    else if(isset($totalPay)){ 
                                        echo $totalPay;
                                    }
                                    else{
                                        echo "0";
                                    }  
                                
                                ?>">
                        </div>
                        <label for="twid" class="col-md-3 mb-2 col-form-label"><b>Total Withdrawal</b></label>
                        <div class="col-md-3 mb-2">
                            <input type="text" name="twid" readonly class="form-control-plaintext" id="twid" value="
                                <?php 
                                    if(isset($amount)){
                                        echo $amount; 
                                    }else{
                                        echo "0";
                                    }
                                ?>">
                        </div>
                        <label for="withdrawal" class="col-md-3 mb-2 col-form-label"><b>Withdrawal Now</b></label>
                        <div class="col-md-3 mb-2">
                            <input type="Number" name="withdrawal" class="form-control" id="withdrawal" value="">
                        </div>
                        <div class="col-md-3">
                            <input type="submit" name="submit_wid" class="btn btn-primary form-control-plaintext" value="withdrawal">
                        </div>
                        <div class="col-md-3">
                            <a data-toggle="modal" title="Account Details" class="btn btn-success text-white quickview modal-view detail-link" data-target="#a<?php echo $_SESSION['id'] ?>" >AC info</a>
                        </div>                                                
                    </div>
                </form>  
                <div id="quickview-wrapper">
						<!-- Modal -->
                    <div class="modal fade" id="a<?php echo $_SESSION['id'] ?>" tabindex="-1" role="dialog">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header modal__header">
                                   <h4 class="text-center w-100">Seller Withdrawal Report</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="modal-body">
                                    <table class="table table-bordered table-striped">
                                        <tr>
                                            <th>Withdrawal Date</th>
                                            <th>Withdrawal Balance</th>
                                        </tr>
                                        <?php 
                                            $sql = $om->dbRaw("SELECT payment_logs.* from payment_logs where seller_id = {$_SESSION['id']} ");
                                            while($d = $sql->fetch_object()){
                                                ?>                                                   
                                                    <tr>
                                                        <td><?php echo $d->date; ?></td>
                                                        <td>Tk. <?php echo $d->amount; ?></td>
                                                    </tr>
                                                <?php
                                            }
                                        ?>
                                        <tr>
                                            <td><b>Total Withdrawal</b></td>
                                            <td><b>Tk. <?php echo $amount; ?></b></td>
                                        </tr>                                        
                                    </table> 
                                    <div class="button-group mt-3 d-print-none">
                                        <a href=""class="btn btn-info"><i class="fa fa-long-arrow-left"></i> Back To Preview</a>
                                        <a href="#"class="btn btn-warning print-btn"><i class="fa fa-print"></i> Print Reports</a>
                                    </div>
                                    <!-- </div> -->
                                </div><!-- .modal-body -->
                            </div><!-- .modal-content -->
                        </div><!-- .modal-dialog -->
                    </div>
                    <!-- END Modal -->
                </div> <!-- Quick view -->
            </div>
            <!-- end right part -->
        </div>
    </div>
</div>
</div>
</div>
</div>
<!-- End dashboard_left Page -->