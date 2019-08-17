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

  <main class="uk-margin-remove uk-margin-auto fullHieght" uk-grid>
    <!-- <div id="sidebar" class="uk-width-1-6 uk-padding-remove">
        <?php	//include $templates . 'sidebar.php'; ?>
    </div> -->
    <div class="uk-width-1-1 uk-padding-remove otherBackground uk-text-center">
      <div class="uk-container">
      <div class="uk-margin-remove" uk-grid>
        <div class="uk-width-1-1">
          <h2><?php echo $_SESSION['user']; ?> 's Profile</h2>
        </div>
				<!-- Start My Posts -->
        <div class="uk-width-1-2 uk-card uk-card-default uk-padding-remove">
					<h3 class="MainColor profile-title">My Posts</h3>

          <div class="uk-card-header uk-height-medium overflow_scroll">
          <?php

          $user_posts = get_posts_by('Member_ID', $user_info['UserID']);
					if(!empty($user_posts)){
           foreach ($user_posts as $post) { ?>
						 <div class="hold_posts" uk-grid>
							 <div class="uk-width-1-2">
                <h3 class="MainColor">
                  <a href="posts.php?postid=<?php echo $post['Post_ID']; ?>" id="<?php echo $post['Post_ID']; ?>" class="checkActive">
                  <?php echo $post['Name']; ?>
                </a>
                </h3>
							</div>
              <div class="uk-width-1-2 caption">
                <p><?php echo $post['Description']; ?></p>
                <span><?php echo $post['Add_Date']; ?></span>
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

			<!-- Start My Comments -->
      <div class="uk-width-1-2 uk-card uk-card-default uk-padding-remove">
				<h3 class="MainColor profile-title">My Comments</h3>
        <div class="uk-card-header uk-height-medium overflow_scroll">
        <?php
				echo "<pre>";
				print_r($user_info);
				echo "</pre>";
        // Select All Users Except Admin

        $stmt = $con->prepare("SELECT comments.*, users.Username, posts.*
                              FROM comments
                              INNER JOIN users
                              ON comments.`user-id` = users.UserID
															INNER JOIN posts
															ON comments.`post-id` = posts.Post_ID
                              WHERE `user-id` = ?");

        // Execute The Statement

				$stmt->execute(array($user_info['UserID']));

        // Assign To Variable

        $comments = $stmt->fetchAll();

        if (! empty($comments)) {
          foreach ($comments as $comment) { ?>
						<div class="uk-alert">
							<h5><?php echo $comment['Username']; ?></h5>
							<p>
							<?php echo $comment['comment']; ?>
							</p>
							<span>post : <?php echo $comment['Name']; ?></span>
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
