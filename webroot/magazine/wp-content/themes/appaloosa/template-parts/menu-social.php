<?php 

if ( has_nav_menu( 'menu-social' ) ) :
	echo '<div class="hm-social-menu">';
		wp_nav_menu(
			array(
				'theme_location'  => 'menu-social',
				'container'       => 'div',
				'container_id'    => 'hm-menu-social',
				'container_class' => 'menu',
				'menu_id'         => 'menu-social-items',
				'menu_class'      => 'menu-items',
				'depth'           => 1,
				'link_before'     => '<span class="screen-reader-text">',
				'link_after'      => '</span>',
				'fallback_cb'     => '',
			)
		);
	echo '</div>';
endif;

?>