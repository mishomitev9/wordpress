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

 require_once 'feature-image-column.php';
// require_once 'feature-checkbox-column.php';
 // require_once 'feature-checkbox-column.php';

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


// Active / Inactive student status - meta box
function student_status_custom_box() {
	add_meta_box( 'student_status_custom_box_id', 'Active status', 'student_status_custom_box_html', 'students' );
}

function student_status_custom_box_html( $post ) {

	$status_student = get_post_meta( $post->ID, '_student_status', true );
	?>
	<label for="student_status_field">Student status: </label>
	<select name="student_status_field" id="student_status_field" >
		<option id="student_active_status" name="student_active_status" value="active" <?php selected( $status_student, 'active' ); ?>>Active</option>
		<option id="student_inactive_status" name="student_inactive_status" value="inactive" <?php selected( $status_student, 'inactive' ); ?>>Inactive</option>
	</select>
	<?php
}

add_action( 'add_meta_boxes', 'student_status_custom_box' );

// Save Student Status
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


// Add submenu in settings
add_action( 'admin_menu', 'students_settings' );
function students_settings() {
	add_submenu_page(
		'edit.php?post_type=students',
		'AJAX Settings',
		'AJAX Settings',
		'administrator',
		'cspd-imdb-options',
		'wporg_options_page_html'
	);
}

// Content page Setting / Student Settings

	/**
	 * @internal never define functions inside callbacks.
	 * these functions could be run multiple times; this would result in a fatal error.
	 * custom option and settings
	 */
function wporg_settings_init() {
	// Register a new setting for "dx_students" page.
	register_setting( 'dx_students', 'wporg_options' );

	// Register a new section in the "dx_students" page.
	add_settings_section(
		'wporg_section_developers',
		__( 'Choose one or many.', 'dx_students' ),
		'__return_false',
		'dx_students'
	);
	$settings_fields = array(
		array(
			'id'    => 'country',
			'label' => 'Country',
		),
		array(
			'id'    => 'address',
			'label' => 'Address',
		),
		array(
			'id'    => 'grade',
			'label' => 'Grade',
		),
		array(
			'id'    => 'birth',
			'label' => 'Birth',
		),
	);

	foreach ( $settings_fields as $field ) {
		add_settings_field(
			$field['id'],
			// Use $args' label_for to populate the id inside the callback.
		__( $field['label'], 'dx_students' ), //phpcs:ignore
			'dx_settings_field_callback',
			'dx_students',
			'wporg_section_developers',
			array(
				'label_for' => $field['id'],
				'label'     => $field['label'],
			)
		);
	}
}

	/**
	 * Register our wporg_settings_init to the admin_init action hook.
	 */
	add_action( 'admin_init', 'wporg_settings_init' );

function dx_settings_field_callback( $args ) {

	$options     = get_option( 'wporg_options' );
	$saved_value = ! empty( $options[ $args['label_for'] ] ) ? $options[ $args['label_for'] ] : '';
	?>
		<label for="wporg_options">Show / Hide - <?php echo esc_html( $args['label'] ); ?></label>
		<select data-field="<?php echo esc_attr( $args['label_for'] ); ?>" class="my_select" name="wporg_options[<?php echo esc_attr( $args['label_for'] ); ?>]" >
			<option class="pref" id="show_student_status" name="show_student_status" value="show" <?php selected( $saved_value, 'show' ); ?>>Show</option>
			<option class="pref" id="hide_student_status" name="hide_student_status" value="hide" <?php selected( $saved_value, 'hide' ); ?>>Hide</option>
		</select>
		<?php
}
	// Ajax action start

add_action( 'wp_ajax_misho_action', 'my_ajax_handler' );

/**
 * AJAX handler not using JSON.
 */
function my_ajax_handler() {
	if ( ! empty( $_POST['status'] ) && ! empty( $_POST['field'] ) ) {
		$status = sanitize_text_field( $_POST['status'] );

		$options = get_option( 'wporg_options' );

		if ( ! empty( $options[ $_POST['field'] ] ) ) {
			$options[ $_POST['field'] ] = $status;
		}

		update_option( 'wporg_options', $options );

		wp_send_json_success();
	}
	wp_send_json_error();
}
// TODO Ajax action end
	/**
	 * Add the top level menu page.
	 */
function wporg_options_page() {
	add_menu_page(
		'Hide/Show students metaboxes',
		'Students Options',
		'manage_options',
		'dx_students',
		'wporg_options_page_html'
	);
}

	/**
	 * Register our wporg_options_page to the admin_menu action hook.
	 */
	add_action( 'admin_menu', 'wporg_options_page' );


	/**
	 * Top level menu callback function
	 */
function wporg_options_page_html() {
	// check user capabilities
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	// add error/update messages

	// check if the user have submitted the settings
	// WordPress will add the "settings-updated" $_GET parameter to the url
	if ( isset( $_GET['settings-updated'] ) ) {
		// add settings saved message with the class of "updated"
		add_settings_error( 'wporg_messages', 'wporg_message', __( 'Settings Saved', 'dx_students' ), 'updated' );
	}

	// show error/update messages
	settings_errors( 'wporg_messages' );

	?>
	<div class="wrap">
		<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
		<form action="options.php" method="post">
		<?php
		// output security fields for the registered setting "wporg"
		// settings_fields( 'dx_students' );
		// output setting sections and their fields
		// (sections are registered for "dx_students", each field is registered to a specific section)
		settings_fields( 'dx_students' );
		do_settings_sections( 'dx_students' );
		submit_button( 'Save Settings' );
		?>
		</form>
	</div>
		<?php
}

	add_action( 'admin_enqueue_scripts', 'my_enqueue' );

	/**
	 * Enqueue my scripts and assets.
	 *
	 * @param $hook
	 */
function my_enqueue( $hook ) {
	if ( 'students_page_cspd-imdb-options' !== $hook ) {
		return;
	}
	wp_enqueue_script(
		'ajax-script',
		plugins_url( '/js/myjquery.js', __FILE__ ),
		array( 'jquery' ),
		'1.0.0',
		true
	);

	wp_localize_script(
		'ajax-script',
		'my_ajax_obj',
		array(
			'ajax_url' => admin_url( 'admin-ajax.php' ),
			'nonce'    => wp_create_nonce( 'title_example' ),
		)
	);
}

/* Display custom column stickiness */
function display_posts_column_check( $column, $post_id ) {
	if ( $column == 'sticky' ) {
		$status_student = get_post_meta( $post_id, '_student_status', true );
		 echo '<input type="checkbox" ' . ( checked( $status_student, 'active', false ) ) . '/>';
	}
}
add_action( 'manage_posts_custom_column', 'display_posts_column_check', 10, 2 );

/* Add custom column to post list */
function add_sticky_column( $columns ) {
	return array_merge(
		$columns,
		array( 'sticky' => __( 'Active', 'your_text_domain' ) )
	);
}
add_filter( 'manage_posts_columns', 'add_sticky_column' );
