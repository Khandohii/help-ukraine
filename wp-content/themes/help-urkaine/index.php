<?php get_header(); ?>

<!-- Основная часть -->
<section class="first_section">
	<div class="cont flex">
		<div class="data">
			<?php if (ot_get_option('first_section_title')) : ?>
			<h1 class="title">
				<?php echo ot_get_option('first_section_title'); ?> <img src="<?php help_images('ic_ua.png'); ?>" alt="" class="icon">
			</h1>
			<?php endif; ?>

			<?php if (ot_get_option('first_section_desc')) : ?>
			<div class="desc"><?php echo ot_get_option('first_section_desc'); ?></div>
			<?php endif; ?>

			<div class="link_btn"><button type="button" class="scroll_link" data-anchor="#sect_requisites">Зробити пожертвування</button></div>
		</div>

		<div class="wrap_map">
			<div class="map">
				<div class="img"><img src="<?php help_images('map.png'); ?>" alt=""></div>

				<?php
				if (ot_get_option('first_section_gallery')) :
					$map_images = explode(',', ot_get_option('first_section_gallery'));
				?>
				<div class="photos">
					<?php
					foreach ($map_images as $key => $img) :
						$img = wp_get_attachment_image_src($img, array(276, 276));
						$hidden = '';
						if ($key > 3) {
							$hidden = 'hidden';
						}

					?>
					<div class="photo <?php echo $hidden; ?>"><img src="<?php echo $img[0]; ?>" alt=""></div>
					<?php endforeach; ?>
				</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>



<?php if (ot_get_option('equipment_on_off') != 'off') : ?>
<section class="equipment">
	<div class="cont">
		<div class="wrap_title flex">
			<?php if (ot_get_option('equipment_title')) : ?>
			<div class="main_title"><?php echo ot_get_option('equipment_title'); ?></div>
			<?php else: ?>
			<div class="main_title">На що ми збираємо кошти?</div>
			<?php endif; ?>

			<div class="box_info hidden_mob">Ціни вказано за одну одиницю</div>
		</div>

		<?php
			$query_equimpents = new WP_Query([
				'post_type' => 'equipment',
				'post_status' => 'publish',
				'order' => 'ASC',
				'posts_per_page' => -1,
			]);
			$equimpents = $query_equimpents->posts;
			/*echo '<pre>';
			print_r($equimpents);
			echo '</pre>';*/

			if ($query_equimpents->have_posts()) :
		?>

		<div class="grid">
			<?php
				foreach ($equimpents as $key => $item) :
					$id = $item->ID;
					$title = $item->post_title;
					$price = CFS()->get( 'equipment_price', $id );
					$img = wp_get_attachment_image_src(get_post_thumbnail_id( $id ), 'full');


					$border = '';
					$hidden = '';

					if (CFS()->get( 'equipment_border', $id )) {
						$border = 'bord';
					}

					if ($key > 8 ) {
						$hidden = 'hidden';
					}
			?>
			<div class="item <?php echo $border; ?> <?php echo $hidden; ?>">
				<div class="item_wrap">
					<div class="img">
						<img data-src="<?php echo $img[0]; ?>" alt="" class="lozad">
					</div>

					<div class="data">
						<div class="name"><?php echo $title; ?></div>

						<div class="price"><?php echo $price; ?></div>
					</div>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
		<?php
			endif;

			// Получаем количество элементов экипировки
			$count = wp_count_posts( 'equipment')->publish;

			if ($count > 9) :
		?>
		<div class="show_more"><button type="button">Показати ще</button></div>
		<?php endif; ?>

		<div class="box_info hidden_desk">Ціни вказано за одну одиницю</div>
	</div>
</section>
<?php endif; ?>


