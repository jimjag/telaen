{config_load file=$umLanguageFile section="MessageList"}
{um_welcome_message messages=$smNumMessages unread=$smNumUnread boxname=$smBoxName var="umWelcomeMessage"}
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<title>UebiMiau Webmail - {$smLabel.messages_to} {$smUserEmail} - Skin by Beauvoir.net</title>
	<meta http-equiv="Content-Type" content="text/html; charset={$smLabel.default_char_set}">
	<link rel="stylesheet" href="inc/themes/beauvoir2/webmail.css" type="text/css">
	<script language="JavaScript" src="inc/themes/beauvoir2/webmail.js" type="text/javascript"></script>
	{$smJS}
</head>

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
			{*{include file=$umMenuTemplate}*}
			<table cellspacing="0" cellpadding="0" width="99.7%" border="0" class="normal" align="center">
				<tr>
					<td align="center" valign="middle" bgcolor="#BFC6D3" height="50" width="83" onmouseover="mOvr(this,'#ACB4C5');" onmouseout="mOut(this,'#BFC6D3');" onclick="mClk(this);"><a class="lien" href="javascript:goinbox()"><img src="inc/themes/beauvoir2/images/inbox.gif" border="0"><br>{$smLabel.messages_mnu}</a></td>
					<td align="center" valign="middle" bgcolor="#BFC6D3" height="50" width="83" onmouseover="mOvr(this,'#ACB4C5');" onmouseout="mOut(this,'#BFC6D3');" onclick="mClk(this);"><a class="lien" href="javascript:newmsg()"><img src="inc/themes/beauvoir2/images/newmsg.gif" border="0"><br>{$smLabel.compose_mnu}</a></td>
					<td align="center" valign="middle" bgcolor="#BFC6D3" height="50" width="83" onmouseover="mOvr(this,'#ACB4C5');" onmouseout="mOut(this,'#BFC6D3');" onclick="mClk(this);"><a class="lien" href="javascript:refreshlist()"><img src="inc/themes/beauvoir2/images/refresh.gif" border="0"><br>{$smLabel.refresh_mnu}</a></td>
					<td align="center" valign="middle" bgcolor="#BFC6D3" height="50" width="83" onmouseover="mOvr(this,'#ACB4C5');" onmouseout="mOut(this,'#BFC6D3');" onclick="mClk(this);"><a class="lien" href="javascript:folderlist()"><img src="inc/themes/beauvoir2/images/folder.gif" border="0"><br>{$smLabel.folders_mnu}</a></td>
					<td align="center" valign="middle" bgcolor="#BFC6D3" height="50" width="83" onmouseover="mOvr(this,'#ACB4C5');" onmouseout="mOut(this,'#BFC6D3');" onclick="mClk(this);"><a class="lien" href="javascript:search()"><img src="inc/themes/beauvoir2/images/search.gif" border="0"><br>{$smLabel.search_mnu}</a></td>
					<td align="center" valign="middle" bgcolor="#BFC6D3" height="50" width="83" onmouseover="mOvr(this,'#ACB4C5');" onmouseout="mOut(this,'#BFC6D3');" onclick="mClk(this);"><a class="lien" href="javascript:addresses()"><img src="inc/themes/beauvoir2/images/addresses.gif" border="0"><br>{$smLabel.address_mnu}</a></td>
					<td align="center" valign="middle" bgcolor="#BFC6D3" height="50" width="83" onmouseover="mOvr(this,'#ACB4C5');" onmouseout="mOut(this,'#BFC6D3');" onclick="mClk(this);"><a class="lien" href="javascript:emptytrash()"><img src="inc/themes/beauvoir2/images/trash.gif" border="0"><br>{$smLabel.empty_trash_mnu}</a></td>
					<td align="center" valign="middle" bgcolor="#BFC6D3" height="50" width="83" onmouseover="mOvr(this,'#ACB4C5');" onmouseout="mOut(this,'#BFC6D3');" onclick="mClk(this);"><a class="lien" href="javascript:prefs()"><img src="inc/themes/beauvoir2/images/prefs.gif" border="0"><br>{$smLabel.prefs_mnu}</a></td>
					<td align="center" valign="middle" bgcolor="#BFC6D3" height="50" width="83" onmouseover="mOvr(this,'#ACB4C5');" onmouseout="mOut(this,'#BFC6D3');" onclick="mClk(this);"><a class="lien" href="javascript:goend()"><img src="inc/themes/beauvoir2/images/logout.gif" border="0"><br>{$smLabel.logoff_mnu}</a></td>
				</tr>
			</table>
			<table width="99.7%" border="0" cellspacing="0" cellpadding="0" class="normal" align="center">
				<tr><td colspan="7">&nbsp;</td></tr>
			{if $smNumMessages gt 0}
				<tr><form name="form1" action="process.php" method="post">{$smForms}
					<td colspan="7">&nbsp;{$umWelcomeMessage}</td>
				</tr>
			{if $smErrorMessage neq ""}
				<tr>
					<td colspan="7">&nbsp;<font color="red"><b>{$smErrorMessage}</b></font></td>
				</tr>
			{/if}
				<tr>
				    <td width="5" bgcolor="#78879C" align="center" valign="middle"><input type="checkbox" name="chkall" onclick="sel()"></td>
					<td width="35" bgcolor="#78879C" align="center" valign="middle"><img src="./images/prior_high.gif" width="5" height="11" border="0" alt="high priority">&nbsp;<img src="images/attach.gif" border="0" width="6" height="14" alt="attached file">&nbsp;<img src="images/msg_read.gif" border="0" width="14" height="14" alt="read message"></td>
				    <td width="340" bgcolor="#78879C" align="center" valign="middle">.: <b><a class="lien" href="javascript:sortby('subject')">{$smLabel.subject_hea}{$smSubjectArrow}</a></b> :.</td>
					{if $smFolder eq "sent"}
					<td width="200" bgcolor="#78879C" align="center" valign="middle">.: <b><a class="lien" href="javascript:sortby('toname')">{$smLabel.to_hea}{$smToArrow}</a></b> :.</td>
					{else}
			    	<td width="200" bgcolor="#78879C" align="center" valign="middle">.: <b><a class="lien" href="javascript:sortby('fromname')">{$smLabel.from_hea}{$smFromArrow}</a></b> :.</td>
					{/if}
				    <td width="100" bgcolor="#78879C" align="center" valign="middle">.: <b><a class="lien" href="javascript:sortby('date')">{$smLabel.date_hea}{$smDateArrow}</a></b> :.</td>
				    <td width="68" bgcolor="#78879C" align="center" valign="middle">.: <b><a class="lien" href="javascript:sortby('size')">{$smLabel.size_hea}{$smSizeArrow}</a></b> :.</td>
				</tr>
				{section name=i loop=$smMessageList}
				<tr bgcolor="#E1E4EB" onmouseover="mOvr(this,'#ACB4C5');" onmouseout="mOut(this,'#E1E4EB');">
					<td align="center" valign="middle" nowrap>{$smMessageList[i].checkbox}</td>
					<td align="center" valign="middle" nowrap>{$smMessageList[i].priorimg}{$smMessageList[i].attachimg}{$smMessageList[i].statusimg}</td>
					<td align="left" valign="middle" nowrap><acronym title="{$smMessageList[i].subject|escape:"html"|default:$smLabel.no_subject_text}">{if $smMessageList[i].read eq "false"}<b>{/if}<a href="{$smMessageList[i].readlink}">{$smMessageList[i].subject|truncate:50:"...":true|escape:"html"|default:$smLabel.no_subject_text}</a>{if $smMessageList[i].read eq "false"}</b>{/if}</acronym></td>
					{if $smFolder eq "sent"}
					<td align="left" valign="middle" nowrap><acronym title="{$smMessageList[i].to|escape:"html"|default:$smLabel.no_recipient_text}"><a href="{$smMessageList[i].composelinksent}">{$smMessageList[i].to|truncate:40:"...":true|escape:"html"|default:$smLabel.no_recipient_text}</a></acronym></td>
					{else}
					<td align="left" valign="middle" nowrap><acronym title="{$smMessageList[i].from|escape:"html"|default:$smLabel.no_recipient_text}"><a href="{$smMessageList[i].composelink}">{$smMessageList[i].from|truncate:40:"...":true|escape:"html"|default:$smLabel.no_subject_text}</a></acronym></td>
					{/if}
					<td align="center" valign="middle" nowrap>{$smMessageList[i].date|date_format:$smLabel.date_format}</td>
					<td align="right" valign="middle" nowrap>{$smMessageList[i].size} Kb &nbsp;</td>
				</tr>
				{/section}
				<tr>
					<td colspan="7">&nbsp;<a class="lien" href="javascript:delemsg()"><img src="./themes/beauvoir2/images/cross.gif" border="0" align="bottom">&nbsp;{$smLabel.delete_selected_mnu}</a> | <a class="lien" href="javascript:movemsg()"><img src="./themes/beauvoir2/images/move.gif" border="0" align="bottom">&nbsp;{$smLabel.move_selected_mnu}</a> <select name="aval_folders">{section name=i loop=$smAvalFolders}<option value="{$smAvalFolders[i].path|escape:"html"}">{$smAvalFolders[i].display|escape:"html"}{/section}</select></td>
				</tr>
				<tr>
					<td colspan="7">&nbsp;{if $smPreviousLink}<a href="{$smPreviousLink}" class="lien">{$smLabel.previous_text}</a> &nbsp;{/if}{$smNavBar}{if $smNextLink}&nbsp;<a href="{$smNextLink}" class="lien">{$smLabel.next_text}</a>{/if}</td>
				</tr>
			{else}		
				<tr>
					<td colspan="7">&nbsp;{$smLabel.no_messages} <b>{$smBoxName|escape:"html"}<br><br></b></td>
				</tr>
			{/if}
			</form>
			{if $smQuotaEnabled eq 1}
			<tr><td align="center" valign="middle" colspan="7">{$smUsageGraph}<br>{$smLabel.quota_usage_info}: {$smLabel.quota_usage_used} <b>{$smTotalUsed}</b> Kb {$smLabel.quota_usage_of} <b>{$smQuotaLimit}</b> Kb {$smLabel.quota_usage_avail}</td></tr>
			{/if}
			</form>
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
