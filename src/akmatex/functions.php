<?php 
use Carbon_Fields\Container;
use Carbon_Fields\Field;

/*Создание страницы Настройки темы и добавление полей на нее*/
add_action( 'carbon_fields_register_fields', 'crb_attach_fields' );
function crb_attach_fields() {
	require_once get_stylesheet_directory() . '/cf/theme_options.php';
	require_once get_stylesheet_directory() . '/cf/post_front.php';
	require_once get_stylesheet_directory() . '/cf/tag_meta.php';
}

/*Включение поддержки изображений для страниц и записей*/
add_theme_support( 'post-thumbnails' );

/*Регистрация навигационных меню*/
register_nav_menus(array(
	'akcies'    => 'Акции',
));

/*Подключение скриптов и стилей*/
add_action( 'wp_enqueue_scripts', 'front_scripts_method' );
function front_scripts_method(){
	if ( !current_user_can( 'manage_options' ) ) {
		wp_deregister_script( 'jquery' );
	}
	wp_enqueue_script( 'script', get_template_directory_uri() . '/js/scripts.min.js', array(), null, 'in_footer');
	wp_enqueue_style( 'style', get_template_directory_uri().'/css/styles.min.css' );
}
add_action( 'wp_enqueue_scripts', 'add_map_code', 99 );
function add_map_code() {
	$src = preg_replace( array( '/.+src="/', '/">.+/' ), '', carbon_get_post_meta( get_option('page_on_front'), 'crb_map_code' ));
	wp_localize_script( 'script', 'map', array( 
		'map_script' => $src, 
		'ajaxurl' => admin_url('admin-ajax.php'),
	) );
}

/*Удаление шортлинков*/
remove_action('wp_head', 'wp_shortlink_wp_head');
remove_action('template_redirect', 'wp_shortlink_header', 11);

/*Разрешить загрузку SVG файлов*/
function my_myme_types($mime_types){
    $mime_types['svg'] = 'image/svg+xml'; // поддержка SVG
    $mime_types['svgz'] = 'image/svg+xml'; // поддержка SVG
    return $mime_types;
}
add_filter('upload_mimes', 'my_myme_types', 1, 1);

//Редактируем стандартную галерею
add_filter('use_default_gallery_style', '__return_false');

add_filter('post_gallery', 'my_gallery_output', 10, 2);
function my_gallery_output( $output, $attr ){
	$ids_arr = explode(',', $attr['ids']);
	$ids_arr = array_map('trim', $ids_arr );

	$pictures = get_posts( array(
		'posts_per_page' => -1,
		'post__in'       => $ids_arr,
		'post_type'      => 'attachment',
		'orderby'        => 'post__in',
	) );

	if( ! $pictures ) return 'Изображения не найдены.';

	// Вывод
	$out = '<div class="content__gallery">';

	// Выводим каждую картинку из галереи
	foreach( $pictures as $pic ){
		$src = $pic->guid;
		$t = esc_attr( $pic->post_title );
		$title = ( $t && false === strpos($src, $t)  ) ? $t : '';

		$caption = ( $pic->post_excerpt != '' ? $pic->post_excerpt : $title );

		$out .= '
			<a data-fslightbox="content_gallery" class="content__gallery_item" href="'. esc_url($src) .'"><img src="'. wp_get_attachment_image_url($pic->ID, 'medium') .'" alt="'. $title .'" class="content__gallery_img" /></a>';
	}

	$out .= '</div>';

	return $out;
}

//установить качество сжатия jpg файлов
add_filter( 'jpeg_quality', create_function( '', 'return 80;' ) );

//Ограничение отрывка 
add_filter( 'excerpt_length', function(){
	return 18;
} );
add_filter('excerpt_more', function($more) {
	return '...';
});


//Пагинация

add_filter('wp_pagenavi_class_current', 'theme_pagination_class');
add_filter('wp_pagenavi_class_pages', 'theme_pagination_class');
add_filter('wp_pagenavi_class_page', 'theme_pagination_class');

function theme_pagination_class($class_name) {
  switch($class_name) {
    case 'pages':
      $class_name = 'pag';
      break;
    case 'current':
      $class_name = 'pag__item pag__item--current';
      break;
    case 'page':
      $class_name = 'pag__item';
      break;
  }
  return $class_name;
}

//Отправка писем
if( wp_doing_ajax()){
  add_action( 'wp_ajax_send_formData', 'send_formData_callback' );
  add_action( 'wp_ajax_nopriv_send_formData', 'send_formData_callback' );
}
function send_formData_callback() {
	if($_POST['Фамилия'] || $_POST['Сообщение']) return;
	$to = carbon_get_theme_option('fos_email');//
	$subject = "Message from site";
	print_r($_POST);
	$boundary = uniqid('np');

	$message = "\r\n\r\n--" . $boundary . "\r\n";
	$message .= "Content-type: text/plain;charset=utf-8\r\n\r\n";
	foreach ($_POST as $key => $value) {
	    if(!empty($value) && $key != 'action') {
	        $message .= $key . ": ".$value."\r\n";
	    }
	}
	$message .= "\r\n\r\n--" . $boundary . "\r\n"; 

	$message .= "Content-type: text/html;charset=utf-8\r\n\r\n
            <html> \r\n
                <head> \r\n
                    <title>$subject</title>\r\n
                    <meta charset='UTF-8' /> \r\n
                </head> \r\n
                <body>\r\n";
	foreach ($_POST as $key => $value) {
	    if(!empty($value) && $key != 'action') {
	        $message .= "<p><b>".$key."</b>: ".$value."</p>\r\n";
	    }
	}
	$message .= "
	                <p><b>IP</b>: ".$_SERVER['REMOTE_ADDR']."</p>\r\n
	                </body>\r\n
	            </html>";
	$message .= "\r\n\r\n--" . $boundary . "--";
	$headers =  "MIME-Version: 1.0\r\n" .
				"From: wordpress <webmaster@seodev.top>" . "\r\n" .
			    "X-Mailer: PHP/" . phpversion()."\r\n".
				"content-Type: multipart/alternative;boundary=" . $boundary . "\r\n";

	mail( $to, $subject, $message, $headers, "-f {$to}" );

	

}