<?php if (ot_get_option('amount_donations_on_off') != 'off') : ?>
<section class="sect_amount">
	<div class="cont">
		<div class="wrap_title flex">
			<div class="main_title"><?php echo ot_get_option('amount_donations_title'); ?></div>

			<div class="date"><?php echo date("d.m.Y H:i"); ?></div>
		</div>

		<div class="box">
			<?php
			if (ot_get_option('amount_donations_donated') && ot_get_option('amount_donations_target_sum')) :
				if (ot_get_option('amount_donations_target_sum') != 0 && ot_get_option('amount_donations_donated') != 0) {
					$target_sum = (int) str_replace(" ", '', ot_get_option('amount_donations_target_sum'));
					$donated_sum = (int) str_replace(" ", '', ot_get_option('amount_donations_donated'));
					$percent = round($donated_sum / $target_sum * 100, 0);
				} else{
					$target_sum = 0;
					$donated_sum = 0;
					$percent = 0;
				}
			?>
			<div class="progressbar"><span style="width: <?php echo $percent; ?>%;"></span></div>
			<?php else: ?>
			<div class="progressbar"><span style="width: 0%;"></span></div>
			<?php
				$percent = 0;
			endif;

			$currency = ot_get_option('amount_donations_currency');

			if ($currency == 'EUR') {
				$currency = "&#8364;";
			} elseif($currency == 'UAH'){
				$currency = "&#8372;";
			}
			?>

			<div class="line_data flex">
				<?php if (ot_get_option('amount_donations_donated')) : ?>
				<div class="col_l"><?php echo ot_get_option('amount_donations_donated'); ?> <?php echo $currency; ?></div>
				<?php else: ?>
				<div class="col_l">0</div>
				<?php endif; ?>

				<div class="center"><?php echo $percent; ?>% / <?php echo ot_get_option('amount_donations_target_sum'); ?> <?php echo $currency; ?></div>

				<div class="col_r"><?php echo ot_get_option('amount_donations_target_sum'); ?> <?php echo $currency; ?></div>
			</div>
		</div>

		<div class="link_btn"><button typr="button" class="scroll_link" data-anchor="#sect_requisites">Зробити пожертвування</button></div>
	</div>
</section>
<?php endif; ?>


<?php if (ot_get_option('requisites_on_off') != 'off') : ?>
<section id="sect_requisites" class="sect_requisites">
	<div class="cont">
		<?php if (ot_get_option('requisites_title')) : ?>
		<div class="main_title"><?php echo ot_get_option('requisites_title'); ?></div>
		<?php endif; ?>

		<div class="columns">
			<div class="info column left">
				<ul>
					<?php if (ot_get_option('requisites_org_name')) : ?>
					<li>
						<div class="grid flex">
							<div class="icon"><img data-src="<?php help_images('ic_requisites.svg'); ?>" alt="" class="lozad"></div>

							<div class="name"><?php echo ot_get_option('requisites_org_name'); ?></div>
						</div>
					</li>
					<?php endif; ?>

					<?php if (ot_get_option('requisites_site_link')) : ?>
					<li>
						<a href="<?php echo ot_get_option('requisites_site_link'); ?>" target="_blank">
							<div class="grid flex">
								<div class="icon"><img data-src="<?php help_images('ic_requisites2.svg'); ?>" alt="" class="lozad"></div>

								<div class="name"><?php echo ot_get_option('requisites_site_link'); ?></div>
							</div>
						</a>
					</li>
					<?php endif; ?>

					<?php if (ot_get_option('requisites_facebook_link')) : ?>
					<li>
						<a href="<?php echo ot_get_option('requisites_facebook_link'); ?>" target="_blank">
							<div class="grid flex">
								<div class="icon"><img data-src="<?php help_images('ic_requisites3.svg'); ?>" alt="" class="lozad"></div>

								<div class="name"><?php echo ot_get_option('requisites_facebook_link'); ?></div>
							</div>
						</a>
					</li>
					<?php endif; ?>
				</ul>
			</div>

			<?php if (ot_get_option('requisites_list_items') != 'off') : ?>
			<div class="accordion column right">
				<?php
				$requisites	= ot_get_option('requisites_list_items');

				foreach ($requisites as $value) :

				?>
				<div class="item">
					<div class="title open_btn"><?php echo $value['title']; ?></div>

					<div class="data text_block">
						<?php echo $value['requisites_list_item_content']; ?>
					</div>
				</div>
				<?php endforeach; ?>
			</div>
			<?php endif; ?>

			<div class="column left">
				<?php if (ot_get_option('requisites_privat_link')) : ?>
				<div class="link_btn">
					<a href="<?php echo ot_get_option('requisites_privat_link'); ?>" target="_blank" class="charity_btn">
						<span class="icon">
							<svg width="29" height="29" viewBox="0 0 29 29" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path fill-rule="evenodd" clip-rule="evenodd" d="M13.764 0.0102859C10.0587 0.2583 6.7987 1.7145 4.25212 4.25905C2.27187 6.23771 0.912866 8.72348 0.308945 11.4717C-0.102982 13.346 -0.102982 15.6559 0.308945 17.5302C0.696227 19.2926 1.42235 21.0094 2.40288 22.481C3.00578 23.3858 3.50453 23.9959 4.25212 24.7429C8.24521 28.7328 14.1253 30.0461 19.4485 28.1369C20.2582 27.8465 21.6713 27.1368 22.4239 26.6427C24.6686 25.1686 26.3417 23.2665 27.5388 20.8276C28.5465 18.7744 29 16.8109 29 14.5009C29 12.1175 28.5045 10.0522 27.4225 7.9261C26.7332 6.57141 25.8427 5.34858 24.7523 4.25905C22.4809 1.98952 19.5185 0.527422 16.3722 0.123144C15.6889 0.0353653 14.2924 -0.0251204 13.764 0.0102859ZM11.095 8.7426C12.0522 8.97353 12.8858 9.61669 13.2716 10.4219C13.8199 11.5663 13.7419 13.0208 13.0772 14.0484C12.499 14.9423 11.7368 15.5402 9.4216 16.9164C8.70246 17.3438 7.94481 18.069 7.72488 18.5402C7.64209 18.7178 7.57429 18.8901 7.57429 18.9232C7.57429 18.965 8.49002 18.9835 10.5556 18.9835H13.5368V19.6927V20.402H9.67129H5.80574L5.84191 20.0757C6.06252 18.085 6.75077 17.0694 8.7668 15.7595C10.6463 14.5382 10.8495 14.3916 11.2579 13.962C11.5235 13.6827 11.7338 13.3968 11.8368 13.1752C12.2741 12.2345 12.1171 11.1366 11.4587 10.5302C10.5713 9.71276 9.05385 9.74237 8.28939 10.592C7.85379 11.0761 7.57764 11.8361 7.57525 12.5576L7.57429 12.8555H6.86446H6.15463V12.3702C6.15463 10.7824 7.05282 9.39688 8.41779 8.87923C9.16861 8.59451 10.2522 8.53918 11.095 8.7426ZM21.5867 12.3858L21.6013 16.1433L22.3817 16.159L23.1621 16.1748L23.1781 16.8699L23.194 17.565H22.3982H21.6025L21.5872 18.9693L21.5721 20.3736L20.8765 20.3896L20.1808 20.4055V18.9852V17.565H17.6254H15.0701V16.8062V16.0475L17.6031 12.3946C18.9962 10.3855 20.1626 8.70907 20.1952 8.66912C20.2386 8.61584 20.4304 8.60069 20.9132 8.61238L21.5721 8.62827L21.5867 12.3858ZM18.3845 13.5005L16.6166 16.1181L18.3789 16.133C19.3483 16.1413 20.1504 16.1389 20.1616 16.1278C20.1728 16.1166 20.1753 14.932 20.1672 13.4952L20.1524 10.8829L18.3845 13.5005Z" fill="currentColor"/>
							</svg>
						</span>

						Переказати на Приват24
					</a>
				</div>
				<?php endif; ?>
			</div>

			<?php if (ot_get_option('requisites_note')) : ?>
			<div class="box_info column left">
				<?php echo ot_get_option('requisites_note'); ?>
			</div>
			<?php endif; ?>

			<div class="clear"></div>
		</div>
	</div>
