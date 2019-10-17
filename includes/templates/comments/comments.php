<!-- Start Comment Box -->
<div class="container">
	<div class="hold_comment">

	<h3 class="text-center add_comment label-success">شاركنا وجهة نظرك</h3>

	<?php if(isset($_SESSION['user'])) { ?>

	<form class="form text-center" action="<?php echo $_SERVER['PHP_SELF'] . '?postid=' . $posts['Post_ID']; ?>" method="POST">
			<div class="form-group">
				<textarea id="mytextarea" class="form-control" name="comment" placeholder="أكتب تعليقك" rows="5" required="required"></textarea>
			</div>
			<button type="submit" class="btn btn-success">
				أضف تعليق
				<i class="fas fa-at"></i>
			</button>
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
			VALUES(:zcomment, 1, NOW(), :zpost_id, :zuser_id)");

			$state->execute(array(
				'zcomment' => $comment,
				'zpost_id' => $post_id,
				'zuser_id' => $user_id
			));

			if(empty($comment)){
				echo "<div class='alert-danger'>Sorry Empty Comment doesnt pass</div>";
			}elseif ($state) {
				echo "<div class='alert-success'>comment added</div>";
			}



	}

} else{
	echo "
	<div class='must_log'>
		<h1>نأسف لابد من تسجيل الدخول حتى تتمكن من وضع تعليق</h1>
	</div>
	";
} ?>
<!-- comment box after inserting data -->
<?php  include $templates . 'comments/comment-box.php'; ?>
</div>
<!-- End Comment Box -->
