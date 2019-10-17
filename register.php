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

        <?php $formErrors[] = '<span class="alert-danger">Sorry This User Is Exist</span>'; ?>
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
       $success = "<div class='alert-success'>Your Account has been created, you can act like a member now</div>";
    }

  }
}
}
 ?>


 <div class="container">
     <div class="row">
       <div class="col-sm-12">

         <form class="login row" method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
        <div class="col-sm-12 form-group">
          <h1 class="text-center">
            سجل معنا الان
          </h1>
        </div>
          <div class="col-sm-12 form-group">
            <input name="user" pattern=".{4,20}" title="Must be between 4 - 20" class="form-control" type="text" id="user" placeholder="الإسم" required autocomplete="off">
        </div>
        <div class="col-sm-12 col-lg-6 form-group">
          <input name="pass" minlength="6" class="form-control" type="password" id="password" placeholder="كلمة المرور" autocomplete="new-password" required>
          </div>
          <div class="col-sm-12 col-lg-6 form-group">
            <input name="pass2" minlength="6" class="form-control" type="password" id="password2" placeholder="تأكيد كلمة المرور" autocomplete="new-password" required>
            </div>
          <div class="col-sm-12 form-group">
            <input name="email" class="form-control" type="email" id="email" placeholder="البريد الاليكترونى" required>
        </div>
        <div class="col-sm-12 form-group text-center">
          <input class="btn" name="signup" type="submit" id="submit" value="Sign Up" style="background: #673ab7;color:#fff;">
          </div>
        <div class="col-sm-12 form-group errors">
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
      </form>
    </div>
  </div>
</div>

<?php include $templates . 'footer-main.php'; ?>
