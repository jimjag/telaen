{config_load file=$umLanguageFile section="AddressBook"}

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset={$smLabel.default_char_set}">
<title>UebiMiau Webmail &copy 2003 - Skin by Beauvoir.net - {$smLabel.adr_title}</title>
<link rel="stylesheet" href="inc/themes/beauvoir/webmail.css" type="text/css">
<script language="JavaScript" src="inc/themes/beauvoir/webmail.js" type="text/javascript"></script>
</head>
{$smJS}
<!--
Skinned by Arnaud BEAUVOIR -  - 

Thank you to let the copyright in place on the login page and in all sources of pages.
This skin is the work of an author, thank you to respect it and not to remove the
copyright, or worse, to put your name at the place.
-->
<body>
<br><br>
<table width="750" border="0" cellspacing="1" cellpadding="0" class="normal" align="center" bgcolor="#999999">
	<tr>
		<td align="center"><img src="inc/themes/beauvoir/logo.gif" border="0" alt="Beauvoir Skin"></td>
	</tr>
</table>
<br><br>
<table width="750" border="0" cellspacing="1" cellpadding="0" class="normal" align="center" bgcolor="#999999">
	<tr>
		<td valign="middle">
			<table cellspacing="0" cellpadding="0" width="100%" border="0" class="normal" >
				<tr><td align="center" valign="middle" bgcolor="#EAEAEA" height="70" width="84" onmouseover="mOvr(this,'#ACB6D1');" onmouseout="mOut(this,'#EAEAEA');" onclick="mClk(this);"><a href="javascript:goinbox()"><img src="inc/themes/beauvoir/inbox.gif" border="0" width="31" height="31"><br>{$smLabel.messages_mnu}</a></td>
				<td align="center" valign="middle" bgcolor="#EAEAEA" height="70" width="84" onmouseover="mOvr(this,'#ACB6D1');" onmouseout="mOut(this,'#EAEAEA');" onclick="mClk(this);"><a href="javascript:newmsg()"><img src="inc/themes/beauvoir/write.gif" border="0" width="31" height="31"><br>{$smLabel.compose_mnu}</a></td>
				<td align="center" valign="middle" bgcolor="#EAEAEA" height="70" width="84"><font class="inactive"><img src="inc/themes/beauvoir/refresh.gif" border="0" width="31" height="31"><br>{$smLabel.refresh_mnu}</font></td>
				<td align="center" valign="middle" bgcolor="#EAEAEA" height="70" width="83" onmouseover="mOvr(this,'#ACB6D1');" onmouseout="mOut(this,'#EAEAEA');" onclick="mClk(this);"><a href="javascript:folderlist()"><img src="inc/themes/beauvoir/folder.gif" border="0" width="31" height="31"><br>{$smLabel.folders_mnu}</a></td>
				<td align="center" valign="middle" bgcolor="#EAEAEA" height="70" width="83" onmouseover="mOvr(this,'#ACB6D1');" onmouseout="mOut(this,'#EAEAEA');" onclick="mClk(this);"><a href="javascript:search()"><img src="inc/themes/beauvoir/search.gif" border="0" width="31" height="31"><br>{$smLabel.search_mnu}</a></td>
				<td align="center" valign="middle" bgcolor="#EAEAEA" height="70" width="83" onmouseover="mOvr(this,'#ACB6D1');" onmouseout="mOut(this,'#EAEAEA');" onclick="mClk(this);"><a href="javascript:addresses()"><img src="inc/themes/beauvoir/contact.gif" border="0" width="31" height="31"><br>{$smLabel.address_mnu}</a></td>
				<td align="center" valign="middle" bgcolor="#EAEAEA" height="70" width="83" onmouseover="mOvr(this,'#ACB6D1');" onmouseout="mOut(this,'#EAEAEA');" onclick="mClk(this);"><a href="javascript:emptytrash()"><img src="inc/themes/beauvoir/trash.gif" border="0" width="31" height="31"><br>{$smLabel.empty_trash_mnu}</a></td>
				<td align="center" valign="middle" bgcolor="#EAEAEA" height="70" width="83" onmouseover="mOvr(this,'#ACB6D1');" onmouseout="mOut(this,'#EAEAEA');" onclick="mClk(this);"><a href="javascript:prefs()"><img src="inc/themes/beauvoir/prefs.gif" border="0" width="31" height="31"><br>{$smLabel.prefs_mnu}</a></td>
				<td align="center" valign="middle" bgcolor="#EAEAEA" height="70" width="83" onmouseover="mOvr(this,'#ACB6D1');" onmouseout="mOut(this,'#EAEAEA');" onclick="mClk(this);"><a href="javascript:goend()"><img src="inc/themes/beauvoir/logout.gif" border="0" width="31" height="31"><br>{$smLabel.logoff_mnu}</a></td></tr>
			</table>		
		</td>
	</tr>
	<tr>
		<td valign="top">
			<form name="form1" method="post" action="addressbook.php">
			<input type="hidden" name="sid" value="{$umSid}">
			<input type="hidden" name="id" value="{$smAddrID}">
			<input type="hidden" name="lid" value="{$umLid}">
			<input type="hidden" name="tid" value="{$umTid}">
			<input type="hidden" name="opt" value="{$smOpt}">
			<table cellspacing="1" cellpadding="0" width="100%" border="0" class="normal" bgcolor="#F5F4F4" align="center">
				<tr>
					<td>&nbsp;</td>
				</tr>
				<tr><td>
					<table cellspacing="1" cellpadding="0" width="350" border="0" class="normal" bgcolor="#EAEAEA" align="center">
						<tr><td width="40%">{$smLabel.adr_name} :</td><td><input type="text" size="40" class="normal" name="name" value="{$smAddrName|escape:"html"}"></td></tr>
						<tr><td>{$smLabel.adr_email} :</td><td><input type="text" size="40" class="normal" name="email" value="{$smAddrEmail|escape:"html"}"></td></tr>
						<tr><td>{$smLabel.adr_street} :</td><td><input type="text" size="40" class="normal" name="street" value="{$smAddrStreet|escape:"html"}"></td></tr>
						<tr><td>{$smLabel.adr_city} :</td><td><input type="text" size="40" class="normal" name="city" value="{$smAddrCity|escape:"html"}"></td></tr>
						<tr><td>{$smLabel.adr_state} :</td><td><input type="text" size="40" class="normal" name="state" value="{$smAddrState|escape:"html"}" maxlength=2></td></tr>
						<tr><td>{$smLabel.adr_work} :</td><td><input type="text" size="40" class="normal" name="work" value="{$smAddrWork|escape:"html"}"></td></tr>
						<tr><td>&nbsp;</td><td><input type="submit" value="{$smLabel.adr_save}" class="normal">&nbsp;<input type="button" value="{$smLabel.adr_back}" class="normal" onClick="location = '{$smGoBack}'"></td></tr>
					</table>
				</td></tr>
				<tr>
					<td>&nbsp;</td>
				</tr>
			</table>
			</form>
		</td>
	</tr>
	<tr>
		<td align="center" bgcolor="#EAEAEA" height="30">
		<font class="normal">Webmail powered by <a href="http://uebimiau.sourceforge.net" target="_blank">Uebimiau</a> - Skinned by <a href="" target="_blank">Beauvoir</a></font>
		</td>
	</tr>
</table>
<br><br>
</body>
</html>
