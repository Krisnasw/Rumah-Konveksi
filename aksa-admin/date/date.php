<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<title>jQuery UI Datepicker - Display multiple months</title>
	<link type="text/css" href="jquery-ui.css" rel="stylesheet" />
	<script type="text/javascript" src="jquery-1.4.2.js"></script>
	<script type="text/javascript" src="jquery.ui.core.js"></script>
	<script type="text/javascript" src="jquery.ui.datepicker.js"></script>
	<link type="text/css" href="demos.css" rel="stylesheet" />
	<script type="text/javascript">
	$(function() {
$( "#from" ).datepicker({
altField: '#fr', 
altFormat: 'd',
showOn: 'button',
			buttonImage: 'images/calendar.gif',
			buttonImageOnly: true,
defaultDate: "+1w",
changeMonth: true,
numberOfMonths: 1,
dateFormat: "d MM, yy",
onClose: function( selectedDate ) {
$( "#to" ).datepicker( "option", "minDate", selectedDate );
}
});
$( "#to" ).datepicker({ 
altField: '#t', 
altFormat: 'd',
showOn: 'button',
			buttonImage: 'images/calendar.gif',
			buttonImageOnly: true,
defaultDate: "+1w",
changeMonth: true,
numberOfMonths: 1,
dateFormat: "d MM, yy",
onClose: function( selectedDate ) {
$( "#from" ).datepicker( "option", "maxDate", selectedDate );
}
});
});
	</script>
</head>
<body>

<div class="demo">

<label for="from">Check in</label><br>
<input type="text" id="fr" name="fr"/>
<input type="text" id="from" name="from"/><br>
<label for="to">Check out</label><br>
<input type="text" id="t" name="t"/>
<input type="text" id="to" name="to"/><br>
<?php
$f = '[fr]';
$t = '[t]';
$v = $t + $f;
echo "$v";
?>

</div><!-- End demo -->

</body>
</html>
