<div class="uk-text-left uk-width-1-1@s uk-width-1-1@m uk-width-1-1@l uk-margin-medium-top">

<span class="uk-text-left home_title">TOP Rating</span>
</div>
<div class="uk-text-left uk-width-1-1@s uk-width-1-1@m uk-width-1-1@l uk-margin-remove uk-margin-auto uk-padding-remove" uk-grid>
<?php
        $cat_state = $con->prepare("SELECT
                           categories.ID,categories.Name as cat_name, posts.* FROM posts
                           INNER JOIN categories ON posts.Cat_ID = categories.ID

                           ORDER BY Rating DESC LIMIT 1");

        $cat_state->execute();
        $the_cat = $cat_state->fetchALL();

      foreach ($the_cat as $post) {
         ?>
         <div class="uk-padding-small uk-width-1-1@s uk-width-1-1@m uk-width-1-1@l">
           <div class="cat-posts uk-border-rounded uk-inline-clip uk-transition-toggle uk-animation-toggle" style="background-image: url(<?php echo empty($post['Image']) ? 'admin/uploads/posts/user.jpg' : 'admin/uploads/posts/' . $post['Image'];?>)">
             <div class="uk-overlay-primary uk-border-rounded">
               <div class="uk-card-header">
                 <h3 class="post_title_cat uk-text-capitalize">
                     <a id="<?php echo $post['Post_ID']; ?>" href="posts.php?postid=<?php echo $post['Post_ID']; ?>" class="checkActive">
                     <?php echo excerpt_len($post['Name']); ?>
                   </a>
                     </h3>
               </div>
               <div class="uk-card-body uk-transition-slide-left-small">
                   <p>
                     <?php echo excerpt_len($post['Description'],50, true); ?>
                   </p>
               </div>
               <div class="uk-card-footer uk-margin-remove uk-transition-slide-bottom-small" uk-grid>
                 <div class="uk-width-1-2">
                   <a href="posts.php?postid=<?php echo $post['Post_ID']; ?>" class="uk-label-success">Read more</a>
                 </div>
                 <div class="uk-width-1-2">
                   <p class="uk-margin-remove-top">
                     <time datetime="2016-04-01T19:00">
                       <?php echo $post['Add_Date']; ?>
                     </time>
                   </p>
                 </div>
               </div>
               <div class="top_commented uk-animation-fade uk-animation-reverse">
                 <span>[<?php echo $post['cat_name']; ?>]</span>
                 <span>[<?php echo $post['Rating'] . "<i class='fas fa-star'></i>"; ?>]</span>

               </div>
             </div>
           </div>
         </div>

       <?php } ?>

     </div>
