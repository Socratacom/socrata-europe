<?php
/*
Plugin Name: Socrata Open Data Field Guide
Plugin URI: http://socrata.com/
Description: This plugin manages the Open Data Field Guide.
Version: 1.0
Author: Michael Church
Author URI: http://socrata.com/
License: GPLv2
*/
include_once("guide_meta-boxes.php");

// Post Type
add_action( 'init', 'create_guide' );
function create_guide() {
  register_post_type( 'guide',
    array(
      'labels' => array(
        'name' => 'OD Guide',
        'singular_name' => 'OD Guide',
        'add_new' => 'Add New Chapter',
        'add_new_item' => 'Add New Chapter',
        'edit' => 'Edit Chapter',
        'edit_item' => 'Edit Chapter',
        'new_item' => 'New Chapter',
        'view' => 'View',
        'view_item' => 'View Chapter',
        'search_items' => 'Search Chapters',
        'not_found' => 'Not found',
        'not_found_in_trash' => 'Not found in Trash'
      ),
      'public' => true,
      'menu_position' => 5,
      'supports' => array( 'title', 'editor', 'revisions' ),
      'taxonomies' => array( '' ),
      'menu_icon' => '',
      'has_archive' => true,
      'rewrite' => array('with_front' => false, 'slug' => 'open-data-guide-chapter')
    )
  );
}

// MENU ICON
//Using Dashicon Font http://melchoyce.github.io/dashicons/
add_action( 'admin_head', 'add_guide_icon' );
function add_guide_icon(){
?>
<style>
#adminmenu .menu-icon-guide div.wp-menu-image:before {
  content: '\f331';
}
</style>
<?php
}

// Custom Columns for admin management page
add_filter( 'manage_edit-guide_columns', 'guide_columns' ) ;
function guide_columns( $columns ) {
  $columns = array(
    'cb' => '<input type="checkbox" />',
    'title' => __( 'Chapter' )
  );
  return $columns;
}


// REGISTER MENUS
add_action( 'init', 'register_odfg_menu' );
function register_odfg_menu() {
  register_nav_menus(
    array(
        'field_guide' => __( 'Field Guide' )
    )
  );
}

// ENQEUE SCRIPTS
function guide_script_loading() {
  if ( 'guide' == get_post_type() && is_single() || 'guide' == get_post_type() && is_archive() || is_page('open-data-guide') ) {
    wp_register_style( 'odfg_styles', plugins_url( 'css/styles.css' , __FILE__ ), false, null );
    wp_enqueue_style( 'odfg_styles' );
  } 
}
add_action('wp_enqueue_scripts', 'guide_script_loading');

// Body Classes for Styling 
add_filter('body_class', 'guide_styling');
function guide_styling($classes) {
  if (is_page('open-data-guide') || 'guide' == get_post_type() && is_archive() || 'guide' == get_post_type() && is_single()) { 
    $classes[] = 'guide'; 
  }
  return $classes; 
}


// Single Template Path
add_filter( 'template_include', 'guide_single_template', 1 );
function guide_single_template( $template_path ) {
  if ( get_post_type() == 'guide' ) {
    if ( is_single() ) {
      // checks if the file exists in the theme first,
      // otherwise serve the file from the plugin
      if ( $theme_file = locate_template( array ( 'single-guide.php' ) ) ) {
        $template_path = $theme_file;
      } else {
        $template_path = plugin_dir_path( __FILE__ ) . 'single-guide.php';
      }
    }
  }
  return $template_path;
}



// Shortcode [homepage-logos]
add_shortcode('open-data-field-guide','guide_shortcode');
function guide_shortcode($atts, $content = null) { ob_start(); ?>
<section>
  <div class="container">
    <h2 class="text-center">Table of Contents</h2>
    <div class="row">
      <div class="col-sm-8 col-sm-offset-2 table-of-contents">
      <?php $query = new WP_Query('post_type=guide&orderby=date&order=desc&showposts=40'); while ($query->have_posts()) : $query->the_post(); ?>
        <article>
          <?php $meta = get_guide_meta(); if ($meta[0]) echo "<div class='chapter-text'>$meta[0]</div>"; ?>
          <h3><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
          <?php $meta = get_guide_meta(); if ($meta[1]) echo "<p>$meta[1]</p>"; ?>
        </article>
      <?php endwhile; wp_reset_postdata(); ?>
      </div>
    </div>
  </div>
</secion>

<?php
$content = ob_get_contents();
ob_end_clean();
return $content;
}
