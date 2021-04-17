<?php
/*
Plugin Name: 	Eleslider
Plugin URI: 	https://wpmasters.org/eleslider/
Description: 	Add full-width content slider into Elementor  
Author: 		wpmasters
Author URI: 	https://wpmasters.org/
Version: 		1.3
License:		GPL2+
*/

/*  Copyright 2018  WPMasters

	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License, version 2, as 
	published by the Free Software Foundation.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

if ( !class_exists( 'Eleslider' ) ) :

final class Eleslider {};

////////////
// variables
$eleslider_main_file = dirname(__FILE__).'/eleslider.php';
$eleslider_directory = plugin_dir_url($eleslider_main_file);
$eleslider_path = dirname(__FILE__);

////////////
// enqueue css 
function eleslider_add_scripts() {
	global $eleslider_directory, $eleslider_path;
	wp_enqueue_style('eleslider-style', $eleslider_directory.'assets/eleslider.css');
}
add_action('wp_enqueue_scripts', 'eleslider_add_scripts');



////////////
// text domain
load_plugin_textdomain('eleslider', false, basename( dirname( __FILE__ ) ) . '/languages' );


////////////
// thumnails
//add_image_size('ele_slider', 1600, 750, true );//(cropped)

////////////
// custom post type + shortcodes

require_once ('functions/wpm-shortcodes.php');			
require_once ('functions/post-type-slider.php'); 

////////////
// widget
include_once (dirname( __FILE__ ) . '/functions/widget-slider.php');


////////////
// global body class
function eleslider_body_class( $c ) {

    global $post;

    if( isset($post->post_content) && has_shortcode( $post->post_content, 'eleslider' ) ) {
        $c[] = 'is-eleslider';
    }
    return $c;
}
add_filter( 'body_class', 'eleslider_body_class' );


////////////
// thumb for admin section 1.
function eleslider_get_featured_image($post_ID) {  
    $post_thumbnail_id = get_post_thumbnail_id($post_ID);  
    if ($post_thumbnail_id) {  
        $post_thumbnail_img = wp_get_attachment_image_src($post_thumbnail_id, 'thumbnail');  
        return $post_thumbnail_img[0];  
    }  
} 
// thumb for admin section 2. ADD NEW COLUMN  
function eleslider_columns_head($defaults) {  
	$defaults['featured_image'] = 'Featured Image';  
	return $defaults;  
}  
// thumb for admin section 3. SHOW THE FEATURED IMAGE  
function eleslider_columns_content($column_name, $post_ID) {  
	if ($column_name == 'featured_image') {  
		$post_featured_image = eleslider_get_featured_image($post_ID);  
		if ($post_featured_image) {  
			echo '<img style=" width:100px;" src="' . $post_featured_image . '" />';  
		}  
	}  
}  
add_filter('manage_posts_columns', 'eleslider_columns_head');  
add_action('manage_posts_custom_column', 'eleslider_columns_content', 10, 2); 

endif; // class_exists check

?>
