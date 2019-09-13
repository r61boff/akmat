<?php  

use Carbon_Fields\Container;
use Carbon_Fields\Field;

Container::make( 'term_meta', 'Tag option' )
    ->where( 'term_taxonomy', '=', 'post_tag' )
    ->add_fields( array(
        Field::make( 'textarea', 'crb_tag_icon', 'Код SVG иконки' ),
    ) );
?>