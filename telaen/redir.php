<?php
// very bad method to get params... the url is passed without the param name...
$url = $_SERVER['QUERY_STRING'];
?>
<html>
<head>
	<meta http-equiv="refresh" content="0; url=<?php echo $url; ?>">
</head>
<br>
<blockquote>
<a href="<?php echo $url; ?>"><?php echo $url; ?></a>
</blockquote>

</html>
