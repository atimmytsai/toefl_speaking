<?php
/**
 * Plugin Name: TOEFL Speaking CPT
 * Description: A plugin to create a custom post type and taxonomies for TOEFL Speaking.
 * Version: 1.0
 * Author: Atimmy Tsai
 */

// Register Custom Post Type
function toef_speaking_register_cpt() {
    $labels = array(
        'name' => __('TOEFL Speaking', 'toef-spk'),
        'singular_name' => __('TOEFL Speaking', 'toef-spk'),
        // ... (other labels)
    );
    $args = array(
        'label' => __('TOEFL Speaking', 'toef-spk'),
        'labels' => $labels,
        'supports' => array('title', 'editor', 'thumbnail'),
        'public' => true,
        'has_archive' => true,
    );
    register_post_type('toef_speaking', $args);
}
add_action('init', 'toef_speaking_register_cpt');

// Register Custom Taxonomies
function toef_speaking_register_taxonomies() {
    // Register Task Taxonomy
    $task_labels = array(
        'name' => __('Tasks', 'toef-spk'),
        'singular_name' => __('Task', 'toef-spk'),
        // ... (other labels)
    );
    $task_args = array(
        'labels' => $task_labels,
        'public' => true,
        'hierarchical' => true,
        'rewrite' => array('slug' => 'toef_speaking_task'),
    );
    register_taxonomy('toef_speaking_task', array('toef_speaking'), $task_args);

    // Register Topic Taxonomy
    $topic_labels = array(
        'name' => __('Topics', 'toef-spk'),
        'singular_name' => __('Topic', 'toef-spk'),
        // ... (other labels)
    );
    $topic_args = array(
        'labels' => $topic_labels,
        'public' => true,
        'hierarchical' => true,
        'rewrite' => array('slug' => 'toef_speaking_topic'),
    );
    register_taxonomy('toef_speaking_topic', array('toef_speaking'), $topic_args);

    // Register Difficulty Taxonomy
    $difficulty_labels = array(
        'name' => __('Difficulties', 'toef-spk'),
        'singular_name' => __('Difficulty', 'toef-spk'),
        // ... (other labels)
    );
    $difficulty_args = array(
        'labels' => $difficulty_labels,
        'public' => true,
        'hierarchical' => true,
        'rewrite' => array('slug' => 'toef_speaking_difficulty'),
    );
    register_taxonomy('toef_speaking_difficulty', array('toef_speaking'), $difficulty_args);
}
add_action('init', 'toef_speaking_register_taxonomies');

// Enqueue Custom CSS and JS
function toef_speaking_enqueue_scripts() {
    wp_enqueue_style('toef-spk-style', plugin_dir_url(__FILE__) . 'css/toef-spk.css');
    wp_enqueue_script('toef-spk-script', plugin_dir_url(__FILE__) . 'js/toef-spk.js', array('jquery'), '1.0', true);
}
add_action('wp_enqueue_scripts', 'toef_speaking_enqueue_scripts');

// Flush rewrite rules upon plugin activation
function toef_speaking_activate() {
    toef_speaking_register_cpt();
    toef_speaking_register_taxonomies();
    flush_rewrite_rules();
}
register_activation_hook(__FILE__, 'toef_speaking_activate');

// Add archive template for TOEFL Speaking CPT
function toef_speaking_archive_template($archive_template) {
    global $post;
    if (is_post_type_archive('toef_speaking')) {
        $archive_template = plugin_dir_path(__FILE__) . 'templates/archive-toef_speaking.php';
    }
    return $archive_template;
}
add_filter('archive_template', 'toef_speaking_archive_template');

// Add single template for TOEFL Speaking CPT
function toef_speaking_single_template($single_template) {
    global $post;
    if ($post->post_type == 'toef_speaking') {
        $single_template = plugin_dir_path(__FILE__) . 'templates/single-toef_speaking.php';
    }
    return $single_template;
}
add_filter('single_template', 'toef_speaking_single_template');
