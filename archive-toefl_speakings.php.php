<?php
get_header(); ?>

<!-- Add your HTML and PHP code for the main content and filters here -->

<?php
// Pagination
global $wp_query;
$big = 999999999;
echo paginate_links( array(
    'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
    'format'    => '?paged=%#%',
    'current'   => max( 1, get_query_var( 'paged' ) ),
    'total'     => $wp_query->max_num_pages,
    'mid_size'  => 2,
    'prev_next' => true,
    'prev_text' => __( '« Previous', 'toefl-speaking' ),
    'next_text' => __( 'Next »', 'toefl-speaking' ),
    'type'      => 'list',
) );



?>

<?php get_footer(); ?>