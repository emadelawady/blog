<?php

	/*
	================================================
	== Manage Members Page
	== You Can Add | Edit | Delete Members From Here
	================================================
	*/

	ob_start(); // Output Buffering Start

	session_start();
	$pageTitle = 'Comments';


  	if (isset($_SESSION['Username'])) {
			$adminPanel = isset($_GET['adminPanel']) ? $_GET['adminPanel'] : 'Manage-comment';

  		include 'init.php'; ?>

      <main class="uk-margin-remove uk-margin-auto fullHieght" uk-grid>
      <div id="sidebar" class="uk-width-1-6 uk-padding-remove">
        <?php	include $templates . 'sidebar.php'; ?>
    </div>
    <div class="uk-width-5-6 uk-padding-remove otherBackground uk-text-center">
      <?php
      if ($adminPanel == 'Manage-comment') {

				include $templates . 'comments/manage-comments.php';

			} elseif ($adminPanel == 'Add-comment') {

				include $templates . 'comments/add-comments.php';

			} elseif ($adminPanel == 'Edit-comment') {

				include $templates . 'comments/edit-comments.php';

			} elseif ($adminPanel == 'Insert-comment') {

				include $templates . 'comments/insert-comments.php';

			} elseif ($adminPanel == 'Delete-comment') {

				include $templates . 'comments/delete-comments.php';

			} elseif ($adminPanel == 'Update-comment') {

				include $templates . 'comments/update-comments.php';

			} elseif ($adminPanel == 'Approve-comment') {

				include $templates . 'comments/approve-comments.php';

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
