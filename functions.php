<?php
/**
 * Theme functions and definitions
 *
 * @package HelloElementorChild
 */

/**
 * Load child theme css and optional scripts
 *
 * @return void
 */
function hello_elementor_child_enqueue_scripts() {
	wp_enqueue_style(
		'hello-elementor-child-style',
		get_stylesheet_directory_uri() . '/style.css',
		[
			'hello-elementor-theme-style',
		],
		'1.0.0'
	);

	


}
add_action( 'wp_enqueue_scripts', 'hello_elementor_child_enqueue_scripts', 20 );


function elementor_child_get_tags(){
	$html = '';
	if(has_tag()){
		$html .= '<div class="blog-tags"><span>' . esc_html__( 'Post Tags : ', 'hello-elementor-child' );
		$html .= get_the_tag_list( '', '', '' );
		$html .= '</div>';
	}
	return $html;
}


function ele_child_widgets_init() {
	register_sidebar( [
        'name'          => esc_html__( 'Blog Sidebar', 'hello-elementor-child' ),
        'id'            => 'blog-sidebar',
        'before_widget' => '<div id="%1$s" class="sidebar__widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<div class="sidebar__widget-head"><h3 class="sidebar__widget-title">',
        'after_title'   => '</h3></div>',
    ] );
}
add_action( 'widgets_init', 'ele_child_widgets_init' );


// ele_child_search_filter_form
if ( !function_exists( 'ele_child_search_filter_form' ) ) {
    function ele_child_search_filter_form( $form ) {

        $form = sprintf(
            '<div class="search-form"><form action="%s" method="get"><input type="text" value="%s" required name="s" placeholder="%s"><button type="submit"></button></form></div>',
            esc_url( home_url( '/' ) ),
            esc_attr( get_search_query() ),
            esc_html__( 'Search', 'hello-elementor-child' )
        );

        return $form;
    }
    add_filter( 'get_search_form', 'ele_child_search_filter_form' );
}



function ele_child_pagination(){
    // global $wp_query;
    // echo paginate_links( array(
    //     'current'   => max( 1, get_query_var( 'paged' ) ),
    //     'total'     => $wp_query->max_num_pages,
    //     'type'      => 'list',
    //     'mid_size'  => 3
    // ) );
}
