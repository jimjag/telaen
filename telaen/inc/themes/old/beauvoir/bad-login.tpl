{config_load file=$umLanguageFile section="BadLogin"}

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset={$smLabel.default_char_set}">
<title>UebiMiau Webmail &copy 2003 - Skin by Beauvoir.net - {$smLabel.bdl_title}</title>
<link rel="stylesheet" href="inc/themes/beauvoir/webmail.css" type="text/css">
</head>
{$smJS}
<!--
Skinned by Arnaud BEAUVOIR -  - 

Thank you to let the copyright in place on the login page and in all sources of pages.
This skin is the work of an author, thank you to respect it and not to remove the
copyright, or worse, to put your name at the place.
-->
<body>
<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0" align="center">
<tr><td valign="middle" align="center">
<table width="750" border="0" cellspacing="1" cellpadding="0" class="normal" align="center" bgcolor="#999999">
	<tr>
		<td align="center"><img src="inc/themes/beauvoir/logo.gif" border="0" alt="Beauvoir Skin"></td>
	</tr>
</table>
<br><br>
<table width="750" border="0" cellspacing="1" cellpadding="0" class="normal" align="center" bgcolor="#999999">
	<tr>
		<td align="left" bgcolor="#EAEAEA" height="30">
		<font class="error">&nbsp;<b>{$smLabel.bdl_title}</b></font>
		</td>
	</tr>
	<tr bgcolor="#F5F4F4">
		<td	align="center">
		<br>
		{$smLabel.bdl_msg}<br>{$umServerResponse}<br>
		<br>
		> <a href="./index.php?tid={$umTid}&lid={$umLid}">{$smLabel.bdl_back}</a> <<br>
		<br>
		</td>
	</tr>
	<tr>
		<td align="center" bgcolor="#EAEAEA" height="30">
		<font class="normal">Webmail powered by <a href="http://uebimiau.sourceforge.net" target="_blank">Uebimiau</a> - Skinned by <a href="" target="_blank">Beauvoir</a></font>		</td>
	</tr>
</td>
</table>
</body>
</html>
