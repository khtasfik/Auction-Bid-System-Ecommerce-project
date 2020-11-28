<?php
$results2 = $om->View("pictures", "*", "", array("product_id" => $_GET['mmh']));
while($d2 = $results2-> fetch_object()){
	$old_ext2 = $d2->ext;

	if($om->delete("pictures", array("id" => $d2->id))){
		if (file_exists("images/products/{$d2->id}.{$old_ext2}")) {
			unlink("images/products/{$d2->id}.{$old_ext2}");
		}
	}
}
$results = $om->View("product", "*", "", array("id" => $_GET['mmh']));
while($d = $results-> fetch_object()){
	$old_ext = $d->ext_feature;

}
if($om->delete("product", array("id" => $_GET['mmh']))){

	if (file_exists("assets/text/product/{$_GET['mmh']}.txt")) {
		unlink("assets/text/product/{$_GET['mmh']}.txt");
	}
	if (file_exists("images/products/{$_GET['mmh']}.{$old_ext}")) {
		unlink("images/products/{$_GET['mmh']}.{$old_ext}");
	}
	echo "<script>window.location='index.php?s=product-view&del=Delete'</script>";
}
?>