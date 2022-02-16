<?php
//désactiver l'éditeur gutenberg
add_filter('use_block_editor_for_post', '__return_false');

//Activer les images sur les articles
add_theme_support( 'post-thumbnails' );

// enregistrer un seul custom post type pour "nos voyages"
register_post_type('trip', [
    'label' => 'Voyages',
    'labels' => [
        'name' => 'Voyages',
        'singular_name' => 'Voyage'
    ],
    'description' => 'Tous les articles qui décrive un voyage',
    'public' => true,
    'menu_position' => 10,
    'menu_icon' => 'dashicons-palmtree'
]);