</section>
<?php endif; ?>


<?php if (ot_get_option('sing_or_donate_on_off') != 'off') : ?>
<section class="sect_subscribe">
	<div class="cont">
		<div class="wrap_title flex">
			<div class="col_l">
				<?php if (ot_get_option('sing_or_donate_title')) : ?>
				<div class="main_title"><?php echo ot_get_option('sing_or_donate_title'); ?></div>
				<?php endif; ?>

				<?php if (ot_get_option('sing_or_donate_subtitle')) : ?>
				<div class="subtitle"><?php echo ot_get_option('sing_or_donate_subtitle'); ?></div>
				<?php endif; ?>
			</div>

			<div class="icon">
				<img data-src="<?php help_images('heart.svg'); ?>" alt="" class="lozad">
			</div>
		</div>

		<div class="columns flex">
			<?php if (ot_get_option('sing_or_donate_sign_list_items')) : ?>
			<div class="column">
				<div class="title">Підписатись на регулярні платежі</div>

				<div class="items flex">
					<?php
					$sing_or_donate	= ot_get_option('sing_or_donate_sign_list_items');

					foreach ($sing_or_donate as $value) :

					?>
					<a href="<?php echo $value['sing_or_donate_sign_list_item_link']; ?>" class="item"><?php echo $value['title']; ?></a>
					<?php endforeach; ?>
				</div>
			</div>
			<?php endif; ?>

			<?php if (ot_get_option('sing_or_donate_donate_list_items')) : ?>
			<div class="column">
				<div class="title">Задонатити разово</div>

				<div class="items flex">
					<?php
					$sing_or_donate	= ot_get_option('sing_or_donate_donate_list_items');

					foreach ($sing_or_donate as $value) :

					?>
					<a href="<?php echo $value['sing_or_donate_donate_list_item_link']; ?>" class="item" target="_blank"><?php echo $value['title']; ?></a>
					<?php endforeach; ?>
				</div>
			</div>
			<?php endif; ?>
		</div>


		<?php if (ot_get_option('sing_or_donate_tg_link')) : ?>
		<div class="block_info flex">
			<?php if (ot_get_option('sing_or_donate_tg_info')) : ?>
			<div class="box_info"><?php echo ot_get_option('sing_or_donate_tg_info'); ?></div>

			<div class="arrow">
				<svg width="204" height="8" viewBox="0 0 204 8" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M203.354 4.35355C203.549 4.15829 203.549 3.84171 203.354 3.64645L200.172 0.464466C199.976 0.269204 199.66 0.269204 199.464 0.464466C199.269 0.659728 199.269 0.976311 199.464 1.17157L202.293 4L199.464 6.82843C199.269 7.02369 199.269 7.34027 199.464 7.53553C199.66 7.7308 199.976 7.7308 200.172 7.53553L203.354 4.35355ZM0 4.5H203V3.5H0V4.5Z" fill="currentColor"/>
				</svg>
			</div>
			<?php endif; ?>

			<div class="telegram_btn">
				<a href="<?php echo ot_get_option('sing_or_donate_tg_link'); ?>" target="_blank">
					<span class="icon">
						<svg width="32" height="32">
							<use xlink:href="#ic_telegram"></use>
						</svg>
					</span>

					Написати в телеграм
				</a>
			</div>
		</div>
		<?php endif; ?>
	</div>
</section>
<?php endif; ?>


