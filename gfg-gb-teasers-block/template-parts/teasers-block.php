<?php

// ------------------------------------------------------------------------------------------------------------
// The template file used to render the block. The same template file will be used on the frontend and as the “Preview” view in the backend editor.
// ------------------------------------------------------------------------------------------------------------

// ---------------------------------------------------
// Show Debug & Meta Info of Gutenberg Block
// ---------------------------------------------------

/**
 * Teasers Block Template.
 *
 * @param	array $block The block settings and attributes.
 * @param	string $content The block inner HTML (empty).
 * @param	bool $is_preview True during AJAX preview.
 * @param	(int|string) $post_id The post ID this block is saved to.
 */

/*
echo get_the_title($post_id);
echo '<pre>';
	var_dump($block);
echo '</pre>';
*/

// ---------------------------------------------------
// Generate Block ID
// ---------------------------------------------------

// Create id attribute allowing for custom "anchor" value.
$id = 'teasers-' . $block['id'];
if( !empty($block['anchor']) ) {
	$id = $block['anchor'];
}

// ---------------------------------------------------
// Load Gutenberg »Alignment«
// ---------------------------------------------------

// Create class attribute allowing for custom "className" and "align" values.
$className = 'customBlockTeasers';
if( !empty($block['className']) ) {
	$className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
	$className .= ' align' . $block['align'];
}

// ---------------------------------------------------
// Backend & Frontend Markup of Block
// ---------------------------------------------------
?>

<figure id="<?php echo esc_attr($id); ?>" class="customBlocks <?php echo esc_attr($className); ?>">

	<div class="blockTitle"><h3>Teasers Block</h3></div>

	<?php if( have_rows('gbTeasers') ): ?>

		<ul>

		<?php while( have_rows('gbTeasers') ): the_row();

			$teaserObject = get_sub_field('gbTeaser');
			$teaserID = $teaserObject->ID;
			$teaserTitle = $teaserObject->post_title;
			$teaserURL = get_permalink($teaserID);
			$teaserThumbnail = get_the_post_thumbnail( $teaserID, 'medium' ); ?>

			<a href="<?php echo esc_url( $teaserURL ); ?>">

				<?php echo $teaserThumbnail; ?>
				<?php echo $teaserTitle; ?>

			</a>

		<?php endwhile; ?>

		</ul>

	<?php endif; ?>

</figure>

<?php
// ---------------------------------------------------
// Backend & Frontend Layout CSS of Block
// ---------------------------------------------------

$background_color = get_field('background_color');

?>

<style type="text/css">
	#<?php echo $id; ?> {
		background: <?php echo $background_color; ?>;
	}
</style>