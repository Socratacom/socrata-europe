<?php
/**
 * Template Name: Homepage
 */
?>
<?php while (have_posts()) : the_post(); ?>
<section class="homepage-hero">
	<div class="wrapper clearfix">
		<h1 class="text-center">Socrata makes sharing government data easier, faster and more affordable.</h1>
		<div class="col-sm-6 hidden-xs">
			<article class="text-center">
				<h2>Open Data</h2>
				<p>A scalable cloud platform helps you create a sustainable open data program from day one.</p>
				<div class="btn-wrapper"><a href="/open-data" class="btn btn-success">Explore Open Data</a></div>
			</article>
		</div>
		<div class="col-sm-6 hidden-xs">
			<article class="text-center">
				<h2>Open Performance</h2>
				<p>Socrata Open Performance is a dynamic performance management and analytics application designed exclusively for the government sector.</p>
				<div class="btn-wrapper"><a href="/open-performance" class="btn btn-success">Explore Open Performance</a></div>
			</article>
		</div>
	</div>
	<div class="text-center down-arrow"><i class="fa fa-chevron-down"></i></div>
</section>
<section class="hidden-sm hidden-md hidden-lg homepage-apps">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 text-center" style="margin-bottom:50px;">
				<h2>Open Data</h2>
				<p>Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
				<p><a href="/open-data" class="btn btn-success">Explore Open Data</a></p>
			</div>
			<div class="col-xs-12 text-center">
				<h2>Open Performance</h2>
				<p>Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
				<p><a href="/open-performance" class="btn btn-success">Explore Open Performance</a></p>
			</div>
		</div>
	</div>
</section>
<?php echo do_shortcode('[homepage-logos]'); ?>
<?php get_template_part('templates/content', 'newsletter'); ?>
<?php endwhile; ?>