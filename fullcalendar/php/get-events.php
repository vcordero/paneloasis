<?php

//--------------------------------------------------------------------------------------------------
// This script reads event data from a JSON file and outputs those events which are within the range
// supplied by the "start" and "end" GET parameters.
//
// An optional "timezone" GET parameter will force all ISO8601 date stings to a given timezone.
//
// Requires PHP 5.2.0 or higher.
//--------------------------------------------------------------------------------------------------

// Require our Event class and datetime utilities
require dirname(__FILE__) . '/utils.php';

// Short-circuit if the client did not give us a date range.
if (!isset($_GET['start']) || !isset($_GET['end'])) {
	die("Please provide a date range.");
}

// Parse the start/end parameters.
// These are assumed to be ISO8601 strings with no time nor timezone, like "2013-12-29".
// Since no timezone will be present, they will parsed as UTC.
$range_start = parseDateTime($_GET['start']);
$range_end = parseDateTime($_GET['end']);

// Parse the timezone parameter if it is present.
$timezone = null;
if (isset($_GET['timezone'])) {
	$timezone = new DateTimeZone($_GET['timezone']);
}

$tz='-05:00';

// Read and parse our events JSON file into an array of event data arrays.
//$json = file_get_contents(dirname(__FILE__) . '/../json/events.json');
//$input_arrays = json_decode($json, true);
require_once("../../config.php");
$sql="select * from events where start >= '".$_GET['start'] ."' and end <= '".$_GET['end']."' ";
//echo $sql;
$res=mysql_query($sql);
$input_arrays=array();
while( $row=mysql_fetch_array($res))
{
	$row2['title']=$row['title'];
	$row2['start']=$row['start']; 
	if(!empty($row['starttime']) && !is_null($row['starttime']) )
		$row2['start'] .= 'T'.$row['starttime'] . $tz;
	if(!empty($row['end']))
	{
		$row2['end']=$row['end']; 
		if(!empty($row['endtime']) && !is_null($row['endtime']) )
			$row2['end'] .= 'T'.$row['endtime'] . $tz;
	}
	$input_arrays[]=$row2;
	unset($row2);
}

// Accumulate an output array of event data arrays.
$output_arrays = array();
foreach ($input_arrays as $array) {

	// Convert the input array into a useful Event object
	$event = new Event($array, $timezone);

	// If the event is in-bounds, add it to the output
	if ($event->isWithinDayRange($range_start, $range_end)) {
		$output_arrays[] = $event->toArray();
	}
}

// Send JSON to the client.
echo json_encode($output_arrays);
