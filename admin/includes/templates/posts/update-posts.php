<?php

			echo "<div class='uk-container'>";

			if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        // Get Variables From The Form
        $id 		= $_POST['postid'];
      	$name 	= $_POST['name'];
      	$desc 	= $_POST['description'];
      	$status 	= $_POST['status'];
      	$members 	= $_POST['members'];
      	$cat 	= $_POST['cat'];
				$tags = filter_var($_POST['tags'], FILTER_SANITIZE_STRING);

				$image = $_FILES['post_upload'];
				// Upload Files
				$imageName = $_FILES['post_upload']['name'];
				$imageTemp = $_FILES['post_upload']['tmp_name'];




      	// Validate The Form

      	$formErrors = array();

      	if (empty($name)) {
      		$formErrors[] = 'Post\'s name Cant Be <strong>Empty</strong>';
      	}

      	if (empty($desc)) {
      		$formErrors[] = 'Post\'s description Cant Be <strong>Empty</strong>';
      	}

				// Loop Into Errors Array And Echo It

				foreach($formErrors as $error) {
					echo '<div class="uk-alert uk-alert-danger">' . $error . '</div>';
				}

				// Check If There's No Error Proceed The Update Operation

				if (empty($formErrors)) {
					// insert uploaded image
					$image = rand(0, 1000000) . '_' . $imageName;

					move_uploaded_file($imageTemp, 'uploads/posts/' . $image);

					$stmt2 = $con->prepare("UPDATE posts SET
												   Name = ?,
                           Description = ?,
                           Status = ?,
                           Member_ID = ?,
                           Cat_ID = ?,
													 tags = ?,
													 Image = ?
											WHERE
												Post_ID = ?");

					$stmt2->execute(array($name, $desc, $status, $members, $cat, $tags, $image, $id));

          // Echo Success Message
    					$theMsg = "<div class='uk-alert uk-alert-success'>" . $stmt2->rowCount() . ' Post Updated</div>';
    				echo redirectHome($theMsg, 'back');

				}

			} else {

				$theMsg = '<div class="alert alert-danger">Sorry You Cant Browse This Page Directly</div>';

				echo redirectHome($theMsg);

			}

			echo "</div>";

 ?>
