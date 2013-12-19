<?php
/**
 * Add decision page
 *
 * @package Elgg-consents_factory
 */

$page_owner = elgg_get_page_owner_entity();

$title = elgg_echo('decision:add');
elgg_push_breadcrumb($title);

$vars = decision_prepare_form_vars();
$content = elgg_view_form('consents_factory/save', array(), $vars);

$body = elgg_view_layout('content', array(
	'filter' => '',
	'content' => $content,
	'title' => $title,
));

echo elgg_view_page($title, $body);