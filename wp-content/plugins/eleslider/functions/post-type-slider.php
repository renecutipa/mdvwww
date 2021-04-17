<?php 
//Custom Post Types
add_action('init', 'create_wpm_ele_slider');
function create_wpm_ele_slider() {
    $slider_args = array(
        'label' => __('Slider posts','eleslider'),
        'singular_label' => __('Slide','eleslider'),
		'add_new'  => __('Add New Slide','eleslider'),
        'public' => true,
        'show_ui' => true,
		'menu_position' => 100,
        'capability_type' => 'post',
		'menu_icon' => 'dashicons-desktop',
        'hierarchical' => false,
		'publicly_queryable' => true,
		'query_var' => true,
        'rewrite' => array( 'slug' => 'slider', 'with_front' => false ),
		'can_export' => true,
        'supports' => array(
			'title', 
			'editor', 
			'post-thumbnails',
			'custom-fields',
			'thumbnail'
		  )
       );
  	register_post_type('wpm_ele_slider',$slider_args);
	register_taxonomy('group', array('wpm_ele_slider'), array('hierarchical' => true, 'label' => 'Group', 'singular_label' => 'Category', 'rewrite' => true));
}
	


// Custom meta boxes
$prefix = 'wpm_slide_';
$meta_boxes = array();
// first meta box
$meta_boxes[] = array(
	'id' => 'wpm-meta-box-1',
	'title' => 'Slider Item Options',
	'pages' => array('wpm_ele_slider'), // multiple post types
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(


        array(
            'name' => 'Content Position (Heading and text)',
            'desc' => '',
            'id' => $prefix . 'content_position',
            'type' => 'select',
            'std' => '',
            'options' => array('Center','Left','Right','Disable')
        ),

		array(
            'name' => 'Slider URL',
            'desc' => 'This is the place for any link.',
            'id' => $prefix . 'url',
            'type' => 'text',
            'std' => ''
        ),
		
	)
);





foreach ($meta_boxes as $meta_box) {
	$my_box = new wpm_slide_meta_box($meta_box);
}

class wpm_slide_meta_box {

	protected $_meta_box;

	// create meta box based on given data
	function __construct($meta_box) {
		if (!is_admin()) return;
	
		$this->_meta_box = $meta_box;


		add_action('admin_menu', array(&$this, 'add'));

		add_action('save_post', array(&$this, 'save'));
	}
	


	/// Add meta box for multiple post types
	function add() {
		foreach ($this->_meta_box['pages'] as $page) {
			add_meta_box($this->_meta_box['id'], $this->_meta_box['title'], array(&$this, 'show'), $page, $this->_meta_box['context'], $this->_meta_box['priority']);
		}
	}



	// Callback function to show fields in meta box
	function show() {
		global $post;

		// Use nonce for verification
		echo '<input type="hidden" name="wmp_slider_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
	
		echo '<table class="form-table">';

		foreach ($this->_meta_box['fields'] as $field) {
        // get current post meta data
        $meta = get_post_meta($post->ID, $field['id'], true);

        echo '<tr class="meta">',
                '<th style="width:15%; padding-left:30px;"><label for="', esc_attr( $field['id']), '">', $field['name'], '</label></th>',
                '<td>';
        switch ($field['type']) {
            case 'text':
                echo '<input style="width:34%;" type="text" name="', esc_attr( $field['id']), '" id="', esc_attr( $field['id']), '" value="', esc_attr($meta ? $meta : $field['std']), '" size="30" style="width:97%" />', '<br />', esc_attr( $field['desc']);
                break;
				
            case 'heading':
                echo '<h3 id="',esc_attr(  $field['id']), '" class="meta">'; echo esc_attr( $field['desc']); echo '</h3>';
                break;
				
				
            case 'line':
                echo '<hr class="meta">';
                break;
				
            case 'textarea':
                echo '<textarea name="',esc_attr(  $field['id']), '" id="',esc_attr(  $field['id']), '" cols="60" rows="4" style="width:97%">',esc_textarea( $meta ? $meta : $field['std']), '</textarea>', '<br />', $field['desc'];
                break;
            case 'select':
                echo '<select name="', esc_attr( $field['id']), '" id="', esc_attr( $field['id']), '" class="meta">';
                foreach ($field['options'] as $option) {
                    echo '<option', $meta == $option ? ' selected="selected"' : '', '>', $option, '</option>';
                }
                echo '</select>', '<br />', $field['desc'];
                break;
        }
        echo     '<td>',
            '</tr>';
    }

    echo '</table>';
	}

	// Save data from meta box
	function save($post_id) {
		// verify nonce
		
		if (isset($_POST['wmp_slider_meta_box_nonce'])) {
		
		
		if (!wp_verify_nonce($_POST['wmp_slider_meta_box_nonce'], basename(__FILE__))) {
			return $post_id;
		}

		// check autosave
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return $post_id;
		}

		// check permissions
		if ('page' == $_POST['post_type']) {
			if (!current_user_can('edit_page', $post_id)) {
				return $post_id;
			}
		} elseif (!current_user_can('edit_post', $post_id)) {
			return $post_id;
		}

		foreach ($this->_meta_box['fields'] as $field) {
			$name = $field['id'];
			
			$old = get_post_meta($post_id, $name, true);
			$new = sanitize_text_field($_POST[$field['id']]);
			
			if ($new && $new != $old) {
				update_post_meta($post_id, $name, $new);
			} elseif ('' == $new && $old) {
				delete_post_meta($post_id, $name, $old);
			}
		}
	}
}}

?>