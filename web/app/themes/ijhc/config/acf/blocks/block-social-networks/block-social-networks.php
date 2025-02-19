<?php

if (have_rows('social_networks')):
    while (have_rows('social_networks')): the_row();
        // Social Media
        $liens = [
            "facebook" => get_sub_field("facebook"),
            "instagram" => get_sub_field("instagram"),
            "twitter" => get_sub_field("twitter"),
            "linkedin" => get_sub_field("linkedin"),
            "tiktok" => get_sub_field("tiktok")
        ];
        ?>
			<section class="section-social-networks">
				<div class="container section-social-networks__container">
					<div class="row">
						<div class="col-12 col-lg-8 offset-lg-2">
                <?php if ($title = get_sub_field('title')): ?>
									<h2 class="section-social-networks__title"><?= $title ?></h2>
                <?php endif; ?>
                <?php if ($description = get_sub_field('description')): ?>
									<p class="section-social-networks__description"><?= $description ?></p>
                <?php endif; ?>
						</div>
					</div>
				</div>
          <?php if ($liens) : ?>
						<div class="container section-social-networks__container__link">
							<div class="row">
								<div class="col-12">
									<ul>
                      <?php
                      foreach ($liens as $lien => $url) :
                          if ($url) : ?>
														<li class="section-social-networks__link">
															<a href="<?= $url ?>" target="_blank" alt=""><?= getIcon($lien) ?></a>
														</li>
                          <?php
                          endif;
                      endforeach;
                      ?>
									</ul>
								</div>
							</div>
						</div>
          <?php endif; ?>
			</section>
    <?php
    endwhile;
endif;
?>