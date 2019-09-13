<!DOCTYPE html>
<html lang="ru">

<head>

	<meta charset="utf-8">



	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="icon" href="/favicon.png">
	<?php 
	echo carbon_get_theme_option('header_approve');
	echo carbon_get_theme_option('header_scripts');
	 ?>
	<?php wp_head(); ?>
</head>

<body>

	<header>
		<div class="container">
			<div class="top<?= is_front_page()?' top--main':'' ?>" style="background-color:;">
				<a <?php if(!is_front_page()) { echo 'href="'.home_url().'"';} ?> class="top__logo<?php if(is_front_page()){ echo(' top__logo--main');}  ?>">
					<?php 	$logo = carbon_get_theme_option('crb_header_logo');
							if ($logo[0]['_type'] == 'logo_img'):
							 ?>
					<img class="top__logo_img" src="<?php echo $logo[0]['logo_img'] ?>" alt="<?php echo carbon_get_theme_option('crb_logo_alt') ?>">
					<?php 
							else : echo $logo[0]['logo_svg'];
							endif;?>

				</a>
				<div class="top__descriptor"><?php echo carbon_get_theme_option('header_descriptor') ?></div>
				<div class="top__adress">
					<div class="map_tag map_tag--fill">
						<!-- <img src="img/map_tag_fill.svg" alt=""> -->
						<svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 484.824 683.623"><defs><clipPath id="a"><path d="M0 512.717h363.618V0H0z"/></clipPath></defs><g clip-path="url(#a)" transform="matrix(1.33333 0 0 -1.33333 0 683.623)"><path d="M299.244 462.568a171.482 171.482 0 0 1-131.532 49.835 8.821 8.821 0 0 0-3.328-4.832 74.076 74.076 0 0 0-36.585-14.898 78.564 78.564 0 0 1-17.129-5.18 61.722 61.722 0 0 0-19.263-32.115 593.155 593.155 0 0 1-43.823-45.927 99.08 99.08 0 0 1-3.624-10.17 422.415 422.415 0 0 1-7.939-43.559c1.173-13.027 1.534-26 1.669-39.14a211.76 211.76 0 0 1 .135-33.676l.012-.023c.501-1.373.862-2.626 1.296-3.938a1030.137 1030.137 0 0 1 73.446-134.028c22.753-32.826 61.995-69.08 76.713-107.708l125.962 181.91c51.458 68.613 44.636 182.803-16.01 243.45" fill="#ffc000"/><path d="M169.28 388.741c23.564 0 42.667-25.47 42.667-56.889 0-31.419-19.103-56.889-42.667-56.889s-42.667 25.47-42.667 56.89c0 31.418 19.103 56.888 42.667 56.888" fill="#fff"/><path d="M63.59 452.042a171.978 171.978 0 0 0 138.875 49.617 170.643 170.643 0 0 1-110.43-49.617h-.001c-60.645-60.646-67.47-174.836-16.01-243.449L199.677 30.021 185.453 9.482 47.58 208.593C-3.88 277.206 2.945 391.396 63.59 452.042" fill="#fff"/><path d="M183.503 379.259c-26.182 0-47.407-21.225-47.407-47.407 0-26.182 21.225-47.407 47.407-47.407 26.182 0 47.406 21.225 47.406 47.407-.03 26.169-21.237 47.377-47.406 47.407m0-113.778c-36.655 0-66.37 29.715-66.37 66.37s29.715 66.37 66.37 66.37c36.654 0 66.37-29.715 66.37-66.37-.045-36.636-29.733-66.325-66.37-66.37"/><path d="M181.827 493.037A161.795 161.795 0 0 1 66.67 445.333C9.309 387.981 2.244 280.01 51.54 214.277L181.827 26.138 311.9 213.99c49.509 66.02 42.444 173.991-14.917 231.343a161.795 161.795 0 0 1-115.157 47.704m0-493.037a9.484 9.484 0 0 0-7.796 4.083L36.16 203.194c-54.352 72.444-46.454 192 17.102 255.546a181.805 181.805 0 0 0 257.129.001c63.556-63.546 71.454-183.102 16.889-255.833L189.623 4.083A9.485 9.485 0 0 0 181.827 0"/></g></svg>
					</div>
					<div class="top_adresstxt">
						<?php echo carbon_get_theme_option('header_adress') ?>
					</div>
				</div>
			</div>
		</div>
	</header>
	<main>