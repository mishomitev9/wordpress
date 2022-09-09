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
