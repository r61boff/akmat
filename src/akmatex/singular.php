<?php 
get_header();
 ?>

<div class="container">
	<?php
	if ( function_exists('yoast_breadcrumb') ) {
	  yoast_breadcrumb( '<div class="breadcrumbs">','</div>' );
	}
	?>

	<article class="content">
		<h1><?php the_title(); ?></h1>
		<?php 
		if ( get_the_post_thumbnail() ) :
		 ?>
		<div class="content__img_wrap">
			<?php 
			the_post_thumbnail( 'medium_large', array(
				'class' => 'content__img'
			) )
			 ?>
			<img src="img/content_img.jpg" alt="" class="content__img">
		</div>
		<?php 
		endif;
		 ?>
		<?php 
		the_content();
		 ?>
	</article>
</div>

 <?php 
get_footer();
  ?>