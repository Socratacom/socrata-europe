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
		'desc'	=> 'Image size should be larger than 300px.', // description
		'id'	=> $prefix.'logo', // field id and name
		'type'	=> 'image' // type of field
	),
	array(
		'label'=> 'Quote',
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
	array( // Image ID field
		'label'	=> 'Author Headshot', // <label>
		'desc'	=> 'Image size should be larger than 50px.', // description
		'id'	=> $prefix.'headshot', // field id and name
		'type'	=> 'image' // type of field
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
	array( // Image ID field
		'label'	=> 'Screen Shot', // <label>
		'desc'	=> 'Image size should be larger than 300px.', // description
		'id'	=> $prefix.'screen_shot_one', // field id and name
		'type'	=> 'image' // type of field
	),
	array( // Image ID field
		'label'	=> 'Screen Shot', // <label>
		'desc'	=> 'Image size should be larger than 300px.', // description
		'id'	=> $prefix.'screen_shot_two', // field id and name
		'type'	=> 'image' // type of field
	),
	array( // Image ID field
		'label'	=> 'Screen Shot', // <label>
		'desc'	=> 'Image size should be larger than 300px.', // description
		'id'	=> $prefix.'screen_shot_three', // field id and name
		'type'	=> 'image' // type of field
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
	$case_study_headshot = get_post_meta($post->ID, 'case_study_headshot', true); //7
	$case_study_screen_shot_one = get_post_meta($post->ID, 'case_study_screen_shot_one', true); //8
	$case_study_screen_shot_two = get_post_meta($post->ID, 'case_study_screen_shot_two', true); //9
	$case_study_screen_shot_three = get_post_meta($post->ID, 'case_study_screen_shot_three', true); //10

  return array(
  	$case_study_banner_title,
  	$case_study_site_name,
  	$case_study_url,
  	$case_study_pull_quote,
  	$case_study_author,
  	$editorField,
  	$case_study_logo,
  	$case_study_headshot,
  	$case_study_screen_shot_one,
  	$case_study_screen_shot_two,
  	$case_study_screen_shot_three,
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


