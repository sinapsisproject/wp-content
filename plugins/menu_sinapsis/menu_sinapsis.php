<?php 

    /*
    Plugin Name: [Sinapsis] Menú
    Plugin URI: https://sinapsis.com
    Description: Plugin para no ocupar nunca más el Menú de elementor en la puta vida.
    Version: 1.0
    Author: Diego Baeza
    Author URI: https://sisnapsis.com
    License: GPL2
    */

    //require dirname(__FILE__) . '/public/assets/smarty/libs/Smarty.class.php';
    require(dirname(__FILE__) .'../../../../wp-load.php');

    wp_enqueue_style( 
    'css-menu-sinapsis',
    plugins_url( '/public/css/menu.css', __FILE__ ),
    array(),
    rand(0, 99)
    );



    function shortcode_menu_sinapsis($atts){

        include "public/partials/menu.php";

    }

    add_shortcode("shortcodemenusinapsis" , "shortcode_menu_sinapsis");





?>