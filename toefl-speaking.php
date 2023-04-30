<?php
/**
 * Plugin Name: TOEFL Speaking
 * Description: Creates a new CPT for TOEFL Speaking with custom taxonomies and a front-end template.
 * Version: 1.0
 * Author: Your Name
 * Author URI: yourwebsite.com
 */

//Register the custom post type:.
function toefl_speaking_cpt() {
    $labels = array(
        'name'               => __( 'TOEFL Speakings', 'toefl-speaking' ),
        'singular_name'      => __( 'TOEFL Speaking', 'toefl-speaking' ),
        'menu_name'          => __( 'TOEFL Speakings', 'toefl-speaking' ),
        'name_admin_bar'     => __( 'TOEFL Speaking', 'toefl-speaking' ),
        'add_new'            => __( 'Add New', 'toefl-speaking' ),
        'add_new_item'       => __( 'Add New TOEFL Speaking', 'toefl-speaking' ),
        'new_item'           => __( 'New TOEFL Speaking', 'toefl-speaking' ),
        'edit_item'          => __( 'Edit TOEFL Speaking', 'toefl-speaking' ),
        'view_item'          => __( 'View TOEFL Speaking', 'toefl-speaking' ),
        'all_items'          => __( 'All TOEFL Speakings', 'toefl-speaking' ),
        'search_items'       => __( 'Search TOEFL Speakings', 'toefl-speaking' ),
        'parent_item_colon'  => __( 'Parent TOEFL Speakings:', 'toefl-speaking' ),
        'not_found'          => __( 'No TOEFL Speakings found.', 'toefl-speaking' ),
        'not_found_in_trash' => __( 'No TOEFL Speakings found in Trash.', 'toefl-speaking' )
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'toefl_speakings' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
    );

    register_post_type( 'toefl_speakings', $args );
}
add_action( 'init', 'toefl_speaking_cpt' );

// Include Metaboxes
require_once dirname( __FILE__ ) . '/inc/toefl_speaking_metaboxes.php';

// Enqueue styles and scripts
function toefl_speaking_cpt_scripts() {
    wp_enqueue_style( 'toefl-speaking-cpt-style', plugins_url( 'assets/css/toefl_speaking.css', __FILE__ ), array(), '1.0.0' );
    wp_enqueue_script( 'toefl-speaking-cpt-script', plugins_url( 'assets/js/toefl_speaking.js', __FILE__ ), array( 'jquery' ), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'toefl_speaking_cpt_scripts' );



// Register the custom taxonomies:

function toefl_speaking_taxonomies() {
    // Register "Task" taxonomy
    $task_labels = array(
        'name' => _x('Tasks', 'taxonomy general name'),
        // Add more labels as needed
    );

    $task_args = array(
        'labels' => $task_labels,
        'public' => true,
        'hierarchical' => true,
        'rewrite' => array('slug' => 'task'),
    );

    register_taxonomy('task', 'toefl_speakings', $task_args);


    // Topic taxonomy
    register_taxonomy('topic', 'toefl_speakings', array(
        'hierarchical' => true,
        'rewrite' => array('slug' => 'topic'),
        'labels' => array(
        'name' => __('Topics'),
        'singular_name' => __('Topic'),
        'menu_name' => __('Topics'),
        ),
    ));

    // Difficulty taxonomy
    register_taxonomy('difficulty', 'toefl_speakings', array(
        'hierarchical' => true,
        'rewrite' => array('slug' => 'difficulty'),
        'labels' => array(
        'name' => __('Difficulties'),
        'singular_name' => __('Difficulty'),
        'menu_name' => __('Difficulties'),
        ),
    ));
    }
add_action('init', 'toefl_speaking_taxonomies');


//Add pre-built terms to "Task" taxonomy:
function toefl_speaking_default_terms() {
    $default_tasks = array('Task 1', 'Task 2', 'Task 3', 'Task 4');
    foreach ($default_tasks as $task) {
        if (!term_exists($task, 'task')) {
            wp_insert_term($task, 'task');
        }
    }
}
add_action('init', 'toefl_speaking_default_terms');


// Include theme functions file
require_once plugin_dir_path( __FILE__ ) . 'theme-functions.php';

register_activation_hook( __FILE__, 'reset_permalinks' );
function reset_permalinks() {
    flush_rewrite_rules();
}

?>
