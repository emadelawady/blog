<!-- Start Comment Box -->
<div class="uk-container uk-padding">
	<div class="hold_comment">

	<h3 class="uk-text-center add_comment">أضف تعليق</h3>

	<?php if(isset($_SESSION['user'])) { ?>

	<form class="uk-form" action="<?php echo $_SERVER['PHP_SELF'] . '?postid=' . $posts['Post_ID']; ?>" method="POST">
		<div class="uk-form-row">
			<div class="uk-form-controls uk-text-center">
				<textarea type="text" id="comment" class="uk-textarea" name="comment" placeholder="أكتب تعليقك"></textarea required="required">
				<button type="submit" class="uk-button">أضف</button>
			</div>
		</div>
	</form>
</div>
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

			if(empty($comment)){
				echo "<div class='uk-alert-danger'>Sorry Empty Comment doesnt pass</div>";
			}elseif ($state) {
				echo "<div class='uk-alert-success'>comment pending</div>";
			}


			
	}

} else{
	echo "Must Login Or Register for Adding Comment";
} ?>
<!-- comment box after inserting data -->
<?php  include $templates . 'comments/comment-box.php'; ?>
</div>
<!-- End Comment Box -->
