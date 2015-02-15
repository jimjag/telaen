{config_load file=$umLanguageFile section="BlockSender"}

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title>UebiMiau - {$smLabel.blk_title}</title>
	<link rel="stylesheet" href="inc/themes/default/webmail.css" type="text/css">
	<meta http-equiv="Content-Type" content="text/html; charset={$smLabel.default_char_set}">
</head>

<body bgcolor="#778899" text="#FFFFFF" link="#FFFFFF" vlink="#FFFFFF" alink="#FFFFFF">

<form name=form1 action="block_address.php" method=POST>
	<input type=hidden name=sid value="{$umSid}">
	<input type=hidden name=lid value="{$umLid}">
	<input type=hidden name=ix value="{$smIx}">
	<input type=hidden name=folder value="{$smFolder|escape:"html"}">

<table width="500" border="0" cellspacing="0" cellpadding="0">

	<tr>
		<td class=default  width="100%" align=center>
		<b>{$smLabel.blk_information}</b><br><br>
		</td>
	</tr>

	{if $smAvailableAddresses gt 0 }
		<tr>
			<td class=headers><b>{$smLabel.blk_email}</b></td>
		</tr>
		{section name=i loop=$smAddressList}
			<tr>
				<td class=default valign=top><input type="checkbox" name="fFilter[]" checked value="{$smAddressList[i].index}">{$smAddressList[i].mail}</td>
			</tr>
		{/section}
		<tr>
			<td class=cent><br><br><input type=submit name=submit class=button value="{$smLabel.blk_save}"></td></tr>
	{else}
		<tr>
			<td class=cent>{$smLabel.blk_no_address}</td>
		<tr>
			<td class=cent><br><br><a href="javascript:self.close()">{$smLabel.blk_close}</a></td></tr>
	{/if}

</table>
</form>
</body>
</html>
