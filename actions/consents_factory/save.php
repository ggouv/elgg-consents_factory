<?php
/**
* ElggObject decision save action
*
* @package Elgg-consents_factory
*/

$title = get_input('title', '', false);
$description = get_input('description');
$access_id = get_input('access_id');
$tags = get_input('tags');
$guid = get_input('guid');
$clarification = (int) get_input('clarification', '7');
$objection = (int) get_input('objection', '7');
$delta = (int) get_input('delta', '1');
$guid = (int) get_input('guid');
$container_guid = get_input('container_guid', elgg_get_logged_in_user_guid());

elgg_make_sticky_form('decision');

if (!$title || !$description) {
	register_error(elgg_echo('decision:save:failed'));
	forward(REFERER);
}

if ($guid == 0) {
	$decision = new ElggObject;
	$decision->subtype = "decision";
	$decision->container_guid = $container_guid;
	$new = true;
} else {
	$decision = get_entity($guid);
	if (!$decision->canEdit()) {
		system_message(elgg_echo('decision:save:failed'));
		forward(REFERRER);
	}
}

$tagarray = string_to_tag_array($tags);

$decision->title = $title;
$decision->description = $description;
$decision->access_id = $access_id;
$decision->tags = $tagarray;
$decision->clarification = $clarification;
$decision->objection = $objection;
$decision->delta = $delta;

if ($decision->save()) {

	elgg_clear_sticky_form('decision');

	system_message(elgg_echo('decision:save:success'));

	//add to river only if new
	if ($new) {
		add_to_river('river/object/decision/create','create', elgg_get_logged_in_user_guid(), $decision->getGUID());
	}

	forward($decision->getURL());
} else {
	register_error(elgg_echo('decision:save:failed'));
	forward(REFERER);
}
