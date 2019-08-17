<?php
session_start();
$pageTitle = 'Login';
include 'init.php';
$hook_up->inc_header();


if (isset($_session['user'])) {
  // redirect to Home page
  header('Location:index.php');
} else{
  echo "
  <style>
  .front_header  {display: none;}
  </style>
  ";
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  if (isset($_POST['login'])) {
  // get Values from the FORM by POST method
  $user = $_POST['user'];
  $pass = $_POST['pass'];

  $hasedPass = sha1($pass);

  $stmt = $con->prepare("SELECT UserID, Username, Password FROM users WHERE Username = ? AND Password = ?");


  $stmt->execute(array($user, $hasedPass));

  $get = $stmt->fetch();

  $count = $stmt->rowCount();

  if ($count > 0) {

    $_SESSION['user'] = $user;
    $_SESSION['u_id'] = $get['UserID'];

    header('Location: profile.php');
    exit();
    }
  } else{
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

        <div class="uk-flex uk-flex-column uk-flex-center uk-flex-middle uk-height-viewport">
          <?php $formErrors[] = '<span class="uk-alert-danger">Sorry This User Is Exist</span>'; ?>
      </div>
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

$actual_link = "http://" .$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

if($actual_link){echo "<style>.log-sign{display: none;}</style>";}
?>
<div class="uk-container hold-login">
<div class="login-page" uk-grid>
  <div class="uk-width-1-1">
    <h2 class="uk-text-center">
      <span class="selected" data-class="login">Login</span> ||
      <span data-class="signup">Sign Up</span>
    </h2>
  </div>
<!-- Start Login Form -->

<form class="uk-form uk-height-1-1 uk-width-1-1 uk-flex uk-flex-middle login" method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
  <div class="uk-form-row uk-text-center">
    <div class="uk-margin">
    <label class="uk-form-label uk-padding-small" for="user">User Name</label>
    <div class="uk-form-controls uk-inline-clip">
      <input name="user" class="uk-padding-small uk-input" type="text" id="user" placeholder="Admin User Name"  autocomplete="off">
    </div>
  </div>
  <div class="uk-margin">
  <label class="uk-form-label uk-padding-small" for="password">Password</label>
  <div class="uk-form-controls uk-inline-clip">
    <input name="pass" class="uk-padding-small uk-input" type="password" id="password" placeholder="Admin Password" autocomplete="new-password">
      </div>
    </div>
    <div class="uk-margin">
    <div class="uk-form-controls">
      <input class="uk-button uk-button-primary" name="login" type="submit" id="submit" value="log in">
        </div>
      </div>
  </div>
</form>

<!-- End Login Form -->

<!-- Start Sign Up Form -->

<form class="uk-form  uk-height-1-1 uk-width-1-1 uk-flex-middle signup uk-flex" method="POST" <?php $_SERVER['PHP_SELF'] ?>>
  <div class="uk-form-row uk-text-center">
    <div class="uk-margin">
    <label class="uk-form-label uk-padding-small" for="user">User Name</label>
    <div class="uk-form-controls uk-inline-clip">
      <input name="user" pattern=".{4,20}" title="Must be between 4 - 20" class="uk-padding-small uk-input" type="text" id="user" placeholder="User Name" required autocomplete="off">
    </div>
  </div>
  <div class="uk-margin">
  <label class="uk-form-label uk-padding-small" for="password">Password</label>
  <div class="uk-form-controls uk-inline-clip">
    <input name="pass" minlength="6" class="uk-padding-small uk-input" type="password" id="password" placeholder="Password" autocomplete="new-password" required>
      </div>
    </div>
    <div class="uk-margin">
    <label class="uk-form-label uk-padding-small" for="password">Repeat Password</label>
    <div class="uk-form-controls uk-inline-clip">
      <input name="pass2" minlength="6" class="uk-padding-small uk-input" type="password" id="password2" placeholder="Password" autocomplete="new-password" required>
        </div>
      </div>
    <div class="uk-margin">
    <label class="uk-form-label uk-padding-small" for="user">Email</label>
    <div class="uk-form-controls uk-inline-clip">
      <input name="email" class="uk-padding-small uk-input" type="email" id="email" placeholder="your Email" required>
    </div>
  </div>
    <div class="uk-margin">
    <div class="uk-form-controls">
      <input class="uk-button uk-button-primary" name="signup" type="submit" id="submit" value="Sign Up">
        </div>
      </div>
  </div>
</form>
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
  <div class="uk-flex uk-flex-column uk-flex-center uk-flex-middle uk-height-viewport">
    <?php echo $success; ?>
 </div>
<?php
}
   ?>
</div>

<!-- End Sign Up Form  -->

</div>
</div>
<?php include $templates . 'footer.php'; ?>
