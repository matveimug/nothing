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

// New order notification only for "Pending" Order status
add_action( 'woocommerce_checkout_order_processed', 'pending_new_order_notification', 20, 1 );
function pending_new_order_notification( $order_id ) {
    // Get an instance of the WC_Order object
    $order = wc_get_order( $order_id );

    // Only for "pending" order status
    if( ! $order->has_status( 'pending' ) ) return;

    // Get an instance of the WC_Email_New_Order object
    $wc_email = WC()->mailer()->get_emails()['WC_Email_New_Order'];

    ## -- Customizing Heading, subject (and optionally add recipients)  -- ##
    // Change Subject
    $wc_email->settings['subject'] = __('{site_title} - New customer Pending order ({order_number}) - {order_date}');
    // Change Heading
    $wc_email->settings['heading'] = __('New customer Pending Order'); 
    // $wc_email->settings['recipient'] .= ',name@email.com'; // Add email recipients (coma separated)

    // Send "New Email" notification (to admin)
    $wc_email->trigger( $order_id );
}

add_filter( 'register_post_type_args', function( $args, $post_type ) {

    if ( 'messages' === $post_type ) {
        $args['show_in_graphql'] = true;
        $args['graphql_single_name'] = 'Message';
        $args['graphql_plural_name'] = 'Messages';
    }

    return $args;

}, 10, 2 );


add_filter( 'register_post_type_args', function( $args, $post_type ) {

    if ( 'meta' === $post_type ) {
        $args['show_in_graphql'] = true;
        $args['graphql_single_name'] = 'Meta';
        $args['graphql_plural_name'] = 'Metas';
    }

    return $args;

}, 10, 2 );

