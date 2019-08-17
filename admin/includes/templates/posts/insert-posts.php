<?php
// Insert Member Page

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	// Get Variables From The Form

	$name 	= $_POST['name'];
	$desc 	= $_POST['description'];
	$status 	= $_POST['status'];
	$members 	= $_POST['members'];
	$cat 	= $_POST['cat'];
	$tags = filter_var($_POST['tags'], FILTER_SANITIZE_STRING);

	$imageName = $_FILES['post_upload']['name'];
	$imageType = $_FILES['post_upload']['type'];
	$imageSize = $_FILES['post_upload']['size'];
	$imageTmp = $_FILES['post_upload']['tmp_name'];


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
		echo '<div class="">' . $error . '</div>';
	}

	// Check If There's No Error Proceed The Update Operation

	if (empty($formErrors)) {
			// Insert Userinfo In Database

				$featured = rand(0, 100000) . '_' .  $imageName;

				move_uploaded_file($imageTmp, 'uploads/posts/' . $featured);

			$stmt = $con->prepare("INSERT INTO
										posts(Name, Description, Status, Add_Date, Member_ID, Cat_ID, tags, Image)
									VALUES(:zname, :zdesc, :zstatus, now(), :zmem, :zcat, :ztags, :zfeat) ");
			$stmt->execute(array(
				'zname' 		=> $name,
				'zdesc' 		=> $desc,
				'zstatus' 	=> $status,
				'zmem'			=> $members,
				'zcat'			=> $cat,
				'ztags'			=> $tags,
				'zfeat'			=> $featured
			)); ?>

			<div class="uk-flex uk-flex-column uk-flex-center uk-flex-middle uk-height-viewport">
				<?php
			// Echo Success Message
			 $theMsg = "<div class='uk-alert-success'>" . $stmt->rowCount() . ' Record Inserted</div>';
			echo redirectHome($theMsg, 'back', 3); ?>
		</div>
			<?php
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
