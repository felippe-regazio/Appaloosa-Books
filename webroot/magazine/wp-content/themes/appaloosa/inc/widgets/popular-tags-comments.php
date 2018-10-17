<?php


/**
 * Displays popular posts, comments and tags in a tabbed pane.
 */
class HitMag_Tabbed_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'hitmag_tabbed_widget', // Base ID
			esc_html__( 'HitMag: Popular Posts, Tags, Comments', 'hitmag' ), // Name
			array( 'description' => esc_html__( 'Displays popular posts, comments, tags in a tabbed pane.', 'hitmag' ), ) // Args
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
		$nop = ! empty( $instance['nop'] ) ? absint( $instance['nop'] ) : 5;
		$noc = ! empty( $instance['noc'] ) ? absint( $instance['noc'] ) : 5; ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'nop' ); ?>"><?php esc_html_e( 'Number of popular posts:', 'hitmag' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'nop' ); ?>" name="<?php echo $this->get_field_name( 'nop' ); ?>" type="text" value="<?php echo esc_attr( $nop ); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'noc' ); ?>"><?php esc_html_e( 'Number of comments:', 'hitmag' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'noc' ); ?>" name="<?php echo $this->get_field_name( 'noc' ); ?>" type="text" value="<?php echo esc_attr( $noc ); ?>">
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
		$instance = array();
		$instance['nop'] = ( ! empty( $new_instance['nop'] ) ) ? (int)( $new_instance['nop'] ) : '';
		$instance['noc'] = ( ! empty( $new_instance['noc'] ) ) ? (int)( $new_instance['noc'] ) : '';

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
		$nop = ( ! empty( $instance['nop'] ) ) ? absint( $instance['nop'] ) : 5;
		$noc = ( ! empty( $instance['noc'] ) ) ? absint( $instance['noc'] ) : 5;

		echo $before_widget; ?>

		<div class="hm-tabs-wdt">

		<ul class="hm-tab-nav">
			<li class="hm-tab"><a class="hm-tab-anchor" href="#hitmag-popular"><?php esc_html_e( 'Popular', 'hitmag' ); ?></a></li>
			<li class="hm-tab"><a class="hm-tab-anchor" href="#hitmag-comments"><?php esc_html_e( 'Comments', 'hitmag' ); ?></a></li>
			<li class="hm-tab"><a class="hm-tab-anchor" href="#hitmag-tags"><?php esc_html_e( 'Tags', 'hitmag' ); ?></a></li>
		</ul>

		<div class="tab-content">
			<div id="hitmag-popular">
				<?php 
					$args = array( 'ignore_sticky_posts' => 1, 'posts_per_page' => $nop, 'post_status' => 'publish', 'orderby' => 'comment_count', 'order' => 'desc' );
					$popular = new WP_Query( $args );

					if ( $popular->have_posts() ) :

					while( $popular-> have_posts() ) : $popular->the_post(); ?>
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
					<?php
					endwhile;
					endif;	
				?>
			</div><!-- .tab-pane #hitmag-popular -->

			<div id="hitmag-comments">
				<?php

					$avatar_size = 50;
					$args = array(
						'number'       => $noc,
					);
					$comments_query = new WP_Comment_Query;
					$comments = $comments_query->query( $args );	
				
					if ( $comments ) {
						foreach ( $comments as $comment ) { ?>
							<div class="hmw-comment">
								<figure class="hmw_avatar">
									<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
										<?php echo get_avatar( $comment->comment_author_email, $avatar_size ); ?>     
									</a>                               
								</figure> 
								<div class="hmw-comm-content">
									<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
										<span class="hmw-comment-author"><?php echo esc_html( get_comment_author( $comment->comment_ID ) ); ?> </span> - <span class="hitmag_comment_post"><?php echo esc_html( get_the_title($comment->comment_post_ID) ); ?></span>
									</a>
									<?php echo '<p class="hmw-comment">' . wp_trim_words( wp_kses_post( $comment->comment_content ), 15, '...' ). '</p>'; ?>
								</div>
							</div>
						<?php }
					} else {
						esc_html_e( 'No comments found.', 'hitmag' );
					}
				?>
			</div><!-- .tab-pane #hitmag-comments -->

			<div id="hitmag-tags">
				<?php        
					$tags = get_tags();             
					if($tags) {               
						foreach ( $tags as $tag ): ?>    
							<span><a href="<?php echo esc_url( get_term_link( $tag ) ); ?>"><?php echo esc_attr( $tag->name ); ?></a></span>           
							<?php     
						endforeach;       
					} else {          
						esc_html_e( 'No tags created.', 'hitmag');           
					}            
				?>
			</div><!-- .tab-pane #hitmag-tags-->

		</div><!-- .tab-content -->		

		</div><!-- #tabs -->


		<?php echo $after_widget; ?>

		<?php wp_enqueue_script( 'jquery-ui-tabs' ); ?>

<?php

	}

}

//Registster hitmag tabbed widget.
function hitmag_register_tabbed_widget() {
    register_widget( 'HitMag_Tabbed_Widget' );
}
add_action( 'widgets_init', 'hitmag_register_tabbed_widget' ); 