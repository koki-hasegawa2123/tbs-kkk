<header id="site-header" class="<?php lightning_the_class_name( 'site-header' ); ?>">
	<?php do_action( 'lightning_site_header_prepend' ); ?>
	<div id="site-header-container" class="<?php lightning_the_class_name( 'site-header-container' ); ?> container">

		<?php
		if ( is_front_page() ) {
			$title_tag = 'h1';
		} else {
			$title_tag = 'div';
		}
		?>
		<<?php echo $title_tag; ?> class="<?php lightning_the_class_name( 'site-header-logo' ); ?>">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
			<span><?php lightning_print_headlogo(); ?></span>
		</a>
		</<?php echo $title_tag; ?>>

		<?php do_action( 'lightning_site_header_logo_after' ); ?>

		<div class="header-link">
			<a href="wp-content/themes/lightning_child_sample/medical.php"><img class="Reserve-img" src="https://tbs-kkk.com/wp-content/uploads/2021/08/601d18468862dc050962d7da.png" alt="リンク" width="450" height="210"></a>
		</div>

		<div class="header-address">
			<p style="text-align: right;">眼形成クリニック Clarity<br><br>

				〒000-0000<br>
			  北海道札幌市中央区南〇条西〇丁目000-00<br>
				○○ビル3F<br><br>

				TEL: 000-000-0000<br><br>

			</p>

		</div>
	</div>
	</header>

		<div class="nav">
		<?php
		wp_nav_menu( array(
			'theme_location' 	=> 'global-nav',
			'container'      	=> 'nav',
			'container_class'	=> lightning_get_the_class_name( 'global-nav' ),
			'container_id'		=> 'global-nav',
			'items_wrap'     	=> '<ul id="%1$s" class="%2$s vk-menu-acc global-nav-list nav">%3$s</ul>',
			'fallback_cb'    	=> '',
			'echo'           	=> true,
			'walker'         	=> new VK_Description_Walker(),
		) );
		?>

	</div>

	
	<?php do_action( 'lightning_site_header_append' ); ?>
