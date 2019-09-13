<?php 
use Carbon_Fields\Container;
use Carbon_Fields\Field;

Container::make( 'post_meta', 'Home page options' )
    ->where( 'post_type', '=', 'page' )
    ->where( 'post_id', '=', get_option('page_on_front') )
    ->add_tab( 'Первый экран', array(
        Field::make( 'image', 'crb_first_bg', 'Фон первого экрана' )
            ->set_value_type( 'url' ),
        Field::make( 'text', 'crb_first_btxt', 'Самый большой текст' ),
        Field::make( 'textarea', 'crb_first_txt', 'Описание под большим текстом' ),
        Field::make( 'text', 'crb_first_wtxt', 'Текст перед временем работы' ),
        Field::make( 'text', 'crb_first_whours', 'Время работы' ),
        Field::make( 'text', 'crb_first_wdays', 'Дни работы' ),
        Field::make( 'text', 'crb_first_toadr', 'Текст ссылки на карту' ),
    ) )
    ->add_tab( 'Преимущества', array(
        Field::make( 'text', 'crb_features_name', 'Заголовок' ),
        Field::make( 'complex', 'crb_features', 'Список преимуществ' )
            ->set_layout( 'tabbed-horizontal' )
            ->add_fields( 'feature', array(
                Field::make( 'complex', 'crb_feature_icon', 'Иконка' )
                    ->set_max( 1 )
                    ->add_fields( 'feature_img', array(
                        Field::make( 'file', 'feature_img', 'Иконка картинкой' )
                            ->set_value_type( 'url' ),
                    ) )
                    ->add_fields( 'feature_svg', array(
                        Field::make( 'textarea', 'feature_svg', 'Иконка кодом SVG' ),
                    ) ),
                Field::make('text', 'feature_name', 'Название'),
                Field::make('textarea', 'feature_descr', 'Описание')
            ) ),
    ) )
    ->add_tab( 'Магазины', array(
        Field::make( 'text', 'crb_malls_heading', 'Заголовок' ),
        Field::make( 'file', 'crb_malls_scheme', 'Схема магазина в SVG' )
            ->set_value_type( 'url' ),
        Field::make( 'complex', 'crb_malls', 'Список магазинов' )
            ->set_layout( 'tabbed-horizontal' )
            ->add_fields( 'mall', array(
                Field::make('text', 'mall_name', 'Название'),
                Field::make('text', 'mall_id', 'id на плане'),
                Field::make('textarea', 'mall_icon', 'SVG код иконки'),
                Field::make('rich_text', 'mall_deacr', 'Описание магазина'),
                Field::make('rich_text', 'mall_contacts', 'Контакты'),
                Field::make( 'association', 'mall_page', 'Страница Подробнее' )
                    ->set_max( 1 )
                    ->set_types( array (
                        array (
                        'type' => 'post',
                        'post_type' => 'page' )
                    ) ),
                Field::make( 'media_gallery', 'mall_gallery', 'Фотографии' )
            ) ),
    ) )
    ->add_tab( 'Акции', array(
        Field::make( 'text', 'crb_shares_heading', 'Заголовок' )
    ) )
    ->add_tab( 'ФОС', array(
        Field::make( 'image', 'crb_fos_bg', 'Фон формы обратной связи' )
            ->set_value_type( 'url' ),
        Field::make( 'text', 'crb_fos_heading', 'Заголовок' ),
        Field::make( 'textarea', 'crb_fos_txt', 'Описание под заголовком' ),
        Field::make( 'association', 'crb_page_soglasie', 'Страница Согласия на обработку ПД' )
            ->set_max( 1 )
            ->set_types( array (
                array (
                'type' => 'post',
                'post_type' => 'page' )
            ) )
    ) )
    ->add_tab( 'Фотогалерея', array(
        Field::make( 'text', 'crb_gallery_heading', 'Заголовок' ),
        Field::make( 'media_gallery', 'crb_gallery_home', 'Фотографии' )
    ) )
    ->add_tab( 'Карта', array(
        Field::make( 'textarea', 'crb_map_code', 'Код яндекс или гугл карты' ),
        Field::make( 'image', 'crb_map_bg', 'Фон для предзагрузки' )
            ->set_value_type( 'url' ),
    ) );
 ?>