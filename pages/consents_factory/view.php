<?php
/**
 * View a decision
 *
 * @package Elgg-consents_factory
 */

$decision = get_entity(get_input('guid'));
if (!$decision) {
	register_error(elgg_echo('noaccess'));
	$_SESSION['last_forward_from'] = current_page_url();
	forward('');
}

$page_owner = elgg_get_page_owner_entity();

$crumbs_title = $page_owner->name;

if (elgg_instanceof($page_owner, 'group')) {
	elgg_push_breadcrumb($crumbs_title, "decision/group/$page_owner->guid/all");
} else {
	elgg_push_breadcrumb($crumbs_title, "decision/owner/$page_owner->username");
}

$title = $decision->title;

elgg_push_breadcrumb($title);


$content = '<div class="row-fluid decision-view">';
$content .= '<div class="span6">' . elgg_view_entity($decision, array('full_view' => true)) . elgg_view_comments($decision) . '</div>';

$end_clarification = ($decision->time_created + $decision->clarification * 60 * 60 * 24) * 1000;
$delta = $decision->delta;
$time_left = elgg_echo('decision:clarification:time_left');
$desc = elgg_echo('decision:clarification:description');
$btn_less = elgg_view('output/url', array(
	'href' => '#',
	'text' => elgg_echo('decision:button:time:less'),
	'class' => 'elgg-button elgg-button-action decision-time-less pvs prm gwfb'
)) . '<span class="pas float">' . elgg_echo('decision:desc:time:less', array($delta, $delta>1?'s':'')) . '</span>';
$btn_egual = elgg_view('output/url', array(
	'href' => '#',
	'text' => elgg_echo('decision:button:time:egual'),
	'class' => 'elgg-button elgg-button-action decision-time-egual pvs phm gwfb'
)) . '<span class="pas float">' . elgg_echo('decision:desc:time:egual', array($delta, $delta>1?'s':'')) . '</span>';
$btn_more = elgg_view('output/url', array(
	'href' => '#',
	'text' => elgg_echo('decision:button:time:more'),
	'class' => 'elgg-button elgg-button-action decision-time-more pvs prm gwfb'
)) . '<span class="pas float">' . elgg_echo('decision:desc:time:more', array($delta, $delta>1?'s':'')) . '</span>';

$content .= <<<HTML
<div class="span6">
	<div class="elgg-heading-basic pam">
		<h3>$time_left</h3>
		<div class="countdown ptm mts" data-end_clarification="{$end_clarification}" data-delta="{$delta}"></div>
	</div>
	<div class="pam mtm">{$desc}</div>
	<ul class="clarification-buttons mtm">
		<li class="pvm prm float">{$btn_less}</li>
		<li class="pvm phm float">{$btn_egual}</li>
		<li class="pvm plm float">{$btn_more}</li>
	</ul>
</div>
HTML;

$content .= '</div>';

$body = elgg_view_layout('content', array(
	'content' => $content,
	'title' => $title,
	'filter' => '',
));

echo elgg_view_page($title, $body);
