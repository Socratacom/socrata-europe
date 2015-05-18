<div class="hero" style="background-image: url(<?php echo case_study_hero('full', 1600, 400); ?>);"></div>
<?php
  $meta = get_attribution_meta(); 
  if ($meta[1]) {
    echo "<div class='img-attribution'>Photo: <a href='$meta[1]' target='_blank'>$meta[0]</a></div>";
  } elseif ($meta[0]) {
    echo "<div class='img-attribution'>Photo: $meta[0]</div>";
  } 
?>
<?php while (have_posts()) : the_post(); ?>
<div class="container content-wrapper">	
	<div class="row">
		<div class="col-sm-3">
			<div class="logo-wrapper">
				<img src="<?php echo case_study_logo('full', 150, true); ?>" class="img-responsive logo" style="display:inline-block;">
			</div>
		</div>
		<div class="col-sm-6">
			<h1 class="title"><?php the_title(); ?></h1>
			<div class="meta">
				<?php $meta = get_case_study_meta(); if ($meta[0]) echo "<strong>$meta[0]</strong>"; ?>
				<?php $meta = get_case_study_meta();
				if ($meta[2]) {echo " | <a href='$meta[2]' target='_blank'>$meta[1]</a>";}
				elseif ($meta[1]) {echo " | $meta[1]";}
				?>
			</div>
			<?php $meta = get_case_study_meta(); if ($meta[5]) echo $meta[5]; ?>
		</div>
		<div class="col-sm-3">
			<?php $meta = get_case_study_meta(); 
              if ($meta[3]) { ?>
                <blockquote class="bubble"><?php echo $meta[3]; ?></blockquote>                	
              <?php
              } 
            ?>
		<ul class="quote-author clearfix">
		<?php $meta = get_case_study_meta(); 
			if ($meta[7]) { ?>
				<li>
					<img src="<?php echo case_study_thumbnail( 'full', 50, 50 ); ?>" class="img-circle" >
				</li>
				<li><?php echo $meta[4]; ?></li>            	
			<?php
			} else { ?>
				<li><i class="fa fa-user avatar"></i></li>
				<li><?php echo $meta[4]; ?></li> 
			<?php
			}
		?>
		</ul>
			<?php $meta = get_case_study_meta(); 
              if ($meta[8]) { ?>
                <div class="screen-shot">
                	<img src="<?php echo case_study_screen_one( 'full', 263 ); ?>" class="img-responsive" >
                </div>
              <?php
              } 
            ?>
            <?php $meta = get_case_study_meta(); 
              if ($meta[9]) { ?>
                <div class="screen-shot">
                	<img src="<?php echo case_study_screen_two( 'full', 263 ); ?>" class="img-responsive" >
                </div>
              <?php
              } 
            ?>
            <?php $meta = get_case_study_meta(); 
              if ($meta[10]) { ?>
                <div class="screen-shot">
                	<img src="<?php echo case_study_screen_three( 'full', 263 ); ?>" class="img-responsive" >
                </div>
              <?php
              } 
            ?>
		</div>
	</div>
</div>
<?php endwhile; ?>
<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-553f9bc9354d386b" async="async"></script>

