<?php
/**
 * Elgg Consents factory plugin everyone page
 *
 * @package Elgg-consents_factory
 */

elgg_pop_breadcrumb();
elgg_push_breadcrumb(elgg_echo('decision'));

elgg_register_title_button();

$content = elgg_list_entities(array(
	'type' => 'object',
	'subtype' => 'decision',
	'limit' => 10,
	'full_view' => false,
	'view_toggle_type' => false
));

if (!$content) {
	$content = elgg_echo('decision:none');
}

$title = elgg_echo('decision:everyone');

$body = elgg_view_layout('content', array(
	'filter_context' => 'all',
	'content' => $content,
	'title' => $title,
	'sidebar' => elgg_view('decision/sidebar'),
));

echo elgg_view_page($title, $body);