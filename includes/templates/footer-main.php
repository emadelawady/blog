<footer class="hold_footer">
  <div class="row">
    <div class="col-sm-12 col-md-4">

      <div class="single_footer">
        <h4>أقسام رئيسية</h4>
        <ul class="row">

        <?php
        $footer_cat = get_all_rec('*', 'categories', 'parent = 0', 'ID DESC',4);
        foreach ($footer_cat as $cat) { ?>
            <li class="col-sm-12 col-md-6">
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
    <div class="col-sm-12 col-md-4">
      <div class="single_footer single_footer_address">
        <h4>أحدث المقالات</h4>
        <div class="row hold_latest">
              <?php
              $latest_posts = get_all_rec('*', 'posts', '', 'Post_ID DESC',2);

              foreach ($latest_posts as $post) { ?>
                <div class="col-sm-12 col-md-6 col-lg-6 hovereffect" style="height:150px;">
                    <span class="img-responsive img_span" style="background-image: url('<?php echo empty($post['Image']) ? 'admin/uploads/posts/user.jpg' : 'admin/uploads/posts/' . $post['Image'];?>')" alt="">
                    </span>
                    <div class="overlay">
                      <h2>
                        <a id="<?php echo $post['Post_ID']; ?>" href="posts.php?postid=<?php echo $post['Post_ID']; ?>" class="checkActive">
                           <?php echo excerpt_len($post['Name']); ?>
                         </a>
                       </h2>
                    </div>
                </div>
            <?php  } ?>
    </div>
  </div>
  </div>

    <!--- END COL -->
    <div class="col-sm-12 col-md-4">
      <div class="single_footer single_footer_address">
        <h4>اشترك الان بدون تسجيل</h4>
        <div class="signup_form">
          <form action="#" class="subscribe">
            <input type="text" class="subscribe__input" placeholder="أكتب بريدك الإلكترونى">
            <button type="button" class="subscribe__btn"><i class="fas fa-paper-plane"></i></button>
          </form>
        </div>
      </div>

    </div>
    <!--- END COL -->
</div>
  <!--- END ROW -->
  <div class="row">
    <div class="col-sm-12 social_profile">
        <ul>
          <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
          <li><a href="#"><i class="fab fa-twitter"></i></a></li>
          <li><a href="#"><i class="fab fa-google-plus-g"></i></a></li>
          <li><a href="#"><i class="fab fa-instagram"></i></a></li>
        </ul>
    </div>
    <div class="col-sm-12">
      <p class="copyright">
        تصميم وبرمجة
        @ <a href="#">راجنار</a>.</p>
    </div>
    <!--- END COL -->
  </div>
  <!--- END ROW -->
</footer>
<!--- END CONTAINER -->

<?php

  // store scripts name into array with variable
  $scripts = array(/*'vue.min', */ 'jquery-3.4.1.min', 'jquery-ui.min', 'bootstrap.min', 'all.min', 'plugins/jquery-slicknav-min', 'plugins/bootstrap-dropdownhover.min', 'main');

  foreach ($scripts as $val) {
    on_scripts($val);
  }
 ?>


  </body>

  </html>
