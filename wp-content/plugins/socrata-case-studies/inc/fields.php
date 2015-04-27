<?

$prefix = 'case_study_';

$fields = array(	
	array(
		'label'=> 'Customer',
		'desc'	=> 'Ex. City of Seattle',
		'id'	=> $prefix.'banner_title',
		'type'	=> 'text'
	),
	array(
		'label'=> 'Site Name',
		'desc'	=> 'Ex. Socrata.com',
		'id'	=> $prefix.'site_name',
		'type'	=> 'text'
	),
	array(
		'label'=> 'URL',
		'desc'	=> 'Ex. http://www.socrata.com',
		'id'	=> $prefix.'url',
		'type'	=> 'text'
	),
	array( // Image ID field
		'label'	=> 'Logo', // <label>
		'desc'	=> 'Image size should be 300x300 pixels.', // description
		'id'	=> $prefix.'logo', // field id and name
		'type'	=> 'image' // type of field
	),
	array(
		'label'=> 'Pull Quote',
		'desc'	=> 'DO NOT use quote marks',
		'id'	=> $prefix.'pull_quote',
		'type'	=> 'textarea'
	),
	array(
		'label'=> 'Quote Author',
		'desc'	=> 'Author of the quote.',
		'id'	=> $prefix.'author',
		'type'	=> 'text'
	),
	array(
	    'label' => 'Content',
	    'desc'  => '',
	    'id'    => 'editorField',
	    'type'  => 'editor',
	    'sanitizer' => 'wp_kses_post',
	    'settings' => array(
	        'textarea_name' => 'editorField'
	    )
	),
);

// Get and return the values for the URL and description
function get_case_study_meta() {
	global $post;
	global $post;
	$case_study_banner_title = get_post_meta($post->ID, 'case_study_banner_title', true); //0
	$case_study_site_name = get_post_meta($post->ID, 'case_study_site_name', true); //1
	$case_study_url = get_post_meta($post->ID, 'case_study_url', true); //2
	$case_study_pull_quote = get_post_meta($post->ID, 'case_study_pull_quote', true); //3
	$case_study_author = get_post_meta($post->ID, 'case_study_author', true); //4
	$editorField = get_post_meta($post->ID, 'editorField', true); // 5 
	$case_study_logo = get_post_meta($post->ID, 'case_study_logo', true); //6

  return array(
  	$case_study_banner_title,
  	$case_study_site_name,
  	$case_study_url,
  	$case_study_pull_quote,
  	$case_study_author,
  	$editorField,
  	$case_study_logo,
  );
}

/**
 * Instantiate the class with all variables to create a meta box
 * var $id string meta box id
 * var $title string title
 * var $fields array fields
 * var $page string|array post type to add meta box to
 * var $js bool including javascript or not
 */
$case_study_box = new case_study_custom_add_meta_box( 'case_study_box', 'Case Study Details', $fields, 'case_study', true );


