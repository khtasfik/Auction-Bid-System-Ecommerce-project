<?php 
if ($om->delete("category", array("id" => $_GET['mmh']))) {
	echo "<script>window.location='index.php?a=category-view&del=Delete'</script>";

}
?>
