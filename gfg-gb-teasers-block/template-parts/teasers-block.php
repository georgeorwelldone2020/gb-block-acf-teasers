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

<div id="<?php echo esc_attr($id); ?>" class="b12 customBlocks <?php echo esc_attr($className); ?>">

	<?php if( have_rows('gbTeasers') ):

		$teaserCount = 0;
		$teaersMarkupArray = array();

		while( have_rows('gbTeasers') ): the_row();

			$teaserCount++;
			$teaserObject = get_sub_field('gbTeaser');
			$teaserID = $teaserObject->ID;
			$teaserTitle = $teaserObject->post_title;
			$teaserURL = esc_url( get_permalink($teaserID) );
			$teaserThumbnail = get_the_post_thumbnail( $teaserID, 'medium' );

			/*  Use single quotes for raw HTML and curly braces around PHP variables */
			$teaserMarkup = "<a href='{$teaserURL}'>";
			$teaserMarkup .= 	$teaserThumbnail;
			$teaserMarkup .= 	$teaserTitle;
			$teaserMarkup .= "</a>";

			array_push($teaersMarkupArray, $teaserMarkup);

		endwhile;

		if ( $teaserCount === 1 ) {
			$teaserGridVal = '12';
		} elseif ( $teaserCount === 2 ) {
			$teaserGridVal = '6';
		} elseif ( $teaserCount === 3 ) {
			$teaserGridVal = '4';
		} elseif ( $teaserCount === 4 ) {
			$teaserGridVal = '3';
		} elseif ( $teaserCount === 5 ) {
			$teaserGridVal = '20';
		} elseif ( $teaserCount === 6 ) {
			$teaserGridVal = '2';
		} else {
			$teaserGridVal = '4';
		} ?>

		<div class="b12 teasers">
			<?php foreach ($teaersMarkupArray as $teaser) { ?>
				<div class="b<?php echo $teaserGridVal; ?> teaser">
					<?php echo $teaser; ?>
				</div>
			<?php } ?>
		</div>

	<?php endif; ?>

</div>

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
