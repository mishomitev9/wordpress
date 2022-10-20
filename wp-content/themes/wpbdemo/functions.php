<?php
/* enqueue scripts and style from parent theme */
function twentytwentyone_styles() {
	wp_enqueue_style(
		'child-style',
		get_stylesheet_uri(),
		array( 'twenty-twenty-one-style' ),
		wp_get_theme()->
		get( 'Version' )
	);
}
	add_action( 'wp_enqueue_scripts', 'twentytwentyone_styles' );
	// Register Sidebars
function custom_sidebars() {

	$args = array(
		'id'            => 'custom_sidebar',
		'name'          => __( 'Custom Widget Area', 'wpbdemo' ),
		'description'   => __( 'A custom widget area', 'wpbdemo' ),
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
	);
	register_sidebar( $args );

}
add_action( 'widgets_init', 'custom_sidebars' );

	add_filter( 'the_content', 'my_filter' );

function my_filter( $content ) {

	if ( is_singular() ) {
		esc_html_e( 'This is my filter', 'wpbdemo' );
	}
}

// Use a predefined filter and learn about filter priority
add_filter( 'the_content', 'test1' );

function test1( $content ) {

	return $content . '<div>Two</div>';
}

	add_filter( 'the_content', 'test2', 8 );

function test2( $content ) {

	return $content . '<div>One</div>';
}

	add_filter( 'the_content', 'test3', 9 );

function test3( $content ) {

	return $content . '<div>Three</div>';
}

// "Profile settings" in the navigation menu, displayed only for logged in users
function add_nav_menu_settings_button( $items ) {
	if ( is_user_logged_in() ) {
		$items .= '<li class="menu-item menu-item-type-post_type menu-item-object-page">
		<a href="/wp-admin/profile.php">Profile settings</a>
		</li>';
	}
	return $items;
}

add_filter( 'wp_nav_menu_items', 'add_nav_menu_settings_button', 10 );

// function that sends an email to the website administrator every time someone updates their profile.
add_action( 'profile_update', 'my_profile_update', 10, 2 );

function my_profile_update( $user_id, $old_user_data ) {
	$to      = get_option( 'admin_email' );
	$subject = "user_id: $user_id - update profile";
	$body    = "user_id: $user_id - update profile";
	$headers = array( 'Content-Type: text/html; charset = UTF - 8' );

	wp_mail( $to, $subject, $body, $headers );

}
// FUNCTIONS

 add_image_size( 'featured_preview', 55, 55, true );

