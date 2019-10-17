<?php

	/*
	================================================
	== Edit Profile Page
	== You Can Edit your Profile From Here
	================================================
	*/

	ob_start(); // Output Buffering Start

	session_start();

$pageTitle = $_SESSION['user'] . "'s" . " Edit Profile";

if (isset($_SESSION['user'])) {
// get init
include 'init.php';
// get header
$hook_up->inc_header();
// users table
global $user_info;

$u_id = $user_info['UserID'];


// Select All Data Depend On This ID

$stmt = $con->prepare("SELECT * FROM users WHERE UserID = ? LIMIT 1");

// Execute Query

$stmt->execute(array($u_id));

// Fetch The Data

$row = $stmt->fetch();

// The Row Count

$count = $stmt->rowCount();
 ?>

<main class="container">
	<div class="row">
		<div class="col-sm-12 col-md-4">
			<?php	include $templates . 'sidebar.php'; ?>
		</div>
		<div class="col-sm-12 col-md-8">
			<?php if ($count > 0) { ?>
				<form class="row" method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
					<input type="hidden" name="userid" value="<?php echo $u_id ?>" />
					<div class="col-sm-12 form-group profile_img">
					<img width="200px" src="admin/uploads/avatars/<?php echo $user_info['avatar']; ?>" alt="">
					</div>
					<div class="col-sm-12 form-group">
						<input name="username" type="text" class="form-control" id="exampleInputEmail1" value="<?php echo $row['Username'] ?>" id="user" placeholder="اسم المستخدم"  autocomplete="off">
					</div>
					<div class="col-sm-12 form-group">
						<input type="text" name="full" class="form-control" value="<?php echo $row['FullName'] ?>" required="required" placeholder="اسمك بالكامل" />

					</div>
					<div class="col-sm-12 form-group">
						<input type="email" name="email" class="form-control" value="<?php echo $row['Email'] ?>" required="required" placeholder="البريد الاليكترونى" />
					</div>
					<div class="col-sm-12 form-group">
						<button type="submit" class="btn btn-secondary">
							تحديث
						</button>
					</div>
				</form>
		</div>
	<?php	} else{
		echo 'Theres No Such ID';
	} ?>
	</div>
</main>




<?php


			if ($_SERVER['REQUEST_METHOD'] == 'POST') {

				// Get Variables From The Form

				$id 	= $_POST['userid'];
				$user 	= $_POST['username'];
				$email 	= $_POST['email'];
				$name 	= $_POST['full'];
				// Upload Files
				$avatarName = $_FILES['avatar']['name'];
				$avatarTemp = $_FILES['avatar']['tmp_name'];

				// insert uploaded image
				$avatar = rand(0, 1000000) . '_' . $avatarName;

				move_uploaded_file($avatarTemp, 'uploads\avatars\\' . $avatar);
				

				// Password Trick

				$pass = empty($_POST['newpassword']) ? $_POST['oldpassword'] : sha1($_POST['newpassword']);

				// Validate The Form

				$formErrors = array();

				if (strlen($user) < 4) {
					$formErrors[] = 'Username Cant Be Less Than <strong>4 Characters</strong>';
				}

				if (strlen($user) > 20) {
					$formErrors[] = 'Username Cant Be More Than <strong>20 Characters</strong>';
				}

				if (empty($user)) {
					$formErrors[] = 'Username Cant Be <strong>Empty</strong>';
				}

				if (empty($name)) {
					$formErrors[] = 'Full Name Cant Be <strong>Empty</strong>';
				}

				if (empty($email)) {
					$formErrors[] = 'Email Cant Be <strong>Empty</strong>';
				}


				// Loop Into Errors Array And Echo It

				foreach($formErrors as $error) {
					echo '<div class="alert alert-danger">' . $error . '</div>';
				}

				// Check If There's No Error Proceed The Update Operation

				if (empty($formErrors)) {

					$stmt2 = $con->prepare("SELECT * FROM users WHERE Username = ? AND UserID != ?");

					$stmt2->execute(array($user, $id));

					$count = $stmt2->rowCount();

					if ($count == 1) {

						echo 'Sorry This User Is Exist';

					} else {

						// Update The Database With This Info

						$stmt = $con->prepare("UPDATE users SET Username = ?, Email = ?, FullName = ?, Password = ?, avatar = ? WHERE UserID = ?");

						$stmt->execute(array($user, $email, $name, $pass, $avatar, $id));

						// Echo Success Message

						echo  $stmt->rowCount() . ' Record Updated';
					}

				}

			}

 ?>

<?php
	$hook_up->inc_footer('main', '-');
	} else {
		header('Location: login.php');

		exit();
	}

	ob_end_flush(); // Release The Output
?>
