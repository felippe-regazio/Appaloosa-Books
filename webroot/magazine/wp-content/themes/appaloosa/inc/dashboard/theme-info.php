<?php

function hitmag_enqueue_admin_scripts( $hook ) {
    if ( 'appearance_page_about-hitmag-theme' != $hook ) {
        return;
    }
    wp_register_style( 'hitmag-admin-css', get_template_directory_uri() . '/inc/dashboard/css/admin.css', false, '1.0.0' );
    wp_enqueue_style( 'hitmag-admin-css' );
}
add_action( 'admin_enqueue_scripts', 'hitmag_enqueue_admin_scripts' );

/**
 * Add admin notice when active theme
 */
function hitmag_admin_notice() {
    ?>
    <div class="updated notice notice-info is-dismissible">
        <p><?php esc_html_e( 'Welcome to HitMag! To get started with HitMag please visit the theme Welcome page.', 'hitmag' ); ?></p>
        <p><a class="button" href="<?php echo esc_url( admin_url( 'themes.php?page=about-hitmag-theme' ) ); ?>"><?php _e( 'Get Started with HitMag', 'hitmag' ) ?></a></p>
    </div>
    <?php
}


function hitmag_activation_admin_notice(){
    global $pagenow;
    if ( is_admin() && ('themes.php' == $pagenow) && isset( $_GET['activated'] ) ) {
        add_action( 'admin_notices', 'hitmag_admin_notice' );
    }
}
add_action( 'load-themes.php',  'hitmag_activation_admin_notice'  );


function hitmag_add_themeinfo_page() {

    // Menu title can be displayed with recommended actions count.
    $menu_title = esc_html__( 'HitMag Theme', 'hitmag' );

    add_theme_page( esc_html__( 'HitMag Theme', 'hitmag' ), $menu_title , 'edit_theme_options', 'about-hitmag-theme', 'hitmag_themeinfo_page_render' );

}
add_action( 'admin_menu', 'hitmag_add_themeinfo_page' );

function hitmag_themeinfo_page_render() { ?>

    <div class="wrap about-wrap">

        <?php $theme_info = wp_get_theme(); ?>

        <h1><?php esc_html_e( 'Welcome to HitMag', 'hitmag' ); ?></h1>

        <p><?php echo esc_html( $theme_info->get( 'Description' ) ); ?></p>
    
        <h2 class="nav-tab-wrapper">
            <a class="nav-tab <?php if ( $_GET['page'] == 'about-hitmag-theme' && ! isset( $_GET['tab'] ) ) echo 'nav-tab-active'; ?>" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'about-hitmag-theme' ), 'themes.php' ) ) ); ?>">
                <?php esc_html_e( 'HitMag', 'hitmag' ); ?>
            </a>
            <a class="nav-tab <?php if ( isset( $_GET['tab'] ) && $_GET['tab'] == 'magazine_homepage' ) echo 'nav-tab-active'; ?>" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'about-hitmag-theme', 'tab' => 'magazine_homepage' ), 'themes.php' ) ) ); ?>">
                <?php esc_html_e( 'Magazine Homepage', 'hitmag' ); ?>
            </a>
        </h2>

        <?php

        $current_tab = ! empty( $_GET['tab'] ) ? sanitize_title( $_GET['tab'] ) : '';

        if ( $current_tab == 'magazine_homepage' ) {
            hitmag_magazine_make_guide();
        } else {
            hitmag_admin_welcome_page();
        }

        ?>

    </div><!-- .wrap .about-wrap -->

    <?php

}

function hitmag_admin_welcome_page() {
    ?>
        <h3><?php esc_html_e( 'Theme Customizer', 'hitmag' ); ?></h3>
        <p><?php esc_html_e( 'All the HitMag theme settings are located at the customizer. Start customizing your website with customizer.', 'hitmag' ) ?></p>
        <a class="button" target="_blank" href="<?php echo esc_url( admin_url( '/customize.php' ) ); ?>"><?php esc_html_e( 'Go to customizer','hitmag' ); ?></a>

        <h3><?php esc_html_e( 'Theme Documentation', 'hitmag' ); ?></h3>
        <p><?php esc_html_e( 'Need to learn all about HitMag? Read the theme documentation carefully.', 'hitmag' ) ?></p>
        <a class="button" target="_blank" href="<?php echo esc_url( 'https://themezhut.com/hitmag-wordpress-theme-documentation/' ); ?>"><?php esc_html_e( 'Read the documentation.','hitmag' ); ?></a>

        <h3><?php esc_html_e( 'Theme Info', 'hitmag' ); ?></h3>
        <p><?php esc_html_e( 'Know all the details about HitMag theme.', 'hitmag' ) ?></p>
        <a class="button" target="_blank" href="<?php echo esc_url( 'https://themezhut.com/themes/hitmag/' ); ?>"><?php esc_html_e( 'Theme Details.','hitmag' ); ?></a>

        <h3><?php esc_html_e( 'Theme Demo', 'hitmag' ); ?></h3>
        <p><?php esc_html_e( 'See the theme preview of free version.', 'hitmag' ) ?></p>
        <a class="button" target="_blank" href="<?php echo esc_url( 'https://themezhut.com/demo/hitmag/' ); ?>"><?php esc_html_e( 'Theme Preview','hitmag' ); ?></a>    
    
    <?php
}

function hitmag_magazine_make_guide() {

    if ( 'posts' == get_option( 'show_on_front' ) ) {
        
        hitmag_template_box( 'posts' );

        hitmag_static_page_box();

    }

    if ( 'page' == get_option( 'show_on_front' ) ) {
        
        $frontpage_id = get_option( 'page_on_front' );

        $frontpage_slug = get_page_template_slug( $frontpage_id );

        if ( $frontpage_slug != 'template-magazine.php' ) {
            hitmag_template_box( 'page' );
        } else {
            ?>
            <p>
                <?php
                    esc_html_e( 'Congratulations...! You have activated a magazine front page successfully. Now start adding posts widgets to "Magazine Homepage" widget area.', 'hitmag' );
                ?>
            </p>
            <a class="button" target="_blank" href="<?php echo esc_url( admin_url( '/widgets.php' ) ); ?>"><?php esc_html_e( 'Go to Widgets Area','hitmag' ); ?></a>
            <?php
        }

    }

}

function hitmag_static_page_box() { 
    ?>
    <div class="th-required-box">
        <h3 class="th-reqbox-heading"><?php esc_html_e( 'Select "A Static page" option for the setting "Front Page Displays"', 'hitmag' ) ?></h3>
        <p class="th-reqbox-desc">
            <?php
                esc_html_e( 'Select the page that has "Magazine Homepage" template as the front page .', 'hitmag' );
            ?>
        </p> 
        <a class="button" target="_blank" href="<?php echo esc_url( admin_url('options-reading.php') ); ?>"><?php _e( 'Select front page.','hitmag' ) ?></a>
    </div>
    <?php
}

function hitmag_template_box( $case ) {
    ?>
    <div class="th-required-box">
        
        <?php  
        if ( $case == 'page' ) : ?>
            <h3 class="th-reqbox-heading"><?php esc_html_e( 'Select the "Magazine Homepage" page template for the front page.', 'hitmag' ) ?></h3>
            <p>
                <?php esc_html_e( 'Go to the edit screen of the front page. Then select the Template - "Magazine Homepage" from "Page Attributes" dialog box.', 'hitmag' ); ?>
            </p>
            <?php
            $frontpage_id = get_option( 'page_on_front' ); ?>
            <a href="<?php echo get_edit_post_link( $frontpage_id ); ?>" class="button" target="_blank"><?php esc_html_e( 'Change front page template', 'hitmag' ); ?></a>
        <?php elseif ( $case == 'posts' ) : ?>
            <h3 class="th-reqbox-heading"><?php esc_html_e( 'Create a page that has "Magazine Homepage" page template.', 'hitmag' ) ?></h3>
            <p class="th-reqbox-desc">
                <ol>
                    <li><?php esc_html_e( 'First create a page to display on front page. Give any title for that page. ( eg: Home )', 'hitmag' ); ?></li>
                    <li><?php esc_html_e( 'Then from the "Page Attributes" dialog box select the Template-"Magazine Homepage"', 'hitmag' ); ?></li>
                </ol>
            </p> 
            <a class="button" target="_blank" href="<?php echo esc_url( admin_url('post-new.php?post_type=page') ); ?>"><?php esc_html_e( 'Create a page.','hitmag' ) ?></a>
        <?php endif; ?>
    
    </div>
    <?php
}