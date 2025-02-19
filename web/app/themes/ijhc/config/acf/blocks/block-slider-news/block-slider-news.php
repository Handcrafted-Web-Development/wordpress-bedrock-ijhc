<?php
/**
 * Name: [Block] - Slider News
 * Author : Baptiste Montécot | @baptistemontecot
 * URL : https://agenceseize.fr
 */

?>

<section class="seize-block-slider-news">
	<div class="container">
		<div class="row bloc-title">
        <?php if ($title = get_field("title")) : ?>
					<h2 class="product-section-title"><?= $title; ?></h2>
        <?php endif; ?>
        <?php if ($subtitle = get_field("subtitle")) : ?>
					<h3 class="product-section-subtitle"><?= $subtitle; ?></h3>
        <?php endif; ?>
        <?php if ($text = get_field("text")) : ?>
					<p class="text"><?= $text; ?></p>
        <?php endif; ?>
		</div>
		<div class="row bloc-content background-container">
			<div class="content">
          <?php if ($vignettes = get_field('vignettes')): ?>
						<div class="slider">
                <?php foreach ($vignettes as $vignette) : ?>
									<article class="article-card">
										<a class="article-card-link" href="<?= get_the_permalink($vignette); ?>">
											<div class="img">
                          <?= responsiveImg(get_post_thumbnail_id($vignette), array("maillagemb")); ?>
											</div>
											<div class="article-description">
												<h3><?= get_the_title($vignette) ?></h3>
												<p><?= get_the_excerpt($vignette); ?></p>
											</div>
											<button class="btn-primary">Voir l'article</button>
										</a>

										<meta itemprop="description" content="<?= nbExcerpt('exptListe'); ?>" />
										<meta itemprop="datePublished" content="<?php the_time('Y-m-d'); ?>" />
										<meta itemprop="dateModified" content="<?php the_modified_date('Y-m-d'); ?>" />
									</article>
                <?php endforeach; ?>
						</div>
          <?php endif; ?>

          <?php if ($link = get_field("lien_url")) :
              if ($link_url = $link['url']) : ?>
								<div class="flex-center">
									<a class="btn-primary btn-slider" href="<?= esc_url($link_url); ?>">
                      <?php if ($link_title = $link['title']) : ?>
												<span><?= esc_html($link_title); ?></span>
                      <?php endif; ?>
									</a>
								</div>
              <?php endif; ?>
          <?php endif; ?>
			</div>
		</div>
	</div>
</section>