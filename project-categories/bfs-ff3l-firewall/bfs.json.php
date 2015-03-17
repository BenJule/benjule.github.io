<?php
/**
 * BitLeaderFirewallStatistics
 *
 * The json metrics generator
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

$coreFile = __DIR__ . '/../inc/ClassBitleaderFirewallStatistics.php';
if ((!file_exists($coreFile))||(!is_readable($coreFile))) {
	die ($coreFile . ' doesn\'t exist.');
}

try {
	require_once($coreFile);
	$bfs = new BitleaderFirewallStatistics();
} catch (Exception $e) {
	die('Error loading the core class file. The error was: ' . $e->getMessage());
}


$values = array();

if (isset($_REQUEST['type'])) {
	try {
		$bfs->setMetricType($_REQUEST['type']);
	} catch (Exception $e) {
		$values[] = $e->getMessage();
	}
}

if (isset($_REQUEST['folder'])) {
	try {
		$bfs->setMetricFolder($_REQUEST['folder']);
	} catch (Exception $e) {
		$values[] = $e->getMessage();
	}
}

if (isset($_REQUEST['metric'])) {
	try {
		$bfs->setMetricFile($_REQUEST['metric']);
	} catch (Exception $e) {
		$values[] = $e->getMessage();
	}
}

if (isset($_REQUEST['start'])) {
	try {
		$bfs->setStart($_REQUEST['start']);
	} catch (Exception $e) {
		$values[] = $e->getMessage();
	}
}

if (isset($_REQUEST['end'])) {
	try {
		$bfs->setEnd($_REQUEST['end']);
	} catch (Exception $e) {
		$values[] = $e->getMessage();
	}
}

$files = $bfs->getFiles();
$types = $bfs->types;

//Request for data from a specific database
if (isset($_REQUEST['file']) && in_array($_REQUEST['file'],$files)) {
	$values[] = $bfs->getValues($_REQUEST['file']);
} elseif (!isset($_REQUEST['file'])) {
	foreach ($files AS $file) {
		try {
			$values[] = $bfs->getValues($file);
		} catch (Exception $e) {
			$values[] = 'Error loading ' . $file . '. The Exception message is: ' . $e->getMessage();
		}
	}
} else {
	$values[] = 'The database filename requested is invalid.';
}

header('Content-Type: application/json');

echo json_encode($values);

