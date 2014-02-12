<?php
/**
* ElggObject decision vote clarification
*
* @package Elgg-consents_factory
*/

$guid = get_input('guid', false);
$vote_type = get_input('vote_type', false);
$decision = get_entity($guid);

if (!$decision || !in_array($vote_type, array('less', 'egual', 'more'))) {
	forward(REFERER);
}

elgg_load_library('elgg:consents_factory');
$user_guid = elgg_get_logged_in_user_guid();

// check if user already voted this decision
$md = decision_get_user_clarification_vote($guid, $user_guid);

if (!$md) { // first vote
	$id = create_metadata($guid, 'clarification_vote', $vote_type, 'text', $user_guid);
} else { // modify vote
	// check if this is same vote. If yes, we delete metadata.
	if ($md->value == $vote_type) {
		$md->delete();
		$vote_type = 'none';
	} else { // vote change
		update_metadata($md->id, 'clarification_vote', $vote_type, 'text');
	}
}

echo json_encode(array(
	'end_clarification' => decision_get_end_clarification($decision),
	'vote_type' => $vote_type
));