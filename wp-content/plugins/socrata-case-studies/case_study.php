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
add_filter('body_class', 'case_study_styling');
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
    wp_register_script( 'masonry-fire', plugins_url( 'js/masonry-fire.js' , __FILE__ ), array( 'jquery' ), false, null, true );
    wp_enqueue_script('masonry-fire');
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

function case_study_logo( $thumb_size, $image_width ) { 
  global $post; 
  $params = array( 'width' => $image_width );
  $meta = get_case_study_meta();  
  $imgsrc = wp_get_attachment_image_src( $meta[6], $thumb_size );
  $custom_img_src = bfi_thumb( $imgsrc[0], $params );     
  return $custom_img_src;   
}

function case_study_screen_one( $thumb_size, $image_width ) { 
  global $post; 
  $params = array( 'width' => $image_width );
  $meta = get_case_study_meta();  
  $imgsrc = wp_get_attachment_image_src($meta[8], $thumb_size );
  $custom_img_src = bfi_thumb( $imgsrc[0], $params );     
  return $custom_img_src;   
}

function case_study_screen_two( $thumb_size, $image_width ) { 
  global $post; 
  $params = array( 'width' => $image_width );
  $meta = get_case_study_meta();  
  $imgsrc = wp_get_attachment_image_src ($meta[9], $thumb_size );
  $custom_img_src = bfi_thumb( $imgsrc[0], $params );     
  return $custom_img_src;   
}

function case_study_screen_three( $thumb_size, $image_width ) { 
  global $post; 
  $params = array( 'width' => $image_width );
  $meta = get_case_study_meta();  
  $imgsrc = wp_get_attachment_image_src($meta[10], $thumb_size );
  $custom_img_src = bfi_thumb( $imgsrc[0], $params );     
  return $custom_img_src;   
}

function case_study_thumbnail( $thumb_size, $image_width, $image_height) { 
  global $post; 
  $params = array( 'width' => $image_width, 'height' => $image_height );   
  $meta = get_case_study_meta();  
  $imgsrc = wp_get_attachment_image_src($meta[7], $thumb_size );
  $custom_img_src = bfi_thumb( $imgsrc[0], $params );     
  return $custom_img_src;   
}

// Pagination
function custom_pagination($numpages = '', $pagerange = '', $paged='') {

  if (empty($pagerange)) {
    $pagerange = 2;
  }

  global $paged;
  if (empty($paged)) {
    $paged = 1;
  }
  if ($numpages == '') {
    global $wp_query;
    $numpages = $wp_query->max_num_pages;
    if(!$numpages) {
        $numpages = 1;
    }
  }

  $pagination_args = array(
    'base'            => get_pagenum_link(1) . '%_%',
    'format'          => 'page/%#%',
    'total'           => $numpages,
    'current'         => $paged,
    'show_all'        => False,
    'end_size'        => 1,
    'mid_size'        => $pagerange,
    'prev_next'       => True,
    'prev_text'       => __('<i class="fa fa-chevron-left"></i>'),
    'next_text'       => __('<i class="fa fa-chevron-right"></i>'),
    'type'            => 'plain',
    'add_args'        => false,
    'add_fragment'    => ''
  );

  $paginate_links = paginate_links($pagination_args);

  if ($paginate_links) {
    echo "<div class='pagination-container'><nav class='pagination'>";
      echo "<span class='page-numbers page-num'>Page " . $paged . " of " . $numpages . "</span> ";
      echo $paginate_links;
    echo "</nav></div>";
  }

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

// [logos category="TAXONOMY-SLUG"]
add_shortcode('logos','logos_shortcode');

function logos_shortcode( $atts ) {
  ob_start();
  extract( shortcode_atts( array (
    'type' => 'case_study',
    'taxonomy' => 'case_study_product',
    'category' => '',
    'orderby' => 'date',
    'order' => 'desc',
    'posts' => 5,
    ), $atts ) );
    $options = array(
    'post_type' => $type,
    'taxonomy' => $taxonomy,
    'term' => $category,
    'orderby' => $orderby,
    'order' => $order,
    'posts_per_page' => $posts,
  );
  $query = new WP_Query( $options );
  if ( $query->have_posts() ) { ?>
  <section class="customer-logos homepage-logos">
    <div class="container">
      <div class="row text-center">
      <?php while ( $query->have_posts() ) : $query->the_post(); ?>
        <div class="col-xs-12 col-sm-2 logo">
          <a href="<?php the_permalink() ?>"><img src="<?php echo case_study_logo('full', 100); ?>"></a>
        </div>
      <?php endwhile; wp_reset_postdata(); ?>
      </div>
    </div>
  </section>
  <?php wp_enqueue_style( 'case_study_styles' ); ?>
  <?php $content = ob_get_clean();
  return $content;
  } 
}

// Shortcode [case-studies]
add_shortcode('case-studies','case_study_shortcode');
function case_study_shortcode($atts, $content = null) { ob_start(); ?>
  <?php
  // set up or arguments for our custom query
  $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
  $query_args = array(
  'post_type' => 'case_study',
  'posts_per_page' => 20,
  'paged' => $paged
  );
  // create a new instance of WP_Query
  $the_query = new WP_Query( $query_args );
  ?>
  <section class="content-wrapper">
    <div class="container">
      <div id="container" class="articles">
      <?php if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); // run the loop ?>
        <article class="item">
          <div class="wrapper">
            <a href="<?php the_permalink() ?>"><img src="<?php echo case_study_hero ('full', 255, 150 ); ?>" class="img-responsive" style="width:100%;"></a>
            <div class="article-title">
              <?php $terms = get_the_terms( $post->ID , 'case_study_product' );
              foreach ( $terms as $term ) { echo '<small>' . $term->name . '</small> '; }; ?>
              <h3><a href="<?php the_permalink() ?>"><?php echo the_title(); ?></a></h3>
            </div>
          </div>
        </article>
        <?php endwhile; ?>
        <?php
          if (function_exists(custom_pagination)) {
            custom_pagination($the_query->max_num_pages,"",$paged);
          }
        ?>
        <?php else: ?>
        <article>
          <h1>Sorry...</h1>
          <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
        </article>
      <?php endif; ?>
      </div>
    </div>
  </section>
<?php
$content = ob_get_contents();
ob_end_clean();
return $content;
}




