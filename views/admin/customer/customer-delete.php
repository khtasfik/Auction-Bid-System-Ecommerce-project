<?php 
if ($om->delete("customer", array("id" => $_GET['mmh']))) {
	echo "<script>window.location='index.php?a=customer-view&del=Delete'</script>";

}
?>
