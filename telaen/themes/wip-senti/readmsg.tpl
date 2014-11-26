{config_load file=$umLanguageFile section="Readmsg"}

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<title>sentiMail - {$umPageTitle|escape:"html"}</title>

<meta http-equiv="Content-Type" content="text/html; charset={$umLabel.default_char_set}">
<link rel="stylesheet" href="themes/senti/webmail.css" type="text/css">
{$umJS}
</head>

<body><br><br>
<table width="760" height="400" border="0" cellpadding="0" cellspacing="0" align="center">
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
	<tr>
<td width="18"><img src="themes/senti/images/leftside.gif" width="18" height="100%"></td>
<td colspan="13">
						<table width="100%" border=0 cellspacing=0 cellpadding=5>
							{$umReplyForm}			
							<tr>
								<td class=default colspan=2  height="18">&nbsp; <br /><br />
									{if $umHavePrevious eq 1}
									<a class="menu" href="{$umPreviousLink}" title="{$umPreviousSubject}">{$umLabel.previous_mnu}</a> :: 
									{/if}
									{if $umHaveNext eq 1}
									<a class="menu" href="{$umNextLink}" title="{$umNextSubject}">{$umLabel.next_mnu}</a> :: 
									{/if}
									<a class="menu" href="javascript:goback()">{$umLabel.back_mnu}</a> :: 
									<a class="menu" href="javascript:reply()">{$umLabel.reply_mnu}</a> :: 
									<a class="menu" href="javascript:replyall()">{$umLabel.reply_all_mnu}</a> :: 
									<a class="menu" href="javascript:forward()">{$umLabel.forward_mnu}</a> :: 
									<a class="menu" href="javascript:printit()">{$umLabel.print_mnu}</a> :: 
									<a class="menu" href="javascript:headers()">{$umLabel.headers_mnu}</a><br /><br />

								</td>
							</tr>

							<tr>
								<td width="20%" height="18" class="headerright">{$umLabel.from_hea} &nbsp;</td>
								<td class="default">
								{section name=i loop=$umFromList}
								 &nbsp;<a href="{$umFromList[i].link}" title="{$umFromList[i].title|escape:"html"}">{$umFromList[i].name|default:#no_sender_text#|escape:"html"}</a>
								{/section}&nbsp; <a href="javascript:block_addresses()">{* not fully functional <img src="themes/senti/images/cross.gif" width="15" height="13" border="0" alt="{$umLabel.block_address}"></a>&nbsp; *}<a href="javascript:catch_addresses()"><img src="themes/senti/images/bookmark_it.gif" width="15" height="12" border="0" alt="{$umLabel.catch_address}"></a>
								</td>
							</tr>
							<tr>
								<td height="18" class="headerright">{$umLabel.to_hea} &nbsp;</td>
								<td class="default">
								{section name=i loop=$umTOList}{if $firstto eq "no"}; {/if} &nbsp;<a href="{$umTOList[i].link}" title="{$umTOList[i].title|escape:"html"}">{$umTOList[i].name|escape:"html"}</a>{assign var="firstto" value="no"}{sectionelse}&nbsp;{$umLabel.no_recipient_text}{/section}
								</td>
							</tr>	

							{if $umHaveCC}
								<tr>
									<td height="18" class="headerright">{$umLabel.cc_hea} &nbsp;</td>
									<td class="default">
									{section name=i loop=$umCCList}{if $firstcc eq "no"}; {/if} <a href="{$umCCList[i].link}" title="{$umCCList[i].title|escape:"html"}">{$umCCList[i].name|escape:"html"}</a>{assign var="firstcc" value="no"}{/section}
									</td>
								</tr>	
							{/if}

							<tr>
								<td height="18" class="headerright">{$umLabel.subject_hea} &nbsp;</td>
								<td class="default"> &nbsp;{$umSubject|default:#no_subject_text#|truncate:100:"...":true|escape:"html"}</td>
							</tr>	
							<tr>
								<td height="18" class="headerright">{$umLabel.date_hea} &nbsp;</td>
								<td class="default"> &nbsp;{$umDate|date_format:$umLabel.date_format}</td>
							</tr>	
							{if $umHaveAttachments}
								<tr>
									<td class="headerright">{$umLabel.attach_hea} &nbsp;</td>
									<td>
										<table width="100%" border=0 cellspacing=1 cellpadding=0>
											<tr">
												<td class="headers" width="60%"> &nbsp;<b>{$umLabel.attch_name_hea}</b> ({$umLabel.attch_force_hea})</td>
												<td class="headers"> &nbsp;<b>{$umLabel.attch_size_hea}</b></td>
												<td class="headers"> &nbsp;<b>{$umLabel.attch_type_hea}</b></td>

												{section name=i loop=$umAttachList}
												<tr bgcolor=white>
													<td class="default"> &nbsp;{$umAttachList[i].normlink}{$umAttachList[i].name|truncate:30:"...":true|escape:"html"}</a> {$umAttachList[i].downlink}<img src="./images/download.gif" width="12" height="12" border="0" alt=""></a></td>
													<td class="right">{$umAttachList[i].size}Kb &nbsp;</td>
													<td class="default"> &nbsp;{$umAttachList[i].type}</td>
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
											<td width="60%"{$umBackImg}{$umBackColor}><font color=black>{$umMessageBody}</font></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<form name=move action="process.php" method=POST>
										{$umDeleteForm}
										<td class=default colspan=2  height="18">
										<a class="menu" href="javascript:deletemsg()">{$umLabel.delete_mnu}</a> ::
										<a class="menu" href="javascript:movemsg()">{$umLabel.move_mnu} </a> 
										<select name="aval_folders">
											{section name=i loop=$umAvalFolders}
												<option value="{$umAvalFolders[i].path|escape:"html"}">{$umAvalFolders[i].display|escape:"html"}
											{/section}
										</select>
									</td>
								</form>
							</tr>

						</table>
		</td><td width="17"><img src="themes/senti/images/rightside.gif" width="17" height="100%"></td>
	</tr>
	<tr>
		<td colspan="15" valign="top" height="25">
			<img src="themes/senti/images/footer.gif" width="760" height="25" alt=""></td>
	</tr>
</table>
</body>
</html>
