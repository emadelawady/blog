<!-- Start Comment Box -->
<div class="uk-container MainBack">
	<h3>Add Comment</h3>
	<!-- comment box after inserting data -->
	<?php  include $templates . 'comments/comment-box.php'; ?>

	<?php if(isset($_SESSION['user'])) { ?>

	<form class="uk-form" action="<?php echo $_SERVER['PHP_SELF'] . '?postid=' . $posts['Post_ID']; ?>" method="POST">
		<div class="uk-form-row">
			<label class="uk-form-label" for="comment">comment :</label>
			<div class="uk-form-controls">
				<textarea type="text" id="comment" class="uk-textarea " name="comment" placeholder=""></textarea>
				<button type="submit" class="uk-button">Add Comment</button>
			</div>
		</div>
	</form>
	<?php
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		// get variables
		$comment = filter_var($_POST['comment'], FILTER_SANITIZE_STRING);
		$post_id = $posts['Post_ID'];
		$user_id = $_SESSION['u_id'];

		$state = $con->prepare("INSERT INTO
			comments(comment,status, comment_date, `post-id`, `user-id`)
			VALUES(:zcomment, 0, NOW(), :zpost_id, :zuser_id)");

			$state->execute(array(
				'zcomment' => $comment,
				'zpost_id' => $post_id,
				'zuser_id' => $user_id
			));

			if ($state) {
				echo "<div class='uk-alert-success'>comment added</div>";
			}
	}

} else{
	echo "Must Login Or Register for Adding Comment";
} ?>
</div>
<!-- End Comment Box -->
