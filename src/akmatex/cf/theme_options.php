<?php 
use Carbon_Fields\Container;
use Carbon_Fields\Field;

Container::make( 'theme_options', 'Theme options' )
	->set_page_menu_title( 'Настройки темы' )
	->add_tab( 'Хедер', array(
		Field::make( 'complex', 'crb_header_logo', 'Логотип компании' )
			->set_max( 1 )
		    ->add_fields( 'logo_img', array(
		        Field::make( 'file', 'logo_img', 'Логотип' )
		        	->set_value_type( 'url' ),
		    ) )
		    ->add_fields( 'logo_svg', array(
		        Field::make( 'textarea', 'logo_svg', 'Логотип' ),
		    ) ),
        Field::make( 'text', 'crb_logo_alt', 'alt к логотипу' ),
        Field::make( 'textarea', 'header_descriptor', 'Дескриптор' ),
        Field::make( 'textarea', 'header_adress', 'Адрес' ),
    ) )
	->add_tab( 'Футер', array(
        Field::make( 'textarea', 'footer_descriptor', 'Дескриптор' ),
        Field::make( 'text', 'footer_phone', 'Телефон' ),
        Field::make( 'text', 'footer_email', 'E-mail' ),
        Field::make( 'textarea', 'footer_adress', 'Адрес' ),
        Field::make( 'complex', 'footer_social', 'Ссылки на соцсети' )
		    ->add_fields( 'social', array(
		        Field::make( 'complex', 'crb_social_icon', 'Иконка соцсети' )
					->set_max( 1 )
				    ->add_fields( 'social_img', array(
				        Field::make( 'file', 'social_img', 'Иконка картинкой' )
				        	->set_value_type( 'url' ),
				    ) )
				    ->add_fields( 'social_svg', array(
				        Field::make( 'textarea', 'social_svg', 'Иконка кодом SVG' ),
				    ) ),
				Field::make('text', 'social_link', 'Ссылка на страницу соцсети')
		    ) )
		   
    ) )
	->add_tab( 'Скрипты аналитики и подтверждения в консолях вебмастеров', array(
		 Field::make( 'textarea', 'header_scripts', 'Скрипт в head' ),
		 Field::make( 'textarea', 'header_approve', 'Подверждение в консолях в head' ),
		 Field::make( 'textarea', 'footer_scripts', 'Скрипт перед закрытием body' ),
    ) )
	->add_tab( 'Прочее', array(
		 Field::make( 'association', 'news_cat', 'Категория акций' )
                    ->set_max( 1 )
                    ->set_types( array (
                        array (
                        'type' => 'term',
                        'taxonomy' => 'category' )
                    ) ),
        Field::make( 'text', 'fos_email', 'e-mail для доставки сообщений с сайта' ),
    ) );





 ?>