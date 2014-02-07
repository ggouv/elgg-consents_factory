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
