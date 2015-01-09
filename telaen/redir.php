<?php
define('I_AM_TELAEN', basename($_SERVER['SCRIPT_NAME']));

require './inc/class/class.Telain_core.php';

// very bad method to get params... the url is passed without the param name...
$url = Telaen_core::create_abs_url($_SERVER['QUERY_STRING']);
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
