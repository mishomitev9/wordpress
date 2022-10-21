<?php

add_filter( 'manage_posts_columns', 'ST4_columns_head_checkbox' );
add_action( 'manage_posts_custom_column', 'ST4_columns_content', 10, 2 );

// TODO New Active Column
// do_action( 'manage_posts_custom_column', $column_name, $post->ID );

function student_status_custom_box() {
	add_meta_box( 'student_status_custom_box_id', 'Active status', 'student_status_custom_box_html', 'students' );
}

function student_status_custom_box_html( $post ) {

	$status_student = get_post_meta( $post->ID, '_student_status_check', true );
	?>
	<input type="checkbox" id="student_status_check" value="checked" />
		<?php checked( $status_student, 'checked' ); ?>
	  <?php
}

add_action( 'add_meta_boxes', 'student_status_custom_box' );

function save_student_status_data( $post_id ) {

	if ( array_key_exists( 'student_status_check', $_POST ) ) {
		update_post_meta(
			$post_id,
			'_student_status_check',
			$_POST['student_status_check']
		);
	}
}
add_action( 'save_post', 'save_student_status_data' );

// ADD NEW COLUMN
function ST4_columns_head_checkbox( $defaults ) {
	$defaults['active'] = 'Active';
	return $defaults;
}

function ST4_columns_content_checkbox( $column_name, $post_ID ) {
	if ( $column_name == 'Active' ) {
		$post_student_status = student_status_custom_box_html( $post_ID );
		if ( $post_student_status ) {
			echo 'Test student status';
		}
	}
}

add_action( 'admin_enqueue_scripts', 'my_enqueue' );

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
		 echo '<input type="checkbox" disabled', ( is_sticky( $post_id ) ? ' checked' : '' ), '/>';
	}
}
add_action( 'manage_posts_custom_column', 'display_posts_column_check', 10, 2 );

/* Add custom column to post list */
function add_sticky_column( $columns ) {
	return array_merge(
		$columns,
		array( 'sticky' => __( 'Sticky', 'your_text_domain' ) )
	);
}
add_filter( 'manage_posts_columns', 'add_sticky_column' );
