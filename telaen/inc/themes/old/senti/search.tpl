{config_load file=$umLanguageFile section="Search"}

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<title>sentiMail - Search</title>
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
			<a class="menu" href="javascript:goinbox()"><img src="inc/themes/senti/images/inbox.gif" width="60" height="61" border="0" alt=""></a></td>
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
			<a class="menu" href="javascript:search()"><img src="inc/themes/senti/images/search_selected.gif" width="74" height="61" alt="" border="0"></a></td>
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
		<td colspan="13" valign="top">
				<table height="100%" width="100%" border=0 cellpadding="0" cellspacing="0">
							<tr>
								<td class="default" colspan="5"> {$smLabel.sch_information_text}
								</td>
							<tr>
								<form name="form1" action="search.php" method="POST">
								<input type=hidden name=tid value="{$umTid}">
								<input type=hidden name=lid value="{$umLid}">
								<input type=hidden name=sid value="{$umSid}">
								<td colspan=5>
									<table height="100%" width="100%" border=0 cellpadding="4" cellspacing="0">
										<tr>
											<td class="right">{$smLabel.sch_from_hea}: &nbsp;<td colspan="4" class="default"><input type=text name=srcFrom value="{$smInputFrom|escape:"html"}" class="textbox" size="40" maxlength="40"></td>
										<tr>
											<td class="right">{$smLabel.sch_subject_hea}: &nbsp;<td colspan="4" class="default"><input type=text name=srcSubject value="{$smInputSubject|escape:"html"}" class="textbox" size="40" maxlength="40"></td>
										<tr>
											<td class="right">{$smLabel.sch_body_hea}: &nbsp;<td colspan="4" class="default"><input type=text name=srcBody value="{$smInputBody|escape:"html"}" class="textbox" size="40" maxlength="40"></td>
										<tr>
											<td class="default"><td colspan="4" class="default"><input type=submit value="{$smLabel.sch_button_text}" class="button"></td>
									</table>			

								</td>
								</form>
							<tr>

							{if $smDoSearch}

								<tr>
								    <td width="35"  class="headers"><img src="./images/prior_high.gif" width=5 height=11 border=0 alt="">&nbsp;<img src="images/attach.gif" border="0" width="6" height="14" alt="">&nbsp;<img src="images/msg_read.gif" border="0" width="14" height="14" alt=""></td>
								    <td width="100%" class="headers">.: <b>{$smLabel.sch_subject_hea}</b> :.</td>
							    	<td width="160" class="headers">.: <b>{$smLabel.sch_from_hea}</b> :.</td>
								    <td width="90" class="headers">.: <b>{$smLabel.sch_date_hea}</b> :.</td>
								    <td width="140" class="headers">.: <b>{$smLabel.sch_folder_hea}</b> :.</td>
								</tr>

								{section name=i loop=$smMessageList}
								<tr>
									<td class="default">{$smMessageList[i].priorimg}{$smMessageList[i].attachimg}{$smMessageList[i].statusimg}</td>
									<td class="default">{if $smMessageList[i].read eq "false"}<b>{/if}<a href="{$smMessageList[i].readlink}">{$smMessageList[i].subject|truncate:30:"...":true|escape:"html"|default:$smLabel.no_subject_text}</a>{if $smMessageList[i].read eq "false"}</b>{/if}</td>
									<td class="default"><a href="{$smMessageList[i].composelink}">{$smMessageList[i].from|truncate:30:"...":true|escape:"html"|default:$smLabel.no_subject_text}</a></td>
									<td class="cent">{$smMessageList[i].date|date_format:$smLabel.date_format}</td>
									<td class="default">&nbsp;<a href="{$smMessageList[i].folderlink}">{$smMessageList[i].foldername|escape:"html"}</a></td>
								</tr>
								{sectionelse}
								<tr>
								    <td width="100%"  class="default"  colspan="5"><center><br>{$smLabel.sch_no_results}</center></td>
								</tr>
								{/section}
							{/if}
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
