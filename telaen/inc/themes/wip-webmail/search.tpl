{config_load file=$umLanguageFile section="Search"}
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<title>UebiMiau Webmail - {$umLabel.messages_to} {$umUserEmail}</title>
	<meta http-equiv="Content-Type" content="text/html; charset={$umLabel.default_char_set}">
	<link rel="stylesheet" href="inc/themes/webmail/css.css" type="text/css">
	<script language="JavaScript" src="inc/themes/webmail/js.js" type="text/javascript"></script>
	{$umJS}
</head>
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
<tr><td valign="middle" align="center">
<table width="750" border="0" cellspacing="0" cellpadding="0" class="frame" align="center">

	<tr><td class=top><img src="inc/themes/webmail/images/logo.gif" border="0""></td></tr>
	<tr><td><img src="inc/themes/webmail/images/bandeau-h.gif" border="0"></td></tr>
	<tr>
		<td background="inc/themes/webmail/images/ligne-fond.gif">
			<table cellspacing="0" cellpadding="0" width="99.7%" border="0" class="normal" align="center">
<tr>
					<td align="center" valign="bottom" bgcolor="#ffffff" height="50" width="83" onmouseover="mOvr(this,'#ffffff');" onmouseout="mOut(this,'#ffffff');" onclick="mClk(this);"><a class="lien" href="javascript:goinbox()"><img src="inc/themes/webmail/images/inbox.gif"><br /><br /><font style="font-size: 10px;">{$umLabel.messages_mnu}</font></a></td>
					<td align="center" valign="bottom" bgcolor="#ffffff" height="50" width="83" onmouseover="mOvr(this,'#ffffff');" onmouseout="mOut(this,'#ffffff');" onclick="mClk(this);"><a class="lien" href="javascript:newmsg()"><img src="inc/themes/webmail/images/newmsg.gif"><br /><br /><font style="font-size: 10px;">{$umLabel.compose_mnu}</font></a></td>
					<td align="center" valign="bottom" bgcolor="#ffffff" height="50" width="83" onmouseover="mOvr(this,'#ffffff');" onmouseout="mOut(this,'#ffffff');" onclick="mClk(this);"><a class="lien" href="javascript:refreshlist()"><img src="inc/themes/webmail/images/refresh.gif"><br /><br /><font style="font-size: 10px;">{$umLabel.refresh_mnu}</font></a></td>
					<td align="center" valign="bottom" bgcolor="#ffffff" height="50" width="83" onmouseover="mOvr(this,'#ffffff');" onmouseout="mOut(this,'#ffffff');" onclick="mClk(this);"><a class="lien" href="javascript:folderlist()"><img src="inc/themes/webmail/images/folder.gif"><br /><br /><font style="font-size: 10px;">{$umLabel.folders_mnu}</font></a></td>
					<td align="center" valign="bottom" bgcolor="#ffffff" height="50" width="83" onmouseover="mOvr(this,'#ffffff');" onmouseout="mOut(this,'#ffffff');" onclick="mClk(this);"><a class="lien" href="javascript:search()"><img src="inc/themes/webmail/images/search.gif"><br /><br /><font style="font-size: 10px;">{$umLabel.search_mnu}</font></a></td>
					<td align="center" valign="bottom" bgcolor="#ffffff" height="50" width="83" onmouseover="mOvr(this,'#ffffff');" onmouseout="mOut(this,'#ffffff');" onclick="mClk(this);"><a class="lien" href="javascript:addresses()"><img src="inc/themes/webmail/images/addresses.gif"><br /><br /><font style="font-size: 10px;">{$umLabel.address_mnu}</font></a></td>
					<td align="center" valign="bottom" bgcolor="#ffffff" height="50" width="83" onmouseover="mOvr(this,'#ffffff');" onmouseout="mOut(this,'#ffffff');" onclick="mClk(this);"><a class="lien" href="javascript:emptytrash()"><img src="inc/themes/webmail/images/trash.gif"><br /><br /><font style="font-size: 10px;">{$umLabel.empty_trash_mnu}</font></a></td>
					<td align="center" valign="bottom" bgcolor="#ffffff" height="50" width="83" onmouseover="mOvr(this,'#ffffff');" onmouseout="mOut(this,'#ffffff');" onclick="mClk(this);"><a class="lien" href="javascript:prefs()"><img src="inc/themes/webmail/images/prefs.gif"><br /><br /><font style="font-size: 10px;">{$umLabel.prefs_mnu}</font></a></td>
					<td align="center" valign="bottom" bgcolor="#ffffff" height="50" width="83" onmouseover="mOvr(this,'#ffffff');" onmouseout="mOut(this,'#ffffff');" onclick="mClk(this);"><a class="lien" href="javascript:goend()"><img src="inc/themes/webmail/images/logout.gif"><br /><br /><font style="font-size: 10px;">{$umLabel.logoff_mnu}</font></a></td>
				</tr>
			</table>
			<table width="99.7%" border="0" cellspacing="0" cellpadding="0" class="normal" align="center">
				<tr><td colspan="5">&nbsp;</td></tr>
			<tr>
				<td align="center" colspan="5" height="30">{$umLabel.sch_information_text}</td>
			<tr>
			<tr>
				<td colspan="5">&nbsp;</td>
			<tr>
				<form name="form1" action="search.php" method="POST">
				<input type="hidden" name="tid" value="{$umTid}">
				<input type="hidden" name="lid" value="{$umLid}">
				<input type="hidden" name="sid" value="{$umSid}">
				<td colspan="5" align="center">
					<table cellspacing="1" cellpadding="0" width="450" border="0" class="normal" bgcolor="#BFC6D3" align="center">
						<tr>
							<td width="40%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{$umLabel.sch_from_hea}:</td>
							<td><input type="text" class="normal" name="srcFrom" value="{$umInputFrom|escape:"html"}" size="40" maxlength="40"></td>
						<tr>
							<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{$umLabel.sch_subject_hea}:</td>
							<td><input type="text" class="normal" name="srcSubject" value="{$umInputSubject|escape:"html"}" size="40" maxlength="40"></td>
						<tr>
							<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{$umLabel.sch_body_hea}:</td>
							<td><input type="text" class="normal" name="srcBody" value="{$umInputBody|escape:"html"}" size="40" maxlength="40"></td>
						<tr>
							<td>&nbsp;</td>
							<td><input type="submit" value="{$umLabel.sch_button_text}" class="button"><br></td>
					</table>			
				</td>
				</form>
			</tr>
			<tr>
				<td colspan="5">&nbsp;</td>
			</tr>
			{if $umDoSearch}
			<tr>
			    <td width="40" height="20" bgcolor="#78879C" align="center" valign="middle"><img src="./images/prior_high.gif" width="5" height="11" border="0" align="absmiddle">&nbsp;<img src="./images/attach.gif" border="0" width="6" height="14" align="absmiddle">&nbsp;<img src="./images/msg_read.gif" border="0" width="14" height="14" align="absmiddle"></td>
			   	<td width="180" bgcolor="#78879C" align="center" valign="middle">.: <b>{$umLabel.sch_from_hea}</b> :.</td>
			    <td width="280" bgcolor="#78879C" align="center" valign="middle">.: <b>{$umLabel.sch_subject_hea}</b> :.</td>
			    <td width="100" bgcolor="#78879C" align="center" valign="middle">.: <b>{$umLabel.sch_date_hea}</b> :.</td>
			    <td width="147" bgcolor="#78879C" align="center" valign="middle">.: <b>{$umLabel.sch_folder_hea}</b> :.</td>
			</tr>
			{section name=i loop=$umMessageList}
			<tr bgcolor="#E1E4EB" onmouseover="mOvr(this,'#ACB4C5');" onmouseout="mOut(this,'#E1E4EB');">
				<td align="center" height="20" valign="middle">{$umMessageList[i].priorimg}{$umMessageList[i].attachimg}{$umMessageList[i].statusimg}</td>
				<td valign="middle"><a href="{$umMessageList[i].composelink}" class="lien">{$umMessageList[i].from|truncate:40:"...":true|escape:"html"|default:$umLabel.no_subject_text}</a></td>
				<td valign="middle">{if $umMessageList[i].read eq "false"}<b>{/if}<a href="{$umMessageList[i].readlink}" class="lien">{$umMessageList[i].subject|truncate:50:"...":true|escape:"html"|default:$umLabel.no_subject_text}</a>{if $umMessageList[i].read eq "false"}</b>{/if}</td>
				<td align="center" valign="middle">{$umMessageList[i].date|date_format:$umLabel.date_format}</td>
				<td align="center" valign="middle"><a href="{$umMessageList[i].folderlink}" class="lien">{$umMessageList[i].foldername|escape:"html"}</a></td>
			</tr>
			{sectionelse}
			<tr>
			    <td width="100%" align="center" valign="center" bgcolor="#E1E4EB" colspan="5"><br>{$umLabel.sch_no_results}<br><br></td>
			</tr>
			{/section}
			{/if}
			<tr>
				<td colspan="5">&nbsp;</td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td class=bot>
			<img src="inc/themes/webmail/images/bandeau-b.gif" border="0" width="750" height="25">
		</td>
	<tr>
</table>
</td></tr>
</table>
</body>
</html>
