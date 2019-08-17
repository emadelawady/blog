<?php

			$query = '';

			if (isset($_GET['page']) && $_GET['page'] == 'Pending') {

				$query = 'AND RegStatus = 0';

			}
			// Select All Users Except Admin

			$stmt = $con->prepare("SELECT * FROM users WHERE GroupID != 1 $query ORDER BY UserID DESC");

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
									<td>Image</td>
									<td>Username</td>
									<td>Email</td>
									<td>Full Name</td>
									<td>Registered Date</td>
									<td>Control</td>
								</tr>
							</thead>
							<tbody>
							<?php
								foreach($rows as $row) { ?>
									<tr>
										<td><?php echo $row['UserID']; ?></td>
										<td>
											<img width="80px" height="80px"  class="uk-border-rounded" src="uploads\avatars\<?php echo $row['avatar']; ?>" alt="">	
										</td>
										<td>
											<span>
											<?php echo $row['Username']; ?>
										</span>
										</td>
										<td>
											<?php echo $row['Email']; ?>
										</td>
										<td>
											<?php echo $row['FullName']; ?>
										</td>
										<td>
											<?php echo $row['Date']; ?>
										</td>
										<td>
											<a href="members.php?adminPanel=Edit-mem&userid=<?php echo $row['UserID']; ?>" class="uk-button uk-button-default">Edit</a>
											<a href="members.php?adminPanel=Delete-mem&userid=<?php echo $row['UserID']; ?>" class="uk-button uk-button-danger  confirm"> Delete </a>
											<?php
											if ($row['RegStatus'] == 0) { ?>
												<a href="members.php?adminPanel=Activate-mem&userid=<?php echo $row['UserID']; ?>" class="uk-button uk-button-primary activate">
														Activate
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
					<a href="members.php?adminPanel=Add-mem" class="uk-button uk-button-primary">
						<span uk-icon="plus"></span> New Member
					</a>

			<?php } else { ?>
				<div class="uk-container">
					<div class="nice-message">There's No Members To Show</div>
					<a href="members.php?adminPanel=Add-mem" class="uk-button uk-button-primary">
							<i class="fa fa-plus"></i> New Member
						</a>
				</div>

	<?php		}
?>
