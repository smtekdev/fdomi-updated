<?php

ob_start();

if ( $donation == 'simple' ) {

	$vid_data = sh_grab_video( $vid_link, '' );

	$settings = get_option( 'wp_deeds' . '_theme_options' );

	?>

	<div class="row">

		<div class="col-md-6 column">

			<div class="simple-text">

				<h3><?php echo wp_kses_post( $title ); ?></h3>

				<p><?php echo wp_kses_post( $contents ); ?></p>

				<a class="button donation_module" href="javascript:void(0)" data-toggle="modal"><?php echo esc_html( $btn_text ); ?></a>

			</div>

		</div>

		<div class="col-md-6 column">

			<div class="video">

				<div class="video-img lightbox">

					<img alt="<?php esc_attr_e( 'image', 'deeds' ); ?>" src="<?php echo sh_set( $vid_data, 'thumb' ); ?>">

					<a title="<?php echo sh_set( $vid_data, 'title' ); ?>" href="http://vimeo.com/<?php echo sh_set( $vid_data, 'id' ); ?>"><i class="fa fa-play"></i></a>

				</div>

			</div>

		</div>

	</div>

	<?php

}

$output = ob_get_contents();

ob_end_clean();



