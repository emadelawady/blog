<?php
// Insert Member Page

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	// Get Variables From The Form

	$user 	= $_POST['username'];
	$pass 	= $_POST['password'];
	$email 	= $_POST['email'];
	$name 	= $_POST['full'];

	$hashPass = sha1($_POST['password']);

	// Upload Files
	$avatarName = $_FILES['avatar']['name'];
	$avatarSize = $_FILES['avatar']['size'];
	$avatarTemp = $_FILES['avatar']['tmp_name'];
	$avatarType = $_FILES['avatar']['type'];

	$avatarAllowedExtention = array('jpeg', 'jpg', 'png', 'gif');

	$extention = explode('.', $avatarName);

	$avatarExtention  = strtolower(end($extention));

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

	if (empty($pass)) {
		$formErrors[] = 'Password Cant Be <strong>Empty</strong>';
	}

	if (empty($name)) {
		$formErrors[] = 'Full Name Cant Be <strong>Empty</strong>';
	}

	if (empty($email)) {
		$formErrors[] = 'Email Cant Be <strong>Empty</strong>';
	}

	if (!empty($avatarName) && ! in_array($avatarExtention, $avatarAllowedExtention)) {
		$formErrors[] = 'This Type of data is not <strong>Supported</strong>';
	}

	if ($avatarSize > 4194304) {
		$formErrors[] = 'Avatar Size can\'t be more than <strong>4MB</strong>';
	}

	if (empty($avatarName)) {
		$formErrors[] = 'Avatar can\'t be <strong>Empty</strong>';
	}

	// Loop Into Errors Array And Echo It

	foreach($formErrors as $error) {
		echo '<div class="">' . $error . '</div>';
	}

	// Check If There's No Error Proceed The Update Operation

	if (empty($formErrors)) {
		// insert uploaded image
		$avatar = rand(0, 1000000) . '_' . $avatarName;

		move_uploaded_file($avatarTemp, 'uploads\avatars\\' . $avatar);
		// Check If User Exist in Database

		$check = checkItem("Username", "users", $user);

		if ($check == 1) { ?>

			<div class="uk-flex uk-flex-column uk-flex-center uk-flex-middle uk-height-viewport">
				<?php
			$theMsg = '<span class="uk-alert-danger">Sorry This User Is Exist</span>';
			echo redirectHome($theMsg, 'back'); ?>
		</div>
	<?php	} else {

			// Insert Userinfo In Database

			$stmt = $con->prepare("INSERT INTO
										users(Username, Password, Email, FullName, RegStatus, Date, avatar)
									VALUES(:zuser, :zpass, :zmail, :zname, 1, now(), :zavatar) ");
			$stmt->execute(array(
				'zuser' 	=> $user,
				'zpass' 	=> $hashPass,
				'zmail' 	=> $email,
				'zname' 	=> $name,
				'zavatar' => $avatar
			)); ?>

			<div class="uk-flex uk-flex-column uk-flex-center uk-flex-middle uk-height-viewport">
				<?php
			// Echo Success Message
			 $theMsg = "<div class='uk-alert-success'>" . $stmt->rowCount() . ' Record Inserted</div>';
			echo redirectHome($theMsg, 'back', 3); ?>
		</div>
			<?php

		}

	}


} else { ?>
	<div class="uk-flex uk-flex-column uk-flex-center uk-flex-middle uk-height-viewport">
		<?php
	$theMsg = '<span class="uk-alert-danger">Sorry You Cant Browse This Page Directly</span>';

	 echo redirectHome($theMsg, ''); ?>
	</div>
<?php
}
 ?>
