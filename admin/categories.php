<?php

	/*
	================================================
	== Category Page
	================================================
	*/

	ob_start(); // Output Buffering Start

	session_start();

	$pageTitle = 'Categories';
	$category = isset($_GET['adminPanel']) ? $_GET['adminPanel'] : 'Manage';


	if (isset($_SESSION['Username'])) {

		include 'init.php';
 ?>

		<main class="uk-margin-remove uk-margin-auto fullHieght" uk-grid>
		<div class="uk-width-1-6 uk-padding-remove">
				<?php	include $templates . 'sidebar.php'; ?>
		</div>
		<div class="uk-width-5-6 uk-padding-remove otherBackground">

					<div class="uk-container">
		<?php

		if ($category == 'Manage-cat') {

			include $templates . 'categories/manage-categories.php';

		} elseif ($category == 'Add-cat') {

			include $templates . 'categories/add-category.php';

		} elseif ($category == 'Insert-cat') {

			include $templates . 'categories/insert-category.php';

		} elseif ($category == 'Edit-cat') {

			include $templates . 'categories/edit-category.php';

		} elseif ($category == 'Update-cat') {

			include $templates . 'categories/update-category.php';

		} elseif ($category == 'Delete-cat') {

			include $templates . 'categories/delete-category.php';

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
