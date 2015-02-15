{config_load file=$umLanguageFile section="Error"}
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<title>UebiMiau Webmail - {$smLabel.err_title}</title>
	<meta http-equiv="Content-Type" content="text/html; charset={$smLabel.default_char_set}">
	<link rel="stylesheet" href="inc/themes/webmail/css.css" type="text/css">
</head>
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
<tr><td valign="middle" align="center">
<table width="750" border="0" cellspacing="0" cellpadding="0" class="frame" align="center">

	<tr><td class=top><img src="inc/themes/webmail/images/logo.gif" border="0""></td></tr>
	<tr><td><img src="inc/themes/webmail/images/bandeau-h.gif" border="0"></td></tr>
	<tr>
		<td background="inc/themes/webmail/images/ligne-fond.gif">
			<table width="450" border="0" cellspacing="1" cellpadding="1" align="center">
				<tr><td align="center"><br><font color="red">.: <b>{$smLabel.err_title}</b> :.</font><br></td></tr>
				<tr><td>&nbsp;</td></tr>
				<tr><td align="center">{$smLabel.err_msg}<br><br>
				<small>{$smLabel.err_system_msg}
				{if $umErrorCode eq "1"}{$smLabel.error_connect}
				{elseif $umErrorCode eq "2"}{$smLabel.error_retrieving}
				{else}{$smLabel.error_other}{/if}</small></td></tr>
				<tr><td>&nbsp;</td></tr>
				<tr><td align="center">> <a href="logout.php?sid={$umSid}&tid={$umTid}&lid={$umLid}" class="lien">{$smLabel.err_exit}</a> <</td></tr>
				<tr><td>&nbsp;</td></tr>
			</table>
		</td>
	</tr>
	<tr>
		<td class=bot>
			<img src="inc/themes/webmail/images/bandeau-b.gif" border="0" width="750" height="25">
		</td>
	<tr>
</table>
</td></tr>
</table>
</body>
</html>
