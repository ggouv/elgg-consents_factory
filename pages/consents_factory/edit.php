<?php
/**
 * Edit decision page
 *
 * @package Elgg-consents_factory
 */

$decision_guid = get_input('guid');
$decision = get_entity($decision_guid);

if (!elgg_instanceof($decision, 'object', 'decision') || !$decision->canEdit()) {
	register_error(elgg_echo('decision:unknown_bookmark'));
	forward(REFERRER);
}

$page_owner = elgg_get_page_owner_entity();

$title = elgg_echo('decision:edit');
elgg_push_breadcrumb($title);

$vars = decision_prepare_form_vars($decision);
$content = elgg_view_form('consents_factory/save', array(), $vars);

$body = elgg_view_layout('content', array(
	'filter' => '',
	'content' => $content,
	'title' => $title,
));

echo elgg_view_page($title, $body);