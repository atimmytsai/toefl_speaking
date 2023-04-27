<?php

get_header();

$term = get_queried_object();

if ( $term ) {
    // Get the term slug
    $term_slug = $term->slug;

    // Load the template part based on the term slug
    if ( $term_slug === 'task1' ) {
        get_template_part( 'template-parts/taxonomy-task', 'task1' );
    } elseif ( $term_slug === 'task2' ) {
        get_template_part( 'template-parts/taxonomy-task', 'task2' );
    } elseif ( $term_slug === 'task3' ) {
        get_template_part( 'template-parts/taxonomy-task', 'task3' );
    } elseif ( $term_slug === 'task4' ) {
        get_template_part( 'template-parts/taxonomy-task', 'task4' );
    }
}

get_footer();