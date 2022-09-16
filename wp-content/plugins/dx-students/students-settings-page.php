// TODO Student settings page Start

<?php
// Content page Setting / Student Settings
 students_settings_page() {
?>
	<h1>This is the page content123</h1>
	<?php
	function dx_settings_field_callback( $args ) {
		$options     = get_option( 'wporg_options' );
		$saved_value = ! empty( $options[ $args['label_for'] ] ) ? $options[ $args['label_for'] ] : '';
		?>
	<label for="wporg_options">Show / Hide - <?php echo esc_html( $args['label'] ); ?></label>
		<select name="wporg_options[<?php echo esc_attr( $args['label_for'] ); ?>]" >
			<option id="show_student_status" name="show_student_status" value="show" <?php selected( $saved_value, 'show' ); ?>>Show</option>
			<option id="hide_student_status" name="hide_student_status" value="hide" <?php selected( $saved_value, 'hide' ); ?>>Hide</option>
		</select>
		<?php

	}
	?>
<?php
function dx_settings_field_callback( $args ) {
		$options     = get_option( 'wporg_options' );
		$saved_value = ! empty( $options[ $args['label_for'] ] ) ? $options[ $args['label_for'] ] : '';
	?>
		<label for="wporg_options">Show / Hide - <?php echo esc_html( $args['label'] ); ?></label>
		<select name="wporg_options[<?php echo esc_attr( $args['label_for'] ); ?>]" >
			<option id="show_student_status" name="show_student_status" value="show" <?php selected( $saved_value, 'show' ); ?>>Show</option>
			<option id="hide_student_status" name="hide_student_status" value="hide" <?php selected( $saved_value, 'hide' ); ?>>Hide</option>
		</select>
		<?php
		echo 'Current status: ' . $saved_value;

}
?>

	// TODO Students settings page End
