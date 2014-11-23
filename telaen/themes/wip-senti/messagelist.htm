
{config_load file=$umLanguageFile section="MessageList"}
{um_welcome_message messages=$umNumMessages unread=$umNumUnread boxname=$umBoxName var="umWelcomeMessage"}

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<title>sentiMail - {$umLabel.messages_to} {$umUserEmail}</title>

<meta http-equiv="Content-Type" content="text/html; charset={$umLabel.default_char_set}">
<link rel="stylesheet" href="themes/senti/webmail.css" type="text/css">
{$umJS}
</head>

<body><br><br>
<table width="760" border="0" cellpadding="0" cellspacing="0" align="center">
	<tr valign="bottom">
		<td height="61">
			<img src="themes/senti/images/mail_01.gif" width="18" height="61" alt=""></td>
		<td>
			<a class="menu" href="javascript:goinbox()"><img src="themes/senti/images/inbox_selected.gif" width="60" height="61" border="0" alt=""></a></td>
		<td>
			<img src="themes/senti/images/mail_03.gif" width="33" height="61" alt=""></td>
		<td>
			<a class="menu" href="javascript:newmsg()"><img src="themes/senti/images/write.gif" width="85" height="61" border="0" alt=""></a></td>
		<td>
			<img src="themes/senti/images/mail_05.gif" width="32" height="61" alt=""></td>
		<td>
			<a class="menu" href="javascript:folderlist()"><img src="themes/senti/images/folders.gif" width="72" height="61" border="0" alt=""></a></td>
		<td>
			<img src="themes/senti/images/mail_07.gif" width="36" height="61" alt=""></td>
		<td>
			<a class="menu" href="javascript:search()"><img src="themes/senti/images/search.gif" width="74" height="61" alt="" border="0"></a></td>
		<td>
			<img src="themes/senti/images/mail_09.gif" width="27" height="61" alt=""></td>
		<td>
			<a class="menu" href="javascript:addresses()"><img src="themes/senti/images/addresses.gif" width="89" height="61" border="0" alt=""></a></td>
		<td>
			<img src="themes/senti/images/mail_11.gif" width="28" height="61" alt=""></td>
		<td>
			<a class="menu" href="javascript:prefs()"><img src="themes/senti/images/preferences.gif" width="88" height="61" border="0" alt=""></a></td>
		<td>
			<img src="themes/senti/images/mail_13.gif" width="31" height="61" alt=""></td>
		<td>
			<a class="menu" href="javascript:goend()"><img src="themes/senti/images/logout.gif" width="70" height="61" border="0" alt=""></a></td>
		<td>
			<img src="themes/senti/images/mail_15.gif" width="17" height="61" alt=""></td>
	</tr>
	<tr><td width="18"><img src="themes/senti/images/leftside.gif" width="18" height="100%"></td>
