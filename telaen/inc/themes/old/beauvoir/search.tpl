{config_load file=$umLanguageFile section="Search"}

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset={$smLabel.default_char_set}">
<title>UebiMiau Webmail &copy 2003 - Skin by Beauvoir.net</title>
<link rel="stylesheet" href="inc/themes/beauvoir/webmail.css" type="text/css">
<script language="JavaScript" src="inc/themes/beauvoir/webmail.js" type="text/javascript"></script>
{$smJS}
</head>
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
				<td align="center" valign="middle" bgcolor="#EAEAEA" height="70" width="84"><img src="inc/themes/beauvoir/refresh.gif" border="0" width="31" height="31"><br><font class="inactive">{$smLabel.refresh_mnu}</font></td>
				<td align="center" valign="middle" bgcolor="#EAEAEA" height="70" width="83" onmouseover="mOvr(this,'#ACB6D1');" onmouseout="mOut(this,'#EAEAEA');" onclick="mClk(this);"><a href="javascript:folderlist()"><img src="inc/themes/beauvoir/folder.gif" border="0" width="31" height="31"><br>{$smLabel.folders_mnu}</a></td>
				<td align="center" valign="middle" bgcolor="#EAEAEA" height="70" width="83"><img src="inc/themes/beauvoir/search.gif" border="0" width="31" height="31"><br><font class="inactive">{$smLabel.search_mnu}</font></td>
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
				<td colspan="5">&nbsp;</td>
			<tr>
			<tr>
				<td align="center" colspan="5" height="30">{$smLabel.sch_information_text}</td>
			<tr>
			<tr>
				<td colspan="5">&nbsp;</td>
			<tr>
				<form name="form1" action="search.php" method="POST">
				<input type="hidden" name="tid" value="{$umTid}">
				<input type="hidden" name="lid" value="{$umLid}">
				<input type="hidden" name="sid" value="{$umSid}">
				<td colspan="5" align="center">
					<table cellspacing="1" cellpadding="0" width="450" border="0" class="normal" bgcolor="#EAEAEA" align="center">
						<tr>
							<td width="40%">&nbsp;{$smLabel.sch_from_hea} :&nbsp;</td>
							<td><input type="text" class="normal" name="srcFrom" value="{$smInputFrom|escape:"html"}" size="40" maxlength="40"></td>
						<tr>
							<td>&nbsp;{$smLabel.sch_subject_hea} :&nbsp;</td>
							<td><input type="text" class="normal" name="srcSubject" value="{$smInputSubject|escape:"html"}" size="40" maxlength="40"></td>
						<tr>
							<td>&nbsp;{$smLabel.sch_body_hea} :&nbsp;</td>
							<td><input type="text" class="normal" name="srcBody" value="{$smInputBody|escape:"html"}" size="40" maxlength="40"></td>
						<tr>
							<td>&nbsp;</td>
							<td><input type="submit" value="{$smLabel.sch_button_text}" class="normal"><br></td>
					</table>			
				</td>
				</form>
			</tr>
			<tr>
				<td colspan="5">&nbsp;</td>
			</tr>
			{if $smDoSearch}
			<tr>
			    <td width="40" height="20" bgcolor="#ACB6D1" align="center" valign="middle"><img src="./images/prior_high.gif" width="5" height="11" border="0" align="absmiddle">&nbsp;<img src="./images/attach.gif" border="0" width="6" height="14" align="absmiddle">&nbsp;<img src="./images/msg_read.gif" border="0" width="14" height="14" align="absmiddle"></td>
			    <td width="280" bgcolor="#ACB6D1" align="center" valign="middle">.: <b>{$smLabel.sch_subject_hea}</b> :.</td>
			   	<td width="180" bgcolor="#ACB6D1" align="center" valign="middle">.: <b>{$smLabel.sch_from_hea}</b> :.</td>
			    <td width="100" bgcolor="#ACB6D1" align="center" valign="middle">.: <b>{$smLabel.sch_date_hea}</b> :.</td>
			    <td width="150" bgcolor="#ACB6D1" align="center" valign="middle">.: <b>{$smLabel.sch_folder_hea}</b> :.</td>
			</tr>
			{section name=i loop=$smMessageList}
			<tr bgcolor="#EAEAEA" onmouseover="mOvr(this,'#ACB6D1');" onmouseout="mOut(this,'#EAEAEA');">
				<td align="center" height="20" valign="middle">&nbsp;{$smMessageList[i].priorimg}{$smMessageList[i].attachimg}{$smMessageList[i].statusimg}</td>
				<td valign="middle">&nbsp;{if $smMessageList[i].read eq "false"}<b>{/if}<a href="{$smMessageList[i].readlink}">{$smMessageList[i].subject|truncate:30:"...":true|escape:"html"|default:$smLabel.no_subject_text}</a>{if $smMessageList[i].read eq "false"}</b>{/if}</td>
				<td valign="middle">&nbsp;<a href="{$smMessageList[i].composelink}">{$smMessageList[i].from|truncate:30:"...":true|escape:"html"|default:$smLabel.no_subject_text}</a></td>
				<td align="center" valign="middle">{$smMessageList[i].date|date_format:$smLabel.date_format}</td>
				<td align="center" valign="middle"><a href="{$smMessageList[i].folderlink}">{$smMessageList[i].foldername|escape:"html"}</a></td>
			</tr>
			{sectionelse}
			<tr>
			    <td width="100%" align="center" valign="center" bgcolor="#EAEAEA" colspan="5"><br>{$smLabel.sch_no_results}<br><br></td>
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
		<td align="center" bgcolor="#EAEAEA" height="30">
		<font class="normal">Webmail powered by <a href="http://uebimiau.sourceforge.net" target="_blank">Uebimiau</a> - Skinned by <a href="" target="_blank">Beauvoir</a></font>
		</td>
	</tr>
</table>
<br><br>
</body>
</html>
