<?php
/**
 * Name: [Block] - Category
 * Author : Baptiste Montécot | @baptistemontecot
 * URL : https://agenceseize.fr
 */
?>

<section class="seize-block-category">
	<div class="img-container">
      <?= responsiveImg(get_field("bloc_fond_visuel"), array("category2400", "category1200", "category820"), "100vw, (min-width: 1200px) 1200px"); ?>
	</div>

	<div class="bloc-content">
		<div class="content">
        <?php if ($titre = get_field("titre")) : ?>
            <?php if ($link = get_field("lien_url")) :
                $link_url = $link['url']; ?>
						<a class="btn-title" href="<?= esc_url($link_url); ?>">
							<h2 <?php if ($titre_couleur = get_field("titre_couleur")) : echo 'style="color:' . $titre_couleur . ';"'; endif; ?>>
                  <?= the_field("titre"); ?>
							</h2>
						</a>
            <?php endif; ?>
        <?php endif; ?>
			<div
				class="text-content global-radius global-shadow" <?php if ($texte_couleur_fond = get_field("texte_couleur_fond")) : echo 'style="background:' . $texte_couleur_fond . ';"'; endif; ?>>
          <?php if ($texte = get_field("texte")) : ?>
						<p
							class="text" <?php if ($texte_couleur = get_field("texte_couleur")) : echo 'style="color:' . $texte_couleur . ';"'; endif; ?>>
                <?= $texte; ?>
						</p>
          <?php endif; ?>
			</div>
        <?php if ($link = get_field("lien_url")) :
            $link_url = $link['url']; ?>
					<a class="btn-primary" href="<?= esc_url($link_url); ?>">
              <?php $link_title = $link['title']; ?>
						<span><?= esc_html($link_title); ?></span>
					</a>
        <?php endif; ?>
		</div>
	</div>
</section>