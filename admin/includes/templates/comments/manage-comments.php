<?php
			// Select All Users Except Admin

			$stmt = $con->prepare("SELECT comments.*, posts.Name, users.Username
                      FROM
                       comments
                       INNER JOIN posts
                       ON
                        comments.`post-id` = posts.Post_ID
                        INNER JOIN users
                       ON
                        comments.`user-id` = users.UserID
                       ");

			// Execute The Statement

			$stmt->execute();

			// Assign To Variable

			$rows = $stmt->fetchAll();

			if (! empty($rows)) {

			?>
					<div class="uk-padding-large uk-border-rounded">
						<table class="uk-table uk-table-divider uk-table-striped latest_table uk-box-shadow-small">
							<thead class="uk-text-center">
								<tr>
									<td>#ID</td>
									<td>Comment</td>
									<td>status</td>
									<td>Date</td>
									<td>Post</td>
									<td>User</td>
                  <td>Controls</td>
								</tr>
							</thead>
							<tbody>
							<?php
								foreach($rows as $row) { ?>
									<tr>
										<td><?php echo $row['c_id']; ?></td>
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
											<?php echo $row['Name']; ?>
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
