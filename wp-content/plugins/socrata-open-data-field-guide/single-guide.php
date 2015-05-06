<div class="container">
	<div class="row">
		<div class="col-sm-9 col-md-8">
			<?php while (have_posts()) : the_post(); ?>
			<?php $meta = get_guide_meta(); if ($meta[0]) echo "<div class='chapter-text'>$meta[0]</div>"; ?>
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
<section class="belize-hole">
	<div class="container">
	<div class="row">
		<h2 class="text-center">Take the Guide with you.</h2>
		<p class="text-center"><a href="#" class="btn btn-default btn-lg" style="color:#2980b9;">Download the Guide</a></p>
	</div>
</div>
</section>
<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-553f9bc9354d386b" async="async"></script>