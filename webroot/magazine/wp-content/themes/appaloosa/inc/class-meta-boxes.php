<?php

/**
 * Calls the class on the post edit screen.
 */
function hitmag_metaboxes_call() {
    new HitMag_Metaboxes();
}
 
if ( is_admin() ) {
    add_action( 'load-post.php',     'hitmag_metaboxes_call' );
    add_action( 'load-post-new.php', 'hitmag_metaboxes_call' );
}
 
/**
 * Adds a Layout select meta box to posts and pages.
 */
class HitMag_Metaboxes {
 
    /**
     * Hook into the appropriate actions when the class is constructed.
     */
    public function __construct() {
        add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
        add_action( 'save_post',      array( $this, 'save'         ) );
    }
 
    /**
     * Adds the meta box container.
     */
    public function add_meta_box( $post_type ) {
        // Limit meta box to certain post types.
        $post_types = array( 'post', 'page' );
 
        if ( in_array( $post_type, $post_types ) ) {
            add_meta_box(
                'hitmag_layout_meta',
                esc_html__( 'Select Layout', 'hitmag' ),
                array( $this, 'render_meta_box_content' ),
                $post_type,
                'side',
                'default'
            );
        }
    }
 
    /**
     * Save the meta when the post is saved.
     *
     * @param int $post_id The ID of the post being saved.
     */
    public function save( $post_id ) {
 
        /*
         * We need to verify this came from the our screen and with proper authorization,
         * because save_post can be triggered at other times.
         */
 
        // Check if our nonce is set.
        if ( ! isset( $_POST['hitmag_layout_metabox_nonce'] ) ) {
            return $post_id;
        }
 
        $nonce = $_POST['hitmag_layout_metabox_nonce'];
 
        // Verify that the nonce is valid.
        if ( ! wp_verify_nonce( $nonce, 'hitmag_layout_metabox' ) ) {
            return $post_id;
        }
 
        /*
         * If this is an autosave, our form has not been submitted,
         * so we don't want to do anything.
         */
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return $post_id;
        }
 
        // Check the user's permissions.
        if ( 'page' == $_POST['post_type'] ) {
            if ( ! current_user_can( 'edit_page', $post_id ) ) {
                return $post_id;
            }
        } else {
            if ( ! current_user_can( 'edit_post', $post_id ) ) {
                return $post_id;
            }
        }
 
        /* OK, it's safe for us to save the data now. */
 
        // Sanitize the user input.
        $selected_layout = sanitize_text_field( $_POST['hitmag_layout'] );
 
        // Update the meta field.
        update_post_meta( $post_id, '_hitmag_layout_meta', $selected_layout );
    }
 
 
    /**
     * Render Meta Box content.
     *
     * @param WP_Post $post The post object.
     */
    public function render_meta_box_content( $post ) {
 
        // Add an nonce field so we can check for it later.
        wp_nonce_field( 'hitmag_layout_metabox', 'hitmag_layout_metabox_nonce' );
 
        // Use get_post_meta to retrieve an existing value from the database.
        $selected_layout = get_post_meta( $post->ID, '_hitmag_layout_meta', true );
 
        // Display the form, using the current value.
        if( empty( $selected_layout) ) { $selected_layout = 'th-default-layout'; }
        ?>

        <input type="radio" id="th-default-layout" name="hitmag_layout" value="th-default-layout" <?php checked( 'th-default-layout', $selected_layout ); ?> />
        <label for="th-default-layout" class="post-format-icon"><?php esc_html_e( 'Default Layout', 'hitmag' ); ?></label><br/>
        
        <input type="radio" id="th-right-sidebar" name="hitmag_layout" value="th-right-sidebar" <?php checked( 'th-right-sidebar', $selected_layout ); ?> />
        <label for="th-right-sidebar" class="post-format-icon"><?php esc_html_e( 'Right Sidebar', 'hitmag' ); ?></label><br/>
        
        <input type="radio" id="th-left-sidebar" name="hitmag_layout" value="th-left-sidebar" <?php checked( 'th-left-sidebar', $selected_layout ); ?> />
        <label for="th-left-sidebar" class="post-format-icon"><?php esc_html_e( 'Left Sidebar', 'hitmag' ); ?></label><br/>
        
        <input type="radio" id="th-no-sidebar" name="hitmag_layout" value="th-no-sidebar" <?php checked( 'th-no-sidebar', $selected_layout ); ?> />
        <label for="th-no-sidebar" class="post-format-icon"><?php esc_html_e( 'Full Width', 'hitmag' ); ?></label><br/>
        
        <input type="radio" id="th-content-centered" name="hitmag_layout" value="th-content-centered" <?php checked( 'th-content-centered', $selected_layout ); ?> />
        <label for="th-content-centered" class="post-format-icon"><?php esc_html_e( 'Full Width Content Centered.', 'hitmag' ); ?></label><br/>
        
        <?php
    }
}