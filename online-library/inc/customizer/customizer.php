<?php
/**
 * Tax Consultant: Customizer
 *
 * @subpackage Tax Consultant
 * @since 1.0
 */

function online_library_customize_register( $wp_customize ) {

	wp_enqueue_style('customizercustom_css', esc_url( get_template_directory_uri() ). '/inc/customizer/customizer.css');

	$wp_customize->add_section('online_library_premium_features_section', array(
		'title'    => __('🔒 Unlock Premium Features', 'online-library'),
		'priority' => 2,
	));
	
	$wp_customize->add_setting('online_library_premium_features');
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'online_library_premium_features',
			array(
				'section'     => 'online_library_premium_features_section',
				'type'        => 'hidden',
				'description' => '<div style="background: linear-gradient(135deg, #2B136B 0%, #A47AE2 100%); padding: 20px; border-radius: 8px; text-align: center; color: #fff;">
									<h3 style="margin-top: 0; color: #fff;">' . __('Unlock Advanced Features', 'online-library') . '</h3>
									<p style="margin: 15px 0;">' . __('Upgrade to Pro to get:', 'online-library') . '</p>
									<ul style="list-style: none; padding: 0; text-align: left; max-width: 300px; margin: 20px auto;">
										<li style="margin-bottom: 10px;">✓ ' . __('12+ Premium Header Layouts', 'online-library') . '</li>
										<li style="margin-bottom: 10px;">✓ ' . __('Advanced Footer Builder', 'online-library') . '</li>
										<li style="margin-bottom: 10px;">✓ ' . __('Typography Controls', 'online-library') . '</li>
										<li style="margin-bottom: 10px;">✓ ' . __('WooCommerce Styling Options', 'online-library') . '</li>
										<li style="margin-bottom: 10px;">✓ ' . __('Priority Support', 'online-library') . '</li>
										<li style="margin-bottom: 10px;">✓ ' . __('One-Click Demo Import', 'online-library') . '</li>
									</ul>
									<a href="' . esc_url(admin_url('themes.php?page=online-library-pro')) . '" 
									   style="display: inline-block; background: #fff; color: #667eea; padding: 12px 30px; text-decoration: none; border-radius: 4px; font-weight: 600; margin: 10px 5px; transition: all 0.3s;">
									   ' . __('View All Features', 'online-library') . '
									</a>
									<a href="' . esc_url(ONLINE_LIBRARY_BUY_PRO) . '" target="_blank" 
									   style="display: inline-block; background: #ffc107; color: #333; padding: 12px 30px; text-decoration: none; border-radius: 4px; font-weight: 600; margin: 10px 5px;">
									   ' . __('Upgrade Now 🚀', 'online-library') . '
									</a>
									<a href="' . esc_url(ONLINE_LIBRARY_BUNDLE_LINK) . '" target="_blank" 
									   style="display: inline-block; background: #28a745; color: #fff; padding: 12px 30px; text-decoration: none; border-radius: 4px; font-weight: 600; margin: 10px 5px;">
									   ' . __('WordPress Bundle 🎁', 'online-library') . '
									</a>
								  </div>',
			)
		)
	);
}
add_action( 'customize_register', 'online_library_customize_register' );