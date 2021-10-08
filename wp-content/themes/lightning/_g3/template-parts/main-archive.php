<?php

// Excrude to in case of filter search
if ( ! is_search() ) {

	/*
	Archive title
	/*-------------------------------------------*/
	$archive_header_html = '';
	$post_top_info       = VK_Helpers::get_post_top_info();
	// Use post top page（ Archive title wrap to div ）.
	if ( $post_top_info['use'] || get_post_type() !== 'post' ) {
		if ( is_year() || is_month() || is_day() || is_tag() || is_tax() || is_category() ) {
			$archive_title       = get_the_archive_title();
			$archive_header_html = '<header class="archive-header"><h1 class="archive-header-title">' . $archive_title . '</h1></header>';
			echo wp_kses_post( apply_filters( 'lightning_archive-header', $archive_header_html ) );
		}
	}

	/*
	Archive description
	/*-------------------------------------------*/
	$archive_description_html = '';
	if ( is_category() || is_tax() || is_tag() ) {
		$archive_description = term_description();
		$page_number         = get_query_var( 'paged', 0 );
		if ( ! empty( $archive_description ) && $page_number == 0 ) {
			$archive_description_html = '<div class="archive-description">' . $archive_description . '</div>';
			echo wp_kses_post( apply_filters( 'lightning_archive_description', $archive_description_html ) );
		}
	}
} // if ( ! is_search() ) {

$post_type_info = VK_Helpers::get_post_type_info();

do_action( 'lightning_loop_before' );
?>

<?php if ( have_posts() ) : ?>

	<?php if ( apply_filters( 'lightning_is_extend_loop', false ) ) { ?>

		<?php do_action( 'lightning_extend_loop' ); ?>

<?php } else { ?>

	<div class="<?php lightning_the_class_name( 'post-list' ); ?> vk_posts vk_posts-mainSection">

		<?php
		global $lightning_loop_item_count;
		$lightning_loop_item_count = 0;

		while ( have_posts() ) {
			the_post();

			lightning_get_template_part( 'template-parts/loop-item', $post_type_info['slug'] );

			$lightning_loop_item_count++;
			do_action( 'lightning_loop_item_after' );

		} // while ( have_posts() ) {
		?>

	</div><!-- [ /.post-list ] -->

<?php } // loop() ?>

	<?php
	the_posts_pagination(
		array(
			'mid_size'           => 1,
			'prev_text'          => '&laquo;',
			'next_text'          => '&raquo;',
			'type'               => 'list',
			'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'lightning' ) . ' </span>',
		)
	);
	?>

<?php else : // hove_posts() ?>

<div class="container-text1">
	<h2>2021年8月1日新規開業！<br>北海道札幌市中央区南〇条西〇丁目 Clarity・眼形成クリニック</h2>
</div>
<div class="container-text2">
	<h4>「手術で治ると思わなかった」「今まで誰も治ることを教えてくれなかった」等はよく言われる言葉です。<br><br>病気になると自然に諦めてしまいます。そのうち自分でも「年だから」と言ってしまいます。<br><br>無用な手術は勧めません。相談だけでもいらしてください。</h4>
</div>

<div class="container-img-corona">
	<div class="img-corona-box">
	<img src="https://tbs-kkk.com/wp-content/uploads/2021/09/link_img.png" alt="コロナ対策強化してます">
	</div>
</div>

<div class="container-img-message">
	<img src="https://tbs-kkk.com/wp-content/uploads/2021/09/img52.jpg" alt="背景画像">
</div>

<div class="container-menu-schedule">
	<img class="menu-img" src="https://tbs-kkk.com/wp-content/uploads/2021/09/img51.jpg" alt="当院スケジュール画像">
		<table class="menu-table">
			<tr>
				<td>院長</td>
				<td>田中太郎</td>
			</tr>
			<tr>
				<td>診療科目</td>
				<td>眼科</td>
			</tr>
			<tr>
				<td>診療内容</td>
				<td>一般眼科、レーザー治療、眼形成手術、涙道手術、涙目治療、眼瞼下垂、内反症、逆さまつげ、目の周りの腫瘍、ほくろ、コンタクトレンズ処方</td>
			</tr>
			<tr>
				<td>住所</td>
				<td>〒000-0000<br>
						北海道札幌市中央区南〇条西〇丁目000-00<br>
						○○ビル3F</td>
			</tr>
			<tr>
				<td>電話</td>
				<td>000-000-0000</td>
			</tr>
		</table>
</div>

<div class="GoogleMap">
	<h3 class="font-access">アクセス</h3>
	<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2914.9969738994355!2d141.35130171576398!3d43.06253119844076!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x5f0b297627507247%3A0x1b9ba84a4b04cdeb!2z5pyt5bmM5biC5pmC6KiI5Y-w!5e0!3m2!1sja!2sjp!4v1630612933943!5m2!1sja!2sjp" width="1903" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
</div>

	
<!-- <div class="main-section-no-posts"><p><?php //echo wp_kses_post( apply_filters( 'lightning_no_posts_text', __( 'No posts.', 'lightning' ) ) ); ?></p></div> -->

<?php endif; // have_post() ?>

<?php do_action( 'lightning_loop_after' ); ?>
