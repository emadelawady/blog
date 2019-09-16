<?php

session_start();
$pageTitle = 'Create New Account';
include 'init.php';
$hook_up->inc_header();


if (isset($_session['user'])) {
  // redirect to Home page
  header('Location:index.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  if (isset($_POST['signup'])) {

  $formErrors = array();

  $username 	= $_POST['user'];
  $password 	= $_POST['pass'];
  $password2 	= $_POST['pass2'];
  $email 		= $_POST['email'];

  if (isset($username)) {

    $filterdUser = filter_var($username, FILTER_SANITIZE_STRING);

    if (strlen($filterdUser) < 4) {

      $formErrors[] = 'Username Must Be Larger Than 4 Characters';

    }

  } // end username
  if (isset($password) && isset($password2)) {
    if (empty($password)) {
      $formErrors[] = 'Must write password';
    }
    $pass_n = sha1($password);
    $pass2_n = sha1($password2);
    if ($pass_n !== $pass2_n) {
      $formErrors[] = 'Password Must Match';

    }

  } // end Password Match
  if (isset($email)) {
    $filterEmail = filter_var($email, FILTER_SANITIZE_EMAIL);
    if (filter_var($filterEmail, FILTER_VALIDATE_EMAIL) != true) {
      $formErrors[] = 'Email Must Be Valid';
    }
  } // end Email
  // Check If There's No Error Proceed The Update Operation

  if (empty($formErrors)) {

    // Check If User Exist in Database

    $check = checkItem("Username", "users", $username);

    if ($check == 1) { ?>

        <?php $formErrors[] = '<span class="uk-alert-danger">Sorry This User Is Exist</span>'; ?>
  <?php	} else {

      // Insert Userinfo In Database

      $stmt = $con->prepare("INSERT INTO
                    users(Username, Password, Email, RegStatus, Date)
                  VALUES(:zuser, :zpass, :zmail, 0, now()) ");
      $stmt->execute(array(
        'zuser' 	=> $username,
        'zpass' 	=> sha1($password),
        'zmail' 	=> $email
      ));
       $success = "<div class='uk-alert-success'>Your Account has been created, you can act like a member now</div>";
    }

  }
}
}
 ?>


 <div class="uk-section uk-section-muted uk-flex uk-flex-middle uk-animation-fade" uk-height-viewport>
     <div class="uk-width-1-1">
             <div class="uk-grid-margin uk-grid uk-grid-stack" uk-grid>
                 <div class="uk-width-1-1@m">
                   <div class="uk-margin uk-width-large uk-margin-auto uk-card uk-card-default uk-card-body uk-box-shadow-large">
                       <h3 class="uk-card-title uk-text-center">
                         سجل معنا الان
                       </h3>

<!-- Start Sign Up Form -->

<form class="uk-form  uk-height-1-1 uk-width-1-1 uk-flex-middle signup uk-flex" method="POST" <?php $_SERVER['PHP_SELF'] ?>>
  <div class="uk-form-row uk-text-center">
    <div class="uk-margin">
    <label class="uk-form-label uk-padding-small" for="user">إسم المستخدم</label>
    <div class="uk-form-controls uk-inline-clip">
      <input name="user" pattern=".{4,20}" title="Must be between 4 - 20" class="uk-padding-small uk-input" type="text" id="user" placeholder="الإسم" required autocomplete="off">
    </div>
  </div>
  <div class="uk-margin">
  <label class="uk-form-label uk-padding-small" for="password">كلمة المرور</label>
  <div class="uk-form-controls uk-inline-clip">
    <input name="pass" minlength="6" class="uk-padding-small uk-input" type="password" id="password" placeholder="لا تقل عن 6" autocomplete="new-password" required>
      </div>
    </div>
    <div class="uk-margin">
    <label class="uk-form-label uk-padding-small" for="password">إعادة كلمة المرور</label>
    <div class="uk-form-controls uk-inline-clip">
      <input name="pass2" minlength="6" class="uk-padding-small uk-input" type="password" id="password2" placeholder="" autocomplete="new-password" required>
        </div>
      </div>
    <div class="uk-margin">
    <label class="uk-form-label uk-padding-small" for="user">البريد الالكترونى</label>
    <div class="uk-form-controls uk-inline-clip">
      <input name="email" class="uk-padding-small uk-input" type="email" id="email" placeholder="" required>
    </div>
  </div>
    <div class="uk-margin">
    <div class="uk-form-controls">
      <input class="uk-button uk-button-primary" name="signup" type="submit" id="submit" value="Sign Up">
        </div>
      </div>
  </div>
</form>
</div>

<div class="uk-width-1-1 errors">
  <?php
  global $formErrors;
//  print_r($formErrors);

if (is_array($formErrors) || is_object($formErrors))
{
    foreach ($formErrors as $err)
    {
      echo $err . '<br>';
    }
}
if (isset($success)) { ?>
    <?php echo $success; ?>
<?php
}
   ?>
</div>


</div>
</div>
</div>
</div>

<?php include $templates . 'footer-main.php'; ?>
