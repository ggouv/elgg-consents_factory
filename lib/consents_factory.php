<?php
/**
 * Elgg Consents factory helper functions
 *
 * @package Elgg-consents_factory
 */

/**
 * Prepare the add/edit form variables
 *
 * @param ElggObject $decision A decision object.
 * @return array
 */
function decision_prepare_form_vars($decision = null) {
	// input names => defaults
	$values = array(
		'title' => '',
		'description' => '',
		'access_id' => ACCESS_DEFAULT,
		'tags' => '',
		'container_guid' => elgg_get_page_owner_guid(),
		'guid' => null,
		'entity' => $decision,
		'clarification' => '7',
		'objection' => '7',
		'delta' => '1',
	);

	if ($decision) {
		foreach (array_keys($values) as $field) {
			if (isset($decision->$field)) {
				$values[$field] = $decision->$field;
			}
		}
	}

	if (elgg_is_sticky_form('decision')) {
		$sticky_values = elgg_get_sticky_values('decision');
		foreach ($sticky_values as $key => $value) {
			$values[$key] = $value;
		}
	}

	elgg_clear_sticky_form('decision');

	return $values;
}


/**
 * Return clarification vote of an user for a decision
 * @param  GUID  $decision_guid   GUID of the decision object
 * @return ElggMetadata           Metadata of the vote
 */
function decision_get_user_clarification_vote($decision_guid, $user_guid = null) {
	if (!$user_guid) $user_guid = elgg_get_logged_in_user_guid();

	$md = elgg_get_metadata(array(
		'guid' => $decision_guid,
		'metadata_owner_guid' => $user_guid,
		'metadata_name' => 'clarification_vote'
	));

	return $md[0];
}



/**
 * Return date of the end of clarification
 * @param  ElggObject $decision A decision object.
 * @return timestamp           timestamp of the end of the clarification
 */
function decision_get_end_clarification($decision) {
	$clarification_end = ($decision->time_created + $decision->clarification * 60 * 60 * 24);

	$metadatas = elgg_get_metadata(array(
		'guid' => $decision->getGUID(),
		'metadata_name' => 'clarification_vote',
		'metadata_values' => array('less', 'more')
	));

	foreach ($metadatas as $metadata) {
		if ($metadata->value == 'less') {
			$clarification_end -= $decision->delta * 60 * 60;
		} else if ($metadata->value == 'more') {
			$clarification_end += $decision->delta * 60 * 60;
		}
	}

	return $clarification_end;
}