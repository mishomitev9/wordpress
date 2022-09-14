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

			$country_city_metabox = get_post_meta( get_the_ID(), '_class_country', true );
			$address_box_metabox  = get_post_meta( get_the_ID(), '_address_box', true );
			$class_grade_metabox  = get_post_meta( get_the_ID(), '_class_grade', true );
			$birth_date_metabox   = get_post_meta( get_the_ID(), '_birth_date', true );

			the_title();
			$options = get_option( 'wporg_options' );

			if ( $options['country'] == 'show' ) {
				echo ' from ' . esc_html( $country_city_metabox ) . ' ';
			} else {
				echo 'Hidden country';
			}
			if ( $options['address'] == 'show' ) {
				echo 'Address: ' . esc_html( $address_box_metabox );

			} else {
				echo ' and Hidden address';
			}
			?>
			<p>He is student in 
			<?php
			if ( $options['grade'] == 'show' ) {
				echo esc_html( $class_grade_metabox ); } else {
				echo 'hidden ';
				}
				?>
			 grade.</p>
			<p>His birth date is: 
			<?php
			if ( $options['birth'] == 'show' ) {
				echo esc_html( $birth_date_metabox ) . 'Y-M-D';
			} else {
				echo ' hidden ';
			}
			?>
			</p>
			<?php
			the_post_thumbnail( array( 50, 50 ) );
			the_excerpt();

		}
	}
	?>

</main>

<?php get_template_part( 'template-parts/footer/footer-widgets' ); ?>

<?php get_footer(); ?>
