<?php
/**
 * Name: [Block] - Title and text
 * Author : Baptiste Montécot | @baptistemontecot
 * URL : https://agenceseize.fr
 */
?>

<section class="section-text-title">
	<div class="container">
		<div class="row">
			<div class="col-12">
          <?php if ($title = get_field('title')) : ?>
              <?php if (($balise_title = get_field('balise_title')) == "h1") : ?>
							<h1
								class="product-section-title"<?php if ($not_thick_title = get_field('not_thick_title')) : ?><?php endif; ?>>
                  <?= $title; ?>
							</h1>
              <?php else : ?>
							<h2
								class="product-section-title" <?php if ($not_thick_title = get_field('not_thick_title')) : ?><?php endif; ?>>
                  <?= $title; ?>
							</h2>
              <?php endif; ?>
          <?php endif; ?>
          <?php if ($subtitle = get_field('subtitle')) : ?>
              <?= $subtitle; ?>
          <?php endif; ?>
			</div>
		</div>
	</div>
</section>