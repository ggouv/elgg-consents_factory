.countdown {
	color: #333;
}
.countdown li {
	display: inline-block;
	padding: 0 10px;
}
.countdown .num {
	font-size: 2.6em;
}
.clarification-buttons li {
	width: 33.33%;
	box-sizing: border-box;
}
.decision-time-less, .decision-time-more, .decision-time-egual {
	font-size: 1.2em;
	width: 100%;
	box-sizing: border-box;
	text-align: left;
	height: auto;
	padding-left: 45px;
}
.elgg-button.decision-time-less:before, .elgg-button.decision-time-more:before, .elgg-button.decision-time-egual:before {
	font-size: 3.7em;
	position: absolute;
	top: 7px;
	left: 0;
}
.elgg-button.decision-time-less:before {
	color: #89C23C;
	content: "\AA00";
}
.elgg-button.decision-time-more:before {
	color: #F33;
	content: "\AA01";
}
.elgg-button.decision-time-egual:before {
	color: #FFED00;
	content: "\2714";
	padding: 0 10px 0 11px;
}
.decision-time-less:hover, .elgg-button.decision-time-less.choosed {
	background-color: #89C23C;
	border-color: #045900;
}
.decision-time-egual:hover, .elgg-button.decision-time-egual.choosed {
	background-color: #FFED00;
	border-color: #D5BB00;
}
.decision-time-more:hover, .elgg-button.decision-time-more.choosed {
	background-color: #F33;
	border-color: #cf0404;
}
.elgg-button.decision-time-less:hover:before,
.elgg-button.decision-time-egual:hover:before,
.elgg-button.decision-time-more:hover:before,
.elgg-button.decision-time-less.choosed,
.elgg-button.decision-time-less.choosed:before,
.elgg-button.decision-time-more.choosed,
.elgg-button.decision-time-more.choosed:before,
.elgg-button.decision-time-egual.choosed,
.elgg-button.decision-time-egual.choosed:before {
	color: white;
}
.elgg-button.decision-time-less.choosed:hover:before, .elgg-button.decision-time-egual.choosed:hover:before, .elgg-button.decision-time-more.choosed:hover:before {
	content: "\2715";
	font-size: 4.7em;
	padding: 0 10px 0 11px;
}