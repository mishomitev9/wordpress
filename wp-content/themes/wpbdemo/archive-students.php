<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

get_header();

$args = array(
	'post_type'      => 'students',
	'post_status'    => 'publish',
	'posts_per_page' => 4,
	'meta_key'       => '_student_status',
	'meta_value'     => 'active', // select only active students
	'meta_compare'   => '==',

);

$loop = new WP_Query( $args );

if ( $loop->have_posts() ) :
	while ( $loop->have_posts() ) :
		$loop->the_post();
		?> 
<h3> Only active students: </h3>
		<?php
		$country_city_metabox = get_post_meta( get_the_ID(), '_class_country', true );
		$address_box_metabox  = get_post_meta( get_the_ID(), '_address_box', true );
		$class_grade_metabox  = get_post_meta( get_the_ID(), '_class_grade', true );
		$birth_date_metabox   = get_post_meta( get_the_ID(), '_birth_date', true );
		the_title();
		?>
			<p>live in <?php echo esc_html( $country_city_metabox ); ?> and his address is <?php echo esc_html( $address_box_metabox ); ?></p>
			<p>He is student in <?php echo esc_html( $class_grade_metabox ); ?> grade.</p>
			<p>His birth date is: <?php echo esc_html( $birth_date_metabox ); ?> Y-M-D</p>
			<?php
			the_excerpt();
			the_post_thumbnail( array( 100, 100 ) );

endwhile;
	endif;

	get_footer();
?>

<?php
wp_reset_postdata();
