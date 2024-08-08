<?php if(!defined('ABSPATH')){ exit(); }
//
require_once 'autoload.php';

/**
 * Class PS
 * @since 1.0.0
 */
class PS{
    /**
     * theme name
     * @var string
     */
    static $theme_name;

    /**
     * theme uri
     * @var string
     */
    static $theme_uri;

    /**
     * framework path
     * @var string
     */
    static $framework_path;

    /**
     * assets url
     * @var string
     */
    static $assets_url;

    /**
     * functions path
     * @var string
     */
    static $functions_path;

    /**
     * libs path
     * @var string
     */
    static $libs_path;

    /**
     * main page
     * @var string
     */
    static $front_page;

    /**
     * shop page
     * @var string
     */
    static $shop_page;

    /**
     * advices
     * @var string
     */
    static $advices_page;

    /**
     * school
     * @var string
     */
    static $school_page;

    /**
     * contacts
     * @var string
     */
    static $contacts_page;

    /**
     * privacy page
     * @var string
     */
    static $privacy_page;

    /**
     * options page
     * @var string
     */
    static $option_page;

    /**
     * login page
     * @var string
     */
    static $login_page;

    /**
     * registration page
     * @var string
     */
    static $registration_page;

    /**
     * reset password page
     * @var string
     */
    static $reset_password_page;

    /**
     * profile info page
     * @var string
     */
    static $profile_info_page;

    /**
     * profile favourite page
     * @var string
     */
    static $profile_favourite_page;

    /**
     * profile history page
     * @var string
     */
    static $profile_history_page;

    /**
     * language
     * @var string
     */
    static $current_language;

    /**
     * PS constructor.
     */
    public function __construct(){
        $this::$theme_name = 'onrial';
        $this::$theme_uri = get_template_directory_uri();
        $this::$framework_path = dirname(__FILE__);
        $this::$functions_path = $this::$framework_path . '/functions/';
        $this::$libs_path = $this::$framework_path . '/libs/';
        $this::$assets_url = $this::$theme_uri . '/assets/';

        $this::$front_page = 8;
        $this::$shop_page = 539;
        $this::$advices_page = 439;
        $this::$school_page = 492;
        $this::$contacts_page = 9;
        $this::$privacy_page = 3869;
        $this::$option_page = 'option';

        $this::$login_page = 4001;
        $this::$registration_page = 4002;
        $this::$reset_password_page = 4001;
        $this::$profile_info_page = 4004;
        $this::$profile_favourite_page = 4089;
        $this::$profile_history_page = 4005;


        $this::$current_language = qtranxf_getLanguage();

        // session
        add_action( 'init', array( $this, 'activate_session' ) );

        // load functions
        $this->load_functions();
    }

    // session
    public function activate_session() {
        session_start();
        setcookie( session_name(), session_id(), time() + 60 * 60 * 24 * 365 * 2, '/' ); // 365 days

        // utm
        $utms = ['utm_medium', 'utm_source', 'utm_campaign', 'utm_term', 'utm_content'];
        foreach($utms as $utm){
            if(isset($_GET[$utm])){
                $_SESSION[$utm] = wp_strip_all_tags($_GET[$utm], true);
            }
        }
    }

    private function load_functions(){
        if(is_dir($this::$functions_path)){
            if($functions_path_handle = opendir($this::$functions_path)){
                $classes = array();
                while(false !== ($functions_folder = readdir($functions_path_handle))){
                    if(is_dir($this::$functions_path . $functions_folder) && !in_array($functions_folder, array('..', '.'))){
                        $functions_folder = strtoupper(substr($functions_folder, 0, 1)) . substr($functions_folder, 1);
                        $functions_folder_long = explode('-', $functions_folder);
                        if(count($functions_folder_long) > 0){
                            $new_folder_part_name = array();
                            foreach($functions_folder_long as $folder_part_item){
                                $new_folder_part_name[] = strtoupper(substr($folder_part_item, 0, 1)) . substr($folder_part_item, 1);
                            }
                            $functions_folder = implode('_', $new_folder_part_name);
                        }
                        $function_init_name = 'PS\Functions\\' . $functions_folder . '\Init';
                        try{
                            if(class_exists($function_init_name)){
                                if(method_exists($function_init_name, 'is_initialize')){
                                    if($function_init_name::is_initialize()){
                                        $classes[] = $function_init_name;
                                    }
                                }else{
                                    $classes[] = $function_init_name;
                                }
                            }
                        }catch(Exception $e){
                            //
                        }
                    }
                }
                foreach($classes as $class){
                    try{
                        new $class;
                    }catch (Exception $e){
                        //
                    }
                }
                closedir($functions_path_handle);
            }
        }
    }

    /**
     * theme vars
     *
     */
    public static function get_context(){
        $context = array();
        return apply_filters('PS_get_context', $context);
    }

}

new PS();
