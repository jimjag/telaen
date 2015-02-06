{config_load file=$umLanguageFile section="Preferences"}
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title>UebiMiau Webmail - {$umLabel.prf_title} - Skin by Beauvoir.net</title>
	<meta http-equiv="Content-Type" content="text/html; charset={$umLabel.default_char_set}">
	<link rel="stylesheet" href="inc/themes/beauvoir2/webmail.css" type="text/css">
	<script language="JavaScript" src="inc/themes/beauvoir2/webmail.js" type="text/javascript"></script>
	{$umJS}
</head>

<!--
Skinned by Arnaud BEAUVOIR -  - 

Thank you to let the copyright in place on the login page and in all sources of pages.
This skin is the work of an author, thank you to respect it and not to remove the
copyright, or worse, to put your name at the place.
-->

<body onLoad="dis()">
<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0" align="center">
<tr><td valign="middle" align="center">
<table width="750" border="0" cellspacing="0" cellpadding="0" class="normal" align="center">
	<tr><td><img src="inc/themes/beauvoir2/images/bandeau-h.gif" border="0"></td></tr>
	<tr><td><img src="inc/themes/beauvoir2/images/logo.gif" border="0" alt="Powered by Beauvoir"></td></tr>
	<tr><td><img src="inc/themes/beauvoir2/images/bandeau-h.gif" border="0"></td></tr>
	<tr>
		<td background="inc/themes/beauvoir2/images/ligne-fond.gif">
			<table cellspacing="0" cellpadding="0" width="99.7%" border="0" class="normal" align="center">
				<tr>
					<td align="center" valign="middle" bgcolor="#BFC6D3" height="50" width="83" onmouseover="mOvr(this,'#ACB4C5');" onmouseout="mOut(this,'#BFC6D3');" onclick="mClk(this);"><a class="lien" href="javascript:goinbox()"><img src="inc/themes/beauvoir2/images/inbox.gif" border="0"><br>{$umLabel.messages_mnu}</a></td>
					<td align="center" valign="middle" bgcolor="#BFC6D3" height="50" width="83" onmouseover="mOvr(this,'#ACB4C5');" onmouseout="mOut(this,'#BFC6D3');" onclick="mClk(this);"><a class="lien" href="javascript:newmsg()"><img src="inc/themes/beauvoir2/images/newmsg.gif" border="0"><br>{$umLabel.compose_mnu}</a></td>
					<td align="center" valign="middle" bgcolor="#BFC6D3" height="50" width="83"><img src="inc/themes/beauvoir2/images/refresh.gif" border="0"><br>{$umLabel.refresh_mnu}</td>
					<td align="center" valign="middle" bgcolor="#BFC6D3" height="50" width="83" onmouseover="mOvr(this,'#ACB4C5');" onmouseout="mOut(this,'#BFC6D3');" onclick="mClk(this);"><a class="lien" href="javascript:folderlist()"><img src="inc/themes/beauvoir2/images/folder.gif" border="0"><br>{$umLabel.folders_mnu}</a></td>
					<td align="center" valign="middle" bgcolor="#BFC6D3" height="50" width="83" onmouseover="mOvr(this,'#ACB4C5');" onmouseout="mOut(this,'#BFC6D3');" onclick="mClk(this);"><a class="lien" href="javascript:search()"><img src="inc/themes/beauvoir2/images/search.gif" border="0"><br>{$umLabel.search_mnu}</a></td>
					<td align="center" valign="middle" bgcolor="#BFC6D3" height="50" width="83" onmouseover="mOvr(this,'#ACB4C5');" onmouseout="mOut(this,'#BFC6D3');" onclick="mClk(this);"><a class="lien" href="javascript:addresses()"><img src="inc/themes/beauvoir2/images/addresses.gif" border="0"><br>{$umLabel.address_mnu}</a></td>
					<td align="center" valign="middle" bgcolor="#BFC6D3" height="50" width="83" onmouseover="mOvr(this,'#ACB4C5');" onmouseout="mOut(this,'#BFC6D3');" onclick="mClk(this);"><a class="lien" href="javascript:emptytrash()"><img src="inc/themes/beauvoir2/images/trash.gif" border="0"><br>{$umLabel.empty_trash_mnu}</a></td>
					<td align="center" valign="middle" bgcolor="#BFC6D3" height="50" width="83"><img src="inc/themes/beauvoir2/images/prefs.gif" border="0"><br>{$umLabel.prefs_mnu}</td>
					<td align="center" valign="middle" bgcolor="#BFC6D3" height="50" width="83" onmouseover="mOvr(this,'#ACB4C5');" onmouseout="mOut(this,'#BFC6D3');" onclick="mClk(this);"><a class="lien" href="javascript:goend()"><img src="inc/themes/beauvoir2/images/logout.gif" border="0"><br>{$umLabel.logoff_mnu}</a></td>
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
							<td align="center" colspan="2" height="30"><b>{$umLabel.prf_general_title} :</b></td>
						</tr>
						<tr bgcolor="#E1E4EB">
							<td size="50%">&nbsp;{$umLabel.prf_name}:</td>
							<td><input type="text" class="normal" style="width : 335px; border: 1 solid #7F9DB9" name="f_real_name" value="{$umRealName|escape:"html"}"></td>
						</tr>
						<tr bgcolor="#E1E4EB">
							<td>&nbsp;{$umLabel.prf_reply_to}:</td>
							<td><input type="text" class="normal" style="width : 335px; border: 1 solid #7F9DB9" name="f_reply_to" size="30" value="{$umReplyTo|escape:"html"}" class="textbox"></td>
						</tr>
						<tr bgcolor="#E1E4EB">
							<td>&nbsp;{$umLabel.prf_time_zone}:</td>
							<td>{$umTimezoneSelect}</td>
						</tr>
						<tr bgcolor="#E1E4EB">
							<td>&nbsp;{$umLabel.prf_default_editor_mode}:</td>
							<td>
							<select name="f_editor_mode">
								<option value="text"{if $umEditorMode eq "text"} selected{/if}>{$umLabel.prf_default_editor_mode_text}
								<option value="html"{if $umEditorMode eq "html"} selected{/if}>{$umLabel.prf_default_editor_mode_html}
							</select>
							</td>
						</tr>
						<tr bgcolor="#78879C">
							<td align="center" colspan="2" height="30"><b>{$umLabel.prf_trash_title} :</b></td>
						</tr>
						<tr bgcolor="#E1E4EB">
							<td colspan="2"><input type="checkbox" name="f_save_trash" onClick="dis()" value="1"{$umSaveTrash}><acronym style="cursor: hand;" OnClick="f_save_trash.click()">{$umLabel.prf_save_to_trash} "<b>{$umLabel.trash_extended}</b>"</acronym></td>
						</tr>
						<tr bgcolor="#E1E4EB">
							<td colspan="2"><input type="checkbox" name="f_st_only_read" onClick="return checkDis()" value="1"{$umSaveTrashOnlyRead}><acronym style="cursor: hand;" OnClick="f_st_only_read.click()">{$umLabel.prf_save_only_read} "<b>{$umLabel.trash_extended}</b>"</acronym></td>
						</tr>
						<tr bgcolor="#E1E4EB">
							<td colspan="2"><input type="checkbox" name="f_empty_on_exit" value="1"{$umEmptyTrashOnExit}><acronym style="cursor: hand;" OnClick="f_empty_on_exit.click()">{$umLabel.prf_empty_on_exit}</acronym></td>
						</tr>
						<tr bgcolor="#78879C">
							<td align="center" colspan="2" height="30"><b>{$umLabel.prf_sent_title} :</b></td>
						</tr>
						<tr bgcolor="#E1E4EB">
							<td colspan=2><input type=checkbox name=f_save_sent value="1"{$umSaveSent}><acronym style="cursor: hand;" OnClick="f_save_sent.click()">{$umLabel.prf_save_sent} "<b>{$umLabel.sent_extended}</b>"</acronym></td>
						</tr>
						<tr bgcolor="#78879C">
							<td align="center" colspan="2" height="30"><b>{$umLabel.prf_messages_title} :</b></td>
						</tr>
						<tr bgcolor="#E1E4EB">
							<td>&nbsp;{$umLabel.prf_page_limit}:</td>
							<td>{$umRecordsPerPage}</td>
						</tr>
						<tr bgcolor="#E1E4EB">
							<td>&nbsp;{$umLabel.prf_time_to_refesh}:</td>
							<td>{$umTimeToRefresh}</td>
						</tr>
						<tr bgcolor="#E1E4EB">
							<td colspan="2"><input type="checkbox" name="f_display_images" value="1"{$umDisplayImages}><acronym style="cursor: hand;" OnClick="f_display_images.click()">{$umLabel.prf_display_images}</acronym></td>
						</tr>
						<tr bgcolor="#78879C">
							<td align="center" colspan="2" height="30"><b>{$umLabel.prf_signature_title} :</b></td>
						</tr>
						<tr bgcolor="#E1E4EB">
							<td valign="top">&nbsp;{$umLabel.prf_signature}:</td>
							<td>{$umSignature}</td>
						</tr>
						<tr bgcolor="#E1E4EB">
							<td colspan="2"><input type="checkbox" name="f_add_sig" value="1"{$umAddSignature}><acronym style="cursor: hand;" OnClick="f_add_sig.click()">{$umLabel.prf_auto_add_sign}</acronym> </td>
						</tr>
						<tr bgcolor="#E1E4EB">
							<td></td>
							<td><br><input type="submit" value="{$umLabel.prf_save_button}" class="button"><br><br></td>
						</tr>
						</form>
					</table>
				</td>
			</tr>
			<tr><td colspan="2">&nbsp;</td></tr>
			<tr>
				<td><map name="Uebimiau">
					<area shape="rect" coords="318,5,371,18" href="" target="_blank">
					<area shape="rect" coords="442,5,552,16" href="" target="_blank">
					</map>
					<img src="inc/themes/beauvoir2/images/bandeau-b.gif" border="0" width="750" height="25" alt="Webmail powered by Uebimiau - Skinned by Forum.Beauvoir" usemap="#Uebimiau">
				</td>
			<tr>
	</table>
</td></tr>
</table>
</body>
</html>
