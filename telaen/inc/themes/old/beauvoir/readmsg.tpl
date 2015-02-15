{config_load file=$umLanguageFile section="Readmsg"}

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset={$smLabel.default_char_set}">
<title>UebiMiau Webmail &copy 2003 - Skin by Beauvoir.net - {$smCCList|escape:"html"}</title>
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
				<td align="center" valign="middle" bgcolor="#EAEAEA" height="70" width="84" onmouseover="mOvr(this,'#ACB6D1');" onmouseout="mOut(this,'#EAEAEA');" onclick="mClk(this);"><img src="inc/themes/beauvoir/refresh.gif" border="0" width="31" height="31"><br><font class="inactive">{$smLabel.refresh_mnu}</font></td>
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
			<table cellspacing="1" cellpadding="0" width="100%" border="0" class="normal" bgcolor="#F5F4F4">
				<tr>
					<td>
						<table cellspacing="0" cellpadding="0" width="100%" border="0" class="normal" bgcolor="#F5F4F4">
						{$smReplyForm}
						<tr>
							<td colspan="2" align="center" valign="middle" height="30"> 
								{if $smHavePrevious eq 1}
								<a href="{$smPreviousLink}" title="{$smPreviousSubject}">{$smLabel.previous_mnu}</a> |
								{/if}
								{if $smHaveNext eq 1}
								<a href="{$smNextLink}" title="{$smNextSubject}">{$smLabel.next_mnu}</a> |
								{/if}
								<a href="javascript:goback()">{$smLabel.back_mnu}</a> |
								<a href="javascript:reply()">{$smLabel.reply_mnu}</a> |
								<a href="javascript:replyall()">{$smLabel.reply_all_mnu}</a> |
								<a href="javascript:forward()">{$smLabel.forward_mnu}</a> |
								<a href="javascript:printit()">{$smLabel.print_mnu}</a> |
								<a href="javascript:headers()">{$smLabel.headers_mnu}</a>
								</td>
							</tr>
							<tr bgcolor="#EAEAEA">
								<td width="15%" align="left" height="20">&nbsp;{$smLabel.from_hea}&nbsp;</td>
								<td>{section name=i loop=$smFromList}<a href="{$smFromList[i].link}" title="{$smFromList[i].title|escape:"html"}">{$smFromList[i].name|default:#no_sender_text#|escape:"html"}</a>{/section}&nbsp;<a href="javascript:block_addresses()"><img src="./images/cross.gif" width="15" height="13" border="0" alt="{$smLabel.block_address}"></a>&nbsp;<a href="javascript:catch_addresses()"><img src="./images/bookmark_it.gif" width="15" height="12" border="0" alt="{$smLabel.catch_address}"></a></td>
							</tr>
							<tr bgcolor="#EAEAEA">
								<td width="15%" align="left" height="20">&nbsp;{$smLabel.to_hea}&nbsp;</td>
								<td>{section name=i loop=$smTOList}{if $firstto eq "no"}; {/if}<a href="{$smTOList[i].link}" title="{$smTOList[i].title|escape:"html"}">{$smTOList[i].name|escape:"html"}</a>{assign var="firstto" value="no"}{sectionelse}&nbsp;{$smLabel.no_recipient_text}{/section}</td>
							</tr>	
							{if $smHaveCC}
							<tr bgcolor="#EAEAEA">
								<td width="15%" align="left" height="20">&nbsp;{$smLabel.cc_hea}&nbsp;</td>
								<td>{section name=i loop=$smCCList}{if $firstcc eq "no"};{/if}<a href="{$smCCList[i].link}" title="{$smCCList[i].title|escape:"html"}">{$smCCList[i].name|escape:"html"}</a>{assign var="firstcc" value="no"}{/section}</td>
							</tr>
							{/if}
							<tr bgcolor="#EAEAEA">
								<td width="15%" align="left" height="20">&nbsp;{$smLabel.subject_hea}&nbsp;</td>
								<td>{$smSubject|default:#no_subject_text#|truncate:100:"...":true|escape:"html"}</td>
							</tr>	
							<tr bgcolor="#EAEAEA">
								<td width="15%" align="left" height="20">&nbsp;{$smLabel.date_hea}&nbsp;</td>
								<td>{$smDate|date_format:$smLabel.date_format}</td>
							</tr>	
							{if $smHaveAttachments}
							<tr bgcolor="#EAEAEA">
								<td width="15%" align="left" height="20">&nbsp;{$smLabel.attach_hea}&nbsp;</td>
								<td>
									<table width="100%" border="0" cellspacing="1" cellpadding="0" class="normal" bgcolor="#999999">
										<tr bgcolor="#ACB6D1">
											<td width="60%">&nbsp;<b>{$smLabel.attch_name_hea}</b> ({$smLabel.attch_force_hea})</td>
											<td>&nbsp;<b>{$smLabel.attch_size_hea}</b></td>
											<td>&nbsp;<b>{$smLabel.attch_type_hea}</b></td>
										</tr>
										{section name=i loop=$smAttachList}
										<tr bgcolor="#EAEAEA">
											<td>&nbsp;{$smAttachList[i].normlink}{$smAttachList[i].name|truncate:30:"...":true|escape:"html"}</a> {$smAttachList[i].downlink}<img src="./images/download.gif" width="12" height="12" border="0"></a></td>
											<td>&nbsp;{$smAttachList[i].size} Kb &nbsp;</td>
											<td>&nbsp;{$smAttachList[i].type}</td>
										{/section}
										</tr>
									</table>
								</td>
							</tr>	
							{/if}
							<tr>
								<td colspan="2">
									<table width="100%" border="0" cellspacing="1" cellpadding="0" class="normal" bgcolor="#F5F4F4">
										<tr>
											<td width="60%"{$smBackImg}{$smBackColor}><font class="normal">{$smMessageBody}</font></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<form name="move" action="process.php" method="POST">
										{$smDeleteForm}
										<td colspan=2 align="center" valign="middle" height="30">
										<a href="javascript:deletemsg()"><img src="./themes/beauvoir/delete.gif" border="0" width="15" height="15" alt="{$smLabel.delete_mnu}" align="absmiddle">&nbsp;{$smLabel.delete_mnu}</a> |
										<a href="javascript:movemsg()"><img src="./themes/beauvoir/move.gif" border="0" width="15" height="15" alt="{$smLabel.move_mnu}" align="absmiddle">&nbsp;{$smLabel.move_mnu} </a>
										<select name="aval_folders">
											{section name=i loop=$smAvalFolders}
												<option value="{$smAvalFolders[i].path|escape:"html"}">{$smAvalFolders[i].display|escape:"html"}
											{/section}
										</select>
									</td>
								</form>
							</tr>
						</table>
					</td>
				</tr>
			</table>
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
