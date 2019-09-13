<?php 
get_header();
 ?>

<div class="container">
	<?php
	if ( function_exists('yoast_breadcrumb') ) {
	  yoast_breadcrumb( '<div class="breadcrumbs">','</div>' );
	}
	?>
	<div>
		<h1><?php single_cat_title() ?></h1>
		
		<?=category_description()?>
		<div class="filter">
			<?php 
			$tags = get_tags();
			foreach ( $tags as $tag ) :
			 ?>

			<a <?php if( $tag->term_id !== get_query_var('tag_id') ) echo 'href="'.get_tag_link($tag->term_id).'"'; ?> class="filter__item<?php if( $tag->term_id === get_query_var('tag_id') ) echo ' filter__item--active' ?>">
				<div class="filter__icon">
					<?=carbon_get_term_meta( $tag->term_id, 'crb_tag_icon' )?>
				</div>
				<div class="filter__name h4"><?=$tag->name?></div>
			</a>
			<?php 
			endforeach;
			 ?>
		</div>
		<div class="share share--akcii">
			<?php 
			if ( have_posts() ) :
				while ( have_posts() ) : the_post();
			 ?>
			<div class="share__item">
				<div class="share__img_wrap">
					<?php echo get_the_post_thumbnail( get_the_ID(), 'medium', array('class' => 'share__img') ); ?>
				</div>
				<a href="<?=get_permalink()?>" class="share__name h4"><?php the_title(); ?></a>
				<span class="share__date"><?=get_the_date()?></span>
				<div class="share__txt"><?=get_the_excerpt() ?></div>
				<a href="<?=get_permalink()?>" class="share__link btn_submit">Смотреть больше</a>
			</div>
			<?php 
				endwhile;
			endif;
			 ?>
			
		</div>
		<div class="pag">
			<?php wp_pagenavi(); ?>
			<!-- <a href="akcies.html" class="pag__item pag__item--current">1</a>
			<a href="akcies.html" class="pag__item">2</a>
			<a href="akcies.html" class="pag__item">3</a> -->
		</div>
	</div>
</div>


 <?php 
get_footer();
  ?>