<ul class="byline">
    <li><?php echo get_avatar( get_the_author_meta('ID'), 50 ); ?></li>
    <li>By <?php the_author(); ?></li>
    <li>Posted: <?php the_time('F jS, Y') ?></li>
</ul>