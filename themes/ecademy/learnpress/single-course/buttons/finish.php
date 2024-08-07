<?php
/**
 * Template for displaying Finish button in single course.
 *
 * This template can be overridden by copying it to edali/learnpress/single-course/buttons/finish.php.
 *
 * @author   ThimPress
 * @package  Learnpress/Templates
 * @version  4.0.0
 */

defined( 'ABSPATH' ) || exit();
?>

<form class="lp-form form-button form-button-finish-course" method="post" data-confirm="<?php echo LP_Strings::esc_attr( 'confirm-finish-course', '', array( $course->get_title() ) ); ?>" data-title="<?php echo esc_attr__( 'Finish course', 'guto-lite' ); ?>">
	<button class="lp-button lp-btn-finish-course default-btn"><i class="flaticon-tag"></i><?php esc_html_e( 'Finish course', 'guto-lite' ); ?><span></span></button>
	<input type="hidden" name="course-id" value="<?php echo esc_attr( $course->get_id() ); ?>"/>
	<input type="hidden" name="finish-course-nonce" value="<?php echo esc_attr( wp_create_nonce( sprintf( 'finish-course-%d-%d', $course->get_id(), $user->get_id() ) ) ); ?>"/>
	<input type="hidden" name="lp-ajax" value="finish-course"/>
	<input type="hidden" name="noajax" value="yes"/>
</form>