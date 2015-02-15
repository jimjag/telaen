{config_load file=$umLanguageFile section="Folders"}
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title>UebiMiau Webmail - {$smLabel.folders_to} {$smUserEmail} - Skin by Beauvoir.net</title>
	<meta http-equiv="Content-Type" content="text/html; charset={$smLabel.default_char_set}">
	<link rel="stylesheet" href="inc/themes/beauvoir2/webmail.css" type="text/css">
	<script language="JavaScript" src="inc/themes/beauvoir2/webmail.js" type="text/javascript"></script>
	{$smJS}
</head>

<!--
Skinned by Arnaud BEAUVOIR -  - 

Thank you to let the copyright in place on the login page and in all sources of pages.
This skin is the work of an author, thank you to respect it and not to remove the
copyright, or worse, to put your name at the place.
-->

<body>
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
					<td align="center" valign="middle" bgcolor="#BFC6D3" height="50" width="83" onmouseover="mOvr(this,'#ACB4C5');" onmouseout="mOut(this,'#BFC6D3');" onclick="mClk(this);"><a class="lien" href="javascript:goinbox()"><img src="inc/themes/beauvoir2/images/inbox.gif" border="0"><br>{$smLabel.messages_mnu}</a></td>
					<td align="center" valign="middle" bgcolor="#BFC6D3" height="50" width="83" onmouseover="mOvr(this,'#ACB4C5');" onmouseout="mOut(this,'#BFC6D3');" onclick="mClk(this);"><a class="lien" href="javascript:newmsg()"><img src="inc/themes/beauvoir2/images/newmsg.gif" border="0"><br>{$smLabel.compose_mnu}</a></td>
					<td align="center" valign="middle" bgcolor="#BFC6D3" height="50" width="83" onmouseover="mOvr(this,'#ACB4C5');" onmouseout="mOut(this,'#BFC6D3');" onclick="mClk(this);"><a class="lien" href="javascript:refreshlist()"><img src="inc/themes/beauvoir2/images/refresh.gif" border="0"><br>{$smLabel.refresh_mnu}</a></td>
					<td align="center" valign="middle" bgcolor="#BFC6D3" height="50" width="83"><img src="inc/themes/beauvoir2/images/folder.gif" border="0"><br>{$smLabel.folders_mnu}</td>
					<td align="center" valign="middle" bgcolor="#BFC6D3" height="50" width="83" onmouseover="mOvr(this,'#ACB4C5');" onmouseout="mOut(this,'#BFC6D3');" onclick="mClk(this);"><a class="lien" href="javascript:search()"><img src="inc/themes/beauvoir2/images/search.gif" border="0"><br>{$smLabel.search_mnu}</a></td>
					<td align="center" valign="middle" bgcolor="#BFC6D3" height="50" width="83" onmouseover="mOvr(this,'#ACB4C5');" onmouseout="mOut(this,'#BFC6D3');" onclick="mClk(this);"><a class="lien" href="javascript:addresses()"><img src="inc/themes/beauvoir2/images/addresses.gif" border="0"><br>{$smLabel.address_mnu}</a></td>
					<td align="center" valign="middle" bgcolor="#BFC6D3" height="50" width="83" onmouseover="mOvr(this,'#ACB4C5');" onmouseout="mOut(this,'#BFC6D3');" onclick="mClk(this);"><a class="lien" href="javascript:emptytrash()"><img src="inc/themes/beauvoir2/images/trash.gif" border="0"><br>{$smLabel.empty_trash_mnu}</a></td>
					<td align="center" valign="middle" bgcolor="#BFC6D3" height="50" width="83" onmouseover="mOvr(this,'#ACB4C5');" onmouseout="mOut(this,'#BFC6D3');" onclick="mClk(this);"><a class="lien" href="javascript:prefs()"><img src="inc/themes/beauvoir2/images/prefs.gif" border="0"><br>{$smLabel.prefs_mnu}</a></td>
					<td align="center" valign="middle" bgcolor="#BFC6D3" height="50" width="83" onmouseover="mOvr(this,'#ACB4C5');" onmouseout="mOut(this,'#BFC6D3');" onclick="mClk(this);"><a class="lien" href="javascript:goend()"><img src="inc/themes/beauvoir2/images/logout.gif" border="0"><br>{$smLabel.logoff_mnu}</a></td>
				</tr>
			</table>
			<table width="99.7%" border="0" cellspacing="0" cellpadding="0" class="normal" align="center">
				<tr><td colspan="5">&nbsp;</td></tr>
			<tr bgcolor="#78879C">
			    <td width="35%" align="center" height="20">.: {$smLabel.fld_name_hea} :.</td>
			    <td width="25%" align="center">.: {$smLabel.fld_messages_hea} :.</td>
			    <td width="20%" align="center">.: {$smLabel.fld_size_hea} :.</td>
			    <td width="10%" align="center">.: {$smLabel.fld_empty_hea} :.</td>
			    <td width="10%" align="center">.: {$smLabel.fld_delete_hea} :.</td>
			</tr>
			{section name=i loop=$smFolderList}
			<tr bgcolor="#E1E4EB" onmouseover="mOvr(this,'#ACB4C5');" onmouseout="mOut(this,'#E1E4EB');">
				<td align="center" height="20"><a href="{$smFolderList[i].chlink}">{$smFolderList[i].name|escape:"html"}</a></td>
				<td align="center">{$smFolderList[i].msgs}</td>
				<td align="center">{$smFolderList[i].boxsize} Kb &nbsp;</td>
				<td align="center"><a href="{$smFolderList[i].emptylink}" class="lien">OK</a></td>
				<td align="center">{$smFolderList[i].del}</td>
			</tr>
			{/section}

			<tr bgcolor="#ACB4C5">
				<td align="center" height="20">&nbsp;</td>
				<td align="center"><b>{$smLabel.fld_total}</b></td>
				<td align="center"><b>{$smTotalUsed}</b> Kb</td>
				<td align="center">&nbsp;</td>
				<td align="center">&nbsp;</td>
			</tr>
			<tr>
				<form name="form1" action="folders.php" method="POST" onsubmit="return create();">
				<input type="hidden" name="sid" value="{$umSid}">
				<input type="hidden" name="lid" value="{$umLid}">
				<input type="hidden" name="tid" value="{$umTid}">
				<td align="center" colspan="5"><br><input type="Text" name="newfolder" class="normal" style="width:180px;border: 1 solid #7F9DB9"> <input type="button" class="button" value="{$smLabel.fld_make_new}" onClick="create()"></td>
				</form>
			</tr>
			{if $smQuotaEnabled eq 1}
			<tr>
				<td colspan="5">&nbsp;</td>
			</tr>
			<tr>
				<td align="center" colspan="5">{$smUsageGraph}<br>{$smLabel.quota_usage_info} : <b>{$smTotalUsed}</b> Kb {$smLabel.quota_usage_used} {$smLabel.quota_usage_of} <b>{$smQuotaLimit}</b> Kb {$smLabel.quota_usage_avail}</td>
			</tr>
			{/if}
			</table>
		</td>
	</tr>
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