<td colspan="13" bgcolor="#dddcdc"><br />
<table cellspacing=0 cellpadding=0 border=0 width="100%" align="center">
								<tr>
									<td colspan="3" class="default"><a class="navigation" href="javascript:refreshlist()"><img src="themes/senti/images/mail_get.gif"  alt="" border="0">{$umLabel.refresh_mnu}</a><BR><BR></td>
									<form name="form1" action="process.php" method="post">
									{$umForms}
									<td colspan="4" class="default" align="right"> &nbsp;&nbsp;
									{$umWelcomeMessage}<br><br>
									</td>
								</tr>
							{if $umNumMessages gt 0}
								<tr>

									</td>
								</tr>
								{if $umErrorMessage neq ""}
								<tr>
									<td colspan="7" class="default"><font color=red><b> &nbsp;&nbsp;{$umErrorMessage}</b></font></td>
								</tr>
								{/if}

								<tr>
								    <td width="5"  class="headers"><input type=checkbox name=chkall onclick="sel()"></td>
								    <td width="34"  class="headers"><img src="themes/senti/images/prior_high.gif" width=5 height=11 border=0 alt="">&nbsp;<img src="images/attach.gif" border="0" width="6" height="14" alt="">&nbsp;<img src="themes/senti/images/msg_read.gif" border="0" width="14" height="14" alt=""></td>
								    <td width="210" class="headers">.: <b><a class="menu" href="javascript:sortby('subject')">{$umLabel.subject_hea}{$umSubjectArrow}</a></b> :.</td>

									{if $umFolder eq "sent"}
								    	<td width="210" class="headers">.: <b><a class="menu" href="javascript:sortby('toname')">{$umLabel.to_hea}{$umToArrow}</a></b> :.</td>
									{else}
								    	<td width="210" class="headers">.: <b><a class="menu" href="javascript:sortby('fromname')">{$umLabel.from_hea}{$umFromArrow}</a></b> :.</td>
									{/if}
								    <td width="90" class="headers">.: <b><a class="menu" href="javascript:sortby('date')">{$umLabel.date_hea}{$umDateArrow}</a></b> :.</td>
								    <td width="70" class="headers">.: <b><a class="menu" href="javascript:sortby('size')">{$umLabel.size_hea}{$umSizeArrow}</a></b> :.</td>
								</tr>

								{section name=i loop=$umMessageList}
								<tr>
									<td class="default" nowrap>{$umMessageList[i].checkbox}</td>
									<td class="default" nowrap>{$umMessageList[i].priorimg}{$umMessageList[i].attachimg}{$umMessageList[i].statusimg}</td>
									<td class="default" nowrap><acronym title="{$umMessageList[i].subject|escape:"html"|default:$umLabel.no_subject_text}">{if $umMessageList[i].read eq "false"}<b>{/if}<a href="{$umMessageList[i].readlink}">{$umMessageList[i].subject|truncate:30:"...":true|escape:"html"|default:$umLabel.no_subject_text}</a>{if $umMessageList[i].read eq "false"}</b>{/if}</acronym></td>

									{if $umFolder eq "sent"}
										<td class="default" nowrap><acronym title="{$umMessageList[i].to|escape:"html"|default:$umLabel.no_recipient_text}"><a href="{$umMessageList[i].composelinksent}">{$umMessageList[i].to|truncate:30:"...":true|escape:"html"|default:$umLabel.no_recipient_text}</a></acronym></td>
									{else}
										<td class="default" nowrap><acronym title="{$umMessageList[i].from|escape:"html"|default:$umLabel.no_recipient_text}"><a href="{$umMessageList[i].composelink}">{$umMessageList[i].from|truncate:30:"...":true|escape:"html"|default:$umLabel.no_subject_text}</a></acronym></td>
									{/if}

									<td class="cent" nowrap>{$umMessageList[i].date|date_format:$umLabel.date_format}</td>
									<td class="right" nowrap>{$umMessageList[i].size}Kb &nbsp;</td>
								</tr>
								{/section}
								<tr>
									<td colspan="4" class="default" valign="bottom"><br><br>&nbsp; 
									<a class="menu" href="javascript:delemsg()">[{$umLabel.delete_selected_mnu}]</a>&nbsp;&nbsp;
									<a class="menu" href="javascript:movemsg()">[{$umLabel.move_selected_mnu}
									<select name="aval_folders">
										{section name=i loop=$umAvalFolders}
											<option value="{$umAvalFolders[i].path|escape:"html"}">{$umAvalFolders[i].display|escape:"html"}
										{/section}
									</select>]</a>
									</td>
									<!-- sb-->
									<td colspan="3" class="default" align="right" valign="bottom">
									<br>Page &nbsp;&nbsp;&nbsp;{$umNavBar}<!--{if $umNextLink}&nbsp;&nbsp;&nbsp;&nbsp;-->
									<!--{if $umPreviousLink}<a href="{$umPreviousLink}" class="navigation">{$umLabel.previous_text}</a> &nbsp;{/if}
									<a href="{$umNextLink}" class="navigation">{$umLabel.next_text}</a>{/if}-->
									</td>
									{else}		
									<td colspan="4" class="cent" align="right" valign="bottom"><br> &nbsp;&nbsp;{$umLabel.no_messages} <b>{$umBoxName|escape:"html"}</b><br><br></td>
									{/if}<!--/sb-->
								</tr>
								<tr>
									<td colspan="7" class="default"></td>
								</tr>
							</form>
							{if $umQuotaEnabled eq 1}
							<tr>
								<td class="cent" colspan=7><br><br>&nbsp; {$umLabel.quota_usage_info}: {$umLabel.quota_usage_used} <b>{$umTotalUsed}</b>Kb {$umLabel.quota_usage_of} <b>{$umQuotaLimit}</b>Kb {$umLabel.quota_usage_avail}<br><!--{$umUsageGraph}--></td>
							</tr>
							{/if}
						</table>
</td><td width="17"><img src="themes/senti/images/rightside.gif" width="17" height="100%"></td>	<tr>
		<td colspan="15" valign="top">
			<img src="themes/senti/images/footer.gif" width="760" height="25" alt=""></td>
	</tr>
</table>
</body>
</html>
