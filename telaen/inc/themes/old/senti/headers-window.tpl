
{config_load file=$umLanguageFile section="Headers"}

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title>sentiMail - {$umPageTitle|escape:"html"}</title>
	<meta http-equiv="Content-Type" content="text/html; charset={$umLabel.default_char_set}">
</head>
<link rel="stylesheet" href="inc/themes/default/webmail.css" type="text/css">
<body bgcolor="#778899" text="#000000" link="#FFFFFF" vlink="#FFFFFF" alink="#FFFFFF">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td bgcolor=white><font face="Courier New" size=2>{$umHeaders}</font></td>
</table>
</body>
</html>
