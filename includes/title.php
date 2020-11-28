<?php 
	session_start();
	date_default_timezone_set('Asia/Dhaka');
    require "models/ourModel.php";
	$om = new ourModel();
	$errorPage = 420;
	if (isset($_GET['a'])) {
		if ($_GET['a']==($_GET['a'])) {
			$title = strtoupper ($_GET['a']." Page");
		}
	}
	else if (isset($_GET['v'])) {
		if ($_GET['v']==($_GET['v'])) {
			$title = strtoupper ($_GET['v']." Page");
		}
	}
	else if (isset($_GET['c'])) {
		if ($_GET['c']==($_GET['c'])) {
			$title = strtoupper ($_GET['c']." Page");
		}
	}
	else if (isset($_GET['s'])) {
		if ($_GET['s']==($_GET['s'])) {
			$title = strtoupper ($_GET['s']." Page");
		}
	}
 ?>