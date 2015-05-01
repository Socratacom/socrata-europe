<div class="container">
	<div class="row">
		<div class="col-sm-9 col-md-8">
			<?php while (have_posts()) : the_post(); ?>
			<h1><?php the_title(); ?></h1>
			<?php the_content()?>
			<?php endwhile; ?>
		</div>
		<div class="col-sm-3 col-md-4 guide-sidebar">
			<h4>Chapters</h4>
			<?php wp_nav_menu( array( 'theme_location' => 'field_guide' ) ); ?>
		</div>		
	</div>
</div>
