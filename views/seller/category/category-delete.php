<?php 
if ($om->delete("category", array("id" => $_GET['mmh']))) {
	echo "<script>window.location='index.php?s=category-view&del=Delete'</script>";

}
?>