<?php // comment box

// show comment SQL
$stmt = $con->prepare("SELECT comments.*, users.UserID, users.Username, users.avatar
								FROM
								 comments
									INNER JOIN users ON
									comments.`user-id` = users.UserID
									WHERE `post-id` = ?
									AND status = 1
									ORDER BY
									c_id DESC");

// Execute The Statement

$stmt->execute(array($posts['Post_ID']));

// Assign To Variable

$comments = $stmt->fetchAll();

if (!empty($comments)) { ?>
<div class="hold_comment">
<?php foreach ($comments as $comment) { ?>
<ul class="comment-list">
	<li>
			<article class="comment visible-toggle" tabindex="-1">
					<header class="comment-header position-relative">
							<div class="row hold_comment_box">
									<div class="col-sm-12 col-md-2 avatar_post">
										<img class="comment-avatar" src="admin/uploads/avatars/<?php echo $comment['avatar']; ?>" width="100" style="height:100px;" alt="">
										<h4 class="comment-title">
											<a class="link-reset" href="#">
												<?php echo $comment['Username']; ?>
											</a>
										</h4>
									</div>
									<div class="col-sm-12 col-md-10">
										<p><?php echo $comment['comment']; ?></p>
									</div>
							</div>
							<div class="row comment_info">
								<div class="col-sm-12 col-md-8 text-right comment-meta">
									<span>
										<?php echo $comment['comment_date']; ?>
									</span>
								</div>
								<div class="col-sm-12 col-md-4 text-center link-muted">
								<a href="#">اترك رد</a>
							</div>
							</div>
					</header>

			</article>

	</li>
</ul>
<?php } ?>
</div>
<?php } ?>
