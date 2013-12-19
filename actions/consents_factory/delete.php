<?php
/**
 * Delete a decision
 *
 * @package Elgg-consents_factory
 */

$guid = get_input('guid');
$decision = get_entity($guid);

if (elgg_instanceof($decision, 'object', 'decision') && $decision->canEdit()) {
	$container = $decision->getContainerEntity();
	if ($decision->delete()) {
		system_message(elgg_echo("decision:delete:success"));
		if (elgg_instanceof($container, 'group')) {
			forward("decision/group/$container->guid/all");
		} else {
			forward("decision/owner/$container->username");
		}
	}
}

register_error(elgg_echo("decision:delete:failed"));
forward(REFERER);
