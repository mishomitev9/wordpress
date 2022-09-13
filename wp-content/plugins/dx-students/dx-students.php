<?php
/**
 * Plugin Name:       Dx_students
 * Plugin URI:        https://example.com/plugins/the-basics/
 * Description:       Plugin that helps a school manage its students.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Mihail Mitev
 * Author URI:        https://author.example.com/
 * Text Domain:       wpbdemo
 */

if ( ! function_exists( 'custom_post_type' ) ) {

	function custom_post_type() {

		$labels = array(
			'name'                  => _x( 'Students', 'Post Type General Name', 'wpbdemo' ),
			'singular_name'         => _x( 'Students', 'Post Type Singular Name', 'wpbdemo' ),
			'menu_name'             => __( 'Students', 'wpbdemo' ),
			'name_admin_bar'        => __( 'Post Type', 'wpbdemo' ),
			'archives'              => __( 'Students', 'wpbdemo' ),
			'attributes'            => __( 'Item Attributes', 'wpbdemo' ),
			'parent_item_colon'     => __( 'Parent Item:', 'wpbdemo' ),
			'all_items'             => __( 'All Items', 'wpbdemo' ),
			'add_new_item'          => __( 'Add New Item', 'wpbdemo' ),
			'add_new'               => __( 'Add New', 'wpbdemo' ),
			'new_item'              => __( 'New Item', 'wpbdemo' ),
			'edit_item'             => __( 'Edit Item', 'wpbdemo' ),
			'update_item'           => __( 'Update Item', 'wpbdemo' ),
			'view_item'             => __( 'View page', 'wpbdemo' ),
			'view_items'            => __( 'View page', 'wpbdemo' ),
			'search_items'          => __( 'Search Item', 'wpbdemo' ),
			'not_found'             => __( 'Not found', 'wpbdemo' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'wpbdemo' ),
			'featured_image'        => __( 'Featured Image', 'wpbdemo' ),
			'set_featured_image'    => __( 'Set featured image', 'wpbdemo' ),
			'remove_featured_image' => __( 'Remove featured image', 'wpbdemo' ),
			'use_featured_image'    => __( 'Use as featured image', 'wpbdemo' ),
			'insert_into_item'      => __( 'Insert into item', 'wpbdemo' ),
			'uploaded_to_this_item' => __( 'Uploaded to this item', 'wpbdemo' ),
			'items_list'            => __( 'Items list', 'wpbdemo' ),
			'items_list_navigation' => __( 'Items list navigation', 'wpbdemo' ),
			'filter_items_list'     => __( 'Filter items list', 'wpbdemo' ),
		);
		$args   = array(
			'label'               => __( 'Students', 'wpbdemo' ),
			'description'         => __( 'This is used for managing students', 'wpbdemo' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
			'taxonomies'          => array( 'category' ),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 5,
			'show_in_admin_bar'   => true,
			'show_in_nav_menus'   => true,
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'page',
		);
		register_post_type( 'students', $args );

	}
	add_action( 'init', 'custom_post_type' );
}
add_filter( 'manage_posts_columns', 'ST4_columns_head' );
add_action( 'manage_posts_custom_column', 'ST4_columns_content', 10, 2 );


// Add Additional Meta Boxes

// Country / City - meta box
function class_country_custom_box() {
	add_meta_box( 'class_country_custom_box_id', 'Lives In (Country, City)', 'class_country_custom_box_html', 'students' );
}

function class_country_custom_box_html( $post ) {

	$country_city = get_post_meta( $post->ID, '_class_country', true );

	echo '<input class="components-text-control__input" type="text"  id="class_country" name="class_country" autocomplete="off" spellcheck="false" value="' . esc_html( $country_city ) . '">';
}

add_action( 'add_meta_boxes', 'class_country_custom_box' );

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id
 */

// Save Country City custom data
function save_class_country_custom_box_data( $post_id ) {

	// Sanitize user input.
	$class_country = sanitize_text_field( $_POST['class_country'] );

	// Update the meta field in the database.
	update_post_meta( $post_id, '_class_country', $class_country );
}

add_action( 'save_post', 'save_class_country_custom_box_data' );


// Address - meta box
function address_custom_box() {
	add_meta_box( 'address_box_id', 'Address', 'address_custom_box_html', 'students' );
}

function address_custom_box_html( $post ) {

	$custom_address = get_post_meta( $post->ID, '_address_box', true );

	echo '<input class="components-text-control__input" type="text"  id="custom_address" name="custom_address" autocomplete="off" spellcheck="false" value="' . esc_html( $custom_address ) . '">';
}

add_action( 'add_meta_boxes', 'address_custom_box' );

// Save Address custom data
function save_address_custom_box_data( $post_id ) {

	// Sanitize user input.
	$my_data = sanitize_text_field( $_POST['custom_address'] );

	// Update the meta field in the database.
	update_post_meta( $post_id, '_address_box', $my_data );
}

add_action( 'save_post', 'save_address_custom_box_data' );

// Class / Grade - meta box
function class_grade_custom_box() {
	add_meta_box( 'class_grade_date_box_id', 'Class / Grade', 'class_grade_custom_box_html', 'students' );
}

function class_grade_custom_box_html( $post ) {

	$class_grade = get_post_meta( $post->ID, '_class_grade', true );

	echo '<input class="components-text-control__input" type="number"  id="class_grade" name="class_grade" autocomplete="off" spellcheck="false" value="' . esc_html( $class_grade ) . '">';
}

add_action( 'add_meta_boxes', 'class_grade_custom_box' );

// Save Class / Grade custom data
function save_class_grade_meta_box_data( $post_id ) {

	// Sanitize user input.
	$my_data = sanitize_text_field( $_POST['class_grade'] );

	// Update the meta field in the database.
	update_post_meta( $post_id, '_class_grade', $my_data );
}

add_action( 'save_post', 'save_class_grade_meta_box_data' );


// Birth Date - meta box
function birth_date_custom_box() {
	add_meta_box( 'birth_date_custom_box_id', 'Birth Date', 'birth_date_custom_box_html', 'students' );
}

function birth_date_custom_box_html( $post ) {

	$birth_date = get_post_meta( $post->ID, '_birth_date', true );

	echo '<input class="components-text-control__input" type="date"  id="birth_date" name="birth_date" autocomplete="off" spellcheck="false" value="' . esc_html( $birth_date ) . '">';
}

add_action( 'add_meta_boxes', 'birth_date_custom_box' );

// Save Class / Grade custom data
function save_birth_date_custom_box_data( $post_id ) {

	// Sanitize user input.
	$my_data = sanitize_text_field( $_POST['birth_date'] );

	// Update the meta field in the database.
	update_post_meta( $post_id, '_birth_date', $my_data );
}

add_action( 'save_post', 'save_birth_date_custom_box_data' );


// Active / Inactive - meta box
function student_status_custom_box() {
	add_meta_box( 'student_status_custom_box_id', 'Active status', 'student_status_custom_box_html', 'students' );
}

function student_status_custom_box_html( $post ) {

	$status_student = get_post_meta( $post->ID, '_student_status', true );
	var_dump( $status_student );
	?>
<label for="student_status_field">Student status: </label>
	<select name="student_status_field" id="student_status_field" >
		<option id="student_active_status" name="student_active_status" value="active" <?php selected( $status_student, 'active' ); ?>>Active</option>
		<option id="student_inactive_status" name="student_inactive_status" value="inactive" <?php selected( $status_student, 'inactive' ); ?>>Inactive</option>
	</select>
	<?php
}

add_action( 'add_meta_boxes', 'student_status_custom_box' );

// Save Class / Grade custom data
function save_student_status_data( $post_id ) {

	if ( array_key_exists( 'student_status_field', $_POST ) ) {
		update_post_meta(
			$post_id,
			'_student_status',
			$_POST['student_status_field']
		);
	}
}
add_action( 'save_post', 'save_student_status_data' );
