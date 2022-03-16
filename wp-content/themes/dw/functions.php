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

//enregistrer un custom post type pour les message de contact

register_post_type('message', [
    'label' => 'Messages de contact',
    'labels' => [
        'name' => 'Messages de contact',
        'singular_name' => 'Message de contact'
    ],
    'description' => 'Message envoyer par le formulaire de contact.',
    'public' => false,
    'show_ui' => true,
    'menu_position' => 15,
    'menu_icon' => 'dashicons-buddicons-pm',
    'capabilities' => [
        'create_posts' => false,
        'read_post' => true,
        'read_post_private' => true,
    ],
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

//gérer l'envoie de formulaire personnaliser

add_action('admin_post_submit_contact_form', 'dw_handle_submit_contact_form');

function dw_handle_submit_contact_form()
{
    $nonce = $_POST['_wpnonce'];

    if (wp_verify_nonce($nonce, 'nonce_submit_contact')){
       $firstname = sanitize_text_field($_POST['firstname']);
       $lastname = sanitize_text_field($_POST['lastname']);
       $email = sanitize_email($_POST['email']);
       $phone = sanitize_text_field($_POST['phone']);
       $message = sanitize_text_field($_POST['message']);
       $rules = sanitize_text_field($_POST['rules'] ?? '');

       if ($firstname && $lastname && $email && $message){
            if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                if ( $rules === '1'){
                    $id = wp_insert_post([
                        'post_title' => 'message de ' . $firstname . ' ' . $lastname,
                        'post_type' => 'message',
                        'post_content' => $message,
                        'post_status' => 'publish',
                    ]);

                    // générez un email contenant l'url vers le post en question
                    $feedback = 'Bonjour, vous avez un nouveau message';
                    $feedback .= 'Y accéder : ' . get_edit_post_link($id);
                    //envoyer un email à l'admin
                    wp_mail(get_bloginfo('admin_email'), 'Nouveau message', $feedback);

                } else{
                    // TO DO : retourner u message d'erreur "règles pas acceptées"
                }
            } else {
                // TO DO : retourner un message d'erreur "email non-valide"
            }
       } else {
           // TO DO : retourner une erreur de validation "champs requis"
       }
    }
    // TO DO : retourner un message d'erreur 'not authorized'
}