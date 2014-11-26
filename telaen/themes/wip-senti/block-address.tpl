{config_load file=$umLanguageFile section="BlockSender"}

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title>UebiMiau - {$umLabel.blk_title}</title>
	<link rel="stylesheet" href="themes/default/webmail.css" type="text/css">
	<meta http-equiv="Content-Type" content="text/html; charset={$umLabel.default_char_set}">
</head>

<body bgcolor="#778899" text="#FFFFFF" link="#FFFFFF" vlink="#FFFFFF" alink="#FFFFFF">

<form name=form1 action="block_address.php" method=POST>
	<input type=hidden name=sid value="{$umSid}">
	<input type=hidden name=lid value="{$umLid}">
	<input type=hidden name=ix value="{$umIx}">
	<input type=hidden name=folder value="{$umFolder|escape:"html"}">

<table width="500" border="0" cellspacing="0" cellpadding="0">

	<tr>
		<td class=default  width="100%" align=center>
		<b>{$umLabel.blk_information}</b><br><br>
		</td>
	</tr>

	{if $umAvailableAddresses gt 0 }
		<tr>
			<td class=headers><b>{$umLabel.blk_email}</b></td>
		</tr>
		{section name=i loop=$umAddressList}
			<tr>
				<td class=default valign=top><input type="checkbox" name="fFilter[]" checked value="{$umAddressList[i].index}">{$umAddressList[i].mail}</td>
			</tr>
		{/section}
		<tr>
			<td class=cent><br><br><input type=submit name=submit class=button value="{$umLabel.blk_save}"></td></tr>
	{else}
		<tr>
			<td class=cent>{$umLabel.blk_no_address}</td>
		<tr>
			<td class=cent><br><br><a href="javascript:self.close()">{$umLabel.blk_close}</a></td></tr>
	{/if}

</table>
</form>
</body>
</html>
