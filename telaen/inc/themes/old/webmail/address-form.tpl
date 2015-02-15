{config_load file=$umLanguageFile section="AddressBook"}
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title>UebiMiau Webmail - {$smLabel.adr_title}</title>
	<meta http-equiv="Content-Type" content="text/html; charset={$smLabel.default_char_set}">
	<link rel="stylesheet" href="inc/themes/webmail/css.css" type="text/css">
	<script language="JavaScript" src="inc/themes/webmail/js.js" type="text/javascript"></script>
</head>
{$smJS}
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
<tr><td valign="middle" align="center">
<table width="750" border="0" cellspacing="0" cellpadding="0" class="frame" align="center">

	<tr><td class=top><img src="inc/themes/webmail/images/logo.gif" border="0""></td></tr>
	<tr><td><img src="inc/themes/webmail/images/bandeau-h.gif" border="0"></td></tr>
	<tr>
		<td background="inc/themes/webmail/images/ligne-fond.gif">
			<table cellspacing="0" cellpadding="0" width="99.7%" border="0" class="normal" align="center">
<tr>
					<td align="center" valign="bottom" bgcolor="#ffffff" height="50" width="83" onmouseover="mOvr(this,'#ffffff');" onmouseout="mOut(this,'#ffffff');" onclick="mClk(this);"><a class="lien" href="javascript:goinbox()"><img src="inc/themes/webmail/images/inbox.gif"><br /><br /><font style="font-size: 10px;">{$smLabel.messages_mnu}</font></a></td>
					<td align="center" valign="bottom" bgcolor="#ffffff" height="50" width="83" onmouseover="mOvr(this,'#ffffff');" onmouseout="mOut(this,'#ffffff');" onclick="mClk(this);"><a class="lien" href="javascript:newmsg()"><img src="inc/themes/webmail/images/newmsg.gif"><br /><br /><font style="font-size: 10px;">{$smLabel.compose_mnu}</font></a></td>
					<td align="center" valign="bottom" bgcolor="#ffffff" height="50" width="83" onmouseover="mOvr(this,'#ffffff');" onmouseout="mOut(this,'#ffffff');" onclick="mClk(this);"><a class="lien" href="javascript:refreshlist()"><img src="inc/themes/webmail/images/refresh.gif"><br /><br /><font style="font-size: 10px;">{$smLabel.refresh_mnu}</font></a></td>
					<td align="center" valign="bottom" bgcolor="#ffffff" height="50" width="83" onmouseover="mOvr(this,'#ffffff');" onmouseout="mOut(this,'#ffffff');" onclick="mClk(this);"><a class="lien" href="javascript:folderlist()"><img src="inc/themes/webmail/images/folder.gif"><br /><br /><font style="font-size: 10px;">{$smLabel.folders_mnu}</font></a></td>
					<td align="center" valign="bottom" bgcolor="#ffffff" height="50" width="83" onmouseover="mOvr(this,'#ffffff');" onmouseout="mOut(this,'#ffffff');" onclick="mClk(this);"><a class="lien" href="javascript:search()"><img src="inc/themes/webmail/images/search.gif"><br /><br /><font style="font-size: 10px;">{$smLabel.search_mnu}</font></a></td>
					<td align="center" valign="bottom" bgcolor="#ffffff" height="50" width="83" onmouseover="mOvr(this,'#ffffff');" onmouseout="mOut(this,'#ffffff');" onclick="mClk(this);"><a class="lien" href="javascript:addresses()"><img src="inc/themes/webmail/images/addresses.gif"><br /><br /><font style="font-size: 10px;">{$smLabel.address_mnu}</font></a></td>
					<td align="center" valign="bottom" bgcolor="#ffffff" height="50" width="83" onmouseover="mOvr(this,'#ffffff');" onmouseout="mOut(this,'#ffffff');" onclick="mClk(this);"><a class="lien" href="javascript:emptytrash()"><img src="inc/themes/webmail/images/trash.gif"><br /><br /><font style="font-size: 10px;">{$smLabel.empty_trash_mnu}</font></a></td>
					<td align="center" valign="bottom" bgcolor="#ffffff" height="50" width="83" onmouseover="mOvr(this,'#ffffff');" onmouseout="mOut(this,'#ffffff');" onclick="mClk(this);"><a class="lien" href="javascript:prefs()"><img src="inc/themes/webmail/images/prefs.gif"><br /><br /><font style="font-size: 10px;">{$smLabel.prefs_mnu}</font></a></td>
					<td align="center" valign="bottom" bgcolor="#ffffff" height="50" width="83" onmouseover="mOvr(this,'#ffffff');" onmouseout="mOut(this,'#ffffff');" onclick="mClk(this);"><a class="lien" href="javascript:goend()"><img src="inc/themes/webmail/images/logout.gif"><br /><br /><font style="font-size: 10px;">{$smLabel.logoff_mnu}</font></a></td>
				</tr>
			</table>
			<table width="99.7%" border="0" cellspacing="0" cellpadding="0" class="normal" align="center">
				<tr><td colspan="5">&nbsp;</td></tr>
				<tr>
					<td valign="top">
						<form name="form1" method="post" action="addressbook.php">
						<input type="hidden" name="sid" value="{$umSid}">
						<input type="hidden" name="id" value="{$smAddrID}">
						<input type="hidden" name="lid" value="{$umLid}">
						<input type="hidden" name="tid" value="{$umTid}">
						<input type="hidden" name="opt" value="{$smOpt}">
						<table cellspacing="0" cellpadding="0" width="99.7%" border="0" class="normal" align="center">
							<tr><td>
								<table cellspacing="0" cellpadding="0" width="350" border="0" class="normal" bgcolor="#BFC6D3" align="center">
									<tr><td colspan="2" height="5"></td></tr>
									<tr><td width="40%">&nbsp;{$smLabel.adr_name}:</td><td><input type="text" size="40" style="border: 1 solid #7F9DB9;" class="normal" name="name" value="{$smAddrName|escape:"html"}">&nbsp;</td></tr>
									<tr><td>&nbsp;{$smLabel.adr_email}:</td><td><input type="text" size="40" style="border: 1 solid #7F9DB9;" class="normal" name="email" value="{$smAddrEmail|escape:"html"}">&nbsp;</td></tr>
									<tr><td>&nbsp;{$smLabel.adr_street}:</td><td><input type="text" size="40" style="border: 1 solid #7F9DB9;" class="normal" name="street" value="{$smAddrStreet|escape:"html"}">&nbsp;</td></tr>
									<tr><td>&nbsp;{$smLabel.adr_city}:</td><td><input type="text" size="40" style="border: 1 solid #7F9DB9;" class="normal" name="city" value="{$smAddrCity|escape:"html"}">&nbsp;</td></tr>
									<tr><td>&nbsp;{$smLabel.adr_state}:</td><td><input type="text" size="40" style="border: 1 solid #7F9DB9;" class="normal" name="state" value="{$smAddrState|escape:"html"}" maxlength=2>&nbsp;</td></tr>
									<tr><td>&nbsp;{$smLabel.adr_work}:</td><td><input type="text" size="40" style="border: 1 solid #7F9DB9;" class="normal" name="work" value="{$smAddrWork|escape:"html"}">&nbsp;</td></tr>
									<tr><td>&nbsp;</td><td><input type="submit" value="{$smLabel.adr_save}" class="button">&nbsp;<input type="button" value="{$smLabel.adr_back}" class="button" onClick="location = '{$smGoBack}'"></td></tr>
									<tr><td colspan="2" height="5"></td></tr>
								</table>
							</td></tr>
							<tr>
								<td>&nbsp;</td>
							</tr>
						</table>
						</form>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>
			<img src="inc/themes/webmailwebmail/images/bandeau-b.gif" border="0" width="750" height="25">
		</td>
	<tr>
</table>
</td></tr>
</table>
</body>
</html>
