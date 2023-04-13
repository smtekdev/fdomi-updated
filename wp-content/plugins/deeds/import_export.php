<?php

if (!defined('ABSPATH'))
    exit('restricted access');

class SH_import_export {

    private $path = '';
    private $file_system = '';
    private $bakup_folder = array();
    private $backup_path = '';
    private $demo = '';

    function __construct() {
     
        $this->path = ABSPATH . 'wp-content/webinane/demo/';


        global $wp_filesystem;
        if (empty($wp_filesystem)) {
            require_once(ABSPATH . '/wp-admin/includes/file.php');
            WP_Filesystem();
        }
        $this->file_system = $wp_filesystem;
    }

    function export() {
        $this->sidebar_export();
        $this->theme_options_export();
        $this->revslider_export();
        if (function_exists('layerslider'))
            $this->layerslider_export();
        if (function_exists('vc_map'))
            $this->vc_template_export();
    }

    function import() {

        $this->sidebar_import();

        $this->theme_options_import();

        $this->revslider_import();

        if (function_exists('layerslider'))
            $this->layerslider_import();
        if (function_exists('vc_map'))
            $this->vc_template_import();
    }

    function revslider_export($file = '') {
        global $wpdb;
        $file = ($file) ? $file : 'default_settings';

        $data = array();

        $sliders = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "revslider_sliders", ARRAY_A);
        $slides = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "revslider_slides", ARRAY_A);
        foreach ($sliders as $k => $s) {
            $slider_id = sh_set($s, 'id');
            if (isset($s['id']))
                unset($s['id']);
            $data['slider'][$k] = $s;
            foreach ($slides as $ss) { 
                if (isset($ss['id']))
                    unset($ss['id']);

                if ($slider_id == sh_set($ss, 'slider_id'))
                    $data['slider'][$k]['slides'][] = $ss;
            }
        }
        
        //printr($data);
        
        $dir = $this->newdir($this->path . DIRECTORY_SEPARATOR . 'revslider_options');
        $fp = $this->file_open($dir . $file);
        $this->write_file($fp, $this->encrypt($data));
        $this->file_close($fp);
    }

    function revslider_import($file = '') {
        global $wpdb;

        $file = ($file) ? $file : 'default_settings';

        $settings = $this->read_file($this->path . 'revslider_options' . DIRECTORY_SEPARATOR . $file);
        foreach ((array) $settings['slider'] as $v) {
            $slider_id = '';

            $res = $wpdb->get_results("SELECT * FROM `" . $wpdb->prefix . "revslider_sliders` WHERE `title` LIKE '%" . $v['title'] . "%'");
            if ($res)
                continue;

            $slides = sh_set($v, 'slides');
            if ($slides)
                unset($v['slides']);

            $wpdb->insert($wpdb->prefix . "revslider_sliders", $v);
            $slider_id = $wpdb->insert_id;

            if ($slider_id) {
                foreach ($slides as $key => $val) {
                    if ($val) {
                        $val['slider_id'] = $slider_id;
                        $wpdb->insert($wpdb->prefix . "revslider_slides", $val);
                    }
                }
            }
        }
    }
    function layerslider_export($file = '') {
        global $wpdb;
        $file = ($file) ? $file : 'default_settings';

        $data = array();

        $sliders = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "layerslider", ARRAY_A);

        $data = array();
        $data['slider'] = $sliders;

        $dir = $this->newdir($this->path . DIRECTORY_SEPARATOR . 'layerslider_options');
        $fp = $this->file_open($dir . $file);
        $this->write_file($fp, $this->encrypt($data));
        $this->file_close($fp);
    }
    function layerslider_import($file = '') {
        global $wpdb;

        $file = ($file) ? $file : 'default_settings';

         $settings = $this->read_file($this->path . 'layerslider_options' . DIRECTORY_SEPARATOR . $file);
        foreach ((array) $settings['slider'] as $v) {
            $res = $wpdb->get_results("SELECT * FROM `" . $wpdb->prefix . "layerslider` WHERE `name` LIKE '%" . $v['name'] . "%'");
            if ($res)
                continue;

            $data = $v;
            $wpdb->insert($wpdb->prefix . "layerslider", array(
                'id' => $data['id'],
                'author' => $data['author'],
                'name' => $data['name'],
                'slug' => $data['slug'],
                'data' => $data['data'],
                'date_c' => $data['date_c'],
                'date_m' => $data['date_m']
                    ), array(
                '%d', '%d', '%s', '%s', '%s', '%d', '%d'
            ));
            $wpdb->insert_id;     
        }
    }
    function file_open($path, $mode = 'wb+') {
        if (!$fp = @fopen($path, $mode))
            return FALSE;
        flock($fp, LOCK_EX);

        return $fp;
    }
    function write_file($fp, $data) {
        fwrite($fp, $this->encrypt($data));
    }
    function file_close($fp) {
        flock($fp, LOCK_UN);
        fclose($fp);
    }
    function create_bakup($folders) {
        if (!empty($folders)) {
            $counter = 0;
            foreach ($folders as $folder) {
                if ($counter == 0) {
                    $check = $this->backup_path . $folder.'/'.$this->demo;
                } else {
                    $check = $this->backup_path . $folder . '/' . $folder;
                }
                if (!$this->file_system->is_dir($check)) {
                    $this->file_system->mkdir($check);
                }
                $counter++;
            }
        }
    }

    function vc_template_export($file = '') {
        global $wpdb;
        $file = ($file) ? $file : 'default_settings';
        $data = array();
        $settings = get_option('wpb_js_templates');
        $dir = $this->path . 'vc_options';
        $this->newdir($dir);
        $w_file = $dir . '/' . $file;
        $this->file_system->put_contents($w_file, $this->encrypt($settings), 0777);
    }

    function vc_template_import($file = '') {
      
       
        global $wpdb;
        $file = ($file) ? $file : 'default_settings';
        $settings = $this->read_file($this->path . 'vc_options'. DIRECTORY_SEPARATOR . $file);

        update_option('wpb_js_templates', $settings);

    }

    function theme_options_import($file = '') {
        global $wpdb;
        $file = ($file) ? $file : 'default_settings';

        $data = $this->read_file($this->path . 'theme_options' . DIRECTORY_SEPARATOR . $file);
        $v = $this->replace_pseudo($data);

        update_option('wp_deeds_theme_options', $v);
        if(sh_set($_POST, 'demo_name') == 'demo_2'){
            $front_page = get_page_by_title('HOME PAGE 2');
        }
        elseif(sh_set($_POST, 'demo_name') == 'demo_3'){
            $front_page = get_page_by_title('HOME PAGE 3');
        }
        elseif(sh_set($_POST, 'demo_name') == 'demo_4'){
            $front_page = get_page_by_title('HOME PAGE 4');
        }
        elseif(sh_set($_POST, 'demo_name') == 'demo_5'){
            $front_page = get_page_by_title('HOME');
        }
        elseif(sh_set($_POST, 'demo_name') == 'demo_6'){
            $front_page = get_page_by_title('HOME PAGE 6');
        }
        elseif(sh_set($_POST, 'demo_name') == 'demo_7'){
            $front_page = get_page_by_title('HOME PAGE 7');
        }
        elseif(sh_set($_POST, 'demo_name') == 'demo_8'){
            $front_page = get_page_by_title('Nonprofit Home (New)');
        }
        elseif(sh_set($_POST, 'demo_name') == 'demo_9'){
            $front_page = get_page_by_title('Home');
        }
        elseif(sh_set($_POST, 'demo_name') == 'demo_10'){
            $front_page = get_page_by_title('Home 2');
        }
        else{
                $front_page = get_page_by_title('HOME');
        }
        
        $blog_page = get_page_by_title('BLOG');
        if ($front_page) {
            if (get_option('show_on_front') != 'page' && !get_option('page_on_front')) {
                update_option('show_on_front', 'page');
                update_option('page_on_front', $front_page->ID);
                update_option('page_for_posts', $blog_page->ID);
            }
        }
        update_option('posts_per_page', 6);
       $res = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "terms WHERE " . $wpdb->prefix . "terms.slug = 'menu-1'");
    
        if ($res) {

            $nav_menu = array('');
            $nav_menu['nav_menu_locations']['main_menu'] = $res[0]->term_id;
            $info = pathinfo(get_template_directory());
            update_option('theme_mods_' . sh_set($info, 'basename'), $nav_menu);
        }
    }

    function theme_options_export($file = '') {
        $file = ($file) ? $file : 'default_settings';
        $options = get_option('wp_deeds_theme_options');
        $options = (!empty($options)) ? $options : array();
        
        $data = $this->pseudo($options);
        
        $dir = $this->path . 'theme_options';
        $this->newdir($dir);
        $w_file = $dir . '/' . $file;

        $this->file_system->put_contents($w_file, $this->encrypt($data), 0777);
    }

    function sidebar_import($file = '') {
        
        $file = ($file) ? $file : 'default_settings';
        $data = $this->read_file($this->path . 'widgets' . DIRECTORY_SEPARATOR . $file);

        if (!isset($data['settings']) || !isset($data['sidebars']))
            return;

        foreach ($data['settings'] as $k => $v) {
            update_option('widget_' . $k, $this->replace_pseudo($v));
        }
        update_option('sidebars_widgets', $data['sidebars']);
    }

    function sidebar_export($file = '') {
        $file = ($file) ? $file : 'default_settings';
        $settings = array();
        $sidebars = wp_get_sidebars_widgets();
        if (isset($sidebars['wp_inactive_widgets']))
            unset($sidebars['wp_inactive_widgets']);

        foreach ($sidebars as $name => $widgets) {
            if (!count($widgets) || $name == 'orphaned_widgets')
                continue;

            foreach ($widgets as $widget) {
                if (preg_match('#(.*?)-(\d+)$#', $widget, $matches)) {
                    $type = $matches[1];
                    $id = $matches[2];
                    if ($widget_settings = get_option('widget_' . $type)) {
                        $settings[$type][$id] = $this->pseudo($widget_settings[$id]);
                    }
                }
            }
        }
        $dir = $this->path . 'widgets';
        $this->newdir($dir);
        $w_file = $dir . '/' . $file;
        $this->file_system->put_contents($w_file, $this->encrypt(array('settings' => $settings, 'sidebars' => $sidebars)), 0777);
    }

    function encrypt($data) {
        if (is_array($data))
            return sh_encrypt(serialize($data));
        else
            return $data;
    }

    function decrypt($data) {
        $data = base64_decode($data);
        if (is_serialized($data))
            return unserialize($data);
        else
            return $data;
    }

    function newdir($path) {
        if (!$this->file_system->is_dir($path)) {
            $this->file_system->mkdir($path);
        }
    }

    function read_file($file) {

        if (!file_exists($file))
            return FALSE;

        $data = '';

        $data .= $this->file_system->get_contents($file);

        return $this->decrypt($data);
    }

    function pseudo($options = array()) {
        foreach ($options as $k => $v) {
            if (is_array($v))
                $options[$k] = $this->pseudo($v);
            elseif (preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $v)) {
                $options[$k] = '{ADMIN_EMAIL}';
            } else {
                $options[$k] = str_replace(array(get_template_directory_uri(), home_url('/'), get_option('admin_email')), array('{THEME_URL}', '{HOME_URL}', '{ADMIN_EMAIL}'), $v);
            }
        }
        return $options;
    }

    function replace_pseudo($options = array()) {
        foreach ((array) $options as $k => $v) {
            if (is_array($v))
                $options[$k] = $this->replace_pseudo($v);
            else {
                $options[$k] = str_replace(array('{THEME_URL}', '{HOME_URL}', '{ADMIN_EMAIL}'), array(get_template_directory_uri(), home_url('/'), get_option('admin_email')), $v);
            }
        }
        return $options;
    }

}
