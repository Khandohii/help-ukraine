<?
/**
 * Настройка админ панели для клиента
 */

// Удаление пунктов меню в админ-панелиadd_action( 'admin_menu', 'remove_admin_menus' );
add_action( 'admin_menu', 'remove_admin_menus' );
function remove_admin_menus(){
    global $menu;

    $unset_titles = [
        __( 'Dashboard' ),
        __( 'Posts' ),
        // __( 'Media' ),
        __( 'Links' ),
        __( 'Pages' ),
        // __( 'Appearance' ),
        __( 'Tools' ),
        // __( 'Users' ),
        __( 'Settings' ),
        __( 'Comments' ),
        __( 'Plugins' ),
    ];

    end( $menu );
    while( prev( $menu ) ){

        $value = explode( ' ', $menu[ key( $menu ) ][0] );
        $title = $value[0] ?: '';

        if( in_array( $title, $unset_titles, true ) ){
            unset( $menu[ key( $menu ) ] );
        }
    }

}

// Свой логотип на странице входа
add_action( 'login_head', 'my_custom_login_logo' );
function my_custom_login_logo(){

    echo '
    <style type="text/css">
    h1 a {  background-image:url('.get_bloginfo('template_directory').'/assets/images/logo_centre.png) !important;  }
    </style>
    ';
}

// Отключение сообщений о необходимости обновиться
if( ! current_user_can( 'edit_users' ) ){
    add_filter( 'auto_update_core', '__return_false' );   // обновление ядра

    add_filter( 'pre_site_transient_update_core', '__return_null' );
}


/**
 * Чистка кода на сайте
 */
function wpassist_remove_block_library_css(){
    wp_dequeue_style( 'wp-block-library' );
    wp_dequeue_style('global-styles');
}
add_action( 'wp_enqueue_scripts', 'wpassist_remove_block_library_css' );


//Выключаем лишнее от WordPress
remove_action('wp_head','wp_generator');
remove_action('wp_head','wlwmanifest_link');
remove_action('wp_head','wp_resource_hints', 2);
remove_action('wp_head','wlwmanifest_link');
remove_action('wp_head','rsd_link');
remove_action('wp_head','rel_canonical');
remove_action('wp_head','wp_site_icon');
remove_action('wp_head','wp_oembed_add_discovery_links' );
remove_action('wp_head','wp_oembed_add_host_js' );
remove_action('wp_head','feed_links_extra', 3 );
remove_action('wp_head','feed_links', 2 );
remove_action('wp_head','print_emoji_detection_script', 7 );
remove_action('wp_head','rest_output_link_wp_head' );
remove_action('wp_head','noindex', 1 );
remove_action('wp_head','wp_shortlink_wp_head', 10, 0);
remove_action('wp_head','adjacent_posts_rel_link_wp_head', 10, 0 );

//off REST API
add_filter( 'rest_enabled', '__return_false' );
remove_action( 'xmlrpc_rsd_apis', 'rest_output_rsd' );
remove_action( 'template_redirect', 'rest_output_link_header', 11);
remove_action( 'auth_cookie_malformed', 'rest_cookie_collect_status' );
remove_action( 'auth_cookie_expired', 'rest_cookie_collect_status' );
remove_action( 'auth_cookie_bad_username', 'rest_cookie_collect_status' );
remove_action( 'auth_cookie_bad_hash', 'rest_cookie_collect_status' );
remove_action( 'auth_cookie_valid', 'rest_cookie_collect_status' );
remove_filter( 'rest_authentication_errors', 'rest_cookie_check_errors', 100 );
remove_action( 'init', 'rest_api_init' );
remove_action( 'rest_api_init', 'rest_api_default_filters', 10 );
remove_action( 'parse_request', 'rest_api_loaded' );
remove_action( 'rest_api_init', 'wp_oembed_register_route' );
remove_filter( 'rest_pre_serve_request', '_oembed_rest_pre_serve_request', 10 );

//Отключение rss ленты
function fb_disable_feed() {wp_redirect(get_option('siteurl'));}
add_action('do_feed', 'fb_disable_feed', 1);
add_action('do_feed_rdf', 'fb_disable_feed', 1);
add_action('do_feed_rss', 'fb_disable_feed', 1);
add_action('do_feed_rss2', 'fb_disable_feed', 1);
add_action('do_feed_atom', 'fb_disable_feed', 1);

//Отключаем Emojii
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );
remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );

//Отменяем srcset
add_filter('wp_calculate_image_srcset_meta', '__return_null' );
add_filter('wp_calculate_image_sizes', '__return_false', 99 );
remove_filter('the_content', 'wp_make_content_images_responsive' );

//Отключаем Gutenberg
add_filter( 'use_block_editor_for_post_type', '__return_false', 100 );
add_action( 'admin_init', function(){
    remove_action( 'admin_notices', [ 'WP_Privacy_Policy_Content', 'notice' ] );
    add_action( 'edit_form_after_title', [ 'WP_Privacy_Policy_Content', 'notice' ] );
});

//Отключение XML-RPC
add_filter('xmlrpc_enabled', '__return_false');

//Стили гутенберга
function gut_style_disable() {wp_dequeue_style( 'wp-block-library' );}
add_action( 'wp_enqueue_scripts', 'gut_style_disable', 100 );

//Отключить migrate
function isa_remove_jquery_migrate( &$scripts ) {
    if( !is_admin() ) {
        $scripts->remove( 'jquery' );
        $scripts->add( 'jquery', false, array( 'jquery-core' ), '1.12.4' );
    }
}
add_filter( 'wp_default_scripts', 'isa_remove_jquery_migrate' );

// remove css js version
add_filter( 'style_loader_src', 'remove_cssjs_ver', 10, 2 );
add_filter( 'script_loader_src', 'remove_cssjs_ver', 10, 2 );
function remove_cssjs_ver( $src ) {
    if( strpos($src,'?ver='))
        $src = remove_query_arg( 'ver', $src );
    return $src;
}

//Поддержка темы
add_theme_support( 'title-tag' );
add_theme_support( 'post-thumbnails' );
add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );

///////////////////////////////
// Добавляет SVG в список разрешенных для загрузки файлов.
add_filter( 'upload_mimes', 'svg_upload_allow' );
function svg_upload_allow( $mimes ) {
    $mimes['svg']  = 'image/svg+xml';
    return $mimes;
}
add_filter( 'wp_check_filetype_and_ext', 'fix_svg_mime_type', 10, 5 );
function fix_svg_mime_type( $data, $file, $filename, $mimes, $real_mime = '' ){
    if( version_compare( $GLOBALS['wp_version'], '5.1.0', '>=' ) )
        $dosvg = in_array( $real_mime, [ 'image/svg', 'image/svg+xml' ] );
    else
        $dosvg = ( '.svg' === strtolower( substr($filename, -4) ) );
    if( $dosvg ){
        if(current_user_can('manage_options')){
            $data['ext']  = 'svg';
            $data['type'] = 'image/svg+xml';
        } else
            $data['ext'] = $type_and_ext['type'] = false;
    }
    return $data;
}