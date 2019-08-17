<div class="hold_footer">
  <div class="" uk-grid>
    <div class="uk-width-1-3@l uk-width-1-3@m uk-width-1-1@s">
      <div class="single_footer">
        <h4>Categories</h4>
        <?php
        $footer_cat = get_all_rec('*', 'categories', 'parent = 0', 'ID DESC');
        foreach ($footer_cat as $cat) { ?>
          <ul class="">
            <li class="<?php if(isset($_GET['page_title']) && $_GET['page_title'] == $cat['Name']) { echo " acitveTwo ";} ?>">
              <?php
              echo "<a href='categories.php?pageid=".$cat['ID']."&page_title=".str_replace(' ', '-', $cat['Name'])."'>";
              echo $cat['Name'];
              echo "</a>";
              ?>
            </li>
          </ul>
          <?php  }
                            ?>
      </div>
    </div>
    <!--- END COL -->
    <div class="uk-width-1-3@l uk-width-1-3@m uk-width-1-1@s">
      <div class="single_footer single_footer_address">
        <h4>Latest Posts</h4>
        <?php
        $latest_comments = get_all_rec('*', 'posts', '', 'Post_ID DESC');
        echo '<ul>';


        foreach ($latest_comments as $latest) {
          echo '<li><a href="posts.php?postid='. $latest['Post_ID'] .'">'. $latest['Name'] .'</a></li>';
        }
        echo '</ul>'; ?>
      </div>
    </div>
    <!--- END COL -->
    <div class="uk-width-1-3@l uk-width-1-3@m uk-width-1-1@s">
      <div class="single_footer single_footer_address">
        <h4>Subscribe today</h4>
        <div class="signup_form">
          <form action="#" class="subscribe">
            <input type="text" class="subscribe__input" placeholder="Enter Email Address">
            <button type="button" class="subscribe__btn"><i class="fas fa-paper-plane"></i></button>
          </form>
        </div>
      </div>
      <div class="social_profile">
        <ul>
          <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
          <li><a href="#"><i class="fab fa-twitter"></i></a></li>
          <li><a href="#"><i class="fab fa-google-plus-g"></i></a></li>
          <li><a href="#"><i class="fab fa-instagram"></i></a></li>
        </ul>
      </div>
    </div>
    <!--- END COL -->
  </div>
  <!--- END ROW -->
  <div class="" uk-grid>
    <div class="uk-width-1-1@s">
      <p class="copyright">Copyright © 2019 <a href="#">Akdesign</a>.</p>
    </div>
    <!--- END COL -->
  </div>
  <!--- END ROW -->
</div>
<!--- END CONTAINER -->
<?php
  // store scripts name into array with variable
  $scripts = array(/*'vue.min', */ 'uikit-icons.min', 'uikit.min', /*'bootstrap.min',*/ 'jquery-1.12.1.min', 'jquery-ui.min', 'main');

  foreach ($scripts as $val) {
    on_scripts($val);
  }
   ?>
  </body>

  </html>
