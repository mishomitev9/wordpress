<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

get_header();
?>

<main id="site-content">

	<?php

	if ( have_posts() ) {

		while ( have_posts() ) {
			the_post();
			$testarr = get_post_custom();
			// $testarr['_birth_dates'];

			echo $testarr['_birth_dates'];
			the_post_thumbnail( array( 50, 50 ) );
			the_title();
			the_excerpt();




		}
	}
	?>


</main>

<?php get_template_part( 'template-parts/footer/footer-widgets' ); ?>

<?php get_footer(); ?>
