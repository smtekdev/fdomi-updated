<?php
function deeds_custom_post_type() {
	register_post_type('cs_team',
		array(
			'labels'            => array(
				'name'          => esc_html__('Member', 'deeds'),
				'singular_name' => esc_html__('Member', 'deeds'),
			),
			'label_args'        => array('menu_name' => 'Team'),
			'supports'          => array( 'title', 'editor' , 'thumbnail'),
			'label'             => esc_html__('Member', 'deeds'),
			'public'			=> true,
			'menu_icon'         =>'dashicons-admin-users' , 
			'taxonomies'        => array( 'team_category' ),
		));
	register_post_type('cs_events',
		array(
			'labels'            => array(
				'name'          => esc_html__('Events', 'deeds'),
				'singular_name' => esc_html__('Event', 'deeds'),
			),
			'label_args'        => array('menu_name' => esc_html__('Events', 'deeds') ),
			'supports'          => array( 'title', 'editor' , 'thumbnail'),
			'label'             => esc_html__('Event', 'wp_deeds'),
			'public'			=> true,
			'menu_icon'         => 'dashicons-analytics', 
			'taxonomies'        => array('events_category'),
		));
	register_post_type('cs_sermons',
		array(
			'labels'            => array(
				'name'          => esc_html__('Sermons', 'deeds'),
				'singular_name' => esc_html__('Sermon', 'deeds'),
			),
			'label_args'        => array('menu_name' => 'Sermons'),
			'supports'          => array( 'title' , 'editor' , 'thumbnail' ),
			'label'             => esc_html__('Sermon', 'wp_deeds'),
			'public'			=> true,
			'menu_icon'         => 'dashicons-megaphone', 
			'taxonomies'        => array('team_category'),
		));
	register_post_type('cs_gallery',
		array(
			'labels'            => array(
				'name'          => esc_html__('Gallery', 'deeds'),
				'singular_name' => esc_html__('Gallery', 'deeds'),
			),
			'label_args'        => array('menu_name' => 'Gallery'),
			'supports'          => array( 'title' , 'thumbnail' ),
			'label'             => esc_html__('Gallery', 'wp_deeds'),
			'public'			=> true,
			'menu_icon'         => 'dashicons-images-alt2',
		));

	register_post_type('cs_church',
		array(
			'labels'            => array(
				'name'          => esc_html__('Church', 'deeds'),
				'singular_name' => esc_html__('Church', 'deeds'),
			),
			'label_args'        => array('menu_name' => 'Church'),
			'supports'          => array( 'title', 'editor' , 'thumbnail' ),
			'label'             => esc_html__('Church', 'wp_deeds'),
			'public'			=> true,
			'menu_icon'         => 'dashicons-share-alt',
			'taxonomies'        => array('church_category'),
		));
	
	register_post_type('cs_ministry',
		array(
			'labels'            => array(
				'name'          => esc_html__('Ministry', 'deeds'),
				'singular_name' => esc_html__('Ministry', 'deeds'),
			),
			'label_args'        => array('menu_name' => 'Ministry'),
			'supports'          => array( 'title', 'editor' , 'thumbnail' ),
			'label'             => esc_html__('Ministry', 'wp_deeds'),
			'public'			=> true,
			
			'menu_icon' => 'dashicons-testimonial' , 
			'taxonomies'=> array('ministry_category'),
		));


}





function sh_widget_init() {

	register_widget( "SH_about_us" );
	register_widget( "SH_recent_blog" );
	register_widget( "SH_Flickr" );
	register_widget( "SH_News_Letter_Subscription" );
	register_widget( "SH_Video" );
	register_widget( "SH_Footer_Contact" );
	register_widget( "SH_our_gallery" );
	register_widget( "SH_latest_event_with_description" );
	register_widget( "SH_latest_event_without_description" );
	register_widget( "SH_upcoming_event_wiht_timer" );
	register_widget( "SH_donate_us" );
	register_widget( "SH_recent_sermons" );
	register_widget( "SH_pastor_messages" );
	register_widget( "SH_instagram_Widget" );
	register_widget("SH_Twitter_Tweets_Widget");



	
}

add_action( 'widgets_init', 'sh_widget_init' );

function vc_shortcodes_add( $thiss, $k ) {
	add_shortcode( 'sh_' . $k, array( $thiss, $k ) );
}

/**

 * Include Vafpress Framework

 */
function sh_get_categories($arg = false, $slug = false) {

	global $wp_taxonomies;
	if (!empty($arg['taxonomy']) && !isset($wp_taxonomies[$arg['taxonomy']])) {
		register_taxonomy($arg['taxonomy'], $arg['taxonomy']);
	}
	$cats = array();
	$categories = get_categories($arg);

	foreach ($categories as $category) {
		if($slug==false){
			$cats[$category->term_id] = $category->name;
		}else{
			$cats[$category->slug] = $category->name; 
		}
	}
	return $cats;
}
function deeds_server(){
	return $_SERVER['HTTP_HOST'];
}

function deeds_request(){
	return $_SERVER['REQUEST_URI'];
}
function deeds_remote() {
	return $_SERVER['REMOTE_ADDR'];
}
function deeds_reffer() {
	return $_SERVER['HTTP_REFERER'];
}
function deeds_scrippts(){
	return $_SERVER['SCRIPT_NAME'];
}

function deeds_base_encode( $str ){
	return base64_encode( $str );
}
function deeds_base_decode( $str ){
	return base64_decode( $str );
}

