<?php

	/*
	================================================
	== Profile Page
	== You Can Edit your Profile From Here
	================================================
	*/

ob_start(); // Output Buffering Start
session_start();
global $session_user;
$pageTitle = 'Posts';
// get init app core
include 'init.php';
// get header
$hook_up->inc_header();


// Check If Get Request userid Is Numeric & Get Its Integer Value

			$postid = isset($_GET['postid']) && is_numeric($_GET['postid']) ? intval($_GET['postid']) : 0;

			// Select All Data Depend On This ID

			$stmt = $con->prepare("SELECT posts.*, users.Username, categories.Name AS cat_name
                              FROM posts
                              INNER JOIN users
                              ON posts.Member_ID = users.UserID
															INNER JOIN categories
															ON posts.Cat_ID =  categories.ID
                              WHERE Post_ID = ?");

			// Execute Query

			$stmt->execute(array($postid));

			// Fetch The Data

			$posts = $stmt->fetch();

			// The Row Count

			$count = $stmt->rowCount();

			// If There's Such ID Show The Form
			if ($count > 0) {

				if(isset($session_user)) {

				?>
  <main class="container">
    <div class="text-center row">

      <div class="col-sm-12 col-md-9">

            <h1 class="post_title">
								<?php echo $posts['Name']; ?>
								</h1>
							<!-- <img class="post_img" src="admin/uploads/posts/<?php // echo $posts['Image']; ?>" alt=""> -->

								<div class="img-responsive img-thumbnail post_img" style="background-image: url('admin/uploads/posts/<?php echo $posts['Image']; ?>');">
								</div>
          <div class="">
            <p class="post-content text-center">
              <?php	echo $posts['Description']; ?>
            </p>
          </div>
				<div class="row">
					<div class="col-sm-12 col-md-6">
	          <p class="post_info">
	            <?php
								if ($posts['Status'] == 1) {
									echo  "نشر";
								} else{
									echo "أرشيف";
								} ?> -
								<span>
								<?php echo date("M Y", strtotime($posts['Add_Date']));?>
							</span> -
								فى
								<span>
									<?php echo $posts['cat_name']; ?>
								</span> بواسطة
								<span>
									<?php echo $posts['Username']; ?>
								</span>

	          </p>
	        </div>
					<div class="col-sm-12 col-md-6">
						<p class="post_rating">
							<?php echo 'تقييم : <span>' . $posts['Rating'] . ' <i class="fas fa-star" ></i></span>'; ?>
						</p>
					</div>
				</div>
				<div class="col-sm-12 col-md-12 tags">
					<?php
					$post_tags = explode(',', $posts['tags']);
					echo 'كلمات مميزة :  ';
					foreach ($post_tags as $tag) {
						$tag = str_replace(' ', '', $tag);
						$tag = strtolower($tag);
						echo '<a href="tags.php?tags='.$tag.'">' . $tag .'</a>' . ' - ';
					}
							 ?>
				</div>
      </div>

      <div class="col-sm-12 col-md-3">
        <?php include $templates . 'sidebar-post.php'; ?>
      </div>
		</div>
    <?php include $templates . 'comments/comments.php' ?>
  </main>
  <!-- End Comments Section -->
  <?php
	$hook_up->inc_footer('main', '-');
	}
} else {
  echo '<div class="container">
    			<div class="nice-message">There\'s No Posts To Show</div>
  			</div>';
 }

ob_end_flush(); // Release The Output ?>
