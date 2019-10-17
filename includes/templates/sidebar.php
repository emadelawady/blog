<div uk-sticky>
<div class="media" uk-grid>
  <div uk-grid>
  <a class="">
    <i class="fas fa-bell"></i>
</a>
  <a href="" class="">
    <i class="fas fa-edit"></i>
  </a>
  <a class="" uk-tooltip="title: top; pos: right">
    <i uk-totop uk-scroll></i>
  </a>
</div>
</div>
<!-- Start My Information -->

<div class="uk-width-1-1 uk-card uk-card-default uk-padding-remove background-main fullHieght">
  <div class="">
      <h3 class="side-profile-title">My Information</h3>
  </div>
  <div class="uk-card-body uk-padding-small uk-margin-remove">
    <!-- Left -->
    <div class="uk-text-center">
    <img width="70%" src="user.jpg" alt="">
    <h4 class="uk-text-capitalize"><?php echo $user_info['Username']; ?> </h4>
  </div>
  <!-- Start Password Field -->
  <div class="uk-margin-small uk-width-1-1">
    <div class="uk-block">
      <label class="uk-label">Password</label>
      <input type="hidden" name="oldpassword" value="<?php echo $row['Password'] ?>" />
      <input type="password" name="newpassword" class="uk-input" value="<?php echo $row['Username'] ?>" autocomplete="off" required="required" autocomplete="new-password" placeholder="Leave Blank If You Dont Want To Change" />
    </div>
  </div>
  <!-- End Password Field -->
  <!-- Right -->
  <div class="uk-text-center">
    <div class="uk-block">
      <span class="uk-label">@ </span>
       <span class=""><?php echo $user_info['Email']; ?></span>
    </div>
    <div class="uk-block">
      <span class="uk-label"> - </span>
      <?php if ($user_info['RegStatus'] == 1) {
        echo "<span class='uk-alert-success'>Activated</span>";
      } else{
        echo "<span class='uk-alert-danger'>Not Activated</span>";

      }?>
    </div>
  </div>
  </div>
</div>
<!-- End My Information -->


</div>
