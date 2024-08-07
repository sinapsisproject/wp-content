<?php
/**
 * Template for displaying archive course content.
 *
 * This template can be overridden by copying it to ecademy/learnpress/content-archive-course.php
 *
 * @author  EnvyTheme
 * @package LearnPress/Templates
 * @version 4.0.0
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();

/**
 * @since 4.0.0
 *
 * @see LP_Template_General::template_header()
 */
if ( empty( $is_block_theme ) ) {
	do_action( 'learn-press/template-header' );
}

global $ecademy_opt;

$is_breadcrumb      	= isset( $ecademy_opt['is_breadcrumb']) ? $ecademy_opt['is_breadcrumb'] : '1';
$is_shape_image     	= isset( $ecademy_opt['enable_shape_images']) ? $ecademy_opt['enable_shape_images'] : '1';
$course_page_bg_image   = isset( $ecademy_opt['course_page_bg_image']['url']) ? $ecademy_opt['course_page_bg_image']['url'] : '';

/**
 * LP Hook
 */
do_action( 'learn-press/before-main-content' );

$page_title = learn_press_page_title( false );
?>
<?php if ( $page_title ) : ?>
	<div class="page-title-area" style="background-image:url(<?php echo esc_url($course_page_bg_image); ?>);">
		<div class="container">
			<div class="page-title-content">
				<h2><?php echo esc_html($page_title); ?></h2>
				<?php do_action( 'lp/template/archive-course/description' ); ?>

				<?php if( $is_breadcrumb == '1' ): ?>
					<?php if(class_exists( 'bbPress' ) && is_bbpress()) { ?>
						<div class="bbpress-breadcrumbs"></div>
						<?php
					}elseif ( function_exists('yoast_breadcrumb') ) {
						yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
					}else{ ?>
						<ul>
							<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e('Home', 'ecademy'); ?></a></li>
							<li><?php echo wp_kses_post($page_title); ?></li>
						</ul>
					<?php } ?>
				<?php endif; ?>
			</div>
		</div>
		<?php if( $is_shape_image == '1' && isset( $ecademy_opt['shape_image1']['url'] )): ?>
        <?php if( $ecademy_opt['shape_image1']['url'] != '' ): ?>
            <div class="shape9">
				<img src="<?php echo esc_url( $ecademy_opt['shape_image1']['url'] ); ?>" alt="<?php esc_attr_e( 'Shape Image One', 'ecademy' ); ?>">
            </div>
        <?php endif; ?>
    <?php endif; ?>
	</div>
<?php endif; ?>

<div class="courses-area courses-section pt-100 pb-70 lp-content-area">
	<div class="container">
		<div class="row">
			<?php if ( is_active_sidebar( 'archive-courses-sidebar' ) ): ?>
				<div class="col-lg-8 col-md-12">
			<?php else: ?>
				<div class="col-lg-12 col-md-12">
			<?php endif; ?>
				<?php do_action( 'learn-press/before-courses-loop' ); ?>
					<div>
						<?php
						LearnPress::instance()->template( 'course' )->begin_courses_loop();

						if ( LP_Settings_Courses::is_ajax_load_courses() && ! LP_Settings_Courses::is_no_load_ajax_first_courses() ) {
							echo '<div class="lp-archive-course-skeleton" style="width:100%">';
							echo lp_skeleton_animation_html( 10, 'random', 'height:20px', 'width:100%' );
							echo '</div>';
						} else {
							if ( have_posts() ) {
								while ( have_posts() ) :
									the_post();
					
									learn_press_get_template_part( 'content', 'course' );
					
								endwhile;
							} else {
								LearnPress::instance()->template( 'course' )->no_courses_found();
							}
					
							if ( LP_Settings_Courses::is_ajax_load_courses() ) {
								echo '<div class="lp-archive-course-skeleton no-first-load-ajax" style="width:100%; display: none">';
								echo lp_skeleton_animation_html( 10, 'random', 'height:20px', 'width:100%' );
								echo '</div>';
							}
						}
					
						LearnPress::instance()->template( 'course' )->end_courses_loop();
						?>
					</div>
				<?php do_action( 'learn-press/after-courses-loop' ); ?>
			</div>

			<?php if ( is_active_sidebar( 'archive-courses-sidebar' ) ): ?>
				<div class="col-lg-4 col-md-12">
					<div id="secondary" class="sidebar">
						<?php dynamic_sidebar('archive-courses-sidebar'); ?>
					</div>
				</div>
			<?php endif; ?>

			<?php
			/**
			 * LP Hook
			 */
			do_action( 'learn-press/after-main-content' );
			?>
		</div>
	</div>
</div>

<?php
/**
 * @since 4.0.0
 *
 * @see   LP_Template_General::template_footer()
 */
if ( empty( $is_block_theme ) ) {
	do_action( 'learn-press/template-footer' );
}