<?php

// ADD TO THEME FUNCTIONS

function toefl_speaking_posts_per_page( $query ) {
    if ( $query->is_main_query() && is_post_type_archive( 'toefl_speakings' ) ) {
        $query->set( 'posts_per_page', 30 );
    }
}
add_action( 'pre_get_posts', 'toefl_speaking_posts_per_page' );



?>