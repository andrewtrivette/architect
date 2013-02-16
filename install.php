<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Architect Cms</title>
</head>

<body>
<?php
$json = file_get_contents('configure.inc');
$options = json_decode($json, true);
?>
<form action="" method="post">
<?
foreach ($options as $key => $value) {
	echo '<input type="text" name="options['.$key.']" value="'.$value.'" /><br />';
}
?>
<button type="submit" name="submit" value="submit">Save Configuration</button>
</form>
</body>
</html>