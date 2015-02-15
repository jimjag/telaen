{config_load file=$umLanguageFile section="Catch"}

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title>UebiMiau - {$smLabel.ctc_title}</title>
	<link rel="stylesheet" href="inc/themes/default/webmail.css" type="text/css">
	<meta http-equiv="Content-Type" content="text/html; charset={$smLabel.default_char_set}">
</head>

<body bgcolor="#778899" text="#FFFFFF" link="#FFFFFF" vlink="#FFFFFF" alink="#FFFFFF">

<form name=form1 action="catch.php" method=POST>
	<input type=hidden name=sid value="{$umSid}">
	<input type=hidden name=lid value="{$umLid}">
	<input type=hidden name=ix value="{$umIx}">
	<input type=hidden name=folder value="{$umFolder|escape:"html"}">

<table width="500" border="0" cellspacing="0" cellpadding="0">

	<tr>
		<td class=default  width="100%" colspan=2 align=center>
		<b>{$smLabel.ctc_information}</b><br><br>
		</td>
	</tr>

	{if $umAvailableAddresses gt 0 }
		<tr>
			<td class=headers width="60%"><b>{$smLabel.ctc_name}</b></td>
			<td class=headers><b>{$smLabel.ctc_email}</b></td>
		</tr>
		{section name=i loop=$smAddressList}
			<tr>
				<td class=default valign=top><input type=checkbox name=ckaval[] checked value={$smAddressList[i].index}>{$smAddressList[i].name|truncate:30:"...":true|escape:"html"}</td>
				<td class=default>{$smAddressList[i].mail}</td>
			</tr>
		{/section}
		<tr>
			<td class=cent colspan=2><br><br><input type=submit name=submit class=button value="{$smLabel.ctc_save}"></td></tr>
	{else}
		<tr><td class=cent>{$smLabel.ctc_no_address}</td></tr>
		<tr><td class=cent><br><br><a href="javascript:self.close()">{$smLabel.ctc_close}</a></td></tr>
	{/if}

</table>
</form>
</body>
</html>
