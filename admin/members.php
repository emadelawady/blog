<?php

	/*
	================================================
	== Manage Members Page
	== You Can Add | Edit | Delete Members From Here
	================================================
	*/

	ob_start(); // Output Buffering Start

	session_start();

	$pageTitle = 'Members';

  	if (isset($_SESSION['Username'])) {
			$adminPanel = isset($_GET['adminPanel']) ? $_GET['adminPanel'] : 'Manage';

  		include 'init.php'; ?>

      <main class="uk-margin-remove uk-margin-auto fullHieght" uk-grid>
      <div id="sidebar" class="uk-width-1-6 uk-padding-remove">
        <?php	include $templates . 'sidebar.php'; ?>
    </div>
    <div class="uk-width-5-6 uk-padding-remove otherBackground uk-text-center">
      <?php
      if ($adminPanel == 'Manage-mem') {

				include $templates . 'members/manage-members.php';

			} elseif ($adminPanel == 'Add-mem') {

				include $templates . 'members/add-member.php';

			} elseif ($adminPanel == 'Edit-mem') {

				include $templates . 'members/edit-members.php';

			} elseif ($adminPanel == 'Insert-mem') {

				include $templates . 'members/insert-members.php';

			} elseif ($adminPanel == 'Delete-mem') {

				include $templates . 'members/delete-members.php';

			} elseif ($adminPanel == 'Update-mem') {

				include $templates . 'members/update-members.php';

			} elseif ($adminPanel == 'Activate-mem') {

				include $templates . 'members/activate-members.php';

			}

  		 ?>
            </div>
  					</main>
  <?php
  		include $templates . 'footer.php';

  	} else {

  		header('Location: index.php');

  		exit();
  	}

  	ob_end_flush(); // Release The Output
  ?>
