<?php while (have_posts()) : the_post(); ?>
<div class="container">
<div class="row">

<div class="col-sm-8">
<article <?php post_class(); ?>>
<header>
<h1 class="entry-title"><?php the_title(); ?></h1>
<?php get_template_part('templates/entry-meta'); ?>
</header>
<div class="entry-content">
<?php the_content(); ?>
</div>
<!--<?php comments_template('/templates/comments.php'); ?>-->
</article>
</div>

<div class="col-sm-4">
  <img src="http://placehold.it/350x150" style="width:100%;">
</div>

</div>
</div>

<?php endwhile; ?>
