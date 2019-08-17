<?php

			// Check If Get Request userid Is Numeric & Get Its Integer Value

			$userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;

			// Select All Data Depend On This ID

			$stmt = $con->prepare("SELECT * FROM users WHERE UserID = ? LIMIT 1");

			// Execute Query

			$stmt->execute(array($userid));

			// Fetch The Data

			$row = $stmt->fetch();

			// The Row Count

			$count = $stmt->rowCount();

			// If There's Such ID Show The Form

			if ($count > 0) { ?>
				<div class="uk-container">
					<form action="?adminPanel=Update-mem" method="POST" enctype="multipart/form-data" uk-grid>
						<input type="hidden" name="userid" value="<?php echo $userid ?>" />
						<!-- Start Username Field -->
						<div class="uk-margin-small uk-width-1-1">
							<div class="uk-block">
								<label class="uk-label">Username</label>
								<input type="text" name="username" class="uk-input" value="<?php echo $row['Username'] ?>" autocomplete="off" required="required" placeholder="Username To Login Into Shop" />
							</div>
						</div>
						<!-- End Username Field -->
						<!-- Start Password Field -->
						<div class="uk-margin-small uk-width-1-1">
							<div class="uk-block">
								<label class="uk-label">Password</label>
								<input type="hidden" name="oldpassword" value="<?php echo $row['Password'] ?>" />
								<input type="password" name="newpassword" class="uk-input" value="<?php echo $row['Username'] ?>" autocomplete="off" required="required" autocomplete="new-password" placeholder="Leave Blank If You Dont Want To Change" />
							</div>
						</div>
						<!-- End Password Field -->
						<!-- Start Email Field -->
						<div class="uk-margin-small uk-width-1-1">
							<div class="uk-block">
								<label class="uk-label">Email</label>
								<input type="email" name="email" class="uk-input" value="<?php echo $row['Email'] ?>" required="required" placeholder="Email To Login Into Shop" />
							</div>
						</div>
						<!-- End Email Field -->
						<!-- Start Full Name Field -->
						<div class="uk-margin-small uk-width-1-1">
							<div class="uk-block">
								<label class="uk-label">Full Name</label>
								<input type="text" name="full" class="uk-input" value="<?php echo $row['FullName'] ?>" required="required" placeholder="Full Name" />
							</div>
						</div>
						<!-- End Full Name Field -->
						<!-- Start Upload Field -->
						<div class="uk-margin uk-width-1-1">
							<span class="uk-text-middle">Your Current Avatar</span>
							<img src="uploads\avatars\<?php echo $row['avatar']; ?>" alt="">
							<div class="uk-inline">

								<span class="uk-text-middle">Set A New Avatar for your profile</span>

								<div uk-form-custom>
										<input type="file" name="avatar">
										<span class="uk-link">upload</span>
								</div>
							</div>
						</div>
						<!-- End Upload Field -->
						<!-- Start Submit Field -->
						<div class="uk-margin-small uk-width-1-1">
							<div class="uk-block uk-text-center">
								<button type="submit" class="uk-button uk-button-secondary">
									Save <span uk-icon="check"></span>
								</button>
							</div>
						</div>
						<!-- End Submit Field -->
					</form>
				</div>

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
