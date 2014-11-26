{config_load file=$umLanguageFile section="Readmsg"}
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<title>UebiMiau Webmail - {$umPageTitle|escape:"html"}</title>
	<meta http-equiv="Content-Type" content="text/html; charset={$umLabel.default_char_set}">
	<link rel="stylesheet" href="themes/webmail/css.css" type="text/css">
	<script language="JavaScript" src="themes/webmail/js.js" type="text/javascript"></script>
</head>
{$umJS}
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
<tr><td valign="middle" align="center">
<table width="750" border="0" cellspacing="0" cellpadding="0" class="frame" align="center">

	<tr><td class=top><img src="themes/webmail/images/logo.gif" border="0""></td></tr>
	<tr><td><img src="themes/webmail/images/bandeau-h.gif" border="0"></td></tr>
	<tr>
		<td background="themes/webmail/images/ligne-fond.gif">
			{*{include file=$umMenuTemplate}*}
			<table cellspacing="0" cellpadding="0" width="99.7%" border="0" class="normal" align="center">
<tr>
					<td align="center" valign="bottom" bgcolor="#ffffff" height="50" width="83" onmouseover="mOvr(this,'#ffffff');" onmouseout="mOut(this,'#ffffff');" onclick="mClk(this);"><a class="lien" href="javascript:goinbox()"><img src="themes/webmail/images/inbox.gif"><br /><br /><font style="font-size: 10px;">{$umLabel.messages_mnu}</font></a></td>
					<td align="center" valign="bottom" bgcolor="#ffffff" height="50" width="83" onmouseover="mOvr(this,'#ffffff');" onmouseout="mOut(this,'#ffffff');" onclick="mClk(this);"><a class="lien" href="javascript:newmsg()"><img src="themes/webmail/images/newmsg.gif"><br /><br /><font style="font-size: 10px;">{$umLabel.compose_mnu}</font></a></td>
					<td align="center" valign="bottom" bgcolor="#ffffff" height="50" width="83" onmouseover="mOvr(this,'#ffffff');" onmouseout="mOut(this,'#ffffff');" onclick="mClk(this);"><a class="lien" href="javascript:refreshlist()"><img src="themes/webmail/images/refresh.gif"><br /><br /><font style="font-size: 10px;">{$umLabel.refresh_mnu}</font></a></td>
					<td align="center" valign="bottom" bgcolor="#ffffff" height="50" width="83" onmouseover="mOvr(this,'#ffffff');" onmouseout="mOut(this,'#ffffff');" onclick="mClk(this);"><a class="lien" href="javascript:folderlist()"><img src="themes/webmail/images/folder.gif"><br /><br /><font style="font-size: 10px;">{$umLabel.folders_mnu}</font></a></td>
					<td align="center" valign="bottom" bgcolor="#ffffff" height="50" width="83" onmouseover="mOvr(this,'#ffffff');" onmouseout="mOut(this,'#ffffff');" onclick="mClk(this);"><a class="lien" href="javascript:search()"><img src="themes/webmail/images/search.gif"><br /><br /><font style="font-size: 10px;">{$umLabel.search_mnu}</font></a></td>
					<td align="center" valign="bottom" bgcolor="#ffffff" height="50" width="83" onmouseover="mOvr(this,'#ffffff');" onmouseout="mOut(this,'#ffffff');" onclick="mClk(this);"><a class="lien" href="javascript:addresses()"><img src="themes/webmail/images/addresses.gif"><br /><br /><font style="font-size: 10px;">{$umLabel.address_mnu}</font></a></td>
					<td align="center" valign="bottom" bgcolor="#ffffff" height="50" width="83" onmouseover="mOvr(this,'#ffffff');" onmouseout="mOut(this,'#ffffff');" onclick="mClk(this);"><a class="lien" href="javascript:emptytrash()"><img src="themes/webmail/images/trash.gif"><br /><br /><font style="font-size: 10px;">{$umLabel.empty_trash_mnu}</font></a></td>
					<td align="center" valign="bottom" bgcolor="#ffffff" height="50" width="83" onmouseover="mOvr(this,'#ffffff');" onmouseout="mOut(this,'#ffffff');" onclick="mClk(this);"><a class="lien" href="javascript:prefs()"><img src="themes/webmail/images/prefs.gif"><br /><br /><font style="font-size: 10px;">{$umLabel.prefs_mnu}</font></a></td>
					<td align="center" valign="bottom" bgcolor="#ffffff" height="50" width="83" onmouseover="mOvr(this,'#ffffff');" onmouseout="mOut(this,'#ffffff');" onclick="mClk(this);"><a class="lien" href="javascript:goend()"><img src="themes/webmail/images/logout.gif"><br /><br /><font style="font-size: 10px;">{$umLabel.logoff_mnu}</font></a></td>
				</tr>
			</table>
			<table width="99.7%" border="0" cellspacing="0" cellpadding="0" class="normal" align="center">
			{$umReplyForm}			
			<tr>
				<td colspan="2" align="center" valign="middle" height="30">
					{if $umHavePrevious eq 1}
					<a class="lien" href="{$umPreviousLink}" title="{$umPreviousSubject}">{$umLabel.previous_mnu}</a> |
					{/if}
					{if $umHaveNext eq 1}
					<a class="lien" href="{$umNextLink}" title="{$umNextSubject}">{$umLabel.next_mnu}</a> |
					{/if}
					<a class="lien" href="javascript:goback()">{$umLabel.back_mnu}</a> |
					<a class="lien" href="javascript:reply()">{$umLabel.reply_mnu}</a> |
					<a class="lien" href="javascript:replyall()">{$umLabel.reply_all_mnu}</a> |
					<a class="lien" href="javascript:forward()">{$umLabel.forward_mnu}</a> |
					<a class="lien" href="javascript:printit()">{$umLabel.print_mnu}</a> |
					<a class="lien" href="javascript:headers()">{$umLabel.headers_mnu}</a>
				</td>
			</tr>
			<tr bgcolor="#BFC6D3">
				<td height="5" colspan="2"></td>
			</tr>
			<tr bgcolor="#BFC6D3">
				<td width="15%" align="left" height="20">&nbsp;{$umLabel.from_hea}</td>
				<td>&nbsp;{section name=i loop=$umFromList}<a href="{$umFromList[i].link}" title="{$umFromList[i].title|escape:"html"}" class="lien">{$umFromList[i].name|default:#no_sender_text#|escape:"html"}</a>{/section}&nbsp;<a href="javascript:block_addresses()">{* not fully functional <img src="./themes/webmail/images/cross.gif" border="0" alt="{$umLabel.block_address}" align="absmiddle"></a>&nbsp;*}<a href="javascript:catch_addresses()"><img src="./themes/webmail/images/bookmark_it.gif" border="0" alt="{$umLabel.catch_address}" align="absmiddle"></a></td>
			</tr>
			<tr bgcolor="#BFC6D3">
				<td width="15%" align="left" height="20">&nbsp;{$umLabel.to_hea}</td>
				<td>&nbsp;{section name=i loop=$umTOList}{if $firstto eq "no"};{/if}<a href="{$umTOList[i].link}" title="{$umTOList[i].title|escape:"html"}" class="lien">{$umTOList[i].name|escape:"html"}</a>{assign var="firstto" value="no"}{sectionelse}&nbsp;{$umLabel.no_recipient_text}{/section}</td>
			</tr>	
			{if $umHaveCC}
			<tr bgcolor="#BFC6D3">
				<td  width="15%" align="left" height="20">&nbsp;{$umLabel.cc_hea}</td>
				<td>&nbsp;{section name=i loop=$umCCList}{if $firstcc eq "no"};{/if}<a href="{$umCCList[i].link}" title="{$umCCList[i].title|escape:"html"}" class="lien">{$umCCList[i].name|escape:"html"}</a>{assign var="firstcc" value="no"}{/section}</td>
			</tr>	
			{/if}
			<tr bgcolor="#BFC6D3">
				<td width="15%" align="left" height="20">&nbsp;{$umLabel.subject_hea}</td>
				<td>&nbsp;{$umSubject|default:#no_subject_text#|truncate:100:"...":true|escape:"html"}</td>
			</tr>	
			<tr bgcolor="#BFC6D3">
				<td width="15%" align="left" height="20">&nbsp;{$umLabel.date_hea}</td>
				<td>&nbsp;{$umDate|date_format:$umLabel.date_format}</td>
			</tr>	
			{if $umHaveAttachments}
			<tr bgcolor="#BFC6D3">
				<td width="15%" align="left" height="20">&nbsp;{$umLabel.attach_hea}</td>
				<td><table width="99.4%" border="0" cellspacing="1" cellpadding="0" bgcolor="#2D3443" class="normal">
						<tr bgcolor="#BFC6D3">
							<td width="60%">&nbsp;<b>{$umLabel.attch_name_hea}</b> ({$umLabel.attch_force_hea})</td>
							<td>&nbsp;<b>{$umLabel.attch_size_hea}</b></td>
							<td>&nbsp;<b>{$umLabel.attch_type_hea}</b></td>
						</tr>
						{section name=i loop=$umAttachList}
						<tr bgcolor="#FFFFFF">
							<td>&nbsp;{$umAttachList[i].normlink}{$umAttachList[i].name|truncate:30:"...":true|escape:"html"}</a> {$umAttachList[i].downlink}<img src="./images/download.gif" border="0" align="absmiddle"></a></td>
							<td>&nbsp;{$umAttachList[i].size} Kb &nbsp;</td>
							<td>&nbsp;{$umAttachList[i].type}</td>
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
							<td width="60%"{$umBackImg}{$umBackColor}>{$umMessageBody}</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<form name="move" action="process.php" method="POST">
				{$umDeleteForm}
				<td colspan="2" align="center" valign="middle" height="30">
					<a class="lien" href="javascript:deletemsg()"><img src="./themes/webmail/images/cross.gif" border="0" align="bottom">&nbsp;{$umLabel.delete_mnu}</a> |
					<a class="lien" href="javascript:movemsg()"><img src="./themes/webmail/images/move.gif" border="0" align="bottom">&nbsp;{$umLabel.move_mnu}</a>&nbsp;<select name="aval_folders">{section name=i loop=$umAvalFolders}<option value="{$umAvalFolders[i].path|escape:"html"}">{$umAvalFolders[i].display|escape:"html"}{/section}</select>
				</td>
				</form>
			</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td class=bot>
			<img src="themes/webmail/images/bandeau-b.gif" border="0" width="750" height="25">
		</td>
	<tr>
</table>
</td></tr>
</table>
</body>
</html>
