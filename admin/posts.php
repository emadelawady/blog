<?php

	/*
	================================================
	== Posts Template Page
	================================================
	*/

	ob_start(); // Output Buffering Start

	session_start();

	$pageTitle = 'Posts';

	if (isset($_SESSION['Username'])) {

		include 'init.php';

		$posts = isset($_GET['adminPanel']) ? $_GET['adminPanel'] : 'Manage'; ?>

    <main class="uk-margin-remove uk-margin-auto fullHieght" uk-grid>
		<div class="uk-width-1-6 uk-padding-remove">
				<?php	include $templates . 'sidebar.php'; ?>
		</div>
		<div class="uk-width-5-6 uk-padding-remove otherBackground">

					<div class="uk-container">
    <?php

		if ($posts == 'Manage-posts') {

      include $templates . 'posts/manage-posts.php';

		} elseif ($posts == 'Add-posts') {

      include $templates . 'posts/add-posts.php';

		} elseif ($posts == 'Insert-posts') {

      include $templates . 'posts/insert-posts.php';

		} elseif ($posts == 'Edit-posts') {

			include $templates . 'posts/edit-posts.php';


		} elseif ($posts == 'Update-posts') {

			include $templates . 'posts/update-posts.php';

		} elseif ($posts == 'Delete-posts') {

			include $templates . 'posts/delete-posts.php';


		} elseif ($posts == 'Approve-posts') {

			include $templates . 'posts/approve-posts.php';

		} ?>
  </div>
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
