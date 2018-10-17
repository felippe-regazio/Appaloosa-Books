<?php 
if ( true == get_theme_mod( 'show_slider', true ) ) :

    $hm_slider_category = get_theme_mod( 'slider_category', '0' );

    $slider_posts = new WP_Query (
        array(
            'cat'                   => $hm_slider_category,
            'posts_per_page'        => 5,
            'ignore_sticky_posts'   => true,
            'meta_query' => array(array('key' => '_thumbnail_id')) // only if have thumbs
        )
    );

    ?>

    <div class="hitmag-featured-slider">
        <section class="slider">
            <div id="hm-slider" class="flexslider">
                <ul class="slides">
                    <?php
                        if ( $slider_posts->have_posts() ) :
                        while( $slider_posts->have_posts() ) : $slider_posts->the_post();

                        if ( has_post_thumbnail() ) { 
                            $thumb_id               = get_post_thumbnail_id();
                            $featured_url_array     = wp_get_attachment_image_src( $thumb_id, 'hitmag-featured' );
                            $featured_image_url     = $featured_url_array[0]; 
                        } else {
                            $featured_image_url = get_template_directory_uri() . '/images/slide.jpg';
                        }
                    ?>
                        <li>
                            <div class="hm-slider-container" data-loc="<?php echo esc_url( get_permalink() ); ?>">

                                <div class="hm-slide-holder" style="background: url(<?php echo esc_url( $featured_image_url ); ?>);">

                                    <div class="hm-slide-content">

                                        <div class="hm-slider-details">
                                            <?php hitmag_category_list(); ?>
                                            <a href="<?php the_permalink(); ?>" rel="bookmark"><h3 class="hm-slider-title"><?php the_title(); ?></h3></a>
                                            <div class="slide-entry-meta">
                                                <?php hitmag_posted_on(); ?>
                                            </div><!-- .entry-meta -->
                                        </div><!-- .hm-slider-details -->

                                    </div><!-- .hm-slide-content -->

                                </div><!-- .hm-slide-holder -->

                            </div><!-- .hm-slider-container -->
                        </li>

                    <?php 

                        endwhile;
                        endif;

                    ?>
                </ul>
            </div><!-- .flexslider -->
        </section><!-- .slider -->

        <?php $slider_posts->rewind_posts(); ?>

        <div id="hm-carousel" class="flexslider">
            <ul class="slides">
                <?php
                    if ( $slider_posts->have_posts() ) :
                        while( $slider_posts->have_posts() ) : $slider_posts->the_post();

                            if ( has_post_thumbnail() ) { 
                                $thumb_id               = get_post_thumbnail_id();
                                $thumb_url_array        = wp_get_attachment_image_src( $thumb_id, 'hitmag-thumbnail' );
                                $thumb_url              = $thumb_url_array[0];
                            } else {
                                $thumb_url = get_template_directory_uri() . '/images/slide-thumb.jpg';
                            }
                        ?>

                        <li>
                            <div class="hm-thumb-bg"><img src="<?php echo esc_url( $thumb_url ); ?>" /></div>
                        </li>

                    <?php 
                        endwhile; 
                    endif; 
                    wp_reset_postdata(); 
                ?>
            </ul><!-- .slides -->
        </div><!-- #hm-carousel -->

    </div><!-- .hm-slider -->

<?php endif;