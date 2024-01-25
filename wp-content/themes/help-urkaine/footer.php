
			<!-- Подвал -->
			<footer>
				<div class="cont">
					<div class="data">
						<?php if (ot_get_option('about_title')) : ?>
						<div class="title"><?php echo ot_get_option('about_title'); ?></div>
						<?php endif; ?>

						<?php if (ot_get_option('about_text')) : ?>
						<div class="text_block">
							<?php echo ot_get_option('about_text'); ?>
						</div>
						<?php endif; ?>

						<?php
						if (ot_get_option('about_gallery')) :
							$gallery_imgs = explode(',', ot_get_option('about_gallery'));
						?>
						<div class="swiper gallery">
							<div class="swiper-wrapper">
								<?php
								foreach ($gallery_imgs as  $img) :
									$img = wp_get_attachment_image_src($img, 'full');

								?>
								<div class="swiper-slide slide">
									<img data-src="<?php echo $img[0]; ?>" alt="" class="lozad">
								</div>
								<?php endforeach; ?>
							</div>

							<div class="slider-pagination"></div>
						</div>
						<?php endif; ?>

						<div class="line_btns flex">
							<?php if (ot_get_option('about_btn_link')) : ?>
							<div class="link_btn link_btn2"><a href="<?php echo ot_get_option('about_btn_link'); ?>" target="_blank">Написати нам</a></div>
							<?php endif; ?>

							<div class="partner">
								<img data-src="<?php help_images('partner_logo.png'); ?>" alt="" class="lozad">
							</div>

							<div class="partner">
								<img data-src="<?php help_images('logo_centre2.png'); ?>" alt="" class="lozad">
							</div>
						</div>


						<?php if (ot_get_option('about_addres')) : ?>
						<div class="adress"><?php echo ot_get_option('about_addres'); ?></div>
						<?php endif; ?>
					</div>
				</div>
			</footer>
			<!-- End Подвал -->
		</div>

		<div class="supports_error">
			Ваш браузер устарел рекомендуем обновить его до последней версии<br /> или использовать другой более современный.
		</div>

		<div id="svg_icons">
			<svg style="display:none;">
				<symbol id="ic_telegram" viewBox="0 0 32 32">
					<path fill-rule="evenodd" clip-rule="evenodd" d="M32 16C32 24.836 24.836 32 16 32C7.164 32 0 24.836 0 16C0 7.164 7.164 0 16 0C24.836 0 32 7.164 32 16ZM16.5733 11.812C15.0173 12.4587 11.9067 13.7987 7.24267 15.8307C6.48533 16.132 6.088 16.4267 6.052 16.7147C5.99067 17.2027 6.60133 17.3947 7.43067 17.6547C7.544 17.6907 7.66133 17.7267 7.78133 17.7667C8.59867 18.032 9.69733 18.3427 10.268 18.3547C10.7867 18.3653 11.3653 18.152 12.004 17.7147C16.3613 14.772 18.6107 13.2853 18.752 13.2533C18.852 13.2307 18.9907 13.2013 19.084 13.2853C19.1773 13.368 19.168 13.5253 19.1587 13.568C19.0973 13.8253 16.7053 16.0507 15.4653 17.2027C15.0787 17.5613 14.8053 17.816 14.7493 17.8747C14.624 18.004 14.496 18.128 14.3733 18.2467C13.6133 18.9773 13.0453 19.5267 14.4053 20.4227C15.0587 20.8533 15.5813 21.2093 16.1027 21.564C16.672 21.952 17.24 22.3387 17.976 22.8213C18.1627 22.944 18.3413 23.0707 18.516 23.1947C19.1787 23.668 19.7747 24.092 20.5107 24.0253C20.9373 23.9853 21.38 23.584 21.604 22.3853C22.1333 19.5507 23.176 13.412 23.4173 10.8813C23.432 10.6712 23.4231 10.4601 23.3907 10.252C23.3713 10.0839 23.2894 9.92924 23.1613 9.81867C22.9707 9.66267 22.6747 9.62933 22.5413 9.632C21.94 9.64267 21.0173 9.964 16.5733 11.812Z" fill="currentColor"/>
				</symbol>
			</svg>
		</div>


		<!-- Подключение javascript файлов -->
		<?php wp_footer(); ?>
	</body>
</html>