/**
 * BitLeaderFirewallStatistics
 *
 * The JS classes
 *
 * PHP Version 5.3
 *
 * @package BFS
 * @author tlex <tlex@e-tel.eu>
 * @version 1.0
 * @copyright 2014 Alexandru Thomae / BitLeader (http://www.bitleader.com)
 * @license http://www.gnu.org/licenses/ GPLv3
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 */

/**
 * Sets some default functions
 *
 * Prevent console.log errors, enables Date.now
 */
(function fixer() {
	var method;
	var noop = function() {
	};
	var methods = ['assert', 'clear', 'count', 'debug', 'dir', 'dirxml', 'error', 'exception', 'group', 'groupCollapsed', 'groupEnd', 'info', 'log', 'markTimeline', 'profile', 'profileEnd', 'table', 'time', 'timeEnd',
		'timeStamp', 'trace', 'warn'];
	var length = methods.length;
	var console = (window.console = window.console || {});

	while (length--) {
		method = methods[length];

		// Only stub undefined methods.
		if (!console[method]) {
			console[method] = noop;
		}
	}

	//Enables Date.now for older browsers
	if (!Date.now) {
		Date.now = function() { return new Date().getTime(); };
	}

}());

/**
 * BFS()
 *
 * Class Declaration
 */
var BFS = (function(a) {

	var plugins = a.plugins = a.plugins || {};
	___bfs = document.___bfs = document.___bfs || [];

	/**
	 * The init function for BFS
	 *
	 * Starts all the plugins functions
	 */
	var init = a.init = a.init || function() {
		console.log('BFS starting');
		for ( var i in a.plugins) {
			if (typeof a.plugins[i].init === 'function') {
				console.log('Initializing plugin ' + i);
				a.plugins[i].init();
			}
		}
	}

	/**
	 * Just a function that doesn't do anything.
	 */
	var noop = function() {
	};

	/**
	 * Loads through AJAX a given data
	 *
	 * @param data
	 *            object containing: string controller, string action, function
	 *            success, optional param.
	 */
	var loadData = a.loadData = a.loadData || function(data) {
		data = data = data || {};
		if (typeof (data) !== 'object') {
			a.triggerException('data is invalid');
		}
		if (typeof (data.url) === 'undefined') {
			a.triggerException('url is not defined');
		}
		data.success = data.success = data.success || noop;
		data.error = data.error = data.error || noop;
		data.complete = data.complete = data.complete || noop;
		if (typeof (data.param) === 'object') {
			data.url = data.url + '?';
			for ( var i in data.param) {
				data.url += i + '=' + data.param[i];
			}
		}
		data.beforeSend = function(xhr) {
			xhr.setRequestHeader('Access-Control-Allow-Headers', 'x-requested-with');
			xhr.setRequestHeader('Access-Control-Allow-Origin', '*');
		}
		$.ajax({
			url : data.url,
			// crossDomain: true,
			// beforeSend: data.beforeSend,
			success : data.success,
			error : data.error,
			complete : data.complete,
			cache : false
		// contentType: 'application/x-www-form-urlencoded'
		});
	};

	/**
	 * Throws a custom exception
	 */
	var triggerException = a.triggerException = a.triggerException || function(message) {
		throw {
			name : a,
			level : 'CRITICAL',
			message : message || 'Critical Error!',
			htmlMessage : '<p class="alert alert-danger">' + (message || 'Critical Error!') + '</p>',
			toString : function() {
				return this.name + ": " + this.message
			}
		}
	}

	var convertSize = a.convertSize = a.convertSize || function(y, source) {
		var abs_y = Math.abs(y), units = ['TiB', 'PiB', 'EiB', 'ZiB', 'YiB'];
		typeof source !== 'undefined' || (source = null);
		if (source == null) {
			return y;
		}
		source = source.toUpperCase();
		switch (source) {
			case 'GiB' :
			case 'GB' :
				units = ['GiB'].concat(units);
				break;
			case 'MiB' :
			case 'MB' :
				units = ['MiB', 'GiB'].concat(units);
				break;
			case 'KiB' :
			case 'KB' :
				units = ['KiB', 'MiB', 'GiB'].concat(units);
				break;
			case 'B' :
				units = ['B', 'KiB', 'MiB', 'GiB'].concat(units);
				break;
		}
		for ( var i in units) {
			if (abs_y >= 1024 && units[i] != 'YiB') {
				abs_y = (abs_y / 1024);
			} else {
				return abs_y.toFixed(2) + units[i];
			}
		}
	}

	return a;
})(BFS || {});

/**
 * The BFS Highcharts Plugin
 */
