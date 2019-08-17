<!-- Add New Member -->
<div class="uk-container">
	<form  action="?adminPanel=Insert-mem" method="POST" enctype="multipart/form-data" class="uk-margin-auto uk-text-center" uk-grid>
		<!-- Start Username Field -->
		<div class="uk-margin uk-width-1-1">
			<div class="uk-inline">
				<span class="uk-form-icon" uk-icon="icon: user"></span>
				<input type="text" name="username" class="uk-input uk-form-width-large" autocomplete="off" required="required" placeholder="Username To Login Into Shop" />
			</div>
		</div>
		<!-- End Username Field -->
		<!-- Start Password Field -->
		<div class="uk-margin uk-width-1-1">
			<div class="uk-inline">
					<span class="uk-form-icon uk-form-icon-flip" uk-icon="icon: lock"></span>
					<input type="password" name="password" class="password uk-input uk-form-width-large" required="required" autocomplete="new-password" placeholder="Password Must Be Hard & Complex" />
			</div>
		</div>
		<!-- End Password Field -->
		<!-- Start Email Field -->
		<div class="uk-margin uk-width-1-1">
			<div class="uk-inline">
				<span class="uk-form-icon" uk-icon="icon: email"></span>
				<input type="email" name="email" class="uk-input uk-form-width-large" required="required" placeholder="Email Must Be Valid" />
			</div>
		</div>
		<!-- End Email Field -->
		<!-- Start Full Name Field -->
		<div class="uk-margin uk-width-1-1">
			<div class="uk-inline">
				<span class="uk-form-icon" uk-icon="icon: email"></span>
				<input type="text" name="full" class="uk-input uk-form-width-large" required="required" placeholder="Full Name Appear In Your Profile Page" />
			</div>
		</div>
		<!-- End Full Name Field -->
		<!-- Start Upload Field -->
		<div class="uk-margin uk-width-1-1">
			<div class="uk-inline">
				<span class="uk-text-middle">Set An Avatar for your profile</span>
				<div uk-form-custom>
						<input type="file" name="avatar">
						<span class="uk-link">upload</span>
				</div>
			</div>
		</div>
		<!-- End Upload Field -->
		<!-- Start Submit Field -->
		<div class="uk-margin uk-width-1-1">
			<div class="uk-inline">
				<input type="submit" value="Add Member" class="uk-button uk-button-primary" />
			</div>
		</div>
		<!-- End Submit Field -->
	</form>
</div>
