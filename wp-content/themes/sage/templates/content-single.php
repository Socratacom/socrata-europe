<?php while (have_posts()) : the_post(); ?>
<div class="blog-hero" style="background-image: url(<?php echo blog_feature_image('full', 1600, 300); ?>); ">
    <div class="hero-overlay"></div>
</div>

<div class="container">
	<div class="row">
		<div class="col-sm-7 col-sm-offset-1 blog-content">
			<article <?php post_class(); ?>>
			<header>
			<h1 class="entry-title"><?php the_title(); ?></h1>
			<?php get_template_part('templates/entry-meta'); ?>
			</header>
			<div class="entry-content">
			<?php the_content(); ?>
			</div>
			</article>
		</div>
		<div class="col-sm-3">
			<img src="http://placehold.it/350x150" style="width:100%;">
			cheese
		</div>
	</div>
</div>

<?php endwhile; ?>
