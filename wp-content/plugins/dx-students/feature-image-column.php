<?php

add_filter( 'manage_posts_columns', 'ST4_columns_head' );
add_action( 'manage_posts_custom_column', 'ST4_columns_content', 10, 2 );

// GET FEATURED IMAGE
function ST4_get_featured_image( $post_ID ) {
	$post_thumbnail_id = get_post_thumbnail_id( $post_ID );
	if ( $post_thumbnail_id ) {
		 $post_thumbnail_img = wp_get_attachment_image_src( $post_thumbnail_id, 'featured_preview' );
		 return $post_thumbnail_img[0];
	}
}

// ADD NEW COLUMN
function ST4_columns_head( $defaults ) {
	$defaults['featured_image'] = 'Featured Image';
	return $defaults;
}

// SHOW THE FEATURED IMAGE
function ST4_columns_content( $column_name, $post_ID ) {
	if ( $column_name == 'featured_image' ) {
		 $post_featured_image = ST4_get_featured_image( $post_ID );
		if ( $post_featured_image ) {
			 echo '<img src="' . $post_featured_image . '" width="55" height="55" />';
		}
	}
}
