<?php

	/*
	================================================
	== Edit Profile Page
	== You Can Edit your Profile From Here
	================================================
	*/

	ob_start(); // Output Buffering Start

	session_start();

$pageTitle = $_SESSION['user'] . "'s" . " Edit Profile";

if (isset($_SESSION['user'])) {
// get init
include 'init.php';
// get header
$hook_up->inc_header('light', '-');
// users table
global $user_info;
 ?>
 <?php echo 'edit profile'; ?>

<?php
	$hook_up->inc_footer('main', '-');
	} else {
		header('Location: login.php');

		exit();
	}

	ob_end_flush(); // Release The Output
?>