<?php if (ot_get_option('rest_and_study_on_off') != 'off') : ?>
<section class="events">
	<div class="cont">
		<div class="wrap_title flex">
			<div class="col_l">
				<?php if (ot_get_option('rest_and_study_title')) : ?>
				<div class="main_title"><?php echo ot_get_option('rest_and_study_title'); ?></div>
				<?php endif; ?>

				<?php if (ot_get_option('rest_and_study_subtitle')) : ?>
				<div class="subtitle"><?php echo ot_get_option('rest_and_study_subtitle'); ?></div>
				<?php endif; ?>
			</div>

			<?php if (ot_get_option('rest_and_study_gt_link')) : ?>
			<div class="col_r">
				<?php if (ot_get_option('rest_and_study_gt_info')) : ?>
				<div class="box_info"><?php echo ot_get_option('rest_and_study_gt_info'); ?></div>
				<?php endif; ?>

				<div class="telegram_btn telegram_btn2">
					<a href="<?php echo ot_get_option('rest_and_study_gt_link'); ?>" target="_blank">
						<span class="icon">
							<svg width="32" height="32">
								<use xlink:href="#ic_telegram"></use>
							</svg>
						</span>

						Написати в телеграм
					</a>
				</div>
			</div>
			<?php endif; ?>
		</div>

		<?php if (ot_get_option('rest_and_study_list_items')) : ?>
		<div class="grid">
			<?php
			$events	= ot_get_option('rest_and_study_list_items');

			foreach ($events as $value) :

			?>
			<div class="item">
				<a href="<?php echo $value['rest_and_study_list_item_img']; ?>" class="fancy_img img">
					<img data-src="<?php echo $value['rest_and_study_list_item_img']; ?>" alt="" class="lozad">
				</a>

				<div class="data">
					<div class="date"><?php echo $value['rest_and_study_list_item_desc']; ?></div>

					<div class="name"><?php echo $value['title']; ?></div>

					<a href="<?php echo $value['rest_and_study_list_item_link']; ?>" class="price" target="_blank">
						<?php echo $value['rest_and_study_list_item_price']; ?>
					</a>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
		<?php endif; ?>
	</div>
</section>
<?php endif; ?>


<?php if (ot_get_option('products_on_off') != 'off') : ?>
<section class="buy_for_victory">
	<div class="cont">
		<?php if (ot_get_option('products_title')) : ?>
		<div class="main_title"><?php echo ot_get_option('products_title'); ?></div>
		<?php endif; ?>

		<?php if (ot_get_option('products_subtitle')) : ?>
		<div class="subtitle"><?php echo ot_get_option('products_subtitle'); ?></div>
		<?php endif; ?>

		<?php if (ot_get_option('products_list_items')) : ?>
		<div class="grid flex">
			<?php
			$products	= ot_get_option('products_list_items');

			foreach ($products as $value) :

			?>
			<div class="item">
				<div class="wrap_item">
					<a href="<?php echo $value['products_list_item_img']; ?>" class="img fancy_img">
						<img data-src="<?php echo $value['products_list_item_img']; ?>" alt="" class="lozad">
					</a>

					<div class="data">
						<div class="desc"><?php echo $value['products_list_item_desc']; ?></div>

						<div class="name"><?php echo $value['title']; ?></div>

						<a href="<?php echo $value['products_list_item_link']; ?>" class="price" target="_blank">
							<?php echo $value['products_list_item_price']; ?>
						</a>
					</div>
				</div>
			</div>
			<?php endforeach; ?>

			<?php if (ot_get_option('products_gt_link')) : ?>
			<div class="item item_buy">
				<?php if (ot_get_option('products_gt_info')) : ?>
				<div class="title"><?php echo ot_get_option('products_gt_info'); ?></div>
				<?php endif; ?>

				<div class="telegram_btn telegram_btn2">
					<a href="<?php echo ot_get_option('products_gt_link'); ?>" target="_blank">
						<span class="icon">
							<svg width="32" height="32">
								<use xlink:href="#ic_telegram"></use>
							</svg>
						</span>

						Написати в телеграм
					</a>
				</div>
			</div>
			<?php endif; ?>
		</div>
		<?php endif; ?>
	</div>
</section>
<?php endif; ?>
<!-- End Основная часть -->
<?php get_footer(); ?>