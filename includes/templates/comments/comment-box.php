<?php // comment box

// show comment SQL
$stmt = $con->prepare("SELECT comments.*, users.Username
								FROM
								 comments
									INNER JOIN users
								 ON
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

<ul class="uk-comment-list">
	<li>
			<article class="uk-comment uk-visible-toggle" tabindex="-1">
					<header class="uk-comment-header uk-position-relative">
							<div class="uk-grid-medium uk-flex-middle hold_comment_box" uk-grid>
									<div class="uk-width-auto">
											<img class="uk-comment-avatar" src="avatar.jpg" width="80" height="80" alt="">
									</div>
									<div class="uk-width-expand">
											<h4 class="uk-comment-title uk-margin-remove"><a class="uk-link-reset" href="#"><?php echo $comment['Username']; ?></a></h4>
											<p class="uk-comment-meta uk-margin-remove-top"><a class="uk-link-reset" href="#">12 days ago</a></p>
									</div>
							</div>
							<div class="uk-position-top-right uk-position-small uk-hidden-hover"><a class="uk-link-muted" href="#">Reply</a></div>
					</header>
					<div class="uk-comment-body">
							<p><?php echo $comment['comment']; ?></p>
					</div>
			</article>
	</li>
</ul>
<?php } ?>
</div>
<?php } ?>
