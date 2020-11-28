<?php include "./views/customer/dashboard_left.php"?>

<div class="col-lg-9 col-12 order-1 order-lg-2">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="wedget__title">View Orders</h3>
            <div class="mb-3">
                <!-- <a class="btn btn-primary" href="index.php?c=customer-new">New</a>
                <a class="btn btn-success" href="index.php?c=customer-view">View</a> -->
            </div>
            <!------------------
            start right part
            ------------------>
            <div class="account__form">
                <table class="table table-bordered table-striped">
                    <tr class="bg-info color--white">
                        <th>Order No</th>
                        <th>Order Date</th>
                        <th>STATUS</th>
                        <th>Amount</th>
                        <th>Details</th>
                    <tr/>
                    <?php
                        $sql = $om->dbRaw("SELECT order_details.*,orders.order_date FROM order_details,shipping, orders WHERE shipping.customers_id = {$_SESSION['id']} AND shipping.id = orders.shipping_id AND orders.id = order_details.orders_id");
                        while($d = $sql->fetch_object()){
                            ?>          
                                <tr>
                                    <td>#<?php echo $d->orders_id; ?></td>
                                    <td><?php echo $d->order_date; ?></td>
                                    <td>Pending</td>
                                    <td>Tk. <?php echo $d->total; ?>.00</td>
                                    <!-- <td><a class="btn btn-info" href="index.php?c=customer-order-view&oid=$d->orders_id">View</a></td> -->
                                    <td><a data-toggle="modal" title="Quick View" class="btn btn-info quickview modal-view detail-link" data-target="#a<?php echo $d->orders_id ?>" >View</a></td>
                                </tr>
                            <?php
                        };
                    ?>
                </table>                
            </div>
            		<!-- QUICKVIEW PRODUCT -->
		<?php 
        	$sql = $om->dbRaw("SELECT order_details.*,orders.order_date,product.title FROM product,order_details,shipping, orders WHERE shipping.customers_id = {$_SESSION['id']} AND shipping.id = orders.shipping_id AND orders.id = order_details.orders_id AND order_details.product_id = product.id");
            while($d = $sql->fetch_object()){                
				?>
					<div id="quickview-wrapper">
						<!-- Modal -->
						<div class="modal fade" id="a<?php echo $d->orders_id ?>" tabindex="-1" role="dialog">
							<div class="modal-dialog modal-lg" role="document">
								<div class="modal-content">
									<div class="modal-header modal__header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									</div>
									<div class="modal-body">
                                        <!-- <div class="account__form"> -->
                                            <h5>Order <mark>#<?php echo $d->orders_id; ?></mark> was placed on <mark><?php echo $d->order_date; ?></mark> and is currently
                                                <mark>Processing.</mark></h5>
                                            <div class="mt-5">
                                                <h3 class="onder__title text-center border">Your order</h3>
                                                <table class="table table-bordered table-striped">
                                                    <tr>
                                                        <th>Product Name</th>
                                                        <td><?php echo $d->title; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Product Price</th>
                                                        <td>Tk. <?php echo $d->price; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Vat</th>
                                                        <td>Tk. <?php echo $vat = $d->price * $d->vat / 100; ?>.00</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Subtotal</th>
                                                        <td>Tk. <?php echo $subtotal = $d->price + $vat; ?>.00</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Discount</th>
                                                        <td>Tk. <?php echo $discount = $d->price * $d->discount / 100; ?>.00</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Order Total</th>
                                                        <td>Tk. <?php echo $subtotal - $discount; ?>.00</td>
                                                    </tr>
                                                </table> 
                                                <div class="button-group mt-3 d-print-none">
                                                    <a href=""class="btn btn-info"><i class="fa fa-long-arrow-left"></i> Back To Preview</a>
                                                    <a href="#"class="btn btn-warning print-btn"><i class="fa fa-print"></i> Print Reports</a>
                                                </div>
                                            </div>
                                        <!-- </div> -->
									</div><!-- .modal-body -->
								</div><!-- .modal-content -->
							</div><!-- .modal-dialog -->
						</div>
						<!-- END Modal -->
					</div>				
				<?php
			}
        ?>
		<!-- END QUICKVIEW PRODUCT -->
            <!-- end right part -->
        </div>
    </div>
</div>
</div>
</div>
</div>
<!-- End dashboard_left Page -->