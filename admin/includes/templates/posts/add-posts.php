<div class="uk-container">
	<form  action="?adminPanel=Insert-posts" method="POST" enctype="multipart/form-data" class="uk-margin-auto uk-text-center" uk-grid>
		<!-- Start Post Name Field -->
		<div class="uk-margin uk-width-1-1">
			<div class="uk-inline">
				<span class="uk-form-icon" uk-icon="icon: user"></span>
				<input type="text" name="name" class="uk-input uk-form-width-large" autocomplete="off"  placeholder="Post Name" />
			</div>
		</div>
		<!-- End Post Name Field -->
		<!-- Start Description Field -->
		<div class="uk-margin uk-width-1-1">
			<div class="uk-inline">
					<span class="uk-form-icon uk-form-icon-flip" uk-icon="icon: lock"></span>
					<textarea name="description" class="uk-textarea uk-form-width-large" placeholder="Description"></textarea>
			</div>
		</div>
		<!-- End Description Field -->
		<!-- Start Status Field -->
		<div class="uk-margin uk-width-1-1">
			<div class="uk-inline">
          <span>Status</span>
          <select class="uk-form-select uk-select" name="status"  data-uk-form-select>
						<option value="">...</option>
            <option value="1">Publish</option>
            <option value="0">Draft</option>
          </select>
			</div>
		</div>
		<!-- End Status Field -->
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
    <!-- Start category Field -->
    <div class="uk-margin uk-width-1-1">
      <div class="uk-inline">
          <span>Category</span>
          <select class="uk-form-select uk-select" name="cat"  data-uk-form-select>
            <option value="0">...</option>
            <?php
              $stmt = $con->prepare("SELECT * FROM categories");
              $stmt->execute();
              $cats = $stmt->fetchAll();
              foreach ($cats as $cat) { ?>
                <option value="<?php echo $cat['ID'] ?>"><?php echo $cat['Name']; ?></option>
            <?php
            }
            ?>
          </select>
      </div>
    </div>
    <!-- End Category Field -->
		<!-- Start Tags Field -->
		<div class="uk-margin uk-width-1-1">
			<div class="uk-inline">
				<i class="fas fa-tags"></i>
				<input type="text" name="tags" class="uk-input uk-form-width-large" placeholder="separate tags with commas (,)" />
			</div>
		</div>
		<!-- End Tags Field -->
		<!-- Start post image Field -->
		<div class="uk-margin uk-width-1-1 image_upload">
			<div class="uk-inline">
				<span class="uk-form-icon" uk-icon="icon: user"></span>
				<input id="image" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])" type="file" name="post_upload" class="uk-input uk-form-width-large" required="required" />
						<img id="blah"  width="100" height="100" />
			</div>
		</div>
		<!-- End post image Field -->
		<!-- Start Submit Field -->
		<div class="uk-margin uk-width-1-1">
			<div class="uk-inline">
				<input type="submit" value="Add Post" class="uk-button uk-button-primary" />
			</div>
		</div>
		<!-- End Submit Field -->
	</form>
</div>
