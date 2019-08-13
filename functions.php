<?php
add_theme_support( 'post-thumbnails' );
add_theme_support( 'menus' );
set_post_thumbnail_size( 1568, 9999 );
register_nav_menus(
	array(
		'menu-1' => __( 'Primary', 'twentynineteen' ),
		'footer' => __( 'Footer Menu', 'twentynineteen' ),
		'social' => __( 'Social Links Menu', 'twentynineteen' ),
	)
);
add_theme_support(
	'html5',
	array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	)
);
add_theme_support(
	'custom-logo',
	array(
		'height'      => 190,
		'width'       => 190,
		'flex-width'  => false,
		'flex-height' => false,
	)
);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function widgets_init() {

	register_sidebar(
		array(
			'name'          => __( 'Footer', 'twentynineteen' ),
			'id'            => 'sidebar-1',
			'description'   => __( 'Add widgets here.', 'twentynineteen' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

}
add_action( 'widgets_init', 'widgets_init' );