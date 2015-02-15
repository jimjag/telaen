{config_load file=$umLanguageFile section="Preferences"}
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<title>sentiMail - {$smLabel.prf_title}</title>

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
			<a class="menu" href="javascript:search()"><img src="inc/themes/senti/images/search.gif" width="74" height="61" alt="" border="0"></a></td>
		<td>
			<img src="inc/themes/senti/images/mail_09.gif" width="27" height="61" alt=""></td>
		<td>
			<a class="menu" href="javascript:addresses()"><img src="inc/themes/senti/images/addresses.gif" width="89" height="61" border="0" alt=""></a></td>
		<td>
			<img src="inc/themes/senti/images/mail_11.gif" width="28" height="61" alt=""></td>
		<td>
			<a class="menu" href="javascript:prefs()"><img src="inc/themes/senti/images/preferences_selected.gif" width="88" height="61" border="0" alt=""></a></td>
		<td>
			<img src="inc/themes/senti/images/mail_13.gif" width="31" height="61" alt=""></td>
		<td>
			<a class="menu" href="javascript:goend()"><img src="inc/themes/senti/images/logout.gif" width="70" height="61" border="0" alt=""></a></td>
		<td>
			<img src="inc/themes/senti/images/mail_15.gif" width="17" height="61" alt=""></td>
	</tr>
	<tr><td width="18"><img src="inc/themes/senti/images/leftside.gif" width="18" height="100%"></td>
		<td colspan="13" valign="top" bgcolor="#dddcdc"><br />
			<table cellspacing=1 cellpadding=4 width="100%" border=0>
				<form name=form1 action=preferences.php method=POST>
				<input type=hidden name=sid value="{$umSid}">
				<input type=hidden name=lid value="{$umLid}">
				<input type=hidden name=tid value="{$umTid}">
				<tr>
					<td colspan=2 class=headers valign="top"><b>{$smLabel.prf_general_title}</b></td>
				</tr>
				<tr>
					<td class=default size="20%" valign="top">&nbsp;{$smLabel.prf_name}</td>
					<td class=default valign="top"><input type=text name=f_real_name size=30 value="{$umRealName|escape:"html"}" class="textbox"></td>
				</tr>
				<tr>
					<td class=default valign="top"> &nbsp;{$smLabel.prf_reply_to}</td>
					<td class=default valign="top"><input type=text name=f_reply_to size=30 value="{$umReplyTo|escape:"html"}" class="textbox"></td>
				</tr>
				<tr>
					<td class=default valign="top"> &nbsp;{$smLabel.prf_time_zone}</td>
					<td class=default valign="top">{$umTimezoneSelect}</td>
				</tr>
				<tr>
					<td class=default valign="top"> &nbsp;{$smLabel.prf_default_editor_mode}</td>
					<td class=default valign="top">
					<select name="f_editor_mode">
						<option value="text"{if $umEditorMode eq "text"} selected{/if}>{$smLabel.prf_default_editor_mode_text}
						<option value="html"{if $umEditorMode eq "html"} selected{/if}>{$smLabel.prf_default_editor_mode_html}
					</select><br><br><br>
					</td>
				</tr>

				<tr>
					<td colspan=2 class=headers><b>{$smLabel.prf_trash_title}</b></td>
				</tr>
				<tr>
					<td class=default colspan=2 valign="top"><input type=checkbox name=f_save_trash onClick="dis()" value="1"{$umSaveTrash}><acronym style="cursor: hand;" OnClick="f_save_trash.click()">{$smLabel.prf_save_to_trash} "<b>{$smLabel.trash_extended}</b>"</acronym></td>
				</tr>
				<tr>
					<td class=default colspan=2 valign="top"><input type=checkbox name=f_st_only_read onClick="return checkDis()" value="1"{$umSaveTrashOnlyRead}><acronym style="cursor: hand;" OnClick="f_st_only_read.click()">{$smLabel.prf_save_only_read} "<b>{$smLabel.trash_extended}</b>"</acronym></td>
				</tr>
				<tr>
					<td class=default colspan=2 valign="top"><input type=checkbox name=f_empty_on_exit value="1"{$umEmptyTrashOnExit}><acronym style="cursor: hand;" OnClick="f_empty_on_exit.click()">{$smLabel.prf_empty_on_exit}</acronym></td>
				</tr>
				<tr>
					<td class=default colspan=2 valign="top"><input type=checkbox name=f_empty_spam_on_exit value="1"{$umEmptySpamOnExit}><acronym style="cursor: hand;" OnClick="f_empty_spam_on_exit.click()">{$smLabel.prf_empty_spam_on_exit}</acronym><br><br><br></td>
				</tr>
				<tr>
					<td colspan=2  class=headers valign="top"><b>{$smLabel.prf_sent_title}</b></td>
				</tr>
				<tr>
					<td class=default colspan=2 valign="top"><input type=checkbox name=f_save_sent value="1"{$umSaveSent}><acronym style="cursor: hand;" OnClick="f_save_sent.click()">{$smLabel.prf_save_sent} "<b>{$smLabel.sent_extended}</b>"</acronym><br><br><br></td>
				</tr>
				<tr>
					<td colspan=2  class=headers><b>{$smLabel.prf_messages_title}</b></td>
				</tr>
				<tr>
					<td class=default> &nbsp;{$smLabel.prf_page_limit}</td>
					<td class=default>{$umRecordsPerPage}</td>
				</tr>

				<tr>
					<td class=default> &nbsp;{$smLabel.prf_time_to_refesh}</td>
					<td class=default>{$umTimeToRefresh}</td>
				</tr>

				<tr>
					<td colspan=2  class=default><input type=checkbox name=f_display_images value="1"{$umDisplayImages}><acronym style="cursor: hand;" OnClick="f_display_images.click()">{$smLabel.prf_display_images}</acronym></td>
				</tr>
				<tr>
					<td colspan=2 valign="top"></td>
				</tr>
				<tr>
					<td colspan=2  class=headers><b>{$smLabel.prf_signature_title}</b></td>
				</tr>
				<tr>
					<td class=default valign=top> &nbsp;{$smLabel.prf_signature}</td>
					<td class=default>{$umSignature}</td>
				</tr>
				<tr>
					<td class=default colspan=2><input type=checkbox name=f_add_sig value="1"{$smAddSignature}><acronym style="cursor: hand;" OnClick="f_add_sig.click()">{$smLabel.prf_auto_add_sign}</acronym> </td>
				</tr>
				<tr>
					<td></td>
					<td><br><input type=submit value="{$smLabel.prf_save_button}" class="button"></td>
				</tr>
				</form>
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
