<?php 
/*-----------------------------------------------------------------------------------*/
/* [eleslider]
/*-----------------------------------------------------------------------------------*/

function wpm_ele_slider($atts, $content = null) {
	extract(shortcode_atts(array(
		"query" => '',
        "category" => '',
		"posts" => '',
		"order" => '',
		"dots_text" => '',
	), $atts));
	wp_enqueue_script('owl.carousel', plugin_dir_url(__DIR__).'assets/js/owl.carousel.min.js','','', true);
	wp_enqueue_script('owl.carousel.start', plugin_dir_url(__DIR__).'assets/js/owl.carousel.start.js','','', true);
	global $wp_query,$paged,$post;
	$temp = $wp_query;
	$wp_query= null;
	$wp_query = new WP_Query();
	if($category === 'flase'){
		$query .= 'post_type=wpm_ele_slider&showposts='.$posts.'&order='.$order;
	}
	else {$query .= 'post_type=wpm_ele_slider&group='.$category.'&showposts='.$posts.'&order='.$order;}
	if(!empty($query)){
		$query .= $query;
	}
	$wp_query->query($query);
	ob_start();
	?>
    <div class="wpm_eleslider_wrap">
    
        <img src="<?php echo plugin_dir_url(__DIR__).'assets/images/tail-spin.svg'; ?>" width="40" alt="">
        
        <div class="wpm_eleslider loop owl-carousel loading dots_text_<?php echo esc_html($dots_text) ?>">
    
        <?php while ($wp_query->have_posts()) : $wp_query->the_post();?>
                
                <?php 
                    $wpm_content_position = get_post_meta(get_the_ID(), 'wpm_slide_content_position', true);
                    $wpm_slide_url = get_post_meta(get_the_ID(), 'wpm_slide_url', true);
                ?>
                      
                <div class="eleinside eleinside_<?php echo esc_attr($wpm_content_position); ?>" data-dot="<?php the_title();?>">
                    
                    <?php if ( has_post_thumbnail()) { ?>
                        
                             <a href="<?php echo (esc_url($wpm_slide_url)); ?>" title="<?php the_title();?>" >
                             
                                <?php the_post_thumbnail( 'ele_slider', array('class' => 'tranz bg_image')); ?>
                                
                             </a>
                        
                    <?php } ?>
                    
                    <div class="eleslideinside tranz ">
                    
                        <?php the_content(); ?>
                    
                    </div>
                            
                </div>
                
        <?php endwhile; wp_reset_postdata(); ?>
        
        
  
        
        </div>
    </div> 
    <div class="clearfix"></div>
    <?php wp_reset_query(); ?>
	<?php $wp_query = null; $wp_query = $temp;
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}
add_shortcode("eleslider", "wpm_ele_slider");
