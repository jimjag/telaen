{config_load file=$umLanguageFile section="Readmsg"}
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<title>UebiMiau Webmail - {$smCCList|escape:"html"}</title>
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
			{*{include file=$umMenuTemplate}*}
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
			{$smReplyForm}
			<tr>
				<td colspan="2" align="center" valign="middle" height="30">
					{if $smHavePrevious eq 1}
					<a class="lien" href="{$smPreviousLink}" title="{$smPreviousSubject}">{$smLabel.previous_mnu}</a> |
					{/if}
					{if $smHaveNext eq 1}
					<a class="lien" href="{$smNextLink}" title="{$smNextSubject}">{$smLabel.next_mnu}</a> |
					{/if}
					<a class="lien" href="javascript:goback()">{$smLabel.back_mnu}</a> |
					<a class="lien" href="javascript:reply()">{$smLabel.reply_mnu}</a> |
					<a class="lien" href="javascript:replyall()">{$smLabel.reply_all_mnu}</a> |
					<a class="lien" href="javascript:forward()">{$smLabel.forward_mnu}</a> |
					<a class="lien" href="javascript:printit()">{$smLabel.print_mnu}</a> |
					<a class="lien" href="javascript:headers()">{$smLabel.headers_mnu}</a>
				</td>
			</tr>
			<tr bgcolor="#BFC6D3">
				<td height="5" colspan="2"></td>
			</tr>
			<tr bgcolor="#BFC6D3">
				<td width="15%" align="left" height="20">&nbsp;{$smLabel.from_hea}</td>
				<td>&nbsp;{section name=i loop=$smFromList}<a href="{$smFromList[i].link}" title="{$smFromList[i].title|escape:"html"}" class="lien">{$smFromList[i].name|default:#no_sender_text#|escape:"html"}</a>{/section}&nbsp;<a href="javascript:block_addresses()">{* not fully functional <img src="./themes/webmail/images/cross.gif" border="0" alt="{$smLabel.block_address}" align="absmiddle"></a>&nbsp;*}<a href="javascript:catch_addresses()"><img src="./themes/webmail/images/bookmark_it.gif" border="0" alt="{$smLabel.catch_address}" align="absmiddle"></a></td>
			</tr>
			<tr bgcolor="#BFC6D3">
				<td width="15%" align="left" height="20">&nbsp;{$smLabel.to_hea}</td>
				<td>&nbsp;{section name=i loop=$smTOList}{if $firstto eq "no"};{/if}<a href="{$smTOList[i].link}" title="{$smTOList[i].title|escape:"html"}" class="lien">{$smTOList[i].name|escape:"html"}</a>{assign var="firstto" value="no"}{sectionelse}&nbsp;{$smLabel.no_recipient_text}{/section}</td>
			</tr>	
			{if $smHaveCC}
			<tr bgcolor="#BFC6D3">
				<td  width="15%" align="left" height="20">&nbsp;{$smLabel.cc_hea}</td>
				<td>&nbsp;{section name=i loop=$smCCList}{if $firstcc eq "no"};{/if}<a href="{$smCCList[i].link}" title="{$smCCList[i].title|escape:"html"}" class="lien">{$smCCList[i].name|escape:"html"}</a>{assign var="firstcc" value="no"}{/section}</td>
			</tr>	
			{/if}
			<tr bgcolor="#BFC6D3">
				<td width="15%" align="left" height="20">&nbsp;{$smLabel.subject_hea}</td>
				<td>&nbsp;{$smSubject|default:#no_subject_text#|truncate:100:"...":true|escape:"html"}</td>
			</tr>	
			<tr bgcolor="#BFC6D3">
				<td width="15%" align="left" height="20">&nbsp;{$smLabel.date_hea}</td>
				<td>&nbsp;{$smDate|date_format:$smLabel.date_format}</td>
			</tr>	
			{if $smHaveAttachments}
			<tr bgcolor="#BFC6D3">
				<td width="15%" align="left" height="20">&nbsp;{$smLabel.attach_hea}</td>
				<td><table width="99.4%" border="0" cellspacing="1" cellpadding="0" bgcolor="#2D3443" class="normal">
						<tr bgcolor="#BFC6D3">
							<td width="60%">&nbsp;<b>{$smLabel.attch_name_hea}</b> ({$smLabel.attch_force_hea})</td>
							<td>&nbsp;<b>{$smLabel.attch_size_hea}</b></td>
							<td>&nbsp;<b>{$smLabel.attch_type_hea}</b></td>
						</tr>
						{section name=i loop=$smAttachList}
						<tr bgcolor="#FFFFFF">
							<td>&nbsp;{$smAttachList[i].normlink}{$smAttachList[i].name|truncate:30:"...":true|escape:"html"}</a> {$smAttachList[i].downlink}<img src="./images/download.gif" border="0" align="absmiddle"></a></td>
							<td>&nbsp;{$smAttachList[i].size} Kb &nbsp;</td>
							<td>&nbsp;{$smAttachList[i].type}</td>
						</tr>
						{/section}
					</table>
				</td>
			</tr>
			<tr bgcolor="#BFC6D3">
				<td height="5" colspan="2"></td>
			</tr>
			{/if}
			<tr>
				<td colspan="2">
					<table width="100%" border="0" cellspacing="1" cellpadding="0" class="normal">
						<tr bgcolor="#FFFFFF">
							<td width="60%"{$smBackImg}{$smBackColor}>{$smMessageBody}</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<form name="move" action="process.php" method="POST">
				{$smDeleteForm}
				<td colspan="2" align="center" valign="middle" height="30">
					<a class="lien" href="javascript:deletemsg()"><img src="./themes/webmail/images/cross.gif" border="0" align="bottom">&nbsp;{$smLabel.delete_mnu}</a> |
					<a class="lien" href="javascript:movemsg()"><img src="./themes/webmail/images/move.gif" border="0" align="bottom">&nbsp;{$smLabel.move_mnu}</a>&nbsp;<select name="aval_folders">{section name=i loop=$smAvalFolders}<option value="{$smAvalFolders[i].path|escape:"html"}">{$smAvalFolders[i].display|escape:"html"}{/section}</select>
				</td>
				</form>
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
