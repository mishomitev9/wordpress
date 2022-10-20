<?php

add_filter( 'manage_posts_columns', 'ST4_columns_head_checkbox' );
add_action( 'manage_posts_custom_column', 'ST4_columns_content', 10, 2 );

// TODO New Active Column
// $column_name = 'Active';
// do_action( 'manage_posts_custom_column', $column_name, $post->ID );


// Copy from dx-students.php
function student_status_custom_box_html( $post ) {

	$status_student = get_post_meta( $post->ID, 'student_status_check', true );
	?>
	<input type="checkbox" name="student_status_check" id="student_status_check" value="1" checked />
		<?php checked( $status_student, '1' ); ?>
	  <?php
}

add_action( 'add_meta_boxes', 'student_status_custom_box_html' );

// // ADD NEW COLUMN
// function ST4_columns_head_checkbox( $defaults ) {
// $defaults['featured_image'] = 'Featured Image';
// return $defaults;
// }

// // SHOW THE FEATURED IMAGE
// function ST4_columns_content_checkbox( $column_name, $post_ID ) {
// if ( $column_name == 'featured_image' ) {
// $post_featured_image = ST4_get_active_status( $post_ID );
// if ( $post_featured_image ) {
// echo '<img src="' . $post_featured_image . '" width="55" height="55" />';
// }
// }
// }
