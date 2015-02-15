
{config_load file=$umLanguageFile section="MessageList"}
{um_welcome_message messages=$smNumMessages unread=$smNumUnread boxname=$smBoxName var="umWelcomeMessage"}

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<title>sentiMail - {$smLabel.messages_to} {$smUserEmail}</title>

<meta http-equiv="Content-Type" content="text/html; charset={$smLabel.default_char_set}">
<link rel="stylesheet" href="inc/themes/senti/webmail.css" type="text/css">
{$smJS}
</head>

<body><br><br>
<table width="760" border="0" cellpadding="0" cellspacing="0" align="center">
	<tr valign="bottom">
		<td height="61">
			<img src="inc/themes/senti/images/mail_01.gif" width="18" height="61" alt=""></td>
		<td>
			<a class="menu" href="javascript:goinbox()"><img src="inc/themes/senti/images/inbox_selected.gif" width="60" height="61" border="0" alt=""></a></td>
		<td>
			<img src="inc/themes/senti/images/mail_03.gif" width="33" height="61" alt=""></td>
		<td>
			<a class="menu" href="javascript:newmsg()"><img src="inc/themes/senti/images/write.gif" width="85" height="61" border="0" alt=""></a></td>
		<td>
			<img src="inc/themes/senti/images/mail_05.gif" width="32" height="61" alt=""></td>
		<td>
			<a class="menu" href="javascript:folderlist()"><img src="inc/themes/senti/images/folders.gif" width="72" height="61" border="0" alt=""></a></td>
		<td>
			<img src="inc/themes/senti/images/mail_07.gif" width="36" height="61" alt=""></td>
		<td>
			<a class="menu" href="javascript:search()"><img src="inc/themes/senti/images/search.gif" width="74" height="61" alt="" border="0"></a></td>
		<td>
			<img src="inc/themes/senti/images/mail_09.gif" width="27" height="61" alt=""></td>
		<td>
			<a class="menu" href="javascript:addresses()"><img src="inc/themes/senti/images/addresses.gif" width="89" height="61" border="0" alt=""></a></td>
		<td>
			<img src="inc/themes/senti/images/mail_11.gif" width="28" height="61" alt=""></td>
		<td>
			<a class="menu" href="javascript:prefs()"><img src="inc/themes/senti/images/preferences.gif" width="88" height="61" border="0" alt=""></a></td>
		<td>
			<img src="inc/themes/senti/images/mail_13.gif" width="31" height="61" alt=""></td>
		<td>
			<a class="menu" href="javascript:goend()"><img src="inc/themes/senti/images/logout.gif" width="70" height="61" border="0" alt=""></a></td>
		<td>
			<img src="inc/themes/senti/images/mail_15.gif" width="17" height="61" alt=""></td>
	</tr>
	<tr><td width="18"><img src="inc/themes/senti/images/leftside.gif" width="18" height="100%"></td>
