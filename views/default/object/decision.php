<?php
/**
 * Elgg decision view
 *
 * @package Elgg-consents_factory
 */

$full = elgg_extract('full_view', $vars, FALSE);
$decision = elgg_extract('entity', $vars, FALSE);

if (!$decision) {
	return;
}

$owner = $decision->getOwnerEntity();
$owner_icon = elgg_view_entity_icon($owner, 'tiny');
$container = $decision->getContainerEntity();
$categories = elgg_view('output/categories', $vars);

$description = elgg_view('output/longtext', array('value' => $decision->description, 'class' => 'pbl'));

$owner_link = elgg_view('output/url', array(
	'href' => "decision/owner/$owner->username",
	'text' => $owner->name,
	'is_trusted' => true,
));
$author_text = elgg_echo('byline', array($owner_link));

$date = elgg_view_friendly_time($decision->time_created);

$comments_count = $decision->countComments();
//only display if there are commments
if ($comments_count != 0) {
	$text = elgg_echo("comments") . " ($comments_count)";
	$comments_link = elgg_view('output/url', array(
		'href' => $decision->getURL() . '#comments',
		'text' => $text,
		'is_trusted' => true,
	));
} else {
	$comments_link = '';
}

$metadata = elgg_view_menu('entity', array(
	'entity' => $decision,
	'handler' => 'decision',
	'sort_by' => 'priority',
	'class' => 'elgg-menu-hz',
));

$subtitle = "$author_text $date $comments_link $categories";

// do not show the metadata and controls in widget view
if (elgg_in_context('widgets')) {
	$metadata = '';
}




if ($full && !elgg_in_context('gallery')) {

	$params = array(
		'entity' => $decision,
		'title' => false,
		'metadata' => $metadata,
		'subtitle' => $subtitle,
	);
	$params = $params + $vars;
	$summary = elgg_view('object/elements/summary', $params);

	$body = <<<HTML
<div class="decision elgg-content mts">
	$description
</div>
HTML;

	echo elgg_view('object/elements/full', array(
		'entity' => $decision,
		'icon' => $owner_icon,
		'summary' => $summary,
		'body' => $body,
	));

} else { // brief view

	$excerpt = elgg_get_excerpt($decision->description);

	$params = array(
		'entity' => $decision,
		'metadata' => $metadata,
		'subtitle' => $subtitle,
		'content' => $excerpt,
	);
	$params = $params + $vars;
	$body = elgg_view('object/elements/summary', $params);

	echo elgg_view_image_block($owner_icon, $body);
}
