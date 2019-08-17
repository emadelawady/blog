<?php
// Insert Member Page

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	// Get Variables From The Form

	$comment 	= $_POST['comment'];
	$status 	= $_POST['comment-status'];
  $posts 	= $_POST['posts'];
	$members 	= $_POST['members'];


	// Validate The Form

	$formErrors = array();

	if (empty($comment)) {
		$formErrors[] = 'Comment Cant Be <strong>Empty</strong>';
	}

	if (empty($status)) {
		$formErrors[] = 'Status Cant Be <strong>Empty</strong>';
	}

	// Loop Into Errors Array And Echo It

	foreach($formErrors as $error) {
		echo '<div class="">' . $error . '</div>';
	}

	// Check If There's No Error Proceed The Update Operation

	if (empty($formErrors)) {

			// Insert Userinfo In Database

			$stmt = $con->prepare("INSERT INTO
										comments(comment, status, comment_date, `post-id`, `user-id`)
									VALUES(:zcomment, :zstatus, now(), :zposts, :zmem) ");
			$stmt->execute(array(
				'zcomment' 		=> $comment,
				'zstatus' 	=> $status,
				'zposts'			=> $posts,
        'zmem'			=> $members
			)); ?>

			<div class="uk-flex uk-flex-column uk-flex-center uk-flex-middle uk-height-viewport">
				<?php
			// Echo Success Message
			 $theMsg = "<div class='uk-alert-success'>" . $stmt->rowCount() . ' Record Inserted</div>';
			echo redirectHome($theMsg, 'back', 3); ?>
		</div>
			<?php

	}


} else { ?>
	<div class="uk-flex uk-flex-column uk-flex-center uk-flex-middle uk-height-viewport">
		<?php
	$theMsg = '<span class="uk-alert-danger">Sorry You Cant Browse This Page Directly</span>';

	 echo redirectHome($theMsg, ''); ?>
	</div>
<?php
}
 ?>
