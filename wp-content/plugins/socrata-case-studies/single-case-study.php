
<div style="background-image: url(<?php echo case_study_hero('full', 1600, 400); ?>); height:400px;"></div>
<div class="container">	
	<div class="row">
		<div class="col-sm-12">
			<?php while (have_posts()) : the_post(); ?>
			<h1><?php the_title(); ?></h1>
			<div><?php $meta = get_case_study_meta(); if ($meta[6]) echo wp_get_attachment_image($meta[6], 'thumbnail', false, array('class' => 'app-icon')); ?></div>
			<p><img src="<?php echo case_study_logo('full', 100, true); ?>"></p>
			<?php the_content()?>
			<?php endwhile; ?>
		</div>
	</div>
</div>