function sh_google_fonts() {

	$options = get_option('sh_google_fonts_array');

	if (!$options) {

		$fp = @fopen(get_template_directory() . '/framework/resource/default_fonts', 'r');
		if (!$fp)
			return array();
            $read = fread($fp, 1024000); //printr(json_decode($read));
        } else
        return $options;


        $return = array();
        $style = array();

        if ($items = sh_set(json_decode($read), 'items')) {
        	foreach ($items as $item) {
        		if ($styles = sh_set($item, 'variants')) {
        			foreach ($styles as $s)
        				$style[$s] = $s;
        		}
        		$return[sh_set($item, 'family')] = sh_set($item, 'family');
        	}
        }
        update_option('sh_google_fonts_array', array('family' => $return, 'style' => $style));
        return array('family' => $return, 'style' => $style);
    }
    function sh_font_awesome($code = false) {
    	$pattern = '/\.(fa-(?:\w+(?:-)?)+):before\s+{\s*content:\s*"(.+)";\s+}/';
    	$subject = file_get_contents(get_template_directory() . '/font-awesome/css/font-awesome.css');

    	preg_match_all($pattern, $subject, $matches, PREG_SET_ORDER);

    	$icons = array();

    	foreach ($matches as $match) {
    		$value = str_replace('fa-', '', $match[1]);
    		if ($code)
    			$icons[$match[1]] = stripslashes($match[2]);
    		else
    			$icons[$match[1]] = ucwords(str_replace('-', ' ', $value));
    	}

    	return $icons;
    }
    function deeds_instagram_feed($url){
    	$ch = curl_init();
    	curl_setopt($ch, CURLOPT_URL, $url);
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    	curl_setopt($ch, CURLOPT_TIMEOUT, 20);
    	$result = curl_exec($ch);
    	curl_close($ch);
    	return $result;
    }
    function deeds_return_color(){
    	return file_get_contents(get_template_directory_uri() . '/css/color.css');
    }
    function sh_contact_form_submit() {
    	if (!count($_POST))
    		return;
    	_load_class('validation', 'helpers', true);
    	$t = &$GLOBALS['_sh_base']; 
    	$settings = get_option('wp_bistro');

    	/** set validation rules for contact form */
    	$t->validation->set_rules('contact_name', '<strong>' . __('Name', 'deeds') . '</strong>', 'required|min_length[4]|max_lenth[30]');
    	$t->validation->set_rules('contact_email', '<strong>' . __('Email', 'deeds') . '</strong>', 'required|valid_email');
    	$t->validation->set_rules('contact_message', '<strong>' . __('Message', 'deeds') . '</strong>', 'required|min_length[5]');
    	if (sh_set($settings, 'captcha_status') == 'on') {
    		if (sh_set($_POST, 'contact_captcha') !== sh_set($_SESSION, 'captcha')) {
    			$t->validation->_error_array['captcha'] = __('Invalid captcha entered, please try again.', 'deeds');
    		}
    	}

    	$messages = '';

    	if ($t->validation->run() !== FALSE && empty($t->validation->_error_array)) {

    		$name = $t->validation->post('contact_name');
    		$email = $t->validation->post('contact_email');
    		$message = $t->validation->post('contact_message');
    		$contact_to = ( sh_set($settings, 'contact_email') ) ? sh_set($settings, 'contact_email') : get_option('admin_email');

    		$headers = 'From: ' . $name . ' <' . $email . '>' . "\r\n";
    		wp_mail($contact_to, __('Contact Us Message', 'deeds'), $message, $headers);

    		$message = sh_set($settings, 'success_message') ? $settings['success_message'] : sprintf(__('Thank you <strong>%s</strong> for using our contact form! Your email was successfully sent and we will be in touch with you soon.', 'deeds'), $name);

    		$messages = '<div class="alert alert-success">
    		<p class="title">' . __('SUCCESS! ', 'deeds') . $message . '</p>
    		</div>';
    	} else {
    		if (is_array($t->validation->_error_array)) {
    			foreach ($t->validation->_error_array as $msg) {
    				$messages .= '<div class="alert alert-error">
    				<p class="title">' . __('Error! ', 'deeds') . $msg . '</p>
    				</div>';
    			}
    		}
    	}

    	return $messages;
    }

    function deeds_mail(  $contact_to, $string, $message, $headers ){

    	return wp_mail( $contact_to, $string, $message, $headers );
    }
    if(!function_exists( 'sh_get_sidebars' )) {
    	function sh_get_sidebars($multi = false) {
    		global $wp_registered_sidebars;

    		$sidebars = !($wp_registered_sidebars) ? get_option('wp_registered_sidebars') : $wp_registered_sidebars;

    		if ($multi)
    			$data[] = array('value' => '', 'label' => __('No Sidebar', 'deeds'));
    		else
    			$data = array('' => __('No Sidebar', 'deeds'));

    		foreach ((array) $sidebars as $sidebar) {
    			if ($multi)
    				$data[] = array('value' => sh_set($sidebar, 'id'), 'label' => sh_set($sidebar, 'name'));
    			else
    				$data[sh_set($sidebar, 'id')] = sh_set($sidebar, 'name');
    		}
    		return $data;
    	}

    }
    if( !function_exists( 'sh_set' ) ) {
    	function sh_set($var, $key, $def = '') {

    		if (!$var)

    			return false;

    		if (is_object($var) && isset($var->$key))

    			return $var->$key;

    		elseif (is_array($var) && isset($var[$key]))

    			return $var[$key];

    		elseif ($def)

    			return $def;

    		else

    			return false;

    	}
    }
    if( !function_exists( '_WSH' ) ) {
    	function _WSH() {
    		return $GLOBALS['_sh_base'];
    	}
    }