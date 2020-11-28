<?php 
if ($om->delete("slider", array("id" => $_GET['mmh']))) {
	if (file_exists("images/sliders/{$_GET['mmh']}.{$old_ext}")) {
		unlink("images/sliders/{$_GET['mmh']}.{$old_ext}");
	}

	//echo "<script>window.location='index.php?a=slider-view&del=Delete'</script>";

}
?>