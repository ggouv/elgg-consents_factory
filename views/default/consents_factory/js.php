
elgg.provide('elgg.decision');

elgg.decision.init = function() {
	if ($('.countdown').length) {
		$('.countdown').countdown({
			date: $('.countdown').data('end_clarification')
		});

		$('.decision-time-less').click(function() {
			$('.countdown').data('countdown').visualUpdate($('.countdown').data('end_clarification')-3600000);
		});
		$('.decision-time-more').click(function() {
			$('.countdown').data('countdown').visualUpdate($('.countdown').data('end_clarification')+3600000);
		});
	}
};

elgg.register_hook_handler('init', 'system', elgg.decision.init);



/*
FORK by ManUtopiK
countdown is a simple jquery plugin for countdowns.

Dual licensed under the MIT (http://www.opensource.org/licenses/mit-license.php)
and GPL-3.0 (http://opensource.org/licenses/GPL-3.0) licenses.

@source: http://github.com/rendro/countdown/
@demo: http://rendro.github.io/countdown/
@autor: Robert Fleischmann
@version: 1.0.1
*/


(function() {
	(function($) {
		$.countdown = function(el, options) {
			var getDateData,
			_this = this;

			this.el = el;
			this.$el = $(el);
			this.$el.data("countdown", this);

			this.init = function() {
				_this.options = $.extend({}, $.countdown.defaultOptions, options);
				if (_this.options.refresh) {
					_this.interval = setInterval(function() {
						return _this.render();
					}, _this.options.refresh);
				}
				_this.render();
				return _this;
			};

			getDateData = function(endDate) {
				var dateData, diff;
				endDate = Date.parse($.isPlainObject(_this.options.date) ? _this.options.date : new Date(_this.options.date));
				diff = (endDate - Date.parse(new Date)) / 1000;
				if (diff <= 0) {
					diff = 0;
					if (_this.interval) _this.stop();
					_this.options.onEnd.apply(_this);
				}
				dateData = {
					years: 0,
					days: 0,
					hours: 0,
					min: 0,
					sec: 0,
					millisec: 0
				};
				if (diff >= (365.25 * 86400)) {
					dateData.years = Math.floor(diff / (365.25 * 86400));
					diff -= dateData.years * 365.25 * 86400;
				}
				if (diff >= 86400) {
					dateData.days = Math.floor(diff / 86400);
					diff -= dateData.days * 86400;
				}
				if (diff >= 3600) {
					dateData.hours = Math.floor(diff / 3600);
					diff -= dateData.hours * 3600;
				}
				if (diff >= 60) {
					dateData.min = Math.floor(diff / 60);
					diff -= dateData.min * 60;
				}
				dateData.sec = diff;
				return dateData;
			};

			this.leadingZeros = function(num, length) {
				if (length == null) length = 2;
				num = String(num);
				while (num.length < length) {
					num = "0" + num;
				}
				return num;
			};

			this.update = function(newDate) {
				_this.options.date = newDate;
				return _this;
			};

			this.visualUpdate = function(newDate, options) {
				if (_this.interval) clearInterval(_this.interval);

				options = $.extend({}, {
					speed: 2000,  // how long it should take to count between the target numbers
					refreshInterval: 90  // how often the element should be updated
				}, options || {});

				var oD = new Date(_this.options.date),
					nD = new Date(newDate),
					loops = Math.ceil(options.speed / options.refreshInterval), // how many times to update the value
					increment = (nD.getTime() - oD.getTime()) / loops, // how much to increment the value on each update
					loopCount = 0,
					iD = oD.getTime(),
					interval = setInterval(function() {
						iD += increment;
						loopCount++;

						_this.options.date = iD;
						_this.render();

						if (loopCount >= loops) {
							clearInterval(interval);
							_this.options.date = newDate;
							_this.start();
						}

					}, options.refreshInterval);

				return _this;
			};

			this.isPlural = function(number, single_string) {
				return (number > 1) ? single_string + "s" : single_string;
			};

			this.render = function() {
				_this.options.render.apply(_this, [getDateData(_this.options.date)]);
				return _this;
			};

			this.display = function(num, name) {
				return '<li><span class="num float pbs">'+ num + '</span><span class="name float clearfloat">' + name + '</span>';
			};

			this.stop = function() {
				if (_this.interval) clearInterval(_this.interval);
				_this.interval = null;
				return _this;
			};
			this.start = function(refresh) {
				if (refresh == null) refresh = _this.options.refresh || $.countdown.defaultOptions.refresh;
				if (_this.interval) clearInterval(_this.interval);
				_this.render();
				_this.options.refresh = refresh;
				_this.interval = setInterval(function() {
					return _this.render();
				}, _this.options.refresh);
				return _this;
			};
			return this.init();
		};

		$.countdown.defaultOptions = {
			date: "June 7, 2087 15:03:25",
			refresh: 1000,
			onEnd: $.noop,
			render: function(date) {
				var years = date.years ? this.display(date.years, elgg.echo(this.isPlural(date.years, "year"))) : '',
					days = date.days ? this.display(date.days, elgg.echo(this.isPlural(date.days, "day"))) : '',
					hours = this.display(this.leadingZeros(date.hours), elgg.echo(this.isPlural(date.hours, "hour"))),
					min = this.display(this.leadingZeros(date.min), elgg.echo(this.isPlural(date.min, "min"))),
					sec = this.display(this.leadingZeros(date.sec), elgg.echo(this.isPlural(date.sec, "sec")));

				return $(this.el).html('<ul>' + years + days + hours + min + sec + '</ul>');
			}
		};

		$.fn.countdown = function(options) {
			return $.each(this, function(i, el) {
				var $el;
				$el = $(el);
				if (!$el.data('countdown')) return $el.data('countdown', new $.countdown(el, options));
			});
		};

		return void 0;
	})(jQuery);
}).call(this);