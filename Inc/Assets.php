<?php
class Quickassets{

    function __construct(){

        $version = '1.0.1';

        wp_enqueue_style('main-css', plugin_dir_url(dirname(__FILE__)) . 'Assets/CSS/style.css', array(), $version);

        // phpcs:ignore
        wp_enqueue_style('slick-css', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css', null);
        // phpcs:ignore
        wp_enqueue_script('slick-js', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js',array(), $version, true );
        wp_enqueue_script('elevatezoom-js', '//cdnjs.cloudflare.com/ajax/libs/elevatezoom/3.0.8/jquery.elevatezoom.min.js',array(), $version, true );

        wp_enqueue_style('all-min-font-awesome', plugin_dir_url(dirname(__FILE__)) . 'Assets/CSS/all.min.css', array(), '5.15.4');
        wp_enqueue_style('main-font-awesome-css', plugin_dir_url(dirname(__FILE__)) . 'Assets/CSS/fontawesome.min.css', array(), '5.15.4');
        wp_enqueue_style('main-font-awesome-css', plugin_dir_url(dirname(__FILE__)) . 'Assets/webfonts', array(), '5.15.4');

        wp_enqueue_script('jquery');
        wp_enqueue_script('main-js', plugin_dir_url(dirname(__FILE__)) . 'Assets/JS/scripts.js',array(), $version, true );
        wp_enqueue_script('frontend-js', plugin_dir_url(dirname(__FILE__)) . 'Assets/JS/frontend-script.js',array(), $version, true );
        wp_enqueue_script('variation-swatches-for-archive-page', plugin_dir_url(dirname(__FILE__)) . 'Assets/JS/variation-swatches-for-archive-page.js',array(), $version, true );
        wp_enqueue_script('jsColor', plugin_dir_url(dirname(__FILE__)) . 'Assets/JS/jscolor.min.js',array(), $version, true );
        wp_localize_script('main-js', 'quick_ajax_obj', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'pro_key' => get_option('QUICK_LICENSE_OK')
        ));

        add_action('wp_enqueue_scripts', array($this,'qctv_enqueue_frontend_scripts'));
        add_action('wp_enqueue_scripts', array($this,'bulk_cart_enqueue_frontend_scripts'));


    }
    function qctv_enqueue_frontend_scripts(){
        wp_localize_script('frontend-js', 'quick_front_ajax_obj', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'siteUrl' => get_site_url(), // Get the cart URL dynamically.
            'nonce'    => wp_create_nonce('woocommerce_ajax_add_to_cart'), // Create a nonce

        ));
    }

    function bulk_cart_enqueue_frontend_scripts(){
        wp_localize_script('frontend-js', 'bulk_add_to_cart_params', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'siteUrl' => get_site_url(), // Get the cart URL dynamically.
            'nonce'    => wp_create_nonce('woocommerce_ajax_add_to_cart'), // Create a nonce

        ));
    }
}
