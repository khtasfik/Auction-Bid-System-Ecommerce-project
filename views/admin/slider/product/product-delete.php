<?php
$results = $om->View("product", "*", "", array("id" => $_GET['mmh']));
while($d = $results-> fetch_object()){
	$old_ext = $d->picture;

}
if($om->delete("product", array("id" => $_GET['mmh']))){
	if (file_exists("images/products/{$_GET['mmh']}.{$old_ext}")) {
		unlink("images/products/{$_GET['mmh']}.{$old_ext}");
	}
	echo "<script>window.location='index.php?a=product-view&del=Delete'</script>";
}

?>