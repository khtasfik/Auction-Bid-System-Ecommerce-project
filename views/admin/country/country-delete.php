<?php 
if ($om->delete("country", array("id" => $_GET['mmh']))) {
	echo "<script>window.location='index.php?a=country-view&del=Delete'</script>";
}
?>
