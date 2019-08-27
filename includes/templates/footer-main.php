<footer class="hold_footer">
  <div class="" uk-grid>
    <div class="uk-width-1-3@l uk-width-1-3@m uk-width-1-1@s">

      <div class="single_footer">
        <h4>Categories</h4>
        <ul class="uk-width-1-1" uk-grid>

        <?php
        $footer_cat = get_all_rec('*', 'categories', 'parent = 0', 'ID DESC',4);
        foreach ($footer_cat as $cat) { ?>
            <li class="uk-width-1-2">
              <?php
              echo "<a href='categories.php?pageid=".$cat['ID']."&page_title=".str_replace(' ', '-', $cat['Name'])."'>";
              echo $cat['Name'];
              echo "</a>";
              ?>
            </li>
          <?php  }  ?>
        </ul>

      </div>
    </div>
    <!--- END COL -->
    <div class="uk-width-1-3@l uk-width-1-3@m uk-width-1-1@s">
      <div class="single_footer single_footer_address">
        <h4>Latest Posts</h4>
        <div class="hold_latest">
              <?php
              $latest_posts = get_all_rec('*', 'posts', '', 'Post_ID DESC',2);

              foreach ($latest_posts as $latest) { ?>

                <div class="uk-inline-clip uk-transition-toggle uk-light _latest_posts" style="background-image: url('admin/uploads/posts/<?php echo $latest['Image']; ?>')" tabindex="0">
                  <div class="uk-overlay-primary uk-height-1-1">
                    <span class="uk-transition-slide-bottom-small uk-margin-auto" uk-icon="icon: plus; ratio: 2">
                  <a class="dod" href="posts.php?postid=<?php echo $latest['Post_ID']; ?>"><?php echo excerpt_len($latest['Name'], 10,true); ?></a>
                </span>

                </div>
              </div>
            <?php  } ?>
    </div>
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

    </div>
    <!--- END COL -->
</div>
  <!--- END ROW -->
  <div class="uk-margin-remove" uk-grid>
    <div class="uk-width-1-1@s social_profile">
        <ul>
          <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
          <li><a href="#"><i class="fab fa-twitter"></i></a></li>
          <li><a href="#"><i class="fab fa-google-plus-g"></i></a></li>
          <li><a href="#"><i class="fab fa-instagram"></i></a></li>
        </ul>
    </div>
    <div class="uk-width-1-1@s">
      <p class="copyright">Copyright © 2019 <a href="#">Ragnar</a>.</p>
    </div>
    <!--- END COL -->
  </div>
  <!--- END ROW -->
</footer>
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
