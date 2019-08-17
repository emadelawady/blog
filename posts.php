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
  <main class="uk-margin-remove uk-container">
    <div class="uk-text-center uk-margin-auto uk-height-max-large" uk-grid>
      <div class="uk-width-3-4">
        <div class="uk-width-1-1 uk-margin-top">
          <div class="uk-block">
            <h1 class="uk-margin-top">
								<?php echo $posts['Name']; ?>
								</h1>
          </div>
          <div class="uk-block">
            <p class="post-content">
              <?php	echo $posts['Description']; ?>
            </p>
          </div>
        </div>
        <div class="uk-width-1-2">
          <p class="uk-alert-success">
            <?php
							if ($posts['Status'] == 1) {
								echo "Published";
							} else{
								echo "Drafted";
							} ?>
          </p>
          <p class="uk-alert-success uk-block">
            <?php echo 'Rating : ' . $posts['Rating']; ?>
          </p>
        </div>
        <div class="uk-width-1-2">
          <?php
							echo $posts['cat_name'] . '<br>';

							echo 'by ' . $posts['Username'] . '<br>';
							 ?>
        </div>
				<div class="uk-width-1-1">
					<?php
					$post_tags = explode(',', $posts['tags']);
					echo 'Tags : - ';
					foreach ($post_tags as $tag) {
						$tag = str_replace(' ', '', $tag);
						$tag = strtolower($tag);
						echo '( <a href="tags.php?tags='.$tag.'">' . $tag . '</a>)';
					}
					echo " - ";
							 ?>
				</div>
        <div class="uk-width-1-1">
          <?php
							echo $posts['Add_Date'];?>
        </div>
      </div>
      <div class="uk-width-1-4 uk-text-center uk-background-secondary">
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
  echo '<div class="uk-container">
    			<div class="nice-message">There\'s No Posts To Show</div>
  			</div>';
 }

ob_end_flush(); // Release The Output ?>
