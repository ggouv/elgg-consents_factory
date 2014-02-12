<?php
/**
 * Elgg-consents_factory English language file
 */

$english = array(

	/**
	 * Menu items and titles
	 */
	'decision' => "Decisions",
	'decision:add' => "Add decision",
	'decision:edit' => "Edit decision",
	'decision:owner' => "%s's decisions",
	'decision:friends' => "Friends' decisions",
	'decision:everyone' => "All site decisions",
	'decision:this:group' => "Decision in %s",
	'decision:moredecisions' => "More decisions",
	'decision:more' => "More",
	'decision:with' => "Share with",
	'decision:new' => "A new decision",
	'decision:none' => 'No decisions',

	'decision:clarification:time_left' => "Fin de la phase de clarification dans :",
	'decision:clarification:description' => "La phase de clarification...",

	'decision:delete:confirm' => "Are you sure you want to delete this decision?",

	'decision:numbertodisplay' => 'Number of decisions to display',

	'decision:recent' => "Recent decisions",

	'river:create:object:decision' => '%s created the decision %s',
	'river:comment:object:decision' => '%s commented on the decision %s',
	'decision:river:annotate' => 'a comment on this decision',
	'decision:river:item' => 'an item',

	'item:object:decision' => 'Decision',

	'decision:group' => 'Group decisions',
	'decision:enableconsents_factory' => 'Enable group decisions',
	'decision:nogroup' => 'This group does not have any decisions yet',
	'decision:more' => 'More decisions',

	'decision:no_title' => 'No title',

	'year' => "année",
	'years' => "années",
	'day' => "jour",
	'days' => "jours",
	'hour' => "heure",
	'hours' => "heures",
	'min' => "minute",
	'mins' => "minutes",
	'sec' => "seconde",
	'secs' => "secondes",

	/**
	 * Forms
	 */
	'decision:time:clarification' => "Delay of clarification (in day)",
	'decision:time:objection' => "Delay of objection (in day)",
	'decision:time:delta' => "Time to remove for clarification rate (in hour)",

	'decision:button:time:less' => "It's clear&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;",
	'decision:desc:time:less' => "and <strong>I remove %s hour%s</strong> to accelerate decision process.",
	'decision:button:time:egual' => "It's clear&nbsp;&nbsp;",
	'decision:desc:time:egual' => "and I let's other the time to make their choices.",
	'decision:button:time:more' => "It's not clear",
	'decision:desc:time:more' => "and <strong>I add %s hour%s</strong> to get more time to clarify this decision.",

	/**
	 * Widget
	 */
	'decision:widget:description' => "Display your latest decisions.",

	/**
	 * Status messages
	 */

	'decision:save:success' => "Your item was successfully created.",
	'decision:modify:success' => "Your item was successfully modified.",
	'decision:delete:success' => "Your decision was deleted.",

	/**
	 * Error messages
	 */

	'decision:save:failed' => "Your decision could not be saved. Make sure you've entered a title and description and then try again.",
	'decision:delete:failed' => "Your decision could not be deleted. Please try again.",
	'decision:clarification:vote:error' => "Your vote cannot be saved.",
);

add_translation('en', $english);