{config_load file=$umLanguageFile section="MessageList"}
{um_welcome_message messages=$umNumMessages unread=$umNumUnread boxname=$umBoxName var="umWelcomeMessage"}
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<title>UebiMiau Webmail - {$umLabel.messages_to} {$umUserEmail}</title>
	<meta http-equiv="Content-Type" content="text/html; charset={$umLabel.default_char_set}">
	<link rel="stylesheet" href="inc/themes/webmail/css.css" type="text/css">
	<script language="JavaScript" src="inc/themes/webmail/js.js" type="text/javascript"></script>
	{$umJS}
</head>
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
<tr><td valign="middle" align="center">
<table width="750" border="0" cellspacing="0" cellpadding="0" class="frame" align="center">

	<tr><td class=top><img src="inc/themes/webmail/images/logo.gif" border="0""></td></tr>
	<tr><td><img src="inc/themes/webmail/images/bandeau-h.gif" border="0"></td></tr>
	<tr>
		<td background="inc/themes/webmail/images/ligne-fond.gif">
			{*{include file=$umMenuTemplate}*}
			<table cellspacing="0" cellpadding="0" width="99.7%" border="0" class="normal" align="center">
<tr>
					<td align="center" valign="bottom" bgcolor="#ffffff" height="50" width="83" onmouseover="mOvr(this,'#ffffff');" onmouseout="mOut(this,'#ffffff');" onclick="mClk(this);"><a class="lien" href="javascript:goinbox()"><img src="inc/themes/webmail/images/inbox.gif"><br /><br /><font style="font-size: 10px;">{$umLabel.messages_mnu}</font></a></td>
					<td align="center" valign="bottom" bgcolor="#ffffff" height="50" width="83" onmouseover="mOvr(this,'#ffffff');" onmouseout="mOut(this,'#ffffff');" onclick="mClk(this);"><a class="lien" href="javascript:newmsg()"><img src="inc/themes/webmail/images/newmsg.gif"><br /><br /><font style="font-size: 10px;">{$umLabel.compose_mnu}</font></a></td>
					<td align="center" valign="bottom" bgcolor="#ffffff" height="50" width="83" onmouseover="mOvr(this,'#ffffff');" onmouseout="mOut(this,'#ffffff');" onclick="mClk(this);"><a class="lien" href="javascript:refreshlist()"><img src="inc/themes/webmail/images/refresh.gif"><br /><br /><font style="font-size: 10px;">{$umLabel.refresh_mnu}</font></a></td>
					<td align="center" valign="bottom" bgcolor="#ffffff" height="50" width="83" onmouseover="mOvr(this,'#ffffff');" onmouseout="mOut(this,'#ffffff');" onclick="mClk(this);"><a class="lien" href="javascript:folderlist()"><img src="inc/themes/webmail/images/folder.gif"><br /><br /><font style="font-size: 10px;">{$umLabel.folders_mnu}</font></a></td>
					<td align="center" valign="bottom" bgcolor="#ffffff" height="50" width="83" onmouseover="mOvr(this,'#ffffff');" onmouseout="mOut(this,'#ffffff');" onclick="mClk(this);"><a class="lien" href="javascript:search()"><img src="inc/themes/webmail/images/search.gif"><br /><br /><font style="font-size: 10px;">{$umLabel.search_mnu}</font></a></td>
					<td align="center" valign="bottom" bgcolor="#ffffff" height="50" width="83" onmouseover="mOvr(this,'#ffffff');" onmouseout="mOut(this,'#ffffff');" onclick="mClk(this);"><a class="lien" href="javascript:addresses()"><img src="inc/themes/webmail/images/addresses.gif"><br /><br /><font style="font-size: 10px;">{$umLabel.address_mnu}</font></a></td>
					<td align="center" valign="bottom" bgcolor="#ffffff" height="50" width="83" onmouseover="mOvr(this,'#ffffff');" onmouseout="mOut(this,'#ffffff');" onclick="mClk(this);"><a class="lien" href="javascript:emptytrash()"><img src="inc/themes/webmail/images/trash.gif"><br /><br /><font style="font-size: 10px;">{$umLabel.empty_trash_mnu}</font></a></td>
					<td align="center" valign="bottom" bgcolor="#ffffff" height="50" width="83" onmouseover="mOvr(this,'#ffffff');" onmouseout="mOut(this,'#ffffff');" onclick="mClk(this);"><a class="lien" href="javascript:prefs()"><img src="inc/themes/webmail/images/prefs.gif"><br /><br /><font style="font-size: 10px;">{$umLabel.prefs_mnu}</font></a></td>
					<td align="center" valign="bottom" bgcolor="#ffffff" height="50" width="83" onmouseover="mOvr(this,'#ffffff');" onmouseout="mOut(this,'#ffffff');" onclick="mClk(this);"><a class="lien" href="javascript:goend()"><img src="inc/themes/webmail/images/logout.gif"><br /><br /><font style="font-size: 10px;">{$umLabel.logoff_mnu}</font></a></td>
				</tr>
			</table>
			<table width="99.7%" border="0" cellspacing="0" cellpadding="0" class="normal" align="center">
				<tr><td colspan="7">&nbsp;</td></tr>
			{if $umNumMessages gt 0}
				<tr><form name="form1" action="process.php" method="post">{$umForms}
					<td colspan="7">&nbsp;{$umWelcomeMessage}</td>
				</tr>
			{if $umErrorMessage neq ""}
				<tr>
					<td colspan="7">&nbsp;<font color="red"><b>{$umErrorMessage}</b></font></td>
				</tr>
			{/if}
				<tr>
				    <td width="5" bgcolor="#78879C" align="center" valign="middle"><input type="checkbox" name="chkall" onclick="sel()"></td>
					<td width="35" bgcolor="#78879C" align="center" valign="middle"><img src="./images/prior_high.gif" width="5" height="11" border="0" alt="high priority">&nbsp;<img src="images/attach.gif" border="0" width="6" height="14" alt="attached file">&nbsp;<img src="images/msg_read.gif" border="0" width="14" height="14" alt="read message"></td>
					{if $umFolder eq "sent"}
					<td width="200" bgcolor="#78879C" align="center" valign="middle">.: <b><a class="lien" href="javascript:sortby('toname')">{$umLabel.to_hea}{$umToArrow}</a></b> :.</td>
					{else}
			    	<td width="200" bgcolor="#78879C" align="center" valign="middle">.: <b><a class="lien" href="javascript:sortby('fromname')">{$umLabel.from_hea}{$umFromArrow}</a></b> :.</td>
					{/if}
				    <td width="340" bgcolor="#78879C" align="center" valign="middle">.: <b><a class="lien" href="javascript:sortby('subject')">{$umLabel.subject_hea}{$umSubjectArrow}</a></b> :.</td>
				    <td width="100" bgcolor="#78879C" align="center" valign="middle">.: <b><a class="lien" href="javascript:sortby('date')">{$umLabel.date_hea}{$umDateArrow}</a></b> :.</td>
				    <td width="68" bgcolor="#78879C" align="center" valign="middle">.: <b><a class="lien" href="javascript:sortby('size')">{$umLabel.size_hea}{$umSizeArrow}</a></b> :.</td>
				</tr>
				{section name=i loop=$umMessageList}
				<tr bgcolor="#E1E4EB" onmouseover="mOvr(this,'#ACB4C5');" onmouseout="mOut(this,'#E1E4EB');">
					<td align="center" valign="middle" nowrap>{$umMessageList[i].checkbox}</td>
					<td align="center" valign="middle" nowrap>{$umMessageList[i].priorimg}{$umMessageList[i].attachimg}{$umMessageList[i].statusimg}</td>
					{if $umFolder eq "sent"}
					<td align="left" valign="middle" nowrap><acronym title="{$umMessageList[i].to|escape:"html"|default:$umLabel.no_recipient_text}"><a href="{$umMessageList[i].composelinksent}">{$umMessageList[i].to|truncate:40:"...":true|escape:"html"|default:$umLabel.no_recipient_text}</a></acronym></td>
					{else}
					<td align="left" valign="middle" nowrap><acronym title="{$umMessageList[i].from|escape:"html"|default:$umLabel.no_recipient_text}"><a href="{$umMessageList[i].composelink}">{$umMessageList[i].from|truncate:40:"...":true|escape:"html"|default:$umLabel.no_subject_text}</a></acronym></td>
					{/if}
					<td align="left" valign="middle" nowrap><acronym title="{$umMessageList[i].subject|escape:"html"|default:$umLabel.no_subject_text}">{if $umMessageList[i].read eq "false"}<b>{/if}<a href="{$umMessageList[i].readlink}">{$umMessageList[i].subject|truncate:50:"...":true|escape:"html"|default:$umLabel.no_subject_text}</a>{if $umMessageList[i].read eq "false"}</b>{/if}</acronym></td>
					<td align="center" valign="middle" nowrap>{$umMessageList[i].date|date_format:$umLabel.date_format}</td>
					<td align="right" valign="middle" nowrap>{$umMessageList[i].size} Kb &nbsp;</td>
				</tr>
				{/section}
				<tr>
					<td colspan="7">&nbsp;<a class="lien" href="javascript:delemsg()"><img src="./themes/webmail/images/cross.gif" border="0" align="bottom" width="16" height="16">&nbsp;{$umLabel.delete_selected_mnu}</a> | <a class="lien" href="javascript:movemsg()"><img src="./themes/webmail/images/move.gif" border="0" align="bottom" width="16" height="16">&nbsp;{$umLabel.move_selected_mnu}</a> <select name="aval_folders">{section name=i loop=$umAvalFolders}<option value="{$umAvalFolders[i].path|escape:"html"}">{$umAvalFolders[i].display|escape:"html"}{/section}</select></td>
				</tr>
				<tr>
					<td colspan="7">&nbsp;{if $umPreviousLink}<a href="{$umPreviousLink}" class="lien">{$umLabel.previous_text}</a> &nbsp;{/if}{$umNavBar}{if $umNextLink}&nbsp;<a href="{$umNextLink}" class="lien">{$umLabel.next_text}</a>{/if}</td>
				</tr>
			{else}		
				<tr>
					<td colspan="7">&nbsp;{$umLabel.no_messages} <b>{$umBoxName|escape:"html"}<br><br></b></td>
				</tr>
			{/if}
			</form>
			{if $umQuotaEnabled eq 1}
			<tr><td align="center" valign="middle" colspan="7">{$umUsageGraph}<br>{$umLabel.quota_usage_info}: {$umLabel.quota_usage_used} <b>{$umTotalUsed}</b> Kb {$umLabel.quota_usage_of} <b>{$umQuotaLimit}</b> Kb {$umLabel.quota_usage_avail}</td></tr>
			{/if}
			</form>
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