<td colspan="13" bgcolor="#dddcdc"><br />
<table cellspacing=0 cellpadding=0 border=0 width="100%" align="center">
								<tr>
									<td colspan="3" class="default"><a class="navigation" href="javascript:refreshlist()"><img src="inc/themes/senti/images/mail_get.gif"  alt="" border="0">{$smLabel.refresh_mnu}</a><BR><BR></td>
									<form name="form1" action="process.php" method="post">
									{$smForms}
									<td colspan="4" class="default" align="right"> &nbsp;&nbsp;
									{$umWelcomeMessage}<br><br>
									</td>
								</tr>
							{if $smNumMessages gt 0}
								<tr>

									</td>
								</tr>
								{if $smErrorMessage neq ""}
								<tr>
									<td colspan="7" class="default"><font color=red><b> &nbsp;&nbsp;{$smErrorMessage}</b></font></td>
								</tr>
								{/if}

								<tr>
								    <td width="5"  class="headers"><input type=checkbox name=chkall onclick="sel()"></td>
								    <td width="34"  class="headers"><img src="inc/themes/senti/images/prior_high.gif" width=5 height=11 border=0 alt="">&nbsp;<img src="images/attach.gif" border="0" width="6" height="14" alt="">&nbsp;<img src="inc/themes/senti/images/msg_read.gif" border="0" width="14" height="14" alt=""></td>
								    <td width="210" class="headers">.: <b><a class="menu" href="javascript:sortby('subject')">{$smLabel.subject_hea}{$smSubjectArrow}</a></b> :.</td>

									{if $smFolder eq "sent"}
								    	<td width="210" class="headers">.: <b><a class="menu" href="javascript:sortby('toname')">{$smLabel.to_hea}{$smToArrow}</a></b> :.</td>
									{else}
								    	<td width="210" class="headers">.: <b><a class="menu" href="javascript:sortby('fromname')">{$smLabel.from_hea}{$smFromArrow}</a></b> :.</td>
									{/if}
								    <td width="90" class="headers">.: <b><a class="menu" href="javascript:sortby('date')">{$smLabel.date_hea}{$smDateArrow}</a></b> :.</td>
								    <td width="70" class="headers">.: <b><a class="menu" href="javascript:sortby('size')">{$smLabel.size_hea}{$smSizeArrow}</a></b> :.</td>
								</tr>

								{section name=i loop=$smMessageList}
								<tr>
									<td class="default" nowrap>{$smMessageList[i].checkbox}</td>
									<td class="default" nowrap>{$smMessageList[i].priorimg}{$smMessageList[i].attachimg}{$smMessageList[i].statusimg}</td>
									<td class="default" nowrap><acronym title="{$smMessageList[i].subject|escape:"html"|default:$smLabel.no_subject_text}">{if $smMessageList[i].read eq "false"}<b>{/if}<a href="{$smMessageList[i].readlink}">{$smMessageList[i].subject|truncate:30:"...":true|escape:"html"|default:$smLabel.no_subject_text}</a>{if $smMessageList[i].read eq "false"}</b>{/if}</acronym></td>

									{if $smFolder eq "sent"}
										<td class="default" nowrap><acronym title="{$smMessageList[i].to|escape:"html"|default:$smLabel.no_recipient_text}"><a href="{$smMessageList[i].composelinksent}">{$smMessageList[i].to|truncate:30:"...":true|escape:"html"|default:$smLabel.no_recipient_text}</a></acronym></td>
									{else}
										<td class="default" nowrap><acronym title="{$smMessageList[i].from|escape:"html"|default:$smLabel.no_recipient_text}"><a href="{$smMessageList[i].composelink}">{$smMessageList[i].from|truncate:30:"...":true|escape:"html"|default:$smLabel.no_subject_text}</a></acronym></td>
									{/if}

									<td class="cent" nowrap>{$smMessageList[i].date|date_format:$smLabel.date_format}</td>
									<td class="right" nowrap>{$smMessageList[i].size}Kb &nbsp;</td>
								</tr>
								{/section}
								<tr>
									<td colspan="4" class="default" valign="bottom"><br><br>&nbsp; 
									<a class="menu" href="javascript:delemsg()">[{$smLabel.delete_selected_mnu}]</a>&nbsp;&nbsp;
									<a class="menu" href="javascript:movemsg()">[{$smLabel.move_selected_mnu}
									<select name="aval_folders">
										{section name=i loop=$smAvalFolders}
											<option value="{$smAvalFolders[i].path|escape:"html"}">{$smAvalFolders[i].display|escape:"html"}
										{/section}
									</select>]</a>
									</td>
									<!-- sb-->
									<td colspan="3" class="default" align="right" valign="bottom">
									<br>Page &nbsp;&nbsp;&nbsp;{$smNavBar}<!--{if $smNextLink}&nbsp;&nbsp;&nbsp;&nbsp;-->
									<!--{if $smPreviousLink}<a href="{$smPreviousLink}" class="navigation">{$smLabel.previous_text}</a> &nbsp;{/if}
									<a href="{$smNextLink}" class="navigation">{$smLabel.next_text}</a>{/if}-->
									</td>
									{else}		
									<td colspan="4" class="cent" align="right" valign="bottom"><br> &nbsp;&nbsp;{$smLabel.no_messages} <b>{$smBoxName|escape:"html"}</b><br><br></td>
									{/if}<!--/sb-->
								</tr>
								<tr>
									<td colspan="7" class="default"></td>
								</tr>
							</form>
							{if $smQuotaEnabled eq 1}
							<tr>
								<td class="cent" colspan=7><br><br>&nbsp; {$smLabel.quota_usage_info}: {$smLabel.quota_usage_used} <b>{$smTotalUsed}</b>Kb {$smLabel.quota_usage_of} <b>{$smQuotaLimit}</b>Kb {$smLabel.quota_usage_avail}<br><!--{$smUsageGraph}--></td>
							</tr>
							{/if}
						</table>
</td><td width="17"><img src="inc/themes/senti/images/rightside.gif" width="17" height="100%"></td>	<tr>
		<td colspan="15" valign="top">
			<img src="inc/themes/senti/images/footer.gif" width="760" height="25" alt=""></td>
	</tr>
</table>
</body>
</html>
