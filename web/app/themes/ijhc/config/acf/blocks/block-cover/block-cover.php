<?php
/**
 * Name: [Block] - Cover
 * Author : Baptiste Montécot | @baptistemontecot
 * URL : https://agenceseize.fr
 */
?>

<section class="section-cover">
    <?php if ($img_header = get_field('image')): ?>
			<div class="section-cover__image">
          <?= responsiveImg($img_header, array('cover3200', "cover1600", "cover800")) ?>
			</div>
    <?php endif; ?>
	<div class="container section-cover__container">
		<div class="row">
			<div class="col-12">
          <?php if ($title = get_field('title')): ?>
						<h1 class="section-cover__title"><?= $title ?></h1>
          <?php endif; ?>
          <?php if ($subtitle = get_field('subtitle')): ?>
						<h2 class="section-cover__subtitle"><?= $subtitle ?></h2>
          <?php endif; ?>
			</div>
        <?php
        if (have_rows('description_repeater')):
            while (have_rows('description_repeater')) : the_row(); ?>
							<div class="offset-lg-1 col-lg-10 col-12 section-cover__description">
                  <?php if ($description = get_sub_field('description')): ?>
										<p><?= $description ?></p>
                  <?php endif; ?>
							</div>
            <?php
            endwhile;
        endif;
        ?>
		</div>
	</div>
</section>