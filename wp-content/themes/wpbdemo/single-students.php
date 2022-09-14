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
			var_dump( $options );
			echo $options;
			if ( $options == 'show' ) {

			}
			?>

			<p>live in <?php echo esc_html( $country_city_metabox ); ?> and his address is 
								  <?php
									if ( $options == 'show' ) {
										echo esc_html( $address_box_metabox );

									} else {
										echo 'Hidden ';
									}
									?>
			</p>
			<p>He is student in <?php echo esc_html( $class_grade_metabox ); ?> grade.</p>
			<p>His birth date is: <?php echo esc_html( $birth_date_metabox ); ?> Y-M-D</p>
			<?php
			the_post_thumbnail( array( 50, 50 ) );
			the_excerpt();

		}
	}
	?>

</main>

<?php get_template_part( 'template-parts/footer/footer-widgets' ); ?>

<?php get_footer(); ?>
