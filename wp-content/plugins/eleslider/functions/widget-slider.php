<?php
add_action('widgets_init', 'wmp_eleslider');

function wmp_eleslider()
{
	register_widget('wmp_eleslider');
}

class wmp_eleslider extends WP_Widget {
	
	public function __construct() {
		$widget_ops = array('classname' => 'wmp_eleslider', 'description' => esc_html__('Display "Slider" posts as slider','eleslider'));
		parent::__construct(false, esc_html__('Eleslider','eleslider'),$widget_ops);        
	}
	
	function widget($args, $instance)
	{
		extract($args);
		
		$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$categories = isset( $instance['categories'] ) ? esc_attr( $instance['categories'] ) : '';
		$posts = isset( $instance['posts'] ) ? esc_attr( $instance['posts'] ) : '';
		$order_type_sel = $instance['order_type_sel'] ;
		$dots_text = $instance['dots_text'] ;
		
		echo ($before_widget);
		?>
		

        	<?php if ( $title == "") {} else { ?>
        
				<h2 class="widget-title"><span><?php echo esc_attr($title); ?></span></h2>
			
            <?php } ?>
            
			<?php

			wp_enqueue_script('owl.carousel', plugin_dir_url(__DIR__).'assets/js/owl.carousel.min.js','','', true);
			wp_enqueue_script('owl.carousel.start', plugin_dir_url(__DIR__).'assets/js/owl.carousel.start.js','','', true);
			
			if (esc_attr($categories) == 'all') {
				
				
				$recent_posts = new WP_Query(array(
					'showposts' => $posts,
					'post_type' => 'wpm_ele_slider',
					'order'		=> $order_type_sel,
	
				));
				
			} else {
				
				$recent_posts = new WP_Query(array(
					'showposts' => $posts,
					'post_type' => 'wpm_ele_slider',
					'tax_query' => array(
						array(
							'taxonomy' => 'group',
							'terms' => $categories,
							'field' => 'term_id',
						)
					),
					'order'		=> $order_type_sel,
				));	
				
			};
			
			?>
            <div class="wpm_eleslider_wrap">
            
                <img src="<?php echo plugin_dir_url(__DIR__).'assets/images/tail-spin.svg'; ?>" width="40" alt="">
                
                <div class="wpm_eleslider loop owl-carousel loading dots_text_<?php echo esc_html($dots_text) ?>">
                
                <?php  while($recent_posts->have_posts()): $recent_posts->the_post();?>
    
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
                        
                        <div class="eleslideinside">
                        
                            <?php the_content(); ?>
                        
                        </div>
                                
                    </div>
    
                <?php endwhile; wp_reset_postdata(); ?>
                
                </div>
            
			</div>
            <?php  ?>
			<div class="clearfix"></div>
		
		<?php
		echo ($after_widget);
	}
	
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		
		$instance['title'] = $new_instance['title'];
		$instance['post_type'] = 'all';
		$instance['categories'] = $new_instance['categories'];
		$instance['posts'] = $new_instance['posts'];
		$instance['order_type_sel'] = $new_instance['order_type_sel'];
		$instance['dots_text'] = $new_instance['dots_text'];
		
		return $instance;
	}

	function form($instance)
	{
		$defaults = array('title' => '', 'post_type' => 'all', 'categories' => 'all', 'posts' => 4, 'order_type_sel' => 'DESC');
			$order_type = array(
				'ASC' => esc_html__('ASC','eleslider'),
				'DESC' => esc_html__('DESC','eleslider'),
			);
		$instance = wp_parse_args((array) $instance, $defaults); ?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title (optional)','eleslider'); ?></label>
			<input class="widefat" style="width: 100%;" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" value="<?php echo esc_attr($instance['title']); ?>" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('categories')); ?>"><?php esc_html_e('Filter by Category','eleslider'); ?></label> 
			<select id="<?php echo esc_attr($this->get_field_id('categories')); ?>" name="<?php echo esc_attr($this->get_field_name('categories')); ?>" class="widefat categories" style="width:100%;">
				<option value='all' <?php if ('all' == $instance['categories']) echo 'selected="selected"'; ?>></option>
				<?php $categories = get_categories($args = array(
															'type'		=> 'wpm_ele_slider',
															'orderby'	=> 'name',
															'order'		=> 'ASC',
															'taxonomy'	=> 'group'
															)) ?>
				<?php foreach($categories as $category) { ?>
				<option value='<?php echo esc_attr($category->term_id); ?>' <?php if ($category->term_id == $instance['categories']) echo 'selected="selected"'; ?>><?php echo esc_attr($category->cat_name); ?></option>
				<?php } ?>
			</select>
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('posts')); ?>"><?php esc_html_e('Number of posts:','eleslider'); ?></label>
			<input class="widefat" style="width: 30px;" id="<?php echo esc_attr($this->get_field_id('posts')); ?>" name="<?php echo esc_attr($this->get_field_name('posts')); ?>" value="<?php echo esc_attr($instance['posts']); ?>" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('order_type_sel')) ?>"><?php esc_html_e('Pick a order for "Slider posts"','eleslider'); ?><br/>
               	
				<select class='widefat' id="<?php echo $this->get_field_id('order_type_sel'); ?>" name="<?php echo $this->get_field_name('order_type_sel'); ?>" type="text">
                  <option value='DESC'<?php echo ($order_type=='DESC')?'selected':''; ?>><?php esc_html_e('DESC','eleslider'); ?></option>
                  <option value='ASC'<?php echo ($order_type=='ASC')?'selected':''; ?>><?php esc_html_e('ASC','eleslider'); ?></option>
                </select> 
			</label>
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('dots_text')) ?>"><?php esc_html_e('Slide title will be visible in "dots" navigation:','eleslider'); ?><br/>
               	
				<select class='widefat' id="<?php echo $this->get_field_id('dots_text'); ?>" name="<?php echo $this->get_field_name('dots_text'); ?>" type="text">
                  <option value=' '<?php echo ($order_type==' ')?'selected':''; ?>> </option>
                  <option value='no'<?php echo ($order_type=='no')?'selected':''; ?>><?php esc_html_e('no','eleslider'); ?></option>
                  <option value='yes'<?php echo ($order_type=='yes')?'selected':''; ?>><?php esc_html_e('yes','eleslider'); ?></option>
                </select> 
			</label>
		</p>

	<?php }
}
?>