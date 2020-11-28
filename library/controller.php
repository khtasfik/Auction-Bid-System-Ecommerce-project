<?php 
	if (isset($_GET['a']) && (isset($_SESSION['status']) && $_SESSION['status']==1)) {
		if (file_exists("views/admin/{$_GET['a']}.php")) {
			require ("views/admin/{$_GET['a']}.php");
		}
		else if (file_exists("views/admin/category/{$_GET['a']}.php")) {
			require ("views/admin/category/{$_GET['a']}.php");
		}
		else if (file_exists("views/admin/sub-category/{$_GET['a']}.php")) {
			require ("views/admin/sub-category/{$_GET['a']}.php");
		}
		else if (file_exists("views/admin/country/{$_GET['a']}.php")) {
			require ("views/admin/country/{$_GET['a']}.php");
		}
		else if (file_exists("views/admin/city/{$_GET['a']}.php")) {
			require ("views/admin/city/{$_GET['a']}.php");
		}
		else if (file_exists("views/admin/product/{$_GET['a']}.php")) {
			require ("views/admin/product/{$_GET['a']}.php");
		}
		else if (file_exists("views/admin/slider/{$_GET['a']}.php")) {
			require ("views/admin/slider/{$_GET['a']}.php");
		}
		else if (file_exists("views/admin/customer/{$_GET['a']}.php")) {
			require ("views/admin/customer/{$_GET['a']}.php");
		}
		else{
			require ("views/common/not_eligible.php");
		}
	}
	else if (isset($_GET['s']) && (isset($_SESSION['status']) && ($_SESSION['status']==2 || $_SESSION['status']==1))) {
		if (file_exists("views/seller/{$_GET['s']}.php")) {
			require ("views/seller/{$_GET['s']}.php");
		}
		else if (file_exists("views/seller/product/{$_GET['s']}.php")) {
			require ("views/seller/product/{$_GET['s']}.php");
		}
		else if (file_exists("views/seller/category/{$_GET['s']}.php")) {
			require ("views/seller/category/{$_GET['s']}.php");
		}
		else if (file_exists("views/seller/sub-category/{$_GET['s']}.php")) {
			require ("views/seller/sub-category/{$_GET['s']}.php");
		}
		else{
			require ("views/common/not_eligible.php");
		}
	}
	else if (isset($_GET['c']) && (isset($_SESSION['status']) && ($_SESSION['status']==3 || $_SESSION['status']==1))) {
		if (file_exists("views/customer/{$_GET['c']}.php")) {
			require ("views/customer/{$_GET['c']}.php");
		}			
		else{
			require ("views/common/not_eligible.php");
		}
	}	
	else if (isset($_GET['v'])) {
		if (file_exists("views/common/{$_GET['v']}.php")) {
			require ("views/common/{$_GET['v']}.php");
		}
		else if (file_exists("views/common/category/{$_GET['v']}.php")) {
			require ("views/common/category/{$_GET['v']}.php");
		}
		else{
			require ("views/common/404.php");
		}
	}	
	else{		
		require "views/common/home.php";
	}

?>