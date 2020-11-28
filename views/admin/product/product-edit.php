<?php include "./views/admin/dashboard_left.php";
	$myScript = [
		"assets/js/jsMini/select-sub-category.js"
	];

?>
<div class="col-lg-9 col-12 order-1 order-lg-2">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="wedget__title">Edit Product</h3>
            <div class="mb-3">
                <a class="btn btn-primary" href="index.php?a=product-new">New</a>
                <a class="btn btn-success" href="index.php?a=product-view">View</a>
            </div>

            <!------------------
 start right part
------------------>


            <?php
		if ($_SERVER['REQUEST_METHOD']=='POST') {
			$msg = "";
			if ($_POST['title']=="") {
				$msg.="Title Required <br>";
			}
			if ($_POST['price']=="") {
				$msg.="Price Required <br>";
			}
			if ($_POST['vat']=="") {
				$msg.="Vat Required <br>";
			}
			if ($_POST['discount']=="") {
				$msg.="Discount Required <br>";
			}
			if ($_POST['sub_category_id']=="") {
				$msg.="Sub-Category-id Required <br>";
			}
			if ($_POST['location']=="") {
				$msg.="Location Required <br>";
			}
			if ($_POST['feature']=="") {
				$msg.="feature Required <br>";
			}
            if ($_POST['sortdes']=="") {
                $msg.="Sort Description Required <br>";
            }
            if ($_POST['longdes']=="") {
                $msg.="Long Description Required <br>";
            }
			if ($_FILES['picture_feature']['name']=="") {
				$msg.=" Picture Required <br>";
			}

			if ($msg=="") {
				$results = $om->View("product", "*", "", array("id" => $_GET['mmh']));
					while ($result = $results->fetch_object()) {
						$old_ext = $result->ext_feature;
					}

					if ($_FILES['picture_feature']['name']) {
						$extension = pathinfo($_FILES['picture_feature']['name']);
						$ext = strtolower($extension['extension']);
						if ($ext !='jpg' && $ext !='jpeg' && $ext !='gif' && $ext !='png' ) {
							$ext = $old_ext;
						}
						else{
							if (file_exists("images/products/{$_GET['mmh']}.{$old_ext}")) {
								unlink("images/products/{$_GET['mmh']}.{$old_ext}");
							}
							move_uploaded_file($_FILES['picture_feature']['tmp_name'], "images/products/{$_GET['mmh']}.{$ext}");
						}
					}
					else{
						$ext = $old_ext;
					}
					$data = [
						'title' => $_POST['title'],
						'price' => $_POST['price'],
						'vat' => $_POST['vat'],
						'discount' => $_POST['discount'],
						'sub_category_id' => $_POST['sub_category_id'],
						'location' => $_POST['location'],
						'feature' => $_POST['feature'],
						'sortdes' => $_POST['sortdes'],
						'ext_feature' => $ext
					];

				if($om->update("product", $data, array("id"=>$_GET['mmh']))){
					$fileContent = $_POST['longdes'];
                        $fh = fopen("assets/text/product/{$_GET['mmh']}.txt", "w");
                        fwrite($fh, $fileContent);
                        fclose($fh);
					echo "<script>window.location='index.php?a=product-view&edit=Edit'</script>";
				}

				// $resultar = $om->View("pictures", $data,"", array("product_id" => $_GET['mmh']));
				// 	while ($resultarr = $resultar->fetch_object()) {
				// 		$old_extar = $resultarr->ext;
				// 	}

				// 	$pid = $om->Id;

				// // Image upload Start
				// $pictures = $_FILES['picture'];
				// // print_r($pictures);
				// // die();
				// 	if ($pictures) {
				// 		for ($i=0; $i < count($pictures['name']); $i++) {
				// 			$temp_arr = [
				// 			  'name' => $pictures['name'][$i],
				// 			  'type' => $pictures['type'][$i],
				// 			  'tmp_name' => $pictures['tmp_name'][$i],
				// 			  'error' => $pictures['error'][$i],
				// 			  'size' => $pictures['size'][$i],
				// 			];

				// // print_r($temp_arr);
				// 			if ($temp_arr['name']) {
				// 				$exten = pathinfo($temp_arr['name']);
				// 				$ext = strtolower($exten['extension']);
				// 				if ($ext !='jpg' && $ext !='jpeg' && $ext !='gif' && $ext !='png' ) {
				// 					$ext = "$old_extar";
				// 				}
				// 				else{
				// 					if (file_exists("images/products/{resultarr->id}.{$old_extar}")) {
				// 						unlink("images/products/{resultarr->id}.{$old_extar}");
				// 					}
				// 					move_uploaded_file($_FILES['picture_feature']['tmp_name'], "images/products/{resultarr->ext}.{$ext}");
				// 				}
				// 			}

				// 			// if ($ext) {
				// 			//    $picImg = [
				// 			//         "product_id" =>$pid,
				// 			//         "ext" => $ext
				// 			//     ];
				// 			//     if ($om->insert("pictures", $picImg)) {
				// 			//         if($ext){
				// 			//             move_uploaded_file($temp_arr['tmp_name'], "images/products/{$om->Id}.{$ext}");
				// 			//         }
				// 			//     }
				// 			// }
				// 		}
				// 	};
				// if($om->update("pictures", $data, array("product_id" => $_GET['mmh']))){
				// 	// echo "<script>window.location='index.php?a=product-view&edit=Edit'</script>";
				// }
				else{
					?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>product already exists</strong>
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
            <?php
			$results = $om->View("product", "*", "", array("id" => $_GET['mmh']));
			while ($result = $results->fetch_object()) {
		?>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-row account__form">
                    <div class="col-md-6 input__box">
                        <label for="reg_name">product Title <span class="required">*</span></label>
                        <input type="text" class="input-text" name="title" id="reg_name"
                            value="<?php echo $result->title ?>" />
                    </div>
                    <div class="col-md-6 input__box">
                        <label for="reg_price">product Price <span class="required">*</span></label>
                        <input type="text" class="input-text" name="price" id="reg_price"
                            value="<?php echo $result->price ?>" />
                    </div>
                    <div class="col-md-6 input__box">
                        <label for="reg_vat">product Vat <span class="required">*</span></label>
                        <input type="text" class="input-text" name="vat" id="reg_vat"
                            value="<?php echo $result->vat ?>" />
                    </div>
                    <div class="col-md-6 input__box">
                        <label for="reg_discount">product Discount <span class="required">*</span></label>
                        <input type="text" class="input-text" name="discount" id="reg_discount"
                            value="<?php echo $result->discount ?>" />
                    </div>
                    <div class="col-md-6 col-md-6 input__box">
                        <label for="cat_id">Category Name <span class="required">*</span></label>
                        <select id="cat_id" name="category" class="form-control">
                            <option value="0">Choose category</option>
                            <?php
							$order = array("name", "asc");
							$select = "id,category_id";
							$subcat = $om->View("sub_category",$select, $order);
							while($d = $subcat->fetch_object()){
								if ($d->id==$result->sub_category_id) {
									$order = array("name", "asc");
									$select = "id, name";
									$catgry = $om->View("category",$select, $order);
									while($dd = $catgry->fetch_object()){
										if ($dd->id == $d->category_id) {
											echo "<option selected value='$dd->id'>{$dd->name}</option>";
										}
										else{
											echo "<option value='$dd->id'>{$dd->name}</option>";
										}

									}

								}
							 }
						?>
                        </select>
                    </div>
                    <div class="col-md-6 col-md-6 input__box">
                        <label for="sub_cat_id">Sub-Category Name <span class="required">*</span></label>
                        <select id="sub_cat_id" name="sub_category_id" class="form-control">
                            <option value="0">Choose category first</option>
                            <?php
								$order = array("name", "asc");
								$select = "id, name";
								$cuid = $om->View("sub_category",$select, $order);
								while($d = $cuid->fetch_object()){
									   if($d->id == $result->sub_category_id){
										echo "<option value='$d->id' selected>{$d->name}</option>";
									}
									else{
									echo "<option value='$d->id'>{$d->name}</option>";
								}
							}
							?>
                        </select>
                    </div>

                    <div class="col-md-6 input__box">
                        <label for="reg_location">Location<span class="required">*</span></label>
                        <input type="text" class="input-text" name="location" id="reg_location"
                            value="<?php echo $result->location ?>" />
                    </div>
                    <div class="col-md-6 input__box">
                        <label for="reg_feature">Product Feature <span class="required">*</span></label>
                        <div class="ar form-control">
                            <?php
						if ($result->feature == 1){
							?>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" checked type="radio" name="feature" value="1"
                                    id="radio">
                                <label class="form-check-label" for="radio">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="feature" value="2" id="radio2">
                                <label class="form-check-label" for="radio2">No</label>
                            </div>
                            <?php
						}
						else if ($result->feature == 2){
							?>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="feature" value="1" id="radio">
                                <label class="form-check-label" for="radio">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" checked type="radio" name="feature" value="2"
                                    id="radio2">
                                <label class="form-check-label" for="radio2">No</label>
                            </div>
                            <?php
						}
					?>
                        </div>
                    </div>
                    <div class="col-md-12 input__box">
                        <label for="sortdes">Sort Description<span class="required">*</span></label>
                        <textarea name="sortdes" id="sortdes"
                            class="form-control"><?php echo "$result->sortdes";?></textarea>
                    </div>
                    <?php 
						$fh = fopen("assets/text/product/{$_GET['mmh']}.txt", "r");
						$fl = fread($fh, filesize("assets/text/product/{$_GET['mmh']}.txt"));
						fclose($fh);
						?>
                    <div class="col-md-12 input__box">
                        <label for="longdes">Long Description<span class="required">*</span></label>
                        <textarea name="longdes" id="longdes" class="form-control"><?php echo $fl ?></textarea>
                    </div>

                    <div class="col-md-6 input__box">
                        <label for="reg_img">Feature Picture<span class="required">*</span></label>
                        <input type="file" class="input-text" name="picture_feature" id="reg_img" value="" />
                        <?php
						if (file_exists("images/products/{$result->id}.{$result->ext_feature}")) {
							echo "<td><img id='blah' src='images/products/{$result->id}.{$result->ext_feature}' alt='' width='80'></td>";
						}
					?>
                    </div>
                    <div class="col-md-6 input__box">
                        <label for="reg_imgF">Picture<span class="required">*</span></label>
                        <input type="file" class="input-text" name="picture[]" multiple id="reg_imgF" value="" />
                        <?php
						$results2 = $om->View("pictures", "*", "", array("product_id" => $_GET['mmh']));
						while($d2 = $results2-> fetch_object()){
							$old_ext2 = $d2->ext;
						if (file_exists("images/products/{$d2->id}.{$old_ext2}")) {
							echo "<td><img id='blah2' src='images/products/{$d2->id}.{$old_ext2}' alt='' width='80'></td>";
						}
					}
					?>
                    </div>

                    <div class="col-md-12">
                        <button class="btn btn-primary">Update</button>
                    </div>
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