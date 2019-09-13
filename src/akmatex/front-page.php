<?php 
get_header();
$id = get_option('page_on_front');
 ?>



		<div class="fst_scr" style="background-image: url('<?php echo carbon_get_post_meta( $id,'crb_first_bg' ); ?>');">
			<div class="container">
				<div class="slide">
					<div class="slide__btxt">
						<?php echo carbon_get_post_meta( $id,'crb_first_btxt' ); ?>
					</div>
					<div class="slide__info">
						<div class="slide__txt">
							<?php echo carbon_get_post_meta( $id,'crb_first_txt' ); ?>
						</div>
						<div class="slide__working">
							<div class="slide__working_txt">
								<?php echo carbon_get_post_meta( $id,'crb_first_wtxt' ); ?>
							</div>
							<div class="slide__working_hours">
								<?php echo carbon_get_post_meta( $id,'crb_first_whours' ); ?>
							</div>
							<div class="slide__working_days">
								<?php echo carbon_get_post_meta( $id,'crb_first_wdays' ); ?>
							</div>
						</div>

					</div>
					<div class="slide__toadr">
						<div class="map_tag">
						<svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 484 682">
							<defs><clipPath id="a"><path d="M0 512h363.618V0H0z"/></clipPath></defs>
							<g clip-path="url(#a)" transform="matrix(1.33333 0 0 -1.33333 0 682.667)"><path d="M183.503 379.259c-26.182 0-47.407-21.225-47.407-47.407 0-26.182 21.225-47.407 47.407-47.407 26.182 0 47.406 21.225 47.406 47.407-.03 26.169-21.237 47.377-47.406 47.407m0-113.778c-36.655 0-66.37 29.715-66.37 66.37s29.715 66.37 66.37 66.37c36.654 0 66.37-29.715 66.37-66.37-.045-36.636-29.733-66.325-66.37-66.37" fill="#fdd32f"/><path d="M181.827 493.037A161.795 161.795 0 0 1 66.67 445.333C9.309 387.981 2.244 280.01 51.54 214.277L181.827 26.138 311.9 213.99c49.509 66.02 42.444 173.991-14.917 231.343a161.795 161.795 0 0 1-115.157 47.704m0-493.037a9.484 9.484 0 0 0-7.796 4.083L36.16 203.194c-54.352 72.444-46.454 192 17.102 255.546a181.805 181.805 0 0 0 257.129.001c63.556-63.546 71.454-183.102 16.889-255.833L189.623 4.083A9.485 9.485 0 0 0 181.827 0" fill="#fdd32f"/></g>
						</svg>
						</div>
						<a class="slide__link" href="#map">
							<?php echo carbon_get_post_meta( $id,'crb_first_toadr' ); ?>
						</a>
					</div>
				</div>
			</div>
		</div>
		<div class="features__bg">
			<div class="container">
				<div class="features">
					<div class="h2">
						<?php echo carbon_get_post_meta( $id,'crb_features_name' ); ?>
					</div>
					<div class="features__wrap">
					<?php 
						$features = carbon_get_post_meta( $id, 'crb_features');
						foreach ($features as $f) : ?>
						<div class="feature">
							<div class="feature__icon">
								<?php	
										if ($f['crb_feature_icon'][0]['_type'] == 'feature_img'): ?>
								<img class="feature__img" src="<?php echo $f['crb_feature_icon'][0]['feature_img']; ?>" alt="<?=$f['feature_name'] ?>">
								<?php  	else : 
											echo $f['crb_feature_icon'][0]['feature_svg'];
										endif; ?>

							</div>
							<div class="feature__name h4">
								<?=$f['feature_name'] ?>
							</div>
							<div class="feature__descr">
								<?=$f['feature_descr'] ?>
							</div>
						</div>
					<?php	
						endforeach;
					 ?>						
					</div>
				</div>
			</div>
		</div>
		<div class="gray">
			<div class="container">
				<div class="mall__wrap">
					<div class="h2"><?=carbon_get_post_meta( $id, 'crb_malls_heading' )?></div>
					<div class="mall">
						<div class="mall__ul">
							<?php 
								$malls = carbon_get_post_meta( $id, 'crb_malls' );
								foreach ($malls as $m):
							 ?>	
								<div id="<?=$m['mall_id']?>" class="mall__ul_li<?php if ($m === $malls[0]) {echo ' mall__ul_li--active';} ?>">
									<div class="mall__ul_icon">
										<?=$m['mall_icon']?>
									</div>
									<div class="mall__ul_name"><?=$m['mall_name']?></div>
								</div>
							<?php 
								endforeach;
							 ?>
						</div>
						<div class="mall__info">
							<div class="mall__map">
								<object id="mall_map" type="image/svg+xml" data="<?=carbon_get_post_meta( $id, 'crb_malls_scheme' )?>"> </object>
							</div>
							<div class="mall__tabs">
								<?php
									$i = 0; 
									foreach ($malls as $m) :
								 ?>
								<div id="<?=$m['mall_id']?>" class="mall__tab<?php if ($m === $malls[0]) {echo ' mall__tab--active';} ?>">
									<div class="mall__tab_name h4"><?=$m['mall_name']?></div>
									<div class="mall__tab_txt">
										<?php echo apply_filters( 'the_content', $m['mall_deacr'] ); ?>
									</div>
									<div class="mall__tab_contacts">
										<?php echo apply_filters( 'the_content', $m['mall_contacts'] ); ?>
									</div>
								<?php 	if ($m['mall_page']): ?>	
									<a href="<?=get_permalink($m['mall_page'][0]['id'])?>" class="mall__tab_link btn_submit">Подробнее</a>
								<?php 	endif; ?>
								<?php 	if ($m['mall_gallery'][0]) : ?>
									<div class="slider">	
										<div class="mall__tab_gallery slider__wrapper">
											<?php foreach ($m['mall_gallery'] as $img_id) :
											 		if ( $img_id === $m['mall_gallery'][0] ) {
											 			$src = wp_get_attachment_image_url( $img_id, 'medium' );
											 		} else {
											 			$src = wp_get_attachment_image_url( $img_id, 'medium' );
											 		}
											 ?>

											<a data-fslightbox="gallery-<?=$i?>" href="<?=wp_get_attachment_image_url( $img_id, 'full' )?>" class="slider__item mall__tab_img_wrap"><img src="<?=$src?>" alt="" class="mall__tab_img"></a>
											
											<?php 
												endforeach;
												$i++;
											 ?>
										</div>
										<a class="slider__control slider__control_left" href="#" role="button"></a>
										<a class="slider__control slider__control_right slider__control_show" href="#" role="button"></a>
									</div>
								<?php endif; ?>
								</div>
								<?php 
									endforeach;
								 ?>
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="shares">
			<div class="container">
				<div class="h2"><?=carbon_get_post_meta( $id, 'crb_shares_heading' )?></div>
				<div class="share">
					<?php 
						$news_id = carbon_get_theme_option('news_cat')[0]['id'];
						$query = new WP_Query( array( 
														'cat' => $news_id,
														'posts_per_page'			=> 4
														) ); 
						if ($query->have_posts()) : 
							while ($query->have_posts()) : $query->the_post();?>
					<div class="share__item">
						<div class="share__img_wrap">
							<?php echo get_the_post_thumbnail( $query->post->ID, 'medium', array('class' => 'share__img') ); ?>
							<!-- <img class="share__img" src="https://cdn.pixabay.com/photo/2018/07/18/11/59/handyman-3546193__340.jpg" alt=""> -->
						</div>
						<a href="<?=get_permalink()?>" class="share__name h4"><?php the_title(); ?></a>
						<span class="share__date"><?=get_the_date()?></span>
					</div>
					<?php 
							endwhile;
							wp_reset_postdata();
						endif;
					 ?>
					<a href="<?=get_category_link($news_id)?>" class="shares__link btn_submit">Подробнее</a>
				</div>
			</div>
		</div>
		<div class="fos__bg" style="background: url('<?=carbon_get_post_meta( $id, 'crb_fos_bg' )?>') no-repeat center;background-size: cover">
			<div class="container">
				<div class="fos">
					<div class="fos__window">
						<div class="h3"><?=carbon_get_post_meta( $id, 'crb_fos_heading' )?></div>
						<div class="fos__txt"><?=carbon_get_post_meta( $id, 'crb_fos_txt' )?></div>
						<form action="" class="fos__form">
							<input type="text" name="Имя" class="fos__input fos__input--name" placeholder="Ваше имя*" required>
							<input type="phone" name="Телефон" class="fos__input fos__input--phone" placeholder="Телефон*" required pattern="\+{0,1}[0-9]{1,2} [0-9]{3,4}[0-9]{6,7}" minlength="0" maxlength="14">
							<input type="text" name="Тема" class="fos__input fos__input--theme" placeholder="Какой товар вас интересует?*" required>
							<input type="text" name="Фамилия" style="display: none;"> <textarea name="Сообщение" style="display: none;"></textarea>
							<button class="btn_submit fos__input--submit">Отправить</button>
						<div class="fos__soglasie">
							<input type="checkbox" name="fos_soglasen" id="fos_soglasen" class="fos__checkbox fos__input" required><label for="fos_soglasen" class="checkbox"></label>
							<label for="fos_soglasen" class="fos__soglasen_txt">Я ознакомлен с <a href="<?=get_privacy_policy_url()?>">политикой конфиденциальности</a> и согласен на <a href="<?=get_permalink(carbon_get_post_meta($id, 'crb_page_soglasie' )[0]['id'])?>">обработку персональных данных</a></label>
						</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="gallery__bg">
			<div class="container">
				<div class="gallery">
					<div class="h2"><?=carbon_get_post_meta( $id, 'crb_gallery_heading' )?></div>
						<div class="slider">
							<div class="gallery__wrap slider__wrapper">
								<?php 
								$gal = carbon_get_post_meta( $id, 'crb_gallery_home' );
								foreach ( $gal as $img_id ) :
								 ?>
								<a class="gallery__item slider__item" href="<?=wp_get_attachment_image_url( $img_id, 'full' )?>" data-fslightbox="gallery_footer">
									<img src="<?=wp_get_attachment_image_url( $img_id, 'medium' )?>" alt="" class="gallery__item_img">
								</a>
								<?php 
								endforeach;
								 ?>
							</div>
							<a class="slider__control slider__control_left" href="#" role="button"></a>
							<a class="slider__control slider__control_right slider__control_show" href="#" role="button"></a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="map" style="min-height: 400px; background-image: url(<?=carbon_get_post_meta( $id, 'crb_map_bg' )?>)">
		</div>

 <?php 
get_footer();
  ?>