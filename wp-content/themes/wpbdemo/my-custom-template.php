<?php
/**
 * Template Name: My Custom Template
 *
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

get_header();
/* Start the Loop */
while ( have_posts() ) :
	the_post();
	?>
		<p> 1.Title: <?php the_title(); ?> </p>
		<p> 2.Feature image: <?php echo get_the_post_thumbnail(); ?> </p>
		<p> 3.Content: <?php the_content(); ?> </p>
		<p> 4.Author: <?php echo get_the_author(); ?> </p>
	<?php

	// If comments are open or there is at least one comment, load up the comment template.
	if ( comments_open() || get_comments_number() ) {
		comments_template();
	}
endwhile;
// End of the loop.

get_footer();
