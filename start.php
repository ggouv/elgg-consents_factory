<?php
/**
 * Elgg Consents factory plugin
 *
 * @package Elgg-consents_factory
 */

elgg_register_event_handler('init', 'system', 'consents_factory');

/**
 * elgg-consents_factory init
 */
function consents_factory() {

	$root = dirname(__FILE__);
	elgg_register_library('elgg:consents_factory', "$root/lib/consents_factory.php");

	// actions
	$action_path = "$root/actions/consents_factory";
	elgg_register_action('consents_factory/save', "$action_path/save.php");
	elgg_register_action('consents_factory/delete', "$action_path/delete.php");
	elgg_register_action('consents_factory/share', "$action_path/share.php");

	// menus
	elgg_register_menu_item('site', array(
		'name' => 'consents_factory',
		'text' => elgg_echo('decision'),
		'href' => 'decision/all'
	));

	elgg_register_plugin_hook_handler('register', 'menu:owner_block', 'consents_factory_owner_block_menu');

	elgg_register_page_handler('decision', 'consents_factory_page_handler');

	elgg_extend_view('css/elgg', 'consents_factory/css');
	elgg_extend_view('js/elgg', 'consents_factory/js');

	elgg_register_widget_type('consents_factory', elgg_echo('decision'), elgg_echo('decision:widget:description'));

	// Register granular notification for this type
	register_notification_object('object', 'decision', elgg_echo('decision:new'));

	// Register a URL handler for decision
	elgg_register_entity_url_handler('object', 'decision', 'decision_url');

	// Register entity type for search
	elgg_register_entity_type('object', 'decision');

	// Groups
	add_group_tool_option('consents_factory', elgg_echo('decision:enableconsents_factory'), false);
	elgg_extend_view('groups/tool_latest', 'consents_factory/group_module');
}

/**
 * Dispatcher for decision.
 *
 * URLs take the form of
 *  All decision:         decision/all
 *  User's decision:      decision/owner/<username>
 *  Friends' decision:    decision/friends/<username>
 *  View decision:        decision/view/<guid>/<title>
 *  New decision:         decision/add/<guid> (container: user, group, parent)
 *  Edit decision:        decision/edit/<guid>
 *  Group decision:       decision/group/<guid>/all
 *
 * Title is ignored
 *
 * @param array $page
 * @return bool
 */
function consents_factory_page_handler($page) {

	elgg_load_library('elgg:consents_factory');

	if (!isset($page[0])) {
		$page[0] = 'all';
	}

	elgg_push_breadcrumb(elgg_echo('decision'), 'decision/all');

	$pages = dirname(__FILE__) . '/pages/consents_factory';

	switch ($page[0]) {
		case "all":
			include "$pages/all.php";
			break;

		case "owner":
			include "$pages/owner.php";
			break;

		case "friends":
			include "$pages/friends.php";
			break;

		case "view":
			set_input('guid', $page[1]);
			include "$pages/view.php";
			break;

		case "add":
			gatekeeper();
			include "$pages/add.php";
			break;

		case "edit":
			gatekeeper();
			set_input('guid', $page[1]);
			include "$pages/edit.php";
			break;

		case 'group':
			group_gatekeeper();
			include "$pages/owner.php";
			break;

		default:
			return false;
	}

	elgg_pop_context();
	return true;
}



/**
 * Populates the ->getUrl() method for decision objects
 *
 * @param ElggEntity $entity The decision object
 * @return string decision item URL
 */
function decision_url($entity) {
	global $CONFIG;

	$title = $entity->title;
	$title = elgg_get_friendly_title($title);
	return $CONFIG->url . "decision/view/" . $entity->getGUID() . "/" . $title;
}



/**
 * Add a menu item to an ownerblock
 *
 * @param string $hook
 * @param string $type
 * @param array  $return
 * @param array  $params
 */
function consents_factory_owner_block_menu($hook, $type, $return, $params) {
	if (elgg_instanceof($params['entity'], 'user')) {
		$url = "decision/owner/{$params['entity']->username}";
		$item = new ElggMenuItem('decision', elgg_echo('decision'), $url);
		$return[] = $item;
	} else {
		if ($params['entity']->consents_factory_enable != 'no') {
			$url = "decision/group/{$params['entity']->guid}/all";
			$item = new ElggMenuItem('decision', elgg_echo('decision:group'), $url);
			$return[] = $item;
		}
	}

	return $return;
}

