<?php

/**
 * Displays latest, category wised posts.
 *
 */

class HitMag_Single_Category_Posts extends WP_Widget {

	/* Register Widget with WordPress*/
	function __construct() {
		parent::__construct(
			'hitmag_single_category_posts', // Base ID
			esc_html__( 'HitMag: Magazine Posts (Style 1)', 'hitmag' ), // Name
			array( 'description' => esc_html__( 'Displays latest posts or posts from a choosen category.', 'hitmag' ), ) // Args
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
		$defaults = array(
			'title'			=>	esc_html__( 'Latest Posts', 'hitmag' ),
			'category'		=>	'all',
			'viewall_text'	=> esc_html__( 'View All', 'hitmag' )
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
		<label for="<?php echo $this->get_field_id( 'viewall_text' ); ?>"><?php esc_html_e( 'View All Text:', 'hitmag' ); ?></label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'viewall_text' ); ?>" name="<?php echo $this->get_field_name( 'viewall_text' ); ?>" value="<?php echo esc_attr( $instance['viewall_text'] ); ?>"/>
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
		$instance[ 'viewall_text' ] = sanitize_text_field( $new_instance[ 'viewall_text' ] );
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
		$category = ( isset( $instance['category'] ) ) ? absint( $instance['category'] ) : '';
		$viewall_text = ( ! empty( $instance['viewall_text'] ) ) ? $instance['viewall_text'] : '';	
		// Latest Posts
		$latest_posts = new WP_Query( 
			array(
				'cat'				=>	$category,
				'posts_per_page'	=>	5,
				'post_status'		=>	'publish',
				'ignore_sticky_posts'=>	'true'
			)
		);	

		echo $before_widget;
		if ( $title ) {
			echo $before_title . $title . $after_title;
		}
	
		hitmag_viewall_link( $category, $viewall_text );
		
		?>

		<div class="hitmag-one-category">
			<?php $hmp_count = 1 ?>
			<?php 
				if ( $latest_posts -> have_posts() ) :
				
				while ( $latest_posts -> have_posts() ) : $latest_posts -> the_post();

					if ( $hmp_count == 1 ) { ?>
					
					<div class="hmb-post">

						<?php if ( has_post_thumbnail() ) { ?>
							<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'hitmag-grid' ); ?></a>
						<?php } ?>

						<?php hitmag_category_list(); ?>

						<?php the_title( '<h3 class="hmb-entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' ); ?>							

						<div class="hmb-entry-meta">
							<?php hitmag_posted_on(); ?>
						</div><!-- .entry-meta -->

						<div class="hmb-entry-summary"><?php the_excerpt(); ?></div>

					</div><!-- .hmb-post -->

					<div class="hms-posts">

				<?php } else { ?>

					<div class="hms-post">
						<?php if ( has_post_thumbnail() ) { ?>
							<div class="hms-thumb">
								<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'hitmag-thumbnail' ); ?></a>
							</div>
						<?php } ?>
						<div class="hms-details">
							<?php the_title( sprintf( '<h3 class="hms-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
							<p class="hms-meta"><?php echo hitmag_posted_datetime(); ?></p>
						</div>
					</div>

				<?php } 
				
				$hmp_count++; 
			endwhile;
			wp_reset_postdata();
			endif; ?>
		
				</div><!-- .hms-posts -->
			</div><!-- .hitmag-one-category -->

	<?php
		echo $after_widget;
	}

}

// Register single category posts widget
function hitmag_register_single_category_posts() {
    register_widget( 'HitMag_Single_Category_Posts' );
}
add_action( 'widgets_init', 'hitmag_register_single_category_posts' );