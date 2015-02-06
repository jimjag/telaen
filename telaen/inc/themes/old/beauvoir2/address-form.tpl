{config_load file=$umLanguageFile section="AddressBook"}
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title>UebiMiau Webmail - {$umLabel.adr_title} - Skin by Beauvoir.net</title>
	<meta http-equiv="Content-Type" content="text/html; charset={$umLabel.default_char_set}">
	<link rel="stylesheet" href="inc/themes/beauvoir2/webmail.css" type="text/css">
	<script language="JavaScript" src="inc/themes/beauvoir2/webmail.js" type="text/javascript"></script>
</head>
{$umJS}

<!--
Skinned by Arnaud BEAUVOIR -  - 

Thank you to let the copyright in place on the login page and in all sources of pages.
This skin is the work of an author, thank you to respect it and not to remove the
copyright, or worse, to put your name at the place.
-->

<body>
<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0" align="center">
<tr><td valign="middle" align="center">
<table width="750" border="0" cellspacing="0" cellpadding="0" class="normal" align="center">
	<tr><td><img src="inc/themes/beauvoir2/images/bandeau-h.gif" border="0"></td></tr>
	<tr><td><img src="inc/themes/beauvoir2/images/logo.gif" border="0" alt="Powered by Beauvoir"></td></tr>
	<tr><td><img src="inc/themes/beauvoir2/images/bandeau-h.gif" border="0"></td></tr>
	<tr>
		<td background="inc/themes/beauvoir2/images/ligne-fond.gif">
			<table cellspacing="0" cellpadding="0" width="99.7%" border="0" class="normal" align="center">
				<tr>
					<td align="center" valign="middle" bgcolor="#BFC6D3" height="50" width="83" onmouseover="mOvr(this,'#ACB4C5');" onmouseout="mOut(this,'#BFC6D3');" onclick="mClk(this);"><a class="lien" href="javascript:goinbox()"><img src="inc/themes/beauvoir2/images/inbox.gif" border="0"><br>{$umLabel.messages_mnu}</a></td>
					<td align="center" valign="middle" bgcolor="#BFC6D3" height="50" width="83" onmouseover="mOvr(this,'#ACB4C5');" onmouseout="mOut(this,'#BFC6D3');" onclick="mClk(this);"><a class="lien" href="javascript:newmsg()"><img src="inc/themes/beauvoir2/images/newmsg.gif" border="0"><br>{$umLabel.compose_mnu}</a></td>
					<td align="center" valign="middle" bgcolor="#BFC6D3" height="50" width="83" onmouseover="mOvr(this,'#ACB4C5');" onmouseout="mOut(this,'#BFC6D3');" onclick="mClk(this);"><a class="lien" href="javascript:refreshlist()"><img src="inc/themes/beauvoir2/images/refresh.gif" border="0"><br>{$umLabel.refresh_mnu}</a></td>
					<td align="center" valign="middle" bgcolor="#BFC6D3" height="50" width="83" onmouseover="mOvr(this,'#ACB4C5');" onmouseout="mOut(this,'#BFC6D3');" onclick="mClk(this);"><a class="lien" href="javascript:folderlist()"><img src="inc/themes/beauvoir2/images/folder.gif" border="0"><br>{$umLabel.folders_mnu}</a></td>
					<td align="center" valign="middle" bgcolor="#BFC6D3" height="50" width="83" onmouseover="mOvr(this,'#ACB4C5');" onmouseout="mOut(this,'#BFC6D3');" onclick="mClk(this);"><a class="lien" href="javascript:search()"><img src="inc/themes/beauvoir2/images/search.gif" border="0"><br>{$umLabel.search_mnu}</a></td>
					<td align="center" valign="middle" bgcolor="#BFC6D3" height="50" width="83" onmouseover="mOvr(this,'#ACB4C5');" onmouseout="mOut(this,'#BFC6D3');" onclick="mClk(this);"><a class="lien" href="javascript:addresses()"><img src="inc/themes/beauvoir2/images/addresses.gif" border="0"><br>{$umLabel.address_mnu}</a></td>
					<td align="center" valign="middle" bgcolor="#BFC6D3" height="50" width="83" onmouseover="mOvr(this,'#ACB4C5');" onmouseout="mOut(this,'#BFC6D3');" onclick="mClk(this);"><a class="lien" href="javascript:emptytrash()"><img src="inc/themes/beauvoir2/images/trash.gif" border="0"><br>{$umLabel.empty_trash_mnu}</a></td>
					<td align="center" valign="middle" bgcolor="#BFC6D3" height="50" width="83" onmouseover="mOvr(this,'#ACB4C5');" onmouseout="mOut(this,'#BFC6D3');" onclick="mClk(this);"><a class="lien" href="javascript:prefs()"><img src="inc/themes/beauvoir2/images/prefs.gif" border="0"><br>{$umLabel.prefs_mnu}</a></td>
					<td align="center" valign="middle" bgcolor="#BFC6D3" height="50" width="83" onmouseover="mOvr(this,'#ACB4C5');" onmouseout="mOut(this,'#BFC6D3');" onclick="mClk(this);"><a class="lien" href="javascript:goend()"><img src="inc/themes/beauvoir2/images/logout.gif" border="0"><br>{$umLabel.logoff_mnu}</a></td>
				</tr>
			</table>
			<table width="99.7%" border="0" cellspacing="0" cellpadding="0" class="normal" align="center">
				<tr><td colspan="5">&nbsp;</td></tr>
				<tr>
					<td valign="top">
						<form name="form1" method="post" action="addressbook.php">
						<input type="hidden" name="sid" value="{$umSid}">
						<input type="hidden" name="id" value="{$umAddrID}">
						<input type="hidden" name="lid" value="{$umLid}">
						<input type="hidden" name="tid" value="{$umTid}">
						<input type="hidden" name="opt" value="{$umOpt}">
						<table cellspacing="0" cellpadding="0" width="99.7%" border="0" class="normal" align="center">
							<tr><td>
								<table cellspacing="0" cellpadding="0" width="350" border="0" class="normal" bgcolor="#BFC6D3" align="center">
									<tr><td colspan="2" height="5"></td></tr>
									<tr><td width="40%">&nbsp;{$umLabel.adr_name}:</td><td><input type="text" size="40" style="border: 1 solid #7F9DB9;" class="normal" name="name" value="{$umAddrName|escape:"html"}">&nbsp;</td></tr>
									<tr><td>&nbsp;{$umLabel.adr_email}:</td><td><input type="text" size="40" style="border: 1 solid #7F9DB9;" class="normal" name="email" value="{$umAddrEmail|escape:"html"}">&nbsp;</td></tr>
									<tr><td>&nbsp;{$umLabel.adr_street}:</td><td><input type="text" size="40" style="border: 1 solid #7F9DB9;" class="normal" name="street" value="{$umAddrStreet|escape:"html"}">&nbsp;</td></tr>
									<tr><td>&nbsp;{$umLabel.adr_city}:</td><td><input type="text" size="40" style="border: 1 solid #7F9DB9;" class="normal" name="city" value="{$umAddrCity|escape:"html"}">&nbsp;</td></tr>
									<tr><td>&nbsp;{$umLabel.adr_state}:</td><td><input type="text" size="40" style="border: 1 solid #7F9DB9;" class="normal" name="state" value="{$umAddrState|escape:"html"}" maxlength=2>&nbsp;</td></tr>
									<tr><td>&nbsp;{$umLabel.adr_work}:</td><td><input type="text" size="40" style="border: 1 solid #7F9DB9;" class="normal" name="work" value="{$umAddrWork|escape:"html"}">&nbsp;</td></tr>
									<tr><td>&nbsp;</td><td><input type="submit" value="{$umLabel.adr_save}" class="button">&nbsp;<input type="button" value="{$umLabel.adr_back}" class="button" onClick="location = '{$umGoBack}'"></td></tr>
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
		<td><map name="Uebimiau">
			<area shape="rect" coords="318,5,371,18" href="" target="_blank">
			<area shape="rect" coords="442,5,552,16" href="" target="_blank">
			</map>
			<img src="inc/themes/beauvoir2/images/bandeau-b.gif" border="0" width="750" height="25" alt="Webmail powered by Uebimiau - Skinned by Forum.Beauvoir" usemap="#Uebimiau">
		</td>
	<tr>
</table>
</td></tr>
</table>
</body>
</html>
