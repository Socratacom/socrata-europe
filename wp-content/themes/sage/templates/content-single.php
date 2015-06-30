<?php while (have_posts()) : the_post(); ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-7 col-sm-offset-1">
                <?php the_content(); ?>
            </div>
            <div class="col-sm-3">
                <p><img src="http://placehold.it/300x250" style="width:100%"></p>
            </div>
        </div>
    </div>
<?php endwhile; ?>