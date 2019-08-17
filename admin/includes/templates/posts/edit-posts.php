<?php
// Check If Get Request userid Is Numeric & Get Its Integer Value

			$postid = isset($_GET['postid']) && is_numeric($_GET['postid']) ? intval($_GET['postid']) : 0;

			// Select All Data Depend On This ID

			$stmt = $con->prepare("SELECT * FROM posts WHERE Post_ID = ?");

			// Execute Query

			$stmt->execute(array($postid));

			// Fetch The Data

			$posts = $stmt->fetch();

			// The Row Count

			$count = $stmt->rowCount();

			// If There's Such ID Show The Form

			if ($count > 0) { ?>

        <div class="uk-container">
        	<form  action="?adminPanel=Update-posts" method="POST" enctype="multipart/form-data" class="uk-margin-auto uk-text-center" uk-grid>
            <input type="hidden" name="postid" value="<?php echo $postid ?>" />

        		<!-- Start Post Name Field -->
        		<div class="uk-margin uk-width-1-1">
        			<div class="uk-inline">
                <span class="uk-label">Post Title</span>
        				<input type="text" name="name" class="uk-input uk-form-width-large" autocomplete="off"  placeholder="Post Name" value="<?php echo $posts['Name']; ?>" />
        			</div>
        		</div>
        		<!-- End Post Name Field -->
        		<!-- Start Description Field -->
        		<div class="uk-margin uk-width-1-1">
        			<div class="uk-inline">
                <span class="uk-label">Post Content</span>
        					<textarea name="description" class="uk-textarea uk-form-width-large" placeholder="Description"><?php echo $posts['Description']; ?></textarea>
        			</div>
        		</div>
        		<!-- End Description Field -->
        		<!-- Start Status Field -->
        		<div class="uk-margin uk-width-1-1">
        			<div class="uk-inline">
                  <span>Status</span>
                  <select class="uk-form-select uk-select" name="status"  data-uk-form-select>
                    <option value="1" <?php if ($posts['Status'] == 1) {echo "selected";} ?>>Publish</option>
                    <option value="0" <?php if ($posts['Status'] == 0) {echo "selected";} ?>>Draft</option>
                  </select>
        			</div>
        		</div>
        		<!-- End Status Field -->
            <!-- Start Members Field -->
            <div class="uk-margin uk-width-1-1">
              <div class="uk-inline">
                  <span>Members</span>
                  <select class="uk-form-select uk-select" name="members"  data-uk-form-select>
                    <option value="0">...</option>
                    <?php
                      $stmt = $con->prepare("SELECT * FROM users");
                      $stmt->execute();
                      $users = $stmt->fetchAll();
                      foreach ($users as $user) { ?>
                        <option value="<?php echo $user['UserID'] ?>"
                          <?php if ($posts['Member_ID'] == $user['UserID']) {echo "selected";} ?> >
                              <?php echo $user['Username']; ?>
                        </option>
                    <?php
                    }
                    ?>
                  </select>
              </div>
            </div>
            <!-- End Members Field -->
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
                        <option value="<?php echo $cat['ID'] ?>" <?php echo $posts['Cat_ID'] == $cat['ID'] ? 'selected' : ''; ?>><?php echo $cat['Name']; ?></option>
                    <?php
                    }
                    ?>
                  </select>
              </div>
            </div>
            <!-- End Members Field -->
						<!-- Start Tags Field -->
						<div class="uk-margin uk-width-1-1">
							<div class="uk-inline">
								<i class="fas fa-tags"></i>
								<input type="text" name="tags" class="uk-input uk-form-width-large" placeholder="separate tags with commas (,)" value="<?php echo $posts['tags']; ?>" />
							</div>
						</div>
						<!-- End Tags Field -->
						<!-- Start post image Field -->
						<div class="uk-margin uk-width-1-1 image_upload">
							<div class="uk-inline">
								<span class="uk-form-icon" uk-icon="icon: user"></span>
								<input id="image" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])" type="file" name="post_upload" class="uk-input uk-form-width-large" />
										<img id="blah"  width="100" height="100" />
							</div>
						</div>
						<div class="uk-margin uk-width-1-1 image_upload">
							<div class="uk-inline">
								<img src="uploads/posts/<?php echo $posts['Image']; ?>" alt="">
								rsar
							</div>
						</div>
						<!-- End post image Field -->
        		<!-- Start Submit Field -->
        		<div class="uk-margin uk-width-1-1">
        			<div class="uk-inline">
        				<input type="submit" value="Update Post" class="uk-button uk-button-primary" />
        			</div>
        		</div>
        		<!-- End Submit Field -->
        	</form>
        </div>
				<?php


									echo '<h1 class="uk-text-center">Manage '. '( '.$posts['Name'] .' )'.' Comments</h1>';
							// Select All Users Except Admin

							$stmt = $con->prepare("SELECT comments.*, users.Username
				                      FROM
				                       comments
				                        INNER JOIN users
				                       ON
				                        comments.`user-id` = users.UserID
				                       WHERE
															 `post-id` = ?");

							// Execute The Statement

							$stmt->execute(array($postid));

							// Assign To Variable

							$rows = $stmt->fetchAll();

							if (! empty($rows)) {

							?>
									<div class="uk-padding-large uk-border-rounded">
										<table class="uk-table uk-table-divider uk-table-striped latest_table uk-box-shadow-small">
											<thead class="uk-text-center">
												<tr>
													<td>Comment</td>
													<td>status</td>
													<td>Date</td>
													<td>User</td>
				                  <td>Controls</td>
												</tr>
											</thead>
											<tbody>
											<?php
												foreach($rows as $row) { ?>
													<tr>
														<td>
															<span>
															<?php echo $row['comment']; ?>
														</span>
														</td>
														<td>
															<?php echo $row['status']; ?>
														</td>
														<td>
															<?php echo $row['comment_date']; ?>
														</td>
				                    <td>
															<?php echo $row['Username']; ?>
														</td>
														<td>
															<a href="comments.php?adminPanel=Edit-comment&commid=<?php echo $row['c_id']; ?>" class="uk-button uk-button-default">Edit</a>
															<a href="comments.php?adminPanel=Delete-comment&commid=<?php echo $row['c_id']; ?>" class="uk-button uk-button-danger  confirm"> Delete </a>
															<?php
															if ($row['status'] == 0) { ?>
																<a href="comments.php?adminPanel=Approve-comment&commid=<?php echo $row['c_id']; ?>" class="uk-button uk-button-primary activate">
																		Approve
																	</a>
														<?php	} ?>
														</td>
													</tr>
													<?php
												}
											?>
											<tr>
											</tbody>
										</table>
									</div>

							<?php } else { ?>
								<div class="uk-container">
									<div class="nice-message">There's No Comments To Show</div>
								</div>

					<?php		}
				?>


			<?php

			// If There's No Such ID Show Error Message

		} else { ?>

				<div class="uk-flex uk-flex-column uk-flex-center uk-flex-middle uk-height-viewport">
<?php
				$theMsg = '<div class="uk-alert uk-alert-danger">Theres No Such ID</div>';

				echo redirectHome($theMsg);
?>

				</div>
<?php
			}
 ?>
