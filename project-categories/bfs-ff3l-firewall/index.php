<?php
/**
 * BitLeaderFirewallStatistics
 *
 * The main index file
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
 */

$classFile= __DIR__ . '/../inc/ClassBitleaderFirewallStatistics.php';
if (file_exists($classFile) && is_readable($classFile)) {
	$classFile = realpath($classFile);
} else {
	die($classFile . ' doesn\'t exist.');
}

try {
	require_once($classFile);
	$bfs = new BitleaderFirewallStatistics();
} catch (Exception $e) {
	die('Error loading the core class file. The error was: ' . $e->getMessage());
}

$files = $bfs->getFiles();

?><!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>BFS</title>
		<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" />
		<link rel="shortcut icon" href="favicon.ico" />
		<link rel="shortcut icon" type="image.png" href="favicon.png" />
		<!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
	</head>
	<body>
		<?php require_once($bfs->config['modal']);?>
		<div class="navbar navbar-default navbar-fixed-top-disabled" role="navigation">
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand" href="<?php echo htmlentities($_SERVER['REQUEST_URI']);?>">Gateway 3</a>
				</div>
				<ul class="nav navbar-nav pull-right">
					<li><a href="#gw1" data-toggle="modal" data-target="#gw1">Gateway 1</a></li>
					<li><a href="#gw2" data-toggle="modal" data-target="#gw2">Gateway 2</a></li>
					<li><a href="#about" data-toggle="modal" data-target="#about">About</a></li>
				</ul>
			</div>
	    </div>
		<div class="container-fluid col-group">
			<div class="col-lg-6">
				<div
					class="panel panel-info load-highchart"
					id="highchart-total-throughput"
					data-source="json"
					data-ytitle=""
					data-type="line"
					data-stacking="percentage"
					data-legend="enabled"
					data-tooltip-convert="B"
					data-url="type=throughput"
				>
					<div class="panel-heading">
						<h4 class="panel-title">Total Throughput (iptables)
							<small>(stacked / stats for <?php echo $bfs->config['pubif'];?>)</small>
						</h4>
					</div>
					<div class="panel-body"></div>
				</div>
			</div>
			<div class="col-lg-6">
				<div
					class="panel panel-info load-highchart"
					id="collectd-if-<?php echo $bfs->config['pubif'];?>"
					data-source="json"
					data-ytitle=""
					data-url="type=collectd&folder=interface-<?php echo $bfs->config['pubif'];?>&metric=if_octets"
					data-legend="disabled"
					data-tooltip-convert="B"
				>
					<div class="panel-heading">
					<h4 class="panel-title">Total Throughput (collectd) <small>(stats for <?php echo $bfs->config['pubif'];?>)</small></h4>
					</div>
					<div class="panel-body"></div>
				</div>
			</div>
		</div>
		<div class="container-fluid col-group">
			<div class="col-lg-6">
				<div
					class="panel panel-default load-highchart"
					id="collectd-load"
					data-source="json"
					data-ytitle=""
					data-url="type=collectd&folder=cpu-0"
					data-legend="disabled"
					data-stacking="percentage"
					data-max-y=100
				>
					<div class="panel-heading">
					<h4 class="panel-title">CPU Average (collectd) <small>(stacked / stats for CPU0)</small></h4>
					</div>
					<div class="panel-body"></div>
				</div>
			</div>
			<div class="col-lg-6">
				<div
					class="panel panel-default load-highchart"
					id="collectd-load"
					data-source="json"
					data-ytitle=""
					data-url="type=collectd&folder=cpu-1"
					data-legend="disabled"
					data-stacking="percentage"
					data-max-y=100
				>
					<div class="panel-heading">
					<h4 class="panel-title">CPU Average (collectd) <small>(stacked / stats for CPU1)</small></h4>
					</div>
					<div class="panel-body"></div>
				</div>
			</div>
		</div>
		<div class="container-fluid col-group">
			<div class="col-lg-12">
				<div
					class="panel panel-default load-highchart"
					id="collectd-memory"
					data-source="json"
					data-ytitle=""
					data-url="type=collectd&folder=memory"
					data-legend="enabled"
					data-stacking="percentage"
					data-type="areaspline"
					data-tooltip-convert="B"
				>
					<div class="panel-heading">
					<h4 class="panel-title">Memory <small>(stacked)</small></h4>
					</div>
					<div class="panel-body"></div>
				</div>
			</div>
		</div>
		<div class="container-fluid col-group">
			<div class="col-lg-6">
				<div
					class="panel panel-default load-highchart"
					id="highcharts-total-bytes"
					data-source="json"
					data-ytitle=""
					data-alias="total"
					data-type="areaspline"
					data-stacking="percentage"
					data-tooltip-convert="B"
					data-url="type=bytes&start=<?php echo time()-(3*60*60);?>"
				>
					<div class="panel-heading">
						<h4 class="panel-title">Total Bytes (iptables)
							<small>(stacked / stats for <?php echo $bfs->config['pubif'];?>)</small>
						</h4>
					</div>
					<div class="panel-body"></div>
				</div>
			</div>
			<div class="col-lg-6">
				<div
					class="panel panel-default load-highchart"
					id="highcharts-total-packets"
					data-source="json"
					data-ytitle=""
					data-colors="#000000|#F28F43|#FE123A|#910000|#0f667a|#8bbc21"
					data-type="spline"
					data-url="type=packets&start=<?php echo time()-(3*60*60);?>"
				>
					<div class="panel-heading">
						<h4 class="panel-title">Total Packets (iptables)
							<small>(statistics for <?php echo $bfs->config['pubif'];?>)</small>
						</h4>
					</div>
					<div class="panel-body"></div>
				</div>
			</div>
		</div>
		<div class="container-fluid col-group">
			<div class="col-lg-6">
				<div
					class="panel panel-default load-highchart"
					id="highchart-collectd-df-root"
					data-source="json"
					data-ytitle=""
					data-type="areaspline"
					data-stacking="percentage"
					data-legend="enabled"
					data-tooltip-convert="B"
					data-url="type=collectd&folder=df-root"
				>
					<div class="panel-heading">
						<h4 class="panel-title">Disk Stats / (collectd)
							<small>(stacked)</small>
						</h4>
					</div>
					<div class="panel-body"></div>
				</div>
			</div>
			<div class="col-lg-6">
				<div
					class="panel panel-default load-highchart"
					id="highchart-collectd-disk-vda"
					data-source="json"
					data-ytitle=""
					data-legend="disabled"
					data-url="type=collectd&folder=disk-vda&metric=disk_ops"
					data-type="line"
				>
					<div class="panel-heading">
					<h4 class="panel-title">Disk IOPS (collectd) <small>(stats for /dev/vda)</small></h4>
					</div>
					<div class="panel-body"></div>
				</div>
			</div>
		</div>
		<script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
		<script type="text/javascript" src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="//code.highcharts.com/highcharts.js"></script>
		<script type="text/javascript" src="bfs.js"></script>
	</body>
</html>

