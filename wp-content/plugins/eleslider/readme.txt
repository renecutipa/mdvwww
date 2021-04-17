=== Eleslider ===
Contributors: Dannci
Donate link: http://wpmasters.org/make-it-easy
Tags: responsive slider, elementor, full-width, full-width slider
Requires at least: 4.6
Tested up to: 4.9.4
Stable tag: 1.3
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html


== Description ==	
Don't hassle with bloated slider plugins. Make it easy!
Eleslider plugin adds 'slider' custom posts and simple widget which can be used in the Elementor page builder. You can display full-width sider in your layouts this way.

[DEMO](http://dannci.wpmasters.org/plugins/eleslider/)

Eleslider is not a full-width slider just for Elementor plugin. You can use it in almost any good page builder plugin.

= Overview: =
1. **create few  Slider posts** in left dashboard menu. One 'Slider post' represents one slide in the slider.
2. **set featured image for every slider post**, add slide content (titles/text), and sort/list slider posts into own categories.
3. display these slider posts as slider. **In Elementor page builder add 'Eleslider' block into full-width section**. 


Alternatively, you can use a shortcode to display the slider.

Add the shortcode on any page to display a 'Slider posts' as a slider. For example:
<pre>[eleslider category="lifestyle" posts="3" order="ASC"]</pre>

= Shortcode Options: =
* Basic shortcode: <code>[eleslider]</code>
* *category* - Represents single slide category (group). <code>[eleslider category="lifestyle"]</code>  Use category 'slugs',
* *posts* - Number of slider posts (slides) to show;
* *order* - Value can be 'ASC' or 'DESC'. Order of slider posts (slides) to be shown. Order is based on slider post publish date.
* *dots_text* - Value can be 'yes' or 'no'. If dots_text option is enabled, titles of slides will be shown in the "dots" navigation.



== Installation ==

- upload 'eleslider' folder into '...wp-content\plugins\' folder
- go to Dashboard > Plugins and activate 'Eleslider' plugin, 
- That's all

== Frequently Asked Questions ==

= What is the correct size of the image for Eleslider? =

Slider displays images 'as they are'. Slider stretches these images to the full width of the screen (or available space). Recommended size for full-width purposes is 1600x750px 

== Screenshots ==
1. 1) create **Slider posts** in left dashboard menu. One 'Slider post' represents one slide in the slider.
2. 2) set featured image for every slider post, add slide content (titles/text).
3. 3) display slider posts as a slider: In Elementor page builder add 'Eleslider' block into full-width section (note: in Elementor edit mode is sliding disabled, only first slide is visible). 

== Changelog ==

= 1.3 =
* Added: 'bg_image' class for slider images

= 1.2 =
* Added: "dots" navigation
* Added: 'loading' icon

= 1.1 =
* Added: "dots" navigation
* Added: 'loading' icon

= 1.0 =
* Initial release