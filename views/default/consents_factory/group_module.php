<?php
/**
 * List most recent decision on group profile page
 *
 * @package Elgg-consents_factory
 */

$group = elgg_get_page_owner_entity();

if ($group->consents_factory_enable == "no") {
	return true;
}

$all_link = elgg_view('output/url', array(
	'href' => "decision/group/$group->guid/all",
	'text' => elgg_echo('link:view:all'),
	'is_trusted' => true,
));

elgg_push_context('widgets');
$options = array(
	'type' => 'object',
	'subtype' => 'decision',
	'container_guid' => elgg_get_page_owner_guid(),
	'limit' => 6,
	'full_view' => false,
	'pagination' => false,
);
$content = elgg_list_entities($options);
elgg_pop_context();

if (!$content) {
	$content = '<p>' . elgg_echo('decision:none') . '</p>';
}

$new_link = elgg_view('output/url', array(
	'href' => "decision/add/$group->guid",
	'text' => elgg_echo('decision:add'),
	'is_trusted' => true,
));

echo elgg_view('groups/profile/module', array(
	'title' => elgg_echo('decision:group'),
	'content' => $content,
	'all_link' => $all_link,
	'add_link' => $new_link,
));
