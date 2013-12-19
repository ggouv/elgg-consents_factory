<?php
/**
 * New decision river entry
 *
 * @package Elgg-consents_factory
 */

$object = $vars['item']->getObjectEntity();
$excerpt = elgg_get_excerpt($object->description);

echo elgg_view('river/elements/layout', array(
	'item' => $vars['item'],
	'message' => $excerpt
));
