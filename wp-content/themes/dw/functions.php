<?php


//chargez les fichiers nécessaire
require_once(__DIR__ . './Menus/PrimaryMenuWalker.php');
require_once(__DIR__ . './Menus/PrimaryMenuItem.php');

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
    'menu_icon' => 'dashicons-palmtree',
    'supports' => ['title','editor','thumbnail'],
    'rewrite' => ['slug' => 'voyages'],
]);

//Récupérer les trips via une requête wordpress
function dw_get_trips($count = 20)
{
    // 1. on instancie l'objet WP_query
    $trips = new WP_Query([
        'post_type' => 'trip',
        'orderby' => 'date',
        'order' => 'DESC',
        'posts_per_page' => $count,
    ]);

    // 2. on retourne l'objet WP_query
    return $trips;
}

//enregistrer les zones de Menus

register_nav_menu('primary', 'Navigation principale (haut de page)');
register_nav_menu('footer', 'Navigation (pied de page)');

//fonction pour récupérez les éléments du menu sous forme d'un tableau d'objet

function dw_get_menu_items($location)
{
    $items = [];

    //récupérez le menu Wordpress pour $location
    $locations = get_nav_menu_locations();

    if ($locations[$location] ?? false){
        $menu = $locations[$location];


        //récupérez tous les éléments du menu réupéré
        $posts = wp_get_nav_menu_items($menu);


        //formater chaque éléments dans une instance de classe personnalisée
        //boucler sur chaque $post
        foreach ($posts as $post) {
            //transformer le WP_post en une instance de notre classe personnaisée
            $item = new PrimaryMenuItem($post);

            //ajouter cette instance à $items ou à l'item parent si sous-menu
            if ($item->isSubItem()){
                //ajouter $item comme "enfant" de l'item parent
                foreach ($items as $parent){
                    if ($parent->isParentFor($item)){
                        $parent->addSubItem();
                    }
                }
            }else{
                //Ajouter
                $items[] = $item;
            }
        }
    }


    //retourner un tableau d'élément de menu formaté

    return $items;
}