<?php

	/*
	================================================
	== Add post Page
	== You Can Add post From Here
	================================================
	*/

	ob_start(); // Output Buffering Start

	session_start();

  $pageTitle = "Add post";

  	if (isset($_SESSION['user'])) {
      include 'init.php';
			// get header
			$hook_up->inc_header('light', '-');
      // users table
      $user_state = $con->prepare("SELECT * FROM users WHERE Username = ?");
      $user_state->execute(array($session_user));
      $user_info = $user_state->fetch();


			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$formErrors = array();

				$post_title = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
				$post_desc = filter_var($_POST['description'], FILTER_SANITIZE_STRING);
				$post_cat = filter_var($_POST['cat'], FILTER_SANITIZE_NUMBER_INT);
				$tags = filter_var($_POST['tags'], FILTER_SANITIZE_STRING);


				// errors statements
				if (strlen($post_title) < 4) {
					$formErrors[] = 'Post Title Must Be over Than 4 characters';
				}
				if (strlen($post_desc) < 10) {
					$formErrors[] = 'Post Description Must Be over Than 10 characters';
				}
				if (empty($post_cat)) {
					$formErrors[] = 'Post Category Must Be selected';
				}

				// Check If There's No Error Proceed The Update Operation

				if (empty($formErrors)) {

					$front_imageName = $_FILES['post_upload']['name'];
					$front_imageTmp = $_FILES['post_upload']['tmp_name'];

					$front_featured = rand(0, 100000) . '_' .  $front_imageName;


					move_uploaded_file($front_imageTmp, 'admin/uploads/posts/' . $front_featured);



						// Insert Userinfo In Database

						$stmt = $con->prepare("INSERT INTO
													posts(Name, Description, Status, Add_Date, Member_ID, Cat_ID, tags, Image)
												VALUES(:zname, :zdesc, 0, now(), :zmem, :zcat, :ztags, :zimage) ");
						$stmt->execute(array(
							'zname' 		=> $post_title,
							'zdesc' 		=> $post_desc,
							'zmem'			=> $_SESSION['u_id'],
							'zcat'			=> $post_cat,
							'ztags'			=> $tags,
							'zimage'		=> $front_featured
						)); ?>

							<?php
							if($stmt) {
						// Echo Success Message
						 echo $theMsg = "<div class='uk-alert-success'>Post Added</div>"; ?>
						<?php
					} // end if $stmt
				}
			}
       ?>

  <main class="uk-margin-remove uk-margin-auto fullHieght" uk-grid>
    <!-- <div id="sidebar" class="uk-width-1-6 uk-padding-remove">
        <?php	//include $templates . 'sidebar.php'; ?>
    </div> -->
    <div class="uk-width-1-1 uk-padding-small otherBackground uk-text-center">
      <div class="uk-container">
      <div class="uk-margin-remove" uk-grid>
        <div class="uk-width-1-1">
          <h2>Add Post</h2>
        </div>
				<div class="uk-width-1-1 form_errors">
					<?php
					if(! empty($formErrors)){
						foreach ($formErrors as $error) {
							echo '
						<div class="uk-alert" data-uk-alert>
							<a href="#" class="uk-alert-close uk-close"></a>
							<p>'.$error.'</p>
						</div>
							';
						}

					}
					 ?>
				</div>
			<!-- Start Add Post -->
      <div class="">
          <!-- Start add post form -->
          <form  action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data" class="uk-margin-auto uk-text-center" uk-grid>
            <!-- Start Post Name Field -->
            <div class="uk-margin uk-width-1-1">
              <div class="uk-inline">
                <span class="uk-form-icon" uk-icon="icon: user"></span>
                <input type="text" name="name" class="uk-input uk-form-width-large live-title" autocomplete="off"  placeholder="Post Name" />
              </div>
            </div>
            <!-- End Post Name Field -->
            <!-- Start Description Field -->
            <div class="uk-margin uk-width-1-1">
              <div class="uk-inline">
                  <span class="uk-form-icon uk-form-icon-flip" uk-icon="icon: lock"></span>
                  <textarea name="description" class="uk-textarea uk-form-width-large" placeholder="Description"></textarea>
              </div>
            </div>
            <!-- End Description Field -->

            <!-- Start category Field -->
            <div class="uk-margin uk-width-1-1">
              <div class="uk-inline">
                  <span>Category</span>
                  <select class="uk-form-select uk-select" name="cat"  data-uk-form-select>
                    <option value="0">...</option>
                    <?php
                      $stmt = $con->prepare("SELECT * FROM categories");
                      $stmt->execute();
                      $cats = $stmt->fetchAll();
                      foreach ($cats as $cat) { ?>
                        <option value="<?php echo $cat['ID'] ?>"><?php echo $cat['Name']; ?></option>
                    <?php
                    }
                    ?>
                  </select>
              </div>
            </div>
            <!-- End category Field -->
						<!-- Start Tags Field -->
						<div class="uk-margin uk-width-1-1">
							<div class="uk-inline">
								<i class="fas fa-tags"></i>
								<input type="text" name="tags" class="uk-input uk-form-width-large" placeholder="separate tags with commas (,)" />
							</div>
						</div>
						<!-- End Tags Field -->
						<!-- Start post image Field -->
						<div class="uk-margin uk-width-1-1 image_upload">
							<div class="uk-inline">
								<span class="uk-form-icon" uk-icon="icon: user"></span>
								<input id="image" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])" type="file" name="post_upload" class="uk-input uk-form-width-large" required="required" />
										<img id="blah"  width="100" height="100" />
							</div>
						</div>
						<!-- End post image Field -->
            <!-- Start Submit Field -->
            <div class="uk-margin uk-width-1-1">
              <div class="uk-inline">
                <input type="submit" value="Add Post" class="uk-button uk-button-primary" />
              </div>
            </div>
            <!-- End Submit Field -->
          </form>
          <!-- End add post form -->
      </div>
			<!-- End Add Post -->
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
