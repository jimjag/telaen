{config_load file=$umLanguageFile section="Readmsg"}

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<title>sentiMail - {$smCCList|escape:"html"}</title>

<meta http-equiv="Content-Type" content="text/html; charset={$smLabel.default_char_set}">
<link rel="stylesheet" href="inc/themes/senti/webmail.css" type="text/css">
{$smJS}
</head>

<body><br><br>
<table width="760" height="400" border="0" cellpadding="0" cellspacing="0" align="center">
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
	<tr>
<td width="18"><img src="inc/themes/senti/images/leftside.gif" width="18" height="100%"></td>
<td colspan="13">
						<table width="100%" border=0 cellspacing=0 cellpadding=5>
							{$smReplyForm}
							<tr>
								<td class=default colspan=2  height="18">&nbsp; <br /><br />
									{if $smHavePrevious eq 1}
									<a class="menu" href="{$smPreviousLink}" title="{$smPreviousSubject}">{$smLabel.previous_mnu}</a> ::
									{/if}
									{if $smHaveNext eq 1}
									<a class="menu" href="{$smNextLink}" title="{$smNextSubject}">{$smLabel.next_mnu}</a> ::
									{/if}
									<a class="menu" href="javascript:goback()">{$smLabel.back_mnu}</a> ::
									<a class="menu" href="javascript:reply()">{$smLabel.reply_mnu}</a> ::
									<a class="menu" href="javascript:replyall()">{$smLabel.reply_all_mnu}</a> ::
									<a class="menu" href="javascript:forward()">{$smLabel.forward_mnu}</a> ::
									<a class="menu" href="javascript:printit()">{$smLabel.print_mnu}</a> ::
									<a class="menu" href="javascript:headers()">{$smLabel.headers_mnu}</a><br /><br />

								</td>
							</tr>

							<tr>
								<td width="20%" height="18" class="headerright">{$smLabel.from_hea} &nbsp;</td>
								<td class="default">
								{section name=i loop=$smFromList}
								 &nbsp;<a href="{$smFromList[i].link}" title="{$smFromList[i].title|escape:"html"}">{$smFromList[i].name|default:#no_sender_text#|escape:"html"}</a>
								{/section}&nbsp; <a href="javascript:block_addresses()">{* not fully functional <img src="inc/themes/senti/images/cross.gif" width="15" height="13" border="0" alt="{$smLabel.block_address}"></a>&nbsp; *}<a href="javascript:catch_addresses()"><img src="inc/themes/senti/images/bookmark_it.gif" width="15" height="12" border="0" alt="{$smLabel.catch_address}"></a>
								</td>
							</tr>
							<tr>
								<td height="18" class="headerright">{$smLabel.to_hea} &nbsp;</td>
								<td class="default">
								{section name=i loop=$smTOList}{if $firstto eq "no"}; {/if} &nbsp;<a href="{$smTOList[i].link}" title="{$smTOList[i].title|escape:"html"}">{$smTOList[i].name|escape:"html"}</a>{assign var="firstto" value="no"}{sectionelse}&nbsp;{$smLabel.no_recipient_text}{/section}
								</td>
							</tr>	

							{if $smHaveCC}
								<tr>
									<td height="18" class="headerright">{$smLabel.cc_hea} &nbsp;</td>
									<td class="default">
									{section name=i loop=$smCCList}{if $firstcc eq "no"}; {/if} <a href="{$smCCList[i].link}" title="{$smCCList[i].title|escape:"html"}">{$smCCList[i].name|escape:"html"}</a>{assign var="firstcc" value="no"}{/section}
									</td>
								</tr>	
							{/if}

							<tr>
								<td height="18" class="headerright">{$smLabel.subject_hea} &nbsp;</td>
								<td class="default"> &nbsp;{$smSubject|default:#no_subject_text#|truncate:100:"...":true|escape:"html"}</td>
							</tr>	
							<tr>
								<td height="18" class="headerright">{$smLabel.date_hea} &nbsp;</td>
								<td class="default"> &nbsp;{$smDate|date_format:$smLabel.date_format}</td>
							</tr>	
							{if $smHaveAttachments}
								<tr>
									<td class="headerright">{$smLabel.attach_hea} &nbsp;</td>
									<td>
										<table width="100%" border=0 cellspacing=1 cellpadding=0>
											<tr">
												<td class="headers" width="60%"> &nbsp;<b>{$smLabel.attch_name_hea}</b> ({$smLabel.attch_force_hea})</td>
												<td class="headers"> &nbsp;<b>{$smLabel.attch_size_hea}</b></td>
												<td class="headers"> &nbsp;<b>{$smLabel.attch_type_hea}</b></td>

												{section name=i loop=$smAttachList}
												<tr bgcolor=white>
													<td class="default"> &nbsp;{$smAttachList[i].normlink}{$smAttachList[i].name|truncate:30:"...":true|escape:"html"}</a> {$smAttachList[i].downlink}<img src="./images/download.gif" width="12" height="12" border="0" alt=""></a></td>
													<td class="right">{$smAttachList[i].size}Kb &nbsp;</td>
													<td class="default"> &nbsp;{$smAttachList[i].type}</td>
												{/section}

											</td>
										</table>
									</td>
								</tr>	
							{/if}
							<tr>
								<td colspan=2 class="default">
									<table width="100%" border=0 cellspacing=1 cellpadding=0>
										<tr bgcolor=white>
											<td width="60%"{$smBackImg}{$smBackColor}><font color=black>{$smMessageBody}</font></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<form name=move action="process.php" method=POST>
										{$smDeleteForm}
										<td class=default colspan=2  height="18">
										<a class="menu" href="javascript:deletemsg()">{$smLabel.delete_mnu}</a> ::
										<a class="menu" href="javascript:movemsg()">{$smLabel.move_mnu} </a>
										<select name="aval_folders">
											{section name=i loop=$smAvalFolders}
												<option value="{$smAvalFolders[i].path|escape:"html"}">{$smAvalFolders[i].display|escape:"html"}
											{/section}
										</select>
									</td>
								</form>
							</tr>

						</table>
		</td><td width="17"><img src="inc/themes/senti/images/rightside.gif" width="17" height="100%"></td>
	</tr>
	<tr>
		<td colspan="15" valign="top" height="25">
			<img src="inc/themes/senti/images/footer.gif" width="760" height="25" alt=""></td>
	</tr>
</table>
</body>
</html>
