{config_load file=$umLanguageFile section="Preferences"}
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title>UebiMiau Webmail - {$smLabel.prf_title}</title>
	<meta http-equiv="Content-Type" content="text/html; charset={$smLabel.default_char_set}">
	<link rel="stylesheet" href="inc/themes/webmail/css.css" type="text/css">
	<script language="JavaScript" src="inc/themes/webmail/js.js" type="text/javascript"></script>
	{$smJS}
</head>
<body onLoad="dis()">
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
<tr><td valign="middle" align="center">
<table width="750" border="0" cellspacing="0" cellpadding="0" class="frame" align="center">

	<tr><td class=top><img src="inc/themes/webmail/images/logo.gif" border="0""></td></tr>
	<tr><td><img src="inc/themes/webmail/images/bandeau-h.gif" border="0"></td></tr>
	<tr>
		<td background="inc/themes/webmail/images/ligne-fond.gif">
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
				<tr><td colspan="2">&nbsp;</td></tr>
				<tr>
					<td valign="top">
					<table cellspacing="0" cellpadding="0" width="99.7%" border="0" class="normal" align="center">
						<form name="form1" action="preferences.php" method="POST">
						<input type="hidden" name="sid" value="{$umSid}">
						<input type="hidden" name="lid" value="{$umLid}">
						<input type="hidden" name="tid" value="{$umTid}">
						<tr bgcolor="#78879C">
							<td align="center" colspan="2" height="30"><b>{$smLabel.prf_general_title} :</b></td>
						</tr>
						<tr bgcolor="#E1E4EB">
							<td size="50%">&nbsp;{$smLabel.prf_name}:</td>
							<td><input type="text" class="normal"  name="f_real_name" value="{$umRealName|escape:"html"}"></td>
						</tr>
						<tr bgcolor="#E1E4EB">
							<td>&nbsp;{$smLabel.prf_reply_to}:</td>
							<td><input type="text" class="normal"  name="f_reply_to" size="30" value="{$umReplyTo|escape:"html"}" class="textbox"></td>
						</tr>
						<tr bgcolor="#E1E4EB">
							<td>&nbsp;{$smLabel.prf_time_zone}:</td>
							<td>{$umTimezoneSelect}</td>
						</tr>
						<tr bgcolor="#E1E4EB">
							<td>&nbsp;{$smLabel.prf_default_editor_mode}:</td>
							<td>
							<select name="f_editor_mode">
								<option value="text"{if $umEditorMode eq "text"} selected{/if}>{$smLabel.prf_default_editor_mode_text}
								<option value="html"{if $umEditorMode eq "html"} selected{/if}>{$smLabel.prf_default_editor_mode_html}
							</select>
							</td>
						</tr>
						<tr bgcolor="#78879C">
							<td align="center" colspan="2" height="30"><b>{$smLabel.prf_trash_title} :</b></td>
						</tr>
						<tr bgcolor="#E1E4EB">
							<td colspan="2"><input type="checkbox" name="f_save_trash" onClick="dis()" value="1"{$umSaveTrash}><acronym style="cursor: hand;" OnClick="f_save_trash.click()">{$smLabel.prf_save_to_trash} "<b>{$smLabel.trash_extended}</b>"</acronym></td>
						</tr>
						<tr bgcolor="#E1E4EB">
							<td colspan="2"><input type="checkbox" name="f_st_only_read" onClick="return checkDis()" value="1"{$umSaveTrashOnlyRead}><acronym style="cursor: hand;" OnClick="f_st_only_read.click()">{$smLabel.prf_save_only_read} "<b>{$smLabel.trash_extended}</b>"</acronym></td>
						</tr>
						<tr bgcolor="#E1E4EB">
							<td colspan="2"><input type="checkbox" name="f_empty_on_exit" value="1"{$umEmptyTrashOnExit}><acronym style="cursor: hand;" OnClick="f_empty_on_exit.click()">{$smLabel.prf_empty_on_exit}</acronym></td>
						</tr>
						<tr bgcolor="#78879C">
							<td align="center" colspan="2" height="30"><b>{$smLabel.prf_sent_title} :</b></td>
						</tr>
						<tr bgcolor="#E1E4EB">
							<td colspan=2><input type=checkbox name=f_save_sent value="1"{$umSaveSent}><acronym style="cursor: hand;" OnClick="f_save_sent.click()">{$smLabel.prf_save_sent} "<b>{$smLabel.sent_extended}</b>"</acronym></td>
						</tr>
						<tr bgcolor="#78879C">
							<td align="center" colspan="2" height="30"><b>{$smLabel.prf_messages_title} :</b></td>
						</tr>
						<tr bgcolor="#E1E4EB">
							<td>&nbsp;{$smLabel.prf_page_limit}:</td>
							<td>{$umRecordsPerPage}</td>
						</tr>
						<tr bgcolor="#E1E4EB">
							<td>&nbsp;{$smLabel.prf_time_to_refesh}:</td>
							<td>{$umTimeToRefresh}</td>
						</tr>
						<tr bgcolor="#E1E4EB">
							<td colspan="2"><input type="checkbox" name="f_display_images" value="1"{$umDisplayImages}><acronym style="cursor: hand;" OnClick="f_display_images.click()">{$smLabel.prf_display_images}</acronym></td>
						</tr>
						<tr bgcolor="#78879C">
							<td align="center" colspan="2" height="30"><b>{$smLabel.prf_signature_title} :</b></td>
						</tr>
						<tr bgcolor="#E1E4EB">
							<td valign="top">&nbsp;{$smLabel.prf_signature}:</td>
							<td>{$umSignature}</td>
						</tr>
						<tr bgcolor="#E1E4EB">
							<td colspan="2"><input type="checkbox" name="f_add_sig" value="1"{$umAddSignature}><acronym style="cursor: hand;" OnClick="f_add_sig.click()">{$smLabel.prf_auto_add_sign}</acronym> </td>
						</tr>
						<tr bgcolor="#E1E4EB">
							<td></td>
							<td><br><input type="submit" value="{$smLabel.prf_save_button}" class="button"><br><br></td>
						</tr>
						</form>
					</table>
				</td>
			</tr>
			<tr><td colspan="2">&nbsp;</td></tr>
			<tr>
				<td>
					<img src="inc/themes/webmail/images/bandeau-b.gif" border="0" width="750" height="25">
				</td>
			<tr>
	</table>
</td></tr>
</table>
</body>
</html>
