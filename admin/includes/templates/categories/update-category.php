<?php
			echo "<div class='uk-container'>";

			if ($_SERVER['REQUEST_METHOD'] == 'POST') {

				// Get Variables From The Form

				$id 		= $_POST['catid'];
				$name 		= $_POST['name'];
				$desc 		= $_POST['description'];
				$order 		= $_POST['ordering'];
				$parent 	= $_POST['parent'];
				$visible 	= $_POST['visibility'];
				$comment 	= $_POST['commenting'];
				$ads 		= $_POST['ads'];

				// Update The Database With This Info

				$stmt = $con->prepare("UPDATE
											categories
										SET
											Name = ?,
											Description = ?,
											Ordering = ?,
											parent = ?,
											Visibility = ?,
											Allow_Comment = ?,
											Allow_Ads = ?
										WHERE
											ID = ?");

				$stmt->execute(array($name, $desc, $order,$parent, $visible, $comment, $ads, $id));

				// Echo Success Message

				$theMsg = "<div class='uk-alert uk-alert-success'>" . $stmt->rowCount() . ' Record Updated</div>';

				echo redirectHome($theMsg, 'back');

			} else {

				$theMsg = '<div class="uk-alert uk-alert-danger">Sorry You Cant Browse This Page cat Directly</div>';

				echo redirectHome($theMsg);

			}

			echo "</div>";

 ?>
