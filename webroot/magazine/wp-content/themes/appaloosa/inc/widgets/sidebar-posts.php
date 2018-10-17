<?php

/**
 * Displays latest or category wised posts list.
 *
 */

class HitMag_Sidebar_Posts extends WP_Widget {

	/* Register Widget with WordPress*/
	function __construct() {
		parent::__construct(
			'sidebar_posts', // Base ID
			esc_html__( 'HitMag: Sidebar Posts', 'hitmag' ), // Name
			array( 'description' => esc_html__( 'Displays latest posts or posts from a choosen category.Use this widget in the main sidebars.', 'hitmag' ), ) // Args
		);
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */

	public function form( $instance ) {
		//print_r($instance);
		$defaults = array(
			'title'		=>	esc_html__( 'Latest Posts', 'hitmag' ),
			'category'	=>	'all',
			'number_posts'	=> 5,
			'sticky_posts' => true,
		);
		$instance = wp_parse_args( (array) $instance, $defaults );

	?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'hitmag' ); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>"/>
		</p>
		<p>
			<label><?php esc_html_e( 'Select a post category', 'hitmag' ); ?></label>
			<?php wp_dropdown_categories( array( 'name' => $this->get_field_name('category'), 'selected' => $instance['category'], 'show_option_all' => 'Show all posts' ) ); ?>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'number_posts' ); ?>"><?php esc_html_e( 'Number of posts:', 'hitmag' ); ?></label>
			<input type="number" id="<?php echo $this->get_field_id( 'number_posts' ); ?>" name="<?php echo $this->get_field_name( 'number_posts' );?>" value="<?php echo absint( $instance['number_posts'] ) ?>" size="3"/> 
		</p>
		<p>
			<input type="checkbox" <?php checked( $instance['sticky_posts'], true ) ?> class="checkbox" id="<?php echo $this->get_field_id('sticky_posts'); ?>" name="<?php echo $this->get_field_name('sticky_posts'); ?>" />
			<label for="<?php echo $this->get_field_id('sticky_posts'); ?>"><?php esc_html_e( 'Hide sticky posts.', 'hitmag' ); ?></label>
		</p>

	<?php

	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance[ 'title' ] = sanitize_text_field( $new_instance[ 'title' ] );	
		$instance[ 'category' ]	= absint( $new_instance[ 'category' ] );
		$instance[ 'number_posts' ] = (int)$new_instance[ 'number_posts' ];
		$instance[ 'sticky_posts' ] = (bool)$new_instance[ 'sticky_posts' ];
		return $instance;
	}


	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	
	public function widget( $args, $instance ) {
		extract($args);

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : '';	
        $title = apply_filters( 'widget_title', $title , $instance, $this->id_base );
		$category = ( ! empty( $instance['category'] ) ) ? absint( $instance['category'] ) : 0;
		$number_posts = ( ! empty( $instance['number_posts'] ) ) ? absint( $instance['number_posts'] ) : 5; 
		$sticky_posts = ( isset( $instance['sticky_posts'] ) ) ? $instance['sticky_posts'] : false;

		// Latest Posts
		$latest_posts = new WP_Query( 
			array(
				'cat' 					=>	$category,
				'posts_per_page' 		=>	$number_posts,
				'ignore_sticky_posts' 	=>  $sticky_posts
			)
		);	

		echo $before_widget; ?>
		<div class="hitmag-category-posts">
		<?php
			if ( $title ) {
				echo $before_title . $title . $after_title;
			}
		?>

		
		<?php if( $latest_posts -> have_posts() ) : ?>	
			<?php while ( $latest_posts -> have_posts() ) : $latest_posts -> the_post(); ?>
					<div class="hms-post">
						<?php if ( has_post_thumbnail() ) { ?>
							<div class="hms-thumb">
								<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">	
									<?php the_post_thumbnail( 'hitmag-thumbnail' ); ?>
								</a>
							</div>
						<?php } ?>
						<div class="hms-details">
							<?php the_title( sprintf( '<h3 class="hms-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
							<p class="hms-meta"><?php echo hitmag_posted_datetime(); ?></p>
						</div>
					</div><!-- .hms-post -->
			<?php endwhile; ?>
			<?php wp_reset_postdata(); ?>
		<?php endif; ?>
        
        </div><!-- .hitmag-category-posts -->


	<?php
		echo $after_widget;
	}

}

// Register single category posts widget
function hitmag_register_sidebar_posts() {
    register_widget( 'HitMag_Sidebar_Posts' );
}
add_action( 'widgets_init', 'hitmag_register_sidebar_posts' );