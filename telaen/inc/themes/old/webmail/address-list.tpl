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
					<td width="40%" bgcolor="#78879C" align="center" valign="middle" height="20">{$smLabel.adr_name_hea}</td>
					<td width="40%" bgcolor="#78879C" align="center" valign="middle">{$smLabel.adr_email_hea}</td>
					<td width="10%" bgcolor="#78879C" align="center" valign="middle">{$smLabel.adr_edit_hea}</td>
					<!--<td width="10%" bgcolor="#78879C" align="center" valign="middle">{$smLabel.adr_expo_hea}</td>-->
					<td width="10%" bgcolor="#78879C" align="center" valign="middle">{$smLabel.adr_dele_hea}</td>
				</tr>
				{section name=i loop=$smAddressList}
				<tr bgcolor="E1E4EB" onmouseover="mOvr(this,'#ACB4C5');" onmouseout="mOut(this,'E1E4EB');">
					<td align="center" valign="middle" height="20"><a href="{$smAddressList[i].viewlink}" class="lien">{$smAddressList[i].name}</a></td>
					<td align="center" valign="middle"><a href="{$smAddressList[i].composelink}" class="lien">{$smAddressList[i].email}</a></td>
					<td align="center" valign="middle"><a href="{$smAddressList[i].editlink}" class="lien">OK</a></td>
					<!--<td align="center" valign="middle"><a href="{$smAddressList[i].exportlink}" class="lien">OK</a></td>-->
					<td align="center" valign="middle"><a href="{$smAddressList[i].dellink}" class="lien">OK</a></td>
				</tr>
                {/section}
				<tr bgcolor="E1E4EB">
					<td colspan="5" align="center" valign="middle">
					<br><form><input type="button" value="{$smLabel.adr_new_entry}" class="button" onClick="location = '{$smNew}'"></form><br><br>
					</td>
				</tr>
				<tr>
					<td colspan="5">&nbsp;{if $smPreviousLink}<a href="{$smPreviousLink}" class="lien">{$smLabel.previous_text}</a> &nbsp;{/if}{$smNavBar}{if $smNextLink}&nbsp;<a href="{$smNextLink}" class="lien">{$smLabel.next_text}</a>{/if}</td>
				</tr>
				<tr>
					<td colspan="5">&nbsp;</td>
				</tr>
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
