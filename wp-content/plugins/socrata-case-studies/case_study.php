<?php
/*
Plugin Name: Socrata Case Studies
Plugin URI: http://socrata.com/
Description: This plugin manages Case Studies.
Version: 1.0
Author: Michael Church
Author URI: http://Socrata.com/
License: GPLv2
*/

include_once('metaboxes/meta_box.php');
include_once('inc/fields.php');

// REGISTER POST TYPE
add_action( 'init', 'case_study_post_type' );
function case_study_post_type() {
register_post_type( 'case_study',
  array(
    'labels' => array(
    'name' => 'Case Studies',
    'singular_name' => 'Case Study',
    'add_new' => 'Add New',
    'add_new_item' => 'Add New Case Study',
    'edit' => 'Edit',
    'edit_item' => 'Edit Case Study',
    'new_item' => 'New Case Study',
    'view' => 'View',
    'view_item' => 'View Case Studies',
    'search_items' => 'Search Case Studies',
    'not_found' => 'Not found',
    'not_found_in_trash' => 'Not found in Trash',
    'parent' => 'Parent Case Study'
    ),
  'public' => true,
  'menu_position' => 5,
  'supports' => array( 'title', 'thumbnail', 'revisions' ),
  'taxonomies' => array( '' ),
  'menu_icon' => '',
  'has_archive' => true,
  'rewrite' => array('with_front' => false, 'slug' => 'case-study'),
  ));
}

// TAXONOMIES
add_action( 'init', 'create_case_study_product', 0 );
function create_case_study_product() {
register_taxonomy(
  'case_study_product',
  'case_study',
  array(
  'labels' => array(
  'name' => 'Product',
  'add_new_item' => 'Add New Product',
  'new_item_name' => "New Product"
  ),
  'show_ui' => true,
  'show_tagcloud' => false,
  'hierarchical' => true,
  'rewrite' => array('with_front' => false, 'slug' => 'case-study-product'),
  ));
}

// MENU ICON
//Using Dashicon Font http://melchoyce.github.io/dashicons/
add_action( 'admin_head', 'add_case_study_icon' );
function add_case_study_icon(){
?>
<style>
#adminmenu .menu-icon-case_study div.wp-menu-image:before {
  content: '\f123';
}
</style>
<?php
}

// Custom Columns for admin management page
add_filter( 'manage_edit-case_study_columns', 'case_study_columns' ) ;
function case_study_columns( $columns ) {
  $columns = array(
    'cb' => '<input type="checkbox" />',
    'title' => __( 'Title' ),
    'case_study_product' => __( 'Product' ),
    'date' => __( 'Date' )
  );
  return $columns;
}

add_action( 'manage_case_study_posts_custom_column', 'case_study_custom_columns', 10, 2 );
function case_study_custom_columns( $column, $post_id ) {
global $post;
switch( $column ) {
case 'case_study_product' :
$terms = get_the_terms( $post_id, 'case_study_product' );
if ( !empty( $terms ) ) {
$out = array();
foreach ( $terms as $term ) {
$out[] = sprintf( '<a href="%s">%s</a>',
esc_url( add_query_arg( array( 'post_type' => $post->post_type, 'case_study' => $term->slug ), 'edit.php' ) ),
esc_html( sanitize_term_field( 'name', $term->name, $term->term_id, 'case_study_product', 'display' ) )
);
}
echo join( ', ', $out );
}
else {_e( 'No Category' );}
break;
default:
break;
}
}

// Body Classes for Styling 
add_filter('thesis_body_classes', 'case_study_styling');
function case_study_styling($classes) {
  if ('case_study' == get_post_type() && is_archive() || 'case_study' == get_post_type() && is_single() || is_page('case-studies')) { 
    $classes[] = 'case-study'; 
  }
  return $classes; 
}

// ENQEUE SCRIPTS
function case_study_enqeues() {
  wp_register_style( 'case_study_styles', plugins_url( 'css/styles.css' , __FILE__ ), false, null );
  if ( 'case_study' == get_post_type() && is_single() || 'case_study' == get_post_type() && is_archive() || is_page('case-studies') ) {    
    wp_enqueue_style( 'case_study_styles' );
  } 
}
add_action('wp_enqueue_scripts', 'case_study_enqeues');

function case_study_landing_enqeues() {
  if ( is_page('case-studies') ) {    
    wp_enqueue_script('masonry');
  } 
}
add_action('wp_enqueue_scripts', 'case_study_landing_enqeues');

// Single Template Path
add_filter( 'template_include', 'case_study_single_template', 1 );
function case_study_single_template( $template_path ) {
  if ( get_post_type() == 'case_study' ) {
    if ( is_single() ) {
      // checks if the file exists in the theme first,
      // otherwise serve the file from the plugin
      if ( $theme_file = locate_template( array ( 'single-case-study.php' ) ) ) {
        $template_path = $theme_file;
      } else {
        $template_path = plugin_dir_path( __FILE__ ) . 'single-case-study.php';
      }
    }
  }
  return $template_path;
}

// Adding New On-the-fly Image resizing
function case_study_hero( $thumb_size, $image_width, $image_height ) { 
  global $post; 
  $params = array( 'width' => $image_width, 'height' => $image_height );   
  $imgsrc = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID, '' ), $thumb_size );
  $custom_img_src = bfi_thumb( $imgsrc[0], $params );     
  return $custom_img_src;   
}

function case_study_logo( $thumb_size, $image_width, $grayscale ) { 
  global $post; 
  $params = array( 'width' => $image_width );
  $meta = get_case_study_meta();  
  $imgsrc = wp_get_attachment_image_src( $meta[6], $thumb_size );
  $custom_img_src = bfi_thumb( $imgsrc[0], $params );     
  return $custom_img_src;   
}

// Shortcode [homepage-logos]
add_shortcode('homepage-logos','homepage_logos_shortcode');
function homepage_logos_shortcode($atts, $content = null) { ob_start(); ?>
  <section class="customer-logos homepage-logos">
    <div class="container">
      <h1 class="text-center">Customers Who Use Socrata</h1>
      <div class="row text-center">
      <?php $query = new WP_Query('post_type=case_study&showposts=5'); while ($query->have_posts()) : $query->the_post(); ?>
        <div class="col-xs-12 col-sm-2 logo">
          <a href="<?php the_permalink() ?>"><img src="<?php echo case_study_logo('full', 100); ?>"></a>
        </div>
      <?php endwhile; wp_reset_postdata(); ?>
      </div>
    </div>
  </section>
  <?php wp_enqueue_style( 'case_study_styles' ); ?>
<?php
$content = ob_get_contents();
ob_end_clean();
return $content;
}

// Shortcode [case-studies]
add_shortcode('case-studies','case_studies_shortcode');
function case_studies_shortcode($atts, $content = null) { ob_start(); ?>
  <section class="section-padding">
    <div class="container">
      <div id="container" class="js-masonry" data-masonry-options='{ "columnWidth": 0, "itemSelector": ".cs-wrapper" }'>
        <?php $query = new WP_Query('post_type=case_study'); while ($query->have_posts()) : $query->the_post(); ?>
          <div class="cs-wrapper">
            <article>
              <a href="<?php the_permalink() ?>"><img src="<?php echo case_study_hero('full', 255, 150 ); ?>" class="img-responsive"></a>
              <h4><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
            </article>
          </div>
        <?php endwhile; wp_reset_postdata(); ?>
      </div>
    </div>
  </section>
<?php
$content = ob_get_contents();
ob_end_clean();
return $content;
}


