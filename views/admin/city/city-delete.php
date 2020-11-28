<?php 
if ($om->delete("city", array("id" => $_GET['mmh']))) {
	echo "<script>window.location='index.php?a=city-view&del=Delete'</script>";

}
?>
