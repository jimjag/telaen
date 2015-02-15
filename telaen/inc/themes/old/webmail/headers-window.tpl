{config_load file=$umLanguageFile section="Headers"}
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title>UebiMiau Webmail - {$smCCList|escape:"html"}</title>
	<meta http-equiv="Content-Type" content="text/html; charset={$smLabel.default_char_set}">
	<link rel="stylesheet" href="inc/themes/beauvoir/css.css" type="text/css">
</head>
<body>
<br>
<table width="95%" border="0" cellspacing="1" cellpadding="0" align="center" bgcolor="#2D3443" class="normal">
	<tr bgcolor="#BFC6D3">
		<td>{$smHeaders}</td>
	</tr>
</table>
<br>
</body>
</html>
