<?php

 ?>

<div uk-sticky>
<div class="media" uk-grid>
  <div uk-grid>
  <a class="">
    <i class="fas fa-bell"></i>
</a>
  <a href="posts.php?adminPanel=Add-posts" class="">
    <i class="fas fa-edit"></i>
  </a>
  <a class="" uk-tooltip="title: top; pos: right">
    <i uk-totop uk-scroll></i>
  </a>
</div>
</div>
<ul class="uk-accordion uk-padding-remove background-main fullHieght sidebar_main" uk-accordion="multiple: true">
  <li class="uk-open">
    <h4 class="uk-accordion-title uk-display-block"><i class="fas fa-cog"></i> General</h4>
    <div class="uk-accordion-content uk-box-shadow-large">
      <div class="uk-display-block">
      <a class="uk-light <?php setActive('adminPanel', 'Manage-dash') ?>" href="dashboard.php?adminPanel=Manage-dash"><i class="fas fa-home"></i> dashboard</a>
    </div>
    </div>
  </li>
  <li class="uk-open">
    <h4 class="uk-accordion-title uk-display-block"><i class="fas fa-users"></i> Members</h4>
    <div class="uk-accordion-content uk-box-shadow-large">
      <div class="uk-display-block">
      <a class="uk-light <?php if(!isset($_GET['page'])){setActive('adminPanel', 'Manage-mem'); } ?>" href="members.php?adminPanel=Manage-mem">Manage Members</a>
    </div>
    <div class="uk-display-block">
      <a class="uk-light <?php if(isset($_GET['adminPanel'])){setActive('page','Pending'); } ?>" href="members.php?adminPanel=Manage-mem&page=Pending">Pending Members</a>
    </div>
    <div class="uk-display-block">
      <a class="uk-light <?php setActive('adminPanel', 'Add-mem') ?>" href="members.php?adminPanel=Add-mem">Add Members</a>
    </div>
    </div>
  </li>
  <li class="uk-open">
    <h4 class="uk-accordion-title"><i class="fab fa-gripfire"></i> Categories</h4>
    <div class="uk-accordion-content uk-box-shadow-large">
      <div class="uk-display-block">
      <a class="uk-light <?php setActive('adminPanel', 'Manage-cat') ?>" href="categories.php?adminPanel=Manage-cat">Manage Categories</a>
    </div>
    <div class="uk-display-block">
      <a class="uk-light <?php setActive('adminPanel', 'Add-cat') ?>" href="categories.php?adminPanel=Add-cat">Add Category</a>
    </div>
    </div>
  </li>
  <li class="uk-open">
    <h4 class="uk-accordion-title"><i class="fas fa-dove"></i> Posts</h4>
    <div class="uk-accordion-content uk-box-shadow-large">
      <div class="uk-display-block">
      <a class="uk-light <?php setActive('adminPanel', 'Manage-posts') ?>" href="posts.php?adminPanel=Manage-posts">Manage Posts</a>
    </div>
    <div class="uk-display-block">
      <a class="uk-light <?php setActive('adminPanel', 'Add-posts') ?>" href="posts.php?adminPanel=Add-posts">Add Post</a>
    </div>
    </div>
  </li>
  <li class="uk-open">
    <h4 class="uk-accordion-title"><i class="fas fa-comment-alt"></i> Comments</h4>
    <div class="uk-accordion-content uk-box-shadow-large">
      <div class="uk-display-block">
      <a class="uk-light <?php setActive('adminPanel', 'Manage-comment') ?>" href="comments.php?adminPanel=Manage-comment">Manage Comments</a>
    </div>
    <div class="uk-display-block">
      <a class="uk-light <?php setActive('adminPanel', 'Add-comment') ?>" href="comments.php?adminPanel=Add-comment">Add Comment</a>
    </div>
    </div>
  </li>
</ul>
</div>
