<?php

function epo_styles(){
    //wp_enqueue_style('style', get_stylesheet_uri());
    wp_enqueue_style('automatize01', get_stylesheet_directory_uri().'/css/autoptimize01.css');
    wp_enqueue_style('automatize01', get_stylesheet_directory_uri().'/css/autoptimize02.css',array(),false,'only screen and (max-width: 768px)');
    wp_enqueue_style('OpenSans', 'http://fonts.googleapis.com/css?family=Open+Sans%3A400&ver=5.7');
    wp_enqueue_style('automatize01s', get_stylesheet_directory_uri().'/css/autoptimize_single01.css');
    wp_enqueue_style('automatize02s', get_stylesheet_directory_uri().'/css/autoptimize_single02.css');
    wp_enqueue_style('NunitoSans', 'https://fonts.googleapis.com/css?family=Nunito%20Sans:200,300,400,600,700,800,900,200italic,300italic,400italic,600italic,700italic,800italic,900italic%7CPoppins:600,400,700,500&subset=latin&display=swap&ver=1604670524');
    wp_enqueue_style('Roboto', 'https://fonts.googleapis.com/css?family=Roboto%3A100%2C100italic%2C200%2C200italic%2C300%2C300italic%2C400%2C400italic%2C500%2C500italic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic%2C900%2C900italic%7CRoboto+Slab%3A100%2C100italic%2C200%2C200italic%2C300%2C300italic%2C400%2C400italic%2C500%2C500italic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic%2C900%2C900italic%7CPoppins%3A100%2C100italic%2C200%2C200italic%2C300%2C300italic%2C400%2C400italic%2C500%2C500italic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic%2C900%2C900italic&ver=5.7');

    wp_enqueue_script('jquery');
     wp_enqueue_script('automatize01js', get_stylesheet_directory_uri().'/js/autoptimize.js');
}


add_action('wp_enqueue_scripts', 'epo_styles');	


register_nav_menus(
    array(
        'quicklinks' => __('Quicklinks', '17epo')
    )
);