BFS = (function(a, b) {
	var z = a.plugins[b] = a.plugins[b] || {
		v : {
			jsonUrl : 'bfs.json.php',
			scheduled : false,
			initialized : false,
			graphs : {},
			tmp : {}
		}
	};

	/**
	 * The init() function
	 * 
	 * Always rewrites the parent one
	 */
	z.init = function() {
		console.log(b + ' initialized');
		var manualHighcharts = false;
		for ( var i in ___bfs) {
			if (___bfs[i].manualHighcharts) {
				manualHighcharts = true;
			}
		}
		manualHighcharts || z.initCharts();
		return this;
	}

	/**
	 * Initializes all the charts on the page
	 */
	z.initCharts = function() {
		if (z.v.initialized)
			return;
		z.v.initialized = true;
		Highcharts.setOptions({
			global : {
				useUTC : false
			}
		});
		$('.load-highchart').each(
			function() {
				var $me = $(this), selector = $me.find('div.panel-body')[0];
				var options = {
					selector : selector,
					type : $me.attr('data-type') || 'spline',
					source : $me.attr('data-source') || 'json',
					graphName : $me.attr('id'),
					colors : $me.attr('data-colors') && ($me.attr('data-colors').split('|')) || ['#7cb5ec', '#434348', '#90ed7d', '#f7a35c', '#8085e9', '#f15c80', '#e4d354', '#8085e8', '#8d4653', '#91e8e1'],
					minRange : $me.attr('data-min-range') || 3600000,
					height : $me.attr('data-height') || 200,
					stacking : $me.attr('data-stacking') || null,
					legend : $me.attr('data-legend') || true,
					markers : $me.attr('data-markers') || false,
					maxX : $me.attr('data-max-x') || null,
					maxY : $me.attr('data-max-y') || null,
					plotX : $me.attr('data-plot-x-line') || false,
					plotXTitle : $me.attr('data-plot-x-title') || null,
					plotY : $me.attr('data-plot-y-line') || false,
					plotYTitle : $me.attr('data-plot-y-title') || null,
					tooltipFormat : $me.attr('data-tooltip-format') || null,
					tooltipConvert : $me.attr('data-tooltip-convert') || null,
					reloadInterval : $me.attr('data-reload-interval') || Math.floor(Math.random() * (60 - 31) + 30), // see
				// https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Math/random
					zoomType : $me.attr('data-zoom-type') || 'x',
					yTitle : $me.attr('data-ytitle') || null,
					metric : $me.attr('data-metric') || null,
					urlAppend : $me.attr('data-url') || null
				}
				options.legend == "disabled" && (options.legend = false);

				options.plotXLines = [];
				options.plotYLines = [];
				options.plotX && (options.plotXLines = [{
					color : '#FF0000',
					width : 2,
					value : parseInt(options.plotX),
					zIndex : 3,
					label : {
						text : options.plotXTitle
					}
				}]);
				options.plotY && (options.plotYLines = [{
					color : '#FF0000',
					width : 2,
					zIndex : 3,
					value : parseInt(options.plotY),
					label : {
						text : options.plotYTitle
					}
				}]);

				z.autoAddSeries(options);
				z.v.scheduled || (z.v.scheduled = setInterval(function() {
					z.reloadAllGraphs(z)
				}, parseInt(options.reloadInterval * 1000)));
			});
	}

	/**
	 * Does the actual call for highcharts and stores the info in an object
	 * 
	 * @param options
	 */
	z.delayStart = function(options) {
		z.v.tmp = z.v.tmp = z.v.tmp || {};
		var series = [];
		for ( var i in z.v.tmp) {
			if (i == options.graphName) {
				series = z.v.tmp[i];
			}
		}
		z.v.graphs = z.v.graphs = z.v.graphs || {};
		var graphOptions = {
			chart : {
				renderTo : options.selector,
				zoomType : options.zoomType,
				spacing : [10, 10, 10, 10],
				height : options.height,
			},
			colors : options.colors,
			credits : {
				enabled : false
			},
			legend : {
				enabled : options.legend
			},
			title : {
				//The title is desabled as we have the bootstrap panels with header
				text : null
			},
			plotOptions : {
				line : {
					marker : {
						enabled : options.markers
					},
					stacking : options.stacking
				},
				area : {
					marker : {
						enabled : options.markers
					},
					stacking : options.stacking
				},
				series : {
					marker : {
						enabled : options.markers
					},
					enableMouseTracking : true,
					dataGrouping : {
						enabled : false
					},
					stacking : options.stacking
				},
				spline : {
					marker : {
						enabled : options.markers
					},
					stacking : options.stacking
				}

			},
			xAxis : {
				type : 'datetime',
				gridLineWidth : 1,
				tickInterval : options.xTickInterval,
				minRange : options.minRange,
				plotLines : options.plotXLines,
				max : options.maxX
			},
			yAxis : {
				min : 0,
				marker : {
					enabled : options.markers
				},
				minorTickInterval : 'auto',
				tickPixelInterval : 50,
				title : {
					text : options.yTitle
				},
				plotLines : options.plotYLines,
				max : options.maxY,
				labels : {
					formatter : function () {
						return options.tooltipConvert && (a.convertSize(this.value, options.tooltipConvert)) || this.value;
					}
				}
			},
			series : series,
			tooltip : {
				shared : true,
				formatter : function() {
					var s = '<span style="font-size: 10px">' + Highcharts.dateFormat('%H:%M:%S %e. %b %Y', this.x) + '</span><br/>';
					$.each(this.points, function(i, point) {
						var pointValue = options.tooltipConvert && (a.convertSize(point.y, options.tooltipConvert)) || point.y;
						s += '<br/><span style="color:' + point.series.color + '">' + point.series.name + '</span>: ';
						s += '<strong>' + pointValue + '</strong>';
					});
					return s;
				}
			}
		}
		//Calls the actual Highcharts Method
		z.v.graphs[options.graphName] = {
			graph : new Highcharts.Chart(graphOptions),
			options : options
		};
		//Redraws the graph once it's loaded
		//z.v.graphs[options.graphName].graph.reflow();

		//Redraw all the initialized graphs, as the width of the page might have changed.
		//Change of page width triggers change of width for the panel holding the graphs.
		z.reflowAll();

	}

	/**
	 * Connects to the server and does the first data load prior to the
	 * initializing of the graphs
	 * 
	 * @param options
	 */
	z.autoAddSeries = function(options) {
		z.v.tmp = z.v.tmp = z.v.tmp || {};
		var loadOptions = {
			url : z.getUrl(options),
			success : function(response) {
				z.v.tmp[options.graphName] = [];
				var lastType = options.type;
				var type = options.type.split('|');
				for ( var i in response) {
					if (typeof type[i] !== 'undefined') {
						lastType = type[i];
					}
					if (typeof response[i].target !== 'undefined') {
						var target = response[i].target;
						z.v.tmp[options.graphName].push({
							name : target,
							// Enable this if you don't want to see gaps in
							// graphs
							// connectNulls : true,
							type : type[i] || lastType,
							data : z.processDatapoints(response[i].datapoints,options)
						});
					}
				}
				z.delayStart(options);
			}

		};
		a.loadData(loadOptions);
	}

	/**
	 * Processes datapoints from graphite
	 * 
	 * @param datapoints
	 * @returns {Array}
	 */
	z.processDatapoints = function(datapoints,options) {
		var data = [];
		if (typeof(options) != 'undefined') {
			for ( var j in datapoints) {
				if ((datapoints[j][0] + '').toUpperCase() == 'NULL') {
					datapoints[j][0] = null;
				} else {
					datapoints[j][0] = parseInt(datapoints[j][0]);
				}
				var yPoint;
				if (options.postProcess) {
					yPoint = z[options["postProcess"]](datapoints[j][0]);
				} else {
					yPoint = datapoints[j][0];
				}
				var point = [parseInt(datapoints[j][1]) * 1000, yPoint];
				data.push(point);
			}
		}
		return data;
	}

	/**
	 * Creates the polling url
	 * 
	 * @param options
	 * @returns {String}
	 */
	z.getUrl = function(options) {
		var url = z.v.jsonUrl + '?' + options.urlAppend;
		var now = Math.round((Date.now() / 1000) - 1);
		//For now, hardcoded to the last 3h
		//var start = now - (3 * 60 * 60);
		//url += '&start=' + start + "&end=" + now;
		return url;
	}

	/**
	 * Processes the json response
	 * 
	 * @param response
	 * @param options
	 */
	z.processResponse = function(response, options) {
		for ( var i in response) {
			if (typeof response[i].datapoints !== 'undefined') {
				for ( var k in z.v.graphs) {
					if (k == options.graphName) {
						for ( var l in z.v.graphs[k].graph.series) {
							var target = response[i].target, graph = z.v.graphs[k].graph;
							if (graph.series[l].name == target) {
								graph.series[l].setData(z.processDatapoints(response[i].datapoints,options), true);
								//graph.reflow();
							}
						}
					}
				}
			}
		}
	}

	/**
	 * Reloads all the graphs
	 * 
	 * @param z
	 *            The plugin itself, so that it knows where to get the
	 *            information from and where to save it
	 */
	z.reloadAllGraphs = function(z) {
		for ( var i in z.v.graphs) {
			var options = z.v.graphs[i].options;
			var loadOptions = {
				url : z.getUrl(options),
				success : function(response) {
					z.processResponse(response, options);
				}
			};
			a.loadData(loadOptions);
		}
	}

	/**
	 * Calls reflow() for all the graphs
	 */
	z.reflowAll = function() {
		for ( var i in z.v.graphs) {
			z.v.graphs[i].graph.reflow();
		}
	}

	return a;
})(BFS || {
	plugins : {}
}, 'highcharts');

/**
 * Initializes the BFS
 */
$(document).ready(function() {
	BFS.init();
});

