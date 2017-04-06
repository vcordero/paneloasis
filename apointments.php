<?php

session_start();
if ($_SESSION['user'] == "") {
	
	header("Location: index.php");
}

include 'config.php';

$SqlStat = "SELECT * FROM cats";
$result = mysql_query($SqlStat);

$SqlStat2 = "SELECT * FROM unitmeasure";
$result2 = mysql_query($SqlStat2);

$SqlStat3 = "SELECT * FROM suppliers";
$result3 = mysql_query($SqlStat3);

if(isset($_POST['submit']))
{
	//print_r($_POST);
	extract($_POST);
	$end=$start;
	$starttime=$sh.":".$sm.":00";
	$endtime=$eh.":".$em.":00";

	$sql="INSERT INTO events(title,start,end,starttime,endtime) values('".$title."','".$start."','".$end."','".$starttime."','".$endtime."')";
	if(mysql_query($sql))
		echo "<font color='#009900'>Event Added</font>";
	else
		echo "<font color='#990000'>Error: ".mysql_error()."</font>";
}

?>

				<div class="page-header">
							<h1>
								Apoinments
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
<link href='fullcalendar/fullcalendar.css' rel='stylesheet' />
<link href='fullcalendar/fullcalendar.print.css' rel='stylesheet' media='print' />
<script src='fullcalendar/lib/moment.min.js'></script>
<script src='fullcalendar/lib/jquery.min.js'></script>
<script src='fullcalendar/lib/jquery-ui.js'></script>
<script src='fullcalendar/fullcalendar.min.js'></script>
<script>

	$(document).ready(function() {

		$( "#datepicker" ).datepicker({ dateFormat: "yy-mm-dd" });
	
		$('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
			defaultDate: '2015-01-02',
			editable: true,
			eventLimit: true, // allow "more" link when too many events
			events: {
				url: 'fullcalendar/php/get-events.php',
				error: function() {
					$('#script-warning').show();
				}
			},			
			loading: function(bool) {
				$('#loading').toggle(bool);
			}
		});

		
	});

</script>
<style>

	body {
		margin: 0;
		padding: 0;
		font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
		font-size: 14px;
	}

	#script-warning {
		display: none;
		background: #eee;
		border-bottom: 1px solid #ddd;
		padding: 0 10px;
		line-height: 40px;
		text-align: center;
		font-weight: bold;
		font-size: 12px;
		color: red;
	}

	#loading {
		display: none;
		position: absolute;
		top: 10px;
		right: 10px;
	}

	#calendar {
		max-width: 900px;
		margin: 40px auto;
		padding: 0 10px;
	}

</style>

	<div id='script-warning'>
		<code>fullcalendar/php/get-events.php</code> must be running.
	</div>

	<div id='loading'>loading...</div>

	<div id='calendar'></div>


	<div id='form'>
		<form name='event_form' action='<?php echo $_SERVER['PHP_SELF'];?>' method='post'>
			<table>
				<tr>
				<td>Title</td>
				<td colspan=3>
				<input name='title' size=50 maxsize='1024'>
				</td>
				</tr>
				<tr>
				<td>
				Date
				</td>
				<td>
				<input name='start' maxsize='10' id="datepicker">
				</td>
				</tr>
				<tr>
				<td>Start Time</td>
				<td>
				<select name='sh'>
				<?php for($i=0;$i<24;$i++) 
					{
						if($i<10)
							echo "<option value=\"0".$i."\">0".$i."</option>";
						else
							echo "<option value=\"".$i."\">".$i."</option>";
					}
				?>
				</select>
				<select name="sm">
				<?php
				      for($i=0;$i<60;$i++) 
					{
						if($i<10)
							echo "<option value=\"0".$i."\">0".$i."</option>";
						else
							echo "<option value=\"".$i."\">".$i."</option>";
					}
				 ?>
				</select>
				</td>

				<td>End Time</td>
				<td>
				<select name='eh'>
				<?php for($i=0;$i<24;$i++) 
					{
						if($i<10)
							echo "<option value=\"0".$i."\">0".$i."</option>";
						else
							echo "<option value=\"".$i."\">".$i."</option>";
					}
				?>
				</select>
				<select name="em">
				<?php
				      for($i=0;$i<60;$i++) 
					{
						if($i<10)
							echo "<option value=\"0".$i."\">0".$i."</option>";
						else
							echo "<option value=\"".$i."\">".$i."</option>";
					}
				 ?>
				</select>
				</td>

				</tr>
				<tr align="center">
				<td clospan=4>
				<input name="p" value="apointments" type="hidden">
				<input name='submit' value='Save' type='submit'>
				</td>
				</tr>
			</table>
		</form>
	</div>
