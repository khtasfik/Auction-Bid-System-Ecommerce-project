<?php 
if ($om->delete("sub_category", array("id" => $_GET['mmh']))) {
	echo "<script>window.location='index.php?a=sub-category-view&del=Delete'</script>";

}
?>
