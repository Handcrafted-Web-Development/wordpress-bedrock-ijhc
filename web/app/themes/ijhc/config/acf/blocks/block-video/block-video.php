<?php
/**
 * Name: [Block] - Video
 * Author : Baptiste Montécot | @baptistemontecot
 * URL : https://agenceseize.fr
 */


// If this file is called directly, abort.
if (!defined('ABSPATH')) {
    die;
}


// ID
$anchor = $block['id'];
if (!empty($block['anchor']))
    $anchor = sanitize_title($block['anchor']);

// Champs acf
$video_type = get_field('video_type');
$video_id = get_field('video_id');
$video_file = get_field('video_file');
$logo_alternative = get_field('logo_alternative');
?>

<section class="project-video">
    <?php if ($video_type == "youtube") : ?>
			<iframe width="560" height="315"
							src="https://www.youtube.com/embed/<?= $video_id; ?>?rel=0&enablejsapi=1&autohide=1&autoplay=1&mute=1&controls=0&modestbranding=1&showInfo=1&loop=1&playlist=<?= $video_id; ?>"
							frameborder="0" allowfullscreen>
			</iframe>
    <?php endif; ?>
</section>