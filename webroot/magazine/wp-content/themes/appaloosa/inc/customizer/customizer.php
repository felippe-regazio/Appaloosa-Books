<?php
/**
 * HitMag Theme Customizer
 *
 * @package HitMag
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 * Add panels and sections of the theme.
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function hitmag_sections_register( $wp_customize ) {

	require( get_template_directory() . '/inc/customizer/custom-controls/control-category-dropdown.php' );

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	$wp_customize->get_section( 'header_image' )->panel 		= 'hitmag-header-options';
	$wp_customize->get_section( 'header_image' )->priority 		= 3;

	/**
	 * Add panels
	 */
	$wp_customize->add_panel( 'hitmag-header-options', array(
		'priority'    => 30,
		'title'       => esc_html__( 'Header options', 'hitmag' ),
	) );

	/**
	 * Add sections
	 */

	// Top Bar Options
	$wp_customize->add_section( 'hitmag_gen_options', array(
		'title'       	=> esc_html__( 'General Settings', 'hitmag' ),
		'priority'    	=> 25
	) );	

	// Top Bar Options
	$wp_customize->add_section( 'top_bar', array(
		'title'       	=> esc_html__( 'Top Bar', 'hitmag' ),
		'panel'			=> 'hitmag-header-options',
		'priority'    	=> 1
	) );	 

	$wp_customize->add_section( 'header_settings', array(
		'title'       	=> esc_html__( 'Header Settings', 'hitmag' ),
		'panel'			=> 'hitmag-header-options',
		'priority'    	=> 2
	) );	 	

	$wp_customize->add_section( 'header_image_options', array(
		'title'       	=> esc_html__( 'Header Image Options', 'hitmag' ),
		'panel'			=> 'hitmag-header-options',
		'priority'    	=> 4
	) );	

	// Slider Settings
	$wp_customize->add_section( 'hitmag_slider_settings', array(
		'title'       	=> esc_html__( 'Slider Settings', 'hitmag' ),
		'priority'    	=> 28
	) );

	// Blog Options
	$wp_customize->add_section( 'hitmag_blog_options', array(
		'title'       	=> esc_html__( 'Blog options', 'hitmag' ),
		'description' 	=> esc_html__( 'These options affect to blog posts listing page and archives like category and tags.', 'hitmag' ),
		'priority'    	=> 30
	) );

	// Post Options
	$wp_customize->add_section( 'hitmag_post_options', array(
		'title'       	=> esc_html__( 'Post options', 'hitmag' ),
		'description' 	=> esc_html__( 'These options affect only to single post articles.', 'hitmag' ),
		'priority'    	=> 31
	) );
	// Page Options
	$wp_customize->add_section( 'hitmag_page_options', array(
		'title'       	=> esc_html__( 'Page options', 'hitmag' ),
		'description' 	=> esc_html__( 'These opitons affect only to pages.', 'hitmag' ),
		'priority'    	=> 32
	) );
	// Theme Info
	$wp_customize->add_section( 'hitmag_theme_info', array(
		'title'       	=> esc_html__( 'Theme Info', 'hitmag' ),
		//'priority'    	=> 100
	) );	


	/* Add primary color setting here until kirki compatible with WordPress 4.9 */
	$wp_customize->add_setting(
		'hitmag_primary_color',
		array(
			'default'			=> '#E74C3C',
			'type'				=> 'theme_mod',
			'capability'		=> 'edit_theme_options',
			'sanitize_callback'	=> 'hitmag_sanitize_hex_color'
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control( 
			$wp_customize,
			'hitmag_primary_color',
			array(
				'settings'		=> 'hitmag_primary_color',
				'section'		=> 'colors',
				'label'			=> esc_html__( 'Theme Primary Color', 'hitmag' ),
			)
		)
	);

}
add_action( 'customize_register', 'hitmag_sections_register' );


/**
 * Add fields to customizer
 */
function hitmag_kirki_fields( $fields ) {

	$fields[] = array(
		'type'        => 'switch',
		'settings'    => 'hitmag_boxed_layout',
		'label'       => esc_html__( 'Boxed Layout', 'hitmag' ),
		'section'     => 'hitmag_gen_options',
		'default'     => '1',
		'priority'    => 1,
		'choices'     => array(
			'on'  	=> esc_attr__( 'On', 'hitmag' ),
			'off' 	=> esc_attr__( 'Off', 'hitmag' ),
		),
	);

	$fields[] = array(
		'type'     => 'textarea',
		'settings' => 'footer_copyright_text',
		'label'    => esc_html__( 'Footer Copyright Text.', 'hitmag' ),
		'section'  => 'hitmag_gen_options',
		'default'  => '',
		'priority' => 2,
	);

	$fields[] = array(
		'type'        => 'switch',
		'settings'    => 'display_topbar',
		'label'       => esc_html__( 'Top Bar Show/Hide', 'hitmag' ),
		'section'     => 'top_bar',
		'default'     => '1',
		'priority'    => 1,
		'choices'     => array(
			'on'  	=> esc_attr__( 'Show', 'hitmag' ),
			'off' 	=> esc_attr__( 'Hide', 'hitmag' ),
		),
	);

	$fields[] = array(
		'type'        		=> 'checkbox',
		'settings'    		=> 'show_nav_search',
		'label'       		=> esc_html__( 'Show search icon on Main Navigation.', 'hitmag' ),
		'section'     		=> 'header_settings',
		'default'     		=> '1',
		'priority'    		=> 1,
	);		

	$fields[] = array(
		'type'        		=> 'toggle',
		'settings'    		=> 'show_topbar_date',
		'label'       		=> esc_html__( 'Show date on topbar.', 'hitmag' ),
		'section'     		=> 'top_bar',
		'default'     		=> '1',
		'priority'    		=> 10,
		'active_callback'	=> array(
			array(
				'setting'  => 'display_topbar',
				'operator' => '==',
				'value'    => true,
			),
		),
	);	

	$fields[] = array(
		'type'        => 'radio',
		'settings'    => 'header_image_position',
		'label'       => esc_html__( 'Header Image Position', 'hitmag' ),
		'section'     => 'header_image_options',
		'default'     => 'after-site-title',
		'priority'    => 1,		
		'choices'     => array(
			'after-site-title'   => array(
				esc_attr__( 'After site title and logo', 'hitmag' )
			),
			'before-site-title' => array(
				esc_attr__( 'Before site title and logo', 'hitmag' )
			),
			'after-main-nav'  => array(
				esc_attr__( 'After Main Navigation', 'hitmag' )
			),
		),
	);	

	$fields[] = array(
		'type'        => 'checkbox',
		'settings'    => 'link_header_image',
		'label'       => esc_html__( 'Link header image to homepage.', 'hitmag' ),
		'section'     => 'header_image_options',
		'default'     => '0',
		'priority'    => 2,
	);

	// Slider Settings.
	$fields[] = array(
		'type'        		=> 'custom',
		'settings'    		=> 'slider_notice',
		'label'       		=> esc_html__( 'Notice', 'hitmag' ),
		'section'     		=> 'hitmag_slider_settings',
		'default'     		=> '<div style="padding: 8px; background-color: #e74c3c; color: #fff; border-radius: 3px;">' . esc_html__( 'Slider displays on magazine homepage only.', 'hitmag' ) . '</div>',
		'priority'    		=> 1,
		'active_callback' 	=> 'hitmag_inactive_magazine'
	);

	$fields[] = array(
		'type'        		=> 'custom',
		'settings'    		=> 'slider_notice_url',
		'label'       		=> esc_html__( 'Create a magazine homepage.', 'hitmag' ),
		'section'     		=> 'hitmag_slider_settings',
		'default'     		=> '<a href="'. esc_url( admin_url( 'themes.php?page=about-hitmag-theme&tab=magazine_homepage' ) ) .'" target="_blank">' . esc_html__('Learn How to create a magazine homepage','hitmag') . '<a><br/><br/>',
		'priority'    		=> 2,
		'active_callback' 	=> 'hitmag_inactive_magazine'
	);

	$fields[] = array(
		'type'        => 'switch',
		'settings'    => 'show_slider',
		'label'       => esc_html__( 'Featured Slider', 'hitmag' ),
		'section'     => 'hitmag_slider_settings',
		'default'     => '1',
		'priority'    => 3,
		'choices'     => array(
			'on'  => esc_attr__( 'On', 'hitmag' ),
			'off' => esc_attr__( 'Off', 'hitmag' ),
		),
	);

	$fields[] = array(
		'type'        		=> 'hitmag-category-dropdown',
		'settings'    		=> 'slider_category',
		'label'       		=> esc_html__( 'Select the category for slider posts', 'hitmag' ),
		'section'     		=> 'hitmag_slider_settings',
		'default'	  		=> '0',
		'priority'    		=> 4,
		'active_callback'	=> array(
			array(
				'setting'  => 'show_slider',
				'operator' => '==',
				'value'    => true,
			),
		),
	);


	// Blog Options
	$fields[] = array(
		'type'        => 'radio-image',
		'settings'    => 'archive_sidebar_align',
		'label'       => esc_html__( 'Content and Sidebar Alignment', 'hitmag' ),
		'section'     => 'hitmag_blog_options',
		'default'     => 'th-right-sidebar',
		'priority'    => 10,
		'option_type' => 'option', 
		'choices'     => array(
			'th-right-sidebar' 		=> get_template_directory_uri() . '/inc/customizer/assets/imgs/2cr.png',
			'th-left-sidebar'   	=> get_template_directory_uri() . '/inc/customizer/assets/imgs/2cl.png',
			'th-no-sidebar'  		=> get_template_directory_uri() . '/inc/customizer/assets/imgs/1c.png',
			'th-content-centered'  	=> get_template_directory_uri() . '/inc/customizer/assets/imgs/1cc.png',
		),
	);

	$fields[] = array(
		'type'        => 'radio',
		'settings'    => 'archive_content_layout',
		'label'       => esc_html__( 'Posts Listing Layout', 'hitmag' ),
		'section'     => 'hitmag_blog_options',
		'default'     => 'th-grid-2',
		'priority'    => 10,
		'option_type' => 'option', 		
		'choices'     => array(
			'th-grid-2'   => array(
				esc_attr__( '2 Columns Grid', 'hitmag' ),
				esc_attr__( '2 posts in a row.', 'hitmag' ),
			),
			'th-grid-3' => array(
				esc_attr__( '3 Columns Grid', 'hitmag' ),
				esc_attr__( '3 posts in a row.', 'hitmag' ),
			),
			'th-list-posts'  => array(
				esc_attr__( 'List Posts', 'hitmag' ),
				esc_attr__( 'Posts with featured images on the left side.', 'hitmag' ),
			),
			'th-large-posts'  => array(
				esc_attr__( 'Large Posts', 'hitmag' ),
				esc_attr__( 'Large posts with featured images on the top.', 'hitmag' ),
			),
		),
	);

	$fields[] = array(
		'type'        => 'multicheck',
		'settings'    => 'blog_post_meta',
		'label'       => esc_html__( 'What post meta to display?', 'hitmag' ),
		'section'     => 'hitmag_blog_options',
		'default'     => array('categories', 'date', 'author', 'comments'),
		'priority'    => 10,
		'choices'     => array(
			'categories' 	=> esc_attr__( 'Category List', 'hitmag' ),
			'date' 			=> esc_attr__( 'Date', 'hitmag' ),
			'author' 		=> esc_attr__( 'Author', 'hitmag' ),
			'comments' 		=> esc_attr__( 'Comments Link', 'hitmag' ),
		),
	);

	$fields[] = array(
		'type'        => 'switch',
		'settings'    => 'excerpt_display',
		'label'       => esc_html__( 'Excerpt Show/Hide', 'hitmag' ),
		'section'     => 'hitmag_blog_options',
		'default'     => '1',
		'priority'    => 10,
		'choices'     => array(
			'on'  	=> esc_attr__( 'Show', 'hitmag' ),
			'off' 	=> esc_attr__( 'Hide', 'hitmag' ),
		),
	);

	$fields[] = array(
		'type'        => 'number',
		'settings'    => 'excerpt_length',
		'label'       => esc_attr__( 'Excerpt Length', 'hitmag' ),
		'section'     => 'hitmag_blog_options',
		'default'     => 30,
		'choices'     => array(
			'min'  => 0,
			'max'  => 500,
			'step' => 1,
		),
		'active_callback'    => array(
			array(
				'setting'  => 'excerpt_display',
				'operator' => '==',
				'value'    => true,
			),
		),
	);

	$fields[] = array(
		'type'        => 'switch',
		'settings'    => 'show_readmore',
		'label'       => esc_html__( 'Show read more button.', 'hitmag' ),
		'section'     => 'hitmag_blog_options',
		'default'     => '1',
		'priority'    => 10,
		'choices'     => array(
			'on'  => esc_attr__( 'Show', 'hitmag' ),
			'off' => esc_attr__( 'Hide', 'hitmag' ),
		),
	);

	$fields[] = array(
		'type'     			=> 'text',
		'settings' 			=> 'readmore_text',
		'label'    			=> esc_html__( 'Read more button text.', 'hitmag' ),
		'section'  			=> 'hitmag_blog_options',
		'default'  			=> esc_attr__( 'Read More', 'hitmag' ),
		'priority' 			=> 10,
		'active_callback'	=> array(
			array(
				'setting'  => 'show_readmore',
				'operator' => '==',
				'value'    => true,
			),
		),
	);

	$fields[] = array(
		'type'        => 'radio-image',
		'settings'    => 'post_sidebar_align',
		'label'       => esc_html__( 'Content and Sidebar Alignment', 'hitmag' ),
		'section'     => 'hitmag_post_options',
		'default'     => 'th-right-sidebar',
		'priority'    => 1,
		'option_type' => 'option', 
		'choices'     => array(
			'th-right-sidebar' 		=> get_template_directory_uri() . '/inc/customizer/assets/imgs/2cr.png',
			'th-left-sidebar'   	=> get_template_directory_uri() . '/inc/customizer/assets/imgs/2cl.png',
			'th-no-sidebar'  		=> get_template_directory_uri() . '/inc/customizer/assets/imgs/1c.png',
			'th-content-centered'  	=> get_template_directory_uri() . '/inc/customizer/assets/imgs/1cc.png',
		),
	);

	$fields[] = array(
		'type'        => 'multicheck',
		'settings'    => 'single_post_meta',
		'label'       => esc_html__( 'What post meta to display in single post?', 'hitmag' ),
		'section'     => 'hitmag_post_options',
		'default'     => array( 'categories', 'date', 'author', 'comments'),
		'priority'    => 2,
		'choices'     => array(
			'categories' 	=> esc_attr__( 'Categories List', 'hitmag' ),
			'date' 			=> esc_attr__( 'Date', 'hitmag' ),
			'author' 		=> esc_attr__( 'Author', 'hitmag' ),
			'comments' 		=> esc_attr__( 'Comments Link', 'hitmag' )
		),
	);	

	$fields[] = array(
		'type'        => 'switch',
		'settings'    => 'single_thumbnail_sw',
		'label'       => esc_html__( 'Featured image inside the single post.', 'hitmag' ),
		'section'     => 'hitmag_post_options',
		'default'     => '1',
		'priority'    => 3,
		'choices'     => array(
			'on'  => esc_attr__( 'Show', 'hitmag' ),
			'off' => esc_attr__( 'Hide', 'hitmag' ),
		),
	);	

	$fields[] = array(
		'type'        => 'checkbox',
		'settings'    => 'thumb_link_to_original',
		'label'       => esc_html__( 'Link featured image to full size image.', 'hitmag' ),
		'section'     => 'hitmag_post_options',
		'default'     => '1',
		'priority'    => 3,
		'active_callback'	=> array(
			array(
				'setting'  => 'single_thumbnail_sw',
				'operator' => '==',
				'value'    => true,
			),
		),		
	);	

	$fields[] = array(
		'type'        		=> 'checkbox',
		'settings'    		=> 'use_lightbox',
		'label'       		=> esc_html__( 'Use lightbox feature.', 'hitmag' ),
		'section'     		=> 'hitmag_post_options',
		'default'     		=> '1',
		'priority'    		=> 3,
		'active_callback'	=> array(
			array(
				'setting'  => 'single_thumbnail_sw',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'thumb_link_to_original',
				'operator' => '==',
				'value'    => true,
			),
		),
	);	

	$fields[] = array(
		'type'        => 'switch',
		'settings'    => 'postsnav_sw',
		'label'       => esc_html__( 'Posts navigation after the post.', 'hitmag' ),
		'section'     => 'hitmag_post_options',
		'default'     => '1',
		'priority'    => 4,
		'choices'     => array(
			'on'  => esc_attr__( 'Show', 'hitmag' ),
			'off' => esc_attr__( 'Hide', 'hitmag' ),
		),
	);	

	$fields[] = array(
		'type'        => 'switch',
		'settings'    => 'authorbox_sw',
		'label'       => esc_html__( 'Author details box after the post.', 'hitmag' ),
		'section'     => 'hitmag_post_options',
		'default'     => '1',
		'priority'    => 5,
		'choices'     => array(
			'on'  => esc_attr__( 'Show', 'hitmag' ),
			'off' => esc_attr__( 'Hide', 'hitmag' ),
		),
	);	

	$fields[] = array(
		'type'        => 'switch',
		'settings'    => 'relatedposts_sw',
		'label'       => esc_html__( 'Related posts after the post.', 'hitmag' ),
		'section'     => 'hitmag_post_options',
		'default'     => '1',
		'priority'    => 6,
		'choices'     => array(
			'on'  => esc_attr__( 'Show', 'hitmag' ),
			'off' => esc_attr__( 'Hide', 'hitmag' ),
		),
	);	

	$fields[] = array(
		'type'        => 'switch',
		'settings'    => 'taglist_sw',
		'label'       => esc_html__( 'Tags list after the post.', 'hitmag' ),
		'section'     => 'hitmag_post_options',
		'default'     => '1',
		'priority'    => 7,
		'choices'     => array(
			'on'  => esc_attr__( 'Show', 'hitmag' ),
			'off' => esc_attr__( 'Hide', 'hitmag' ),
		),
	);	

	$fields[] = array(
		'type'        => 'radio-image',
		'settings'    => 'page_sidebar_align',
		'label'       => esc_html__( 'Content and Sidebar Alignment', 'hitmag' ),
		'section'     => 'hitmag_page_options',
		'default'     => 'th-right-sidebar',
		'priority'    => 10,
		'option_type' => 'option', 
		'choices'     => array(
			'th-right-sidebar' 		=> get_template_directory_uri() . '/inc/customizer/assets/imgs/2cr.png',
			'th-left-sidebar'   	=> get_template_directory_uri() . '/inc/customizer/assets/imgs/2cl.png',
			'th-no-sidebar'  		=> get_template_directory_uri() . '/inc/customizer/assets/imgs/1c.png',
			'th-content-centered'  	=> get_template_directory_uri() . '/inc/customizer/assets/imgs/1cc.png',
		),
	);

	$fields[] = array(
		'type'        => 'custom',
		'settings'    => 'theme_documentation',
		'label'       => __( 'Theme Setup Guide', 'hitmag' ),
		'section'     => 'hitmag_theme_info',
		'default'     => '<a href="https://themezhut.com/hitmag-wordpress-theme-documentation/" target="_blank">' . esc_html__( 'Read the documentation', 'hitmag' ) . '</a>',
	);

	$fields[] = array(
		'type'        => 'custom',
		'settings'    => 'theme_info',
		'label'       => __( 'Theme Details', 'hitmag' ),
		'section'     => 'hitmag_theme_info',
		'default'     => '<a href="https://themezhut.com/themes/hitmag/" target="_blank">' . esc_html__( 'Theme Details', 'hitmag' ) . '</a>',
	);	

	return $fields;
}
add_filter( 'kirki/fields', 'hitmag_kirki_fields' );

/**
 * Returns false if Magazine Homepage is activated.
 */
function hitmag_is_active_magazine_homepage() {
	
	if ( 'page' == get_option( 'show_on_front' ) ) {
        
		$frontpage_id = get_option( 'page_on_front' );
        $frontpage_slug = get_page_template_slug( $frontpage_id );

        if ( $frontpage_slug == 'template-magazine.php' ) {
            return true;
        } else {
			return false;
		}

	} else {
		return false;
	}
	
}

function hitmag_inactive_magazine() {
	if ( true == hitmag_is_active_magazine_homepage() ) {
		return false;
	} else {
		return true;
	}
}

function hitmag_sanitize_hex_color( $hex_color, $setting ) {
	// Sanitize $input as a hex value without the hash prefix.
	$hex_color = sanitize_hex_color( $hex_color );
	
	// If $input is a valid hex value, return it; otherwise, return the default.
	return ( ! is_null( $hex_color ) ? $hex_color : $setting->default );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function hitmag_customize_preview_js() {
	wp_enqueue_script( 'hitmag_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'hitmag_customize_preview_js' );

/**
 * Enqueue the customizer stylesheet.
 */
function hitmag_enqueue_customizer_stylesheets() {

    wp_register_style( 'hitmag-customizer-css', get_template_directory_uri() . '/css/customizer.css', NULL, NULL, 'all' );
    wp_enqueue_style( 'hitmag-customizer-css' );
    wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '4.7.0' );

}
add_action( 'customize_controls_print_styles', 'hitmag_enqueue_customizer_stylesheets' );