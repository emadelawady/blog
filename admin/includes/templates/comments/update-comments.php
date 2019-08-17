<?php
			echo "<div class='uk-container'>";

			if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        // Get Variables From The Form
        $commid 		= $_POST['commid'];
      	$comment 	= $_POST['comment'];
      	$status 	= $_POST['comment-status'];


				// Check If There's No Error Proceed The Update Operation

				if (empty($formErrors)) {

					$stmt2 = $con->prepare("UPDATE comments SET
												   comment = ?,
                           status = ?
											WHERE
												c_id = ?");

					$stmt2->execute(array($comment, $status, $commid));

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
