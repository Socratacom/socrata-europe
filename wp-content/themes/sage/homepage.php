<?php
/**
 * Template Name: Homepage
 */
?>
<?php while (have_posts()) : the_post(); ?>
<section class="homepage-hero">
	<div class="vertical-align">
		<div class="container">
			<div class="row">
				<div class="col-sm-10 col-sm-offset-1">
					<h1 class="text-center">Socrata makes sharing government data easier, faster and more affordable.</h1>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-6 col-md-5  col-md-offset-1">
					<article class="text-center">
						<h2>Open Data</h2>
						<p>A scalable cloud platform helps you create a sustainable open data program from day one.</p>
						<div class="btn-wrapper"><a href="/open-data" class="btn btn-success">Explore Open Data</a></div>
					</article>
				</div>
				<div class="col-sm-6 col-md-5">
					<article class="text-center">
						<h2>Open Performance</h2>
						<p>Socrata Open Performance is a dynamic performance management and communication application designed exclusively for the government sector.</p>
						<div class="btn-wrapper"><a href="/open-performance" class="btn btn-success">Explore Open Performance</a></div>
					</article>
				</div>
			</div>
		</div>
	</div>
	<div class="text-center down-arrow hidden-xs">
		<a href="#pagestart"><i class="fa fa-chevron-down"></i></a>
	</div>
</section>
<?php echo do_shortcode('[homepage-logos]'); ?>
<?php get_template_part('templates/content', 'newsletter'); ?>
<?php endwhile; ?>