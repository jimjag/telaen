{config_load file=$umLanguageFile section="Catch"}

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset={$smLabel.default_char_set}">
<title>UebiMiau Webmail &copy 2003 - Skin by Beauvoir.net - {$smLabel.ctc_title}</title>
<link rel="stylesheet" href="inc/themes/beauvoir/webmail.css" type="text/css">
</head>

<!--
Skinned by Arnaud BEAUVOIR -  - 

Thank you to let the copyright in place on the login page and in all sources of pages.
This skin is the work of an author, thank you to respect it and not to remove the
copyright, or worse, to put your name at the place.
-->
<body>

<form name="form1" action="catch.php" method="POST">
	<input type="hidden" name="sid" value="{$umSid}">
	<input type="hidden" name="lid" value="{$umLid}">
	<input type="hidden" name="ix" value="{$smIx}">
	<input type="hidden" name="folder" value="{$smFolder|escape:"html"}">
<br><br>
<table width="500" border="0" cellspacing="1" cellpadding="0" class="normal" align="center" bgcolor="#999999">
	<tr>
		<td height="30" width="100%" colspan="2" align="center" valign="middle"><b>{$smLabel.ctc_information}</b></td>
	</tr>
	{if $smAvailableAddresses gt 0 }
	<tr bgcolor="#EAEAEA">
		<td width="60%" align="center" valign="middle"><b>{$smLabel.ctc_name}</b></td>
		<td align="center" valign="middle"><b>{$smLabel.ctc_email}</b></td>
	</tr>
	{section name=i loop=$smAddressList}
	<tr bgcolor="#EAEAEA">
		<td valign="middle"><input type="checkbox" name="ckaval[]" checked value="{$smAddressList[i].index}">{$smAddressList[i].name|truncate:30:"...":true|escape:"html"}</td>
		<td align="center" valign="middle">{$smAddressList[i].mail}</td>
	</tr>
	{/section}
	<tr bgcolor="#EAEAEA">
		<td align="center" valign="middle" colspan="2"><br><input type="submit" name="submit" class="normal" value="{$smLabel.ctc_save}"><br><br></td>
	</tr>
	{else}
	<tr bgcolor="#EAEAEA">
		<td align="center" valign="middle" colspan="2">{$smLabel.ctc_no_address}</td>
	</tr>
	<tr bgcolor="#EAEAEA">
		<td align="center" valign="middle" colspan="2">> <a href="javascript:self.close()">{$smLabel.ctc_close}</a> <</td>
	</tr>
	{/if}
	<tr>
		<td align="center" bgcolor="#EAEAEA" height="30" colspan="2">
		<font class="normal">Webmail powered by <a href="http://uebimiau.sourceforge.net" target="_blank">Uebimiau</a> - Skinned by <a href="" target="_blank">Beauvoir</a></font>
		</td>
	</tr>
</table>
</form>
</body>
</html>
