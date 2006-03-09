<html>
<?php
extract($_SERVER);
?>
<head>
	<meta http-equiv="refresh" content="0; url=<?php echo $QUERY_STRING; ?>">
</head>
<br>
<blockquote>
<a href="<?php echo $QUERY_STRING; ?>"><?php echo $QUERY_STRING; ?></a>
</blockquote>

</html>
