<?php
			echo "<div class='uk-container'>";

				// Check If Get Request userid Is Numeric & Get The Integer Value Of It

				$postid = isset($_GET['postid']) && is_numeric($_GET['postid']) ? intval($_GET['postid']) : 0;

				// Select All Data Depend On This ID

				$check = checkItem('Post_ID', 'posts', $postid);

				// If There's Such ID Show The Form

				if ($check > 0) {

					$stmt = $con->prepare("DELETE FROM posts WHERE Post_ID = :zname");

					$stmt->bindParam(":zname", $postid);

					$stmt->execute();

					$theMsg = "<div class='uk-alert uk-alert-success'>" . $stmt->rowCount() . ' Post Deleted</div>';

					echo redirectHome($theMsg, 'back');

				} else {

					$theMsg = '<div class="uk-alert uk-alert-danger">This ID is Not Exist</div>';

					echo redirectHome($theMsg);

				}

			echo '</div>';
 ?>
