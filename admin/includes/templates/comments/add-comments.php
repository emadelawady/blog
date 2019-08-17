<div class="uk-container">
	<form  action="?adminPanel=Insert-comment" method="POST" enctype="multipart/form-data" class="uk-margin-auto uk-text-center" uk-grid>
		<!-- Start comment Field -->
		<div class="uk-margin uk-width-1-1">
			<div class="uk-inline">
				<span class="uk-form-icon" uk-icon="icon: user"></span>
				<input type="text" name="comment" class="uk-input uk-form-width-large" autocomplete="off" required="required" placeholder="comment" />
			</div>
		</div>
		<!-- End comment Field -->
    <!-- Start Status Field -->
		<div class="uk-margin uk-width-1-1">
			<div class="uk-inline">
          <span>Comments Status</span>
          <select class="uk-form-select uk-select" name="comment-status"  data-uk-form-select>
            <option value="1">Publish</option>
            <option value="0">Draft</option>
          </select>
			</div>
		</div>
		<!-- End Status Field -->
    <!-- Start Post Field -->
    <div class="uk-margin uk-width-1-1">
      <div class="uk-inline">
          <span>Post</span>
          <select class="uk-form-select uk-select" name="posts"  data-uk-form-select>
            <option value="0">...</option>
            <?php
              $stmt = $con->prepare("SELECT * FROM posts");
              $stmt->execute();
              $posts = $stmt->fetchAll();
              foreach ($posts as $post) { ?>
                <option value="<?php echo $post['Post_ID'] ?>"><?php echo $post['Name']; ?></option>
            <?php
            }
            ?>
          </select>
      </div>
    </div>
    <!-- End Post Field -->
    <!-- Start Members Field -->
    <div class="uk-margin uk-width-1-1">
      <div class="uk-inline">
          <span>Members</span>
          <select class="uk-form-select uk-select" name="members"  data-uk-form-select>
            <option value="0">...</option>
            <?php
              $stmt = $con->prepare("SELECT * FROM users");
              $stmt->execute();
              $users = $stmt->fetchAll();
              foreach ($users as $user) { ?>
                <option value="<?php echo $user['UserID'] ?>"><?php echo $user['Username']; ?></option>
            <?php
            }
            ?>
          </select>
      </div>
    </div>
    <!-- End Members Field -->
		<!-- Start Submit Field -->
		<div class="uk-margin uk-width-1-1">
			<div class="uk-inline">
				<input type="submit" value="Add comment" class="uk-button uk-button-primary" />
			</div>
		</div>
		<!-- End Submit Field -->
	</form>
</div>
