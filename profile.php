<?php

	/*
	================================================
	== Profile Page
	== You Can Edit your Profile From Here
	================================================
	*/

	ob_start(); // Output Buffering Start

	session_start();

  $pageTitle = $_SESSION['user'] . "'s" . " Profile";

  	if (isset($_SESSION['user'])) {
			// get init
  		include 'init.php';
			// get header
			$hook_up->inc_header('light', '-');
			// users table
			global $user_info;
       ?>
				 <div class="profile_img">
				 <img width="200px" src="admin/uploads/avatars/<?php echo $user_info['avatar']; ?>" alt="">
				 <h2 class="uk-text-capitalize"><?php echo $_SESSION['user']; ?></h2>
				 </div>
  <main class="uk-margin-remove uk-margin-auto" uk-grid>
    <!-- <div id="sidebar" class="uk-width-1-6 uk-padding-remove">
        <?php	//include $templates . 'sidebar.php'; ?>
    </div> -->
    <div class="uk-width-1-1 uk-padding-remove otherBackground uk-text-center">
      <div class="uk-container">
      <div class="uk-margin-remove" uk-grid>
				<!-- Start My Posts -->
        <div class="uk-width-1-1 uk-card uk-card-default uk-padding-remove">
					<h3 class="MainColor profile-title">أحدث مقالاتك</h3>

					<div class="hold_posts cat-posts uk-border-rounded" uk-grid>
          <?php

          $user_posts = get_posts_by('Member_ID', $user_info['UserID'], 3);
					if(!empty($user_posts)){
           foreach ($user_posts as $post) { ?>
						 <div class="uk-width-1-3">
							 <div class="head_post">
                <h3 class="MainColor">
                  <a href="posts.php?postid=<?php echo $post['Post_ID']; ?>" id="<?php echo $post['Post_ID']; ?>" class="checkActive">
                  <?php echo $post['Name']; ?>
                </a>
                </h3>
								<img src="<?php echo empty($post['Image']) ? 'admin/uploads/posts/user.jpg' : 'admin/uploads/posts/' . $post['Image'];?>" alt="">
							</div>
              <div class="caption">
                <p><?php echo excerpt_len($post['Description'], 50); ?></p>
								<?php echo date("D M Y", strtotime($post['Add_Date']));?>
                <span><?php echo $post['Rating']; ?></span>
                <br>
                <span><?php echo $post['Username']; ?></span>
              </div>
							 </div>
          <?php } // end posts loop
				} else{
					echo "<span class='uk-alert uk-alert-danger'>No Posts To Show Yet</span>";
				} // end check for empty or not empty value
				 ?>
        </div>
			</div>
			<!-- End My Posts -->

		<div class="uk-width-1-1 uk-padding-remove uk-margin-auto-vertical">
			<h3 class="MainColor profile-title">أحدث تعليقاتك</h3>
			<div class="uk-card">
			<?php
			// Select All Users Except Admin

			$stmt = $con->prepare("SELECT comments.*, users.Username, posts.*
														FROM comments
														INNER JOIN users
														ON comments.`user-id` = users.UserID
														INNER JOIN posts
														ON comments.`post-id` = posts.Post_ID
														WHERE `user-id` = ?
														ORDER BY c_id DESC
														LIMIT 3
														");

			// Execute The Statement

			$stmt->execute(array($user_info['UserID']));

			// Assign To Variable

			$comments = $stmt->fetchAll();

			if (! empty($comments)) {
				foreach ($comments as $comment) { ?>
					<div class="comment uk-width-1-1" uk-grid>
						<p class="uk-width-1-2">
						<span><?php echo $comment['comment']; ?></span>
						</p>
						<p class="uk-width-1-2">
						@
						<span><?php echo $comment['Name']; ?></span>
						</p>
					</div>
			<?php  }

			} else {
				echo "No Comments";
			}
				?>
		</div>
		</div>
			<!-- End Comment -->
      </div>
      </div>
    </div>
  </main>
  <?php
		$hook_up->inc_footer('main', '-');
  	} else {
  		header('Location: login.php');

  		exit();
  	}

  	ob_end_flush(); // Release The Output
  ?>
