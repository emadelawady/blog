<?php

			// Select All Users Except Admin

			$stmt = $con->prepare("SELECT
														posts.*,
														categories.Name AS cat_name,
														users.Username
														FROM posts INNER JOIN categories
														ON
															categories.ID = posts.Cat_ID
														INNER JOIN users
														ON
															users.UserID = posts.Member_ID
														ORDER BY Post_ID DESC
															");

			// Execute The Statement

			$stmt->execute();

			// Assign To Variable

			$posts = $stmt->fetchAll();

			if (!empty($posts)) {

			?>
					<div class="uk-padding-large uk-border-rounded">
						<table class="uk-table uk-table-divider uk-table-striped latest_table uk-box-shadow-small">
							<thead class="uk-text-center">
								<tr>
									<td>#ID</td>
									<td>Fratured Image</td>
									<td>Post's Name</td>
									<td>Description</td>
									<td>Status</td>
									<td>Registered Date</td>
									<td>Author</td>
									<td>Category</td>
									<td>Control</td>
								</tr>
							</thead>
							<tbody>
							<?php
								foreach($posts as $row) { ?>
									<tr>
										<td><?php echo $row['Post_ID']; ?></td>
										<td>
											<img width="200px" src="uploads/posts/<?php
											echo empty($row['Image']) ? 'user.jpg' : $row['Image'];?>" />
										</td>
										<td>
											<span>
											<?php echo $row['Name']; ?>
										</span>
										</td>
										<td>
											<?php echo excerpt_len($row['Description'], $len = 25, $dots = true); ?>
										</td>
										<td>
											<?php echo $row['Status'] == 1 ? "published" : "drafted"; ?>
										</td>
										<td>
											<?php echo $row['Add_Date']; ?>
										</td>
										<td>
											<?php echo $row['Username']; ?>
										</td>
										<td>
											<?php echo $row['cat_name']; ?>
										</td>
										<td>
											<a href="posts.php?adminPanel=Edit-posts&postid=<?php echo $row['Post_ID']; ?>" class="uk-button uk-button-default">Edit</a>
											<a href="posts.php?adminPanel=Delete-posts&postid=<?php echo $row['Post_ID']; ?>" class="uk-button uk-button-danger  confirm"> Delete </a>
											<?php
											if ($row['Approve'] == 0) { ?>
												<a href="posts.php?adminPanel=Approve-posts&postid=<?php echo $row['Post_ID']; ?>" class="uk-button uk-button-primary activate">
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
					<a href="posts.php?adminPanel=Add-posts" class="uk-button uk-button-primary">
						<span uk-icon="plus"></span> New Post
					</a>

			<?php } else { ?>
				<div class="uk-container">
					<div class="nice-message">There's No Members To Show</div>
					<a href="posts.php?adminPanel=Add-posts" class="uk-button uk-button-primary">
							<i class="fa fa-plus"></i> New Post
						</a>
				</div>

	<?php		}
?>
