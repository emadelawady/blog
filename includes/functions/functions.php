<?php
// front end functions


/*==========================================
== get_cat() func to select Posts v0.1
============================================*/
function get_posts($cat_id = NULL) {
  global $con;

  $getPosts = $con->prepare(
    "SELECT posts.*, users.Username
      FROM posts
      INNER JOIN users
      ON users.UserID = posts.Member_ID
      WHERE Cat_ID = ? ORDER BY Post_ID DESC
      "
  );

  $getPosts->execute($cat_id);

  $posts = $getPosts->fetchAll();

    return $posts;

}


/*==============================================================================
= get_posts_by() v0.2
= to select Posts by Approve or Not-Approve Posts [ 3 Parameters]
= $where = the column name
= $value = value to execute in array to bind with $where column name
= $approve = ture is the default for approved posts only, false for All Posts
// ::NOTICE:: //
- This func will return always only Approved Posts
- you can set the 3rd param to 'false' for all posts
==============================================================================*/

function get_posts_by($where, $value = NULL, $limit = 2) {
  global $con;
  $get_posts = $con->prepare(
    "SELECT posts.*, users.Username
      FROM posts
      INNER JOIN users
      ON users.UserID = posts.Member_ID
      WHERE $where = ? ORDER BY Post_ID DESC LIMIT $limit
      ");
    $get_posts->execute(array($value));
    $the_posts = $get_posts->fetchAll();
    return $the_posts;
}

/*=========================================================
= check_reg_status() v0.2
= Function to check user MemberShip Status [ 1 Parameter ]
= $user = [Required] for bind and execute Username col
============================================================*/

function check_reg_status($user) {
  global $con;

  $state = $con->prepare("SELECT Username, RegStatus FROM users WHERE Username = ? AND RegStatus = 0");

  $state->execute(array($user));

  $status = $state->rowCOunt();
  return $status;
}

/*
** Check Items Function v1.0
** Function to Check Item In Database [ Function Accept Parameters ]
** $select = The Item To Select [ Example: user, item, category ]
** $from = The Table To Select From [ Example: users, items, categories ]
** $value = The Value Of Select [ Example: Osama, Box, Electronics ]
*/

function checkItem($select, $from, $value) {

  global $con;

  $statement = $con->prepare("SELECT $select FROM $from WHERE $select = ?");

  $statement->execute(array($value));

  $count = $statement->rowCount();

  return $count;

}

function get_latest($sel, $table, $order, $limit = 5) {
  global $con;

  $stmt = $con->prepare("SELECT $sel FROM $table ORDER BY $order DESC LIMIT $limit");

  $stmt->execute();

  $row = $stmt->fetchAll();

  return $row;

}

/*==========================================
- excerpt_words() func to select Posts v0.1
- for trim content
- $string = the string to trim
- $len = number of letters [default: 20]
- $words = count of words to run fun [default: 2]
============================================*/
function excerpt_len($string, $len = 20, $dots = false, $words = 2) {

  $count = $string;
  if ($dots !== false) {
    $dots = ' ..';
  } else{
    $dots = '';
  }
  if (strlen($count) > $words ) {

      return substr($string,0, $len) . $dots;

  }
}
/*==========================================
- get_all_rec() func to select Any record from DB v0.2.1.0
- for Target any record return with data [ 2 parameters ]
- $cols = target column to select
- $table = the table
- $where =
============================================*/

function get_all_rec($cols, $tables, $where = NULL, $orderby = NULL, $limits = 1, $inner = NULL){

  global $con;
  $inner_join = '';
  $inner_where = '';

if ($inner != NULL) { $inner_join = ' INNER JOIN ' . $inner; }
if ($where != NULL) { $inner_where = ' WHERE ' . $where; }

$cat_state = $con->prepare("SELECT $cols FROM $tables
$inner_where $inner_join ORDER BY $orderby LIMIT $limits");
$cat_state->execute();
$the_cat = $cat_state->fetchALL();
return $the_cat;
}











 /**
** enqueue styles
 **/

 function on_styles($style = NULL, $switch = 'on') {
   global $css;
   // var for hold LINK REL
  //echo $link_rel = '<link rel="stylesheet" href="' . $css . 'uikit.min.css">' . PHP_EOL;
  $mainStyle = '';
  if ($style == $style && $switch == 'on') {
    $mainStyle = $style;
  } elseif($style == $style &&  $switch == 'off') {
    $mainStyle = '';
    echo "string";
  }
  if ($mainStyle == $style) {
    $link_rel = '<link rel="stylesheet" href="' . $css . $style .'.css"> ' . PHP_EOL ;
    echo $link_rel;
  }
 }

 function on_scripts($script = NULL, $switch = 'on') {
   global $js;
   // var for hold LINK REL
  //echo $link_rel = '<link rel="stylesheet" href="' . $css . 'uikit.min.css">' . PHP_EOL;
  $mainScript = '';
  if ($script == $script && $switch == 'on') {
    $mainScript = $script;
  } elseif($script == $script &&  $switch == 'off') {
    $mainScript = '';
  }
  if ($mainScript == $script) {
    $script_src = '<script src="'. $js . $script . '.js"></script>' . PHP_EOL ;
    echo $script_src;
  }
 }

 /**
** print uk-active class
 **/

 // function setActive($value) {
 //   if (isset($_GET['adminPanel']) && $_GET['adminPanel'] == $value ) {
 //     echo "active";
 //   }
 // }

 function setActive($get_req = NULL, $page = NULL) {

   echo $re_turn = isset($_GET[$get_req]) && $_GET[$get_req] == $page ?  "active" :  "nonActive";
	 return $re_turn;
	}


 /*
 ** Home Redirect Function v2.0
 ** This Function Accept Parameters
 ** $theMsg = Echo The Message [ Error | Success | Warning ]
 ** $url = The Link You Want To Redirect To
 ** $seconds = Seconds Before Redirecting
 */
 function redirectHome($theMsg, $url = NULL, $seconds = 3) {

   if ($url === NULL) {

     $url = 'index.php';

     $link = 'Homepage';

   } else {

     if (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] !== '') {

       $url = $_SERVER['HTTP_REFERER'];

       $link = 'Previous Page';

     } else {

       $url = 'index.php';

       $link = 'Homepage';

     }

   }

   $daa =  $theMsg . " - " ."<span class='uk-alert-danger'> You Will Be Redirected to " . $link . " After " . $seconds . " Seconds</span>";

   return $daa . header("refresh:$seconds;url=$url");

   die();

 }



 /*
 ** Count Number Of Items Function v1.0
 ** Function To Count Number Of Items Rows
 ** $item = The Item To Count
 ** $table = The Table To Choose From
 */

 function countItems($item, $table) {

   global $con;

   $stmt2 = $con->prepare("SELECT COUNT($item) FROM $table");

   $stmt2->execute();

   return $stmt2->fetchColumn();

 }



 	/*
 	** Get All Function v2.0
 	** Function To Get All Records From Any Database Table
 	*/

 	function getAllFrom($field, $table, $where = NULL, $and = NULL, $orderfield, $ordering = "DESC") {

 		global $con;

 		$getAll = $con->prepare("SELECT $field FROM $table $where $and ORDER BY $orderfield $ordering");

 		$getAll->execute();

 		$all = $getAll->fetchAll();

 		return $all;

 	}





	/*
	** Title Function v1.0
	** Title Function That Echo The Page Title In Case The Page
	** Has The Variable $pageTitle And Echo Defult Title For Other Pages
	*/

	function getTitle() {

		global $pageTitle;

		if (isset($pageTitle)) {

			echo $pageTitle;

		} else {

			echo 'Default';

		}
	}


  function alert_on($page_url = NULL, $title = NULL){
    // get script name
    $script_name = $_SERVER['SCRIPT_NAME'];

    $get_link = explode('/', $script_name);

    if (in_array($page_url, $get_link)) { ?>
      <div  class="uk-alert-danger" uk-alert>
        <ul class="uk-flex uk-width-1-1 noticed">
          <li class="uk-alert-success">
            <a class="uk-alert-danger uk-alert-close" uk-close></a>
            <i class="fas fa-check"></i>
            <?php echo $title ; ?>
            - Welcome - <?php echo $_SESSION['Username']; ?>

          </li>
          <li>
            <a href="dashboard.php?adminPanel=Manage-dash">
              <i class="fas fa-home fa-1x"></i>
              Home
            </a>
          </li>
          <li>
            <a href="members.php?adminPanel=Manage-mem">
              <i class="fas fa-users fa-1x"></i>
              Manage Members
            </a>
          </li>
          <li>
            <a href="members.php?adminPanel=Edit-mem&userid=<?php echo $_SESSION['ID']; ?>">
              <i class="fas fa-user-cog fa-1x"></i>
              Edit Profile
            </a>
          </li>
        </ul>
      </div>
      <?php
   } else{
      echo "not matched";
    }

  }


  function get_nav_title($get, $req_name = '', $value, $icon = NULL) {

    if (isset($_GET[$get]) && $_GET[$get] == $req_name) {
      if (isset($icon)) {
        echo '<i class="'. $icon .' fa-2x"></i>';
      }
      echo $value;
    }
  }



  // This function will take $_SERVER['REQUEST_URI'] and build a breadcrumb based on the user's current path
  function breadcrumbs($separator = ' &raquo; ', $home = 'Home') {
      // This gets the REQUEST_URI (/path/to/file.php), splits the string (using '/') into an array, and then filters out any empty values
      $path = array_filter(explode('/', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)));
      // This will build our "base URL" ... Also accounts for HTTPS :)
      $base = (isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';
      // Initialize a temporary array with our breadcrumbs. (starting with our home page, which I'm assuming will be the base URL)
      $breadcrumbs = Array("<a href=\"$base\">$home</a>");
      // Find out the index for the last value in our path array
      $last_p = array_keys($path);
      $last = end($last_p);
      // Build the rest of the breadcrumbs
      foreach ($path AS $x => $crumb) {
          // Our "title" is the text that will be displayed (strip out .php and turn '_' into a space)
          $title = ucwords(str_replace(Array('.php', '_'), Array('', ' '), $crumb));
          // If we are not on the last index, then display an <a> tag
          if ($x != $last)
              $breadcrumbs[] = "<a href=\"$base$crumb\">$title</a>";
          // Otherwise, just display the title (minus)
          else
              $breadcrumbs[] = $title;
      }
      // Build our temporary array (pieces of bread) into one big string :)
      return implode($separator, $breadcrumbs);
  }
