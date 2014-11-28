{config_load file=$umLanguageFile section="AddressBook"}
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
    <title>UebiMiau Webmail - {$umLabel.adr_title} - Skin by Beauvoir.net</title>
	<meta http-equiv="Content-Type" content="text/html; charset={$umLabel.default_char_set}">
	<link rel="stylesheet" href="themes/beauvoir2/webmail.css" type="text/css">
	<script language="JavaScript" src="themes/beauvoir2/webmail.js" type="text/javascript"></script>
</head>
{$umJS}

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
	<tr><td><img src="themes/beauvoir2/images/bandeau-h.gif" border="0"></td></tr>
	<tr><td><img src="themes/beauvoir2/images/logo.gif" border="0" alt="Powered by Beauvoir"></td></tr>
	<tr><td><img src="themes/beauvoir2/images/bandeau-h.gif" border="0"></td></tr>
	<tr>
		<td background="themes/beauvoir2/images/ligne-fond.gif">
			<table cellspacing="0" cellpadding="0" width="99.7%" border="0" class="normal" align="center">
				<tr>
					<td align="center" valign="middle" bgcolor="#BFC6D3" height="50" width="83" onmouseover="mOvr(this,'#ACB4C5');" onmouseout="mOut(this,'#BFC6D3');" onclick="mClk(this);"><a class="lien" href="javascript:goinbox()"><img src="themes/beauvoir2/images/inbox.gif" border="0"><br>{$umLabel.messages_mnu}</a></td>
					<td align="center" valign="middle" bgcolor="#BFC6D3" height="50" width="83" onmouseover="mOvr(this,'#ACB4C5');" onmouseout="mOut(this,'#BFC6D3');" onclick="mClk(this);"><a class="lien" href="javascript:newmsg()"><img src="themes/beauvoir2/images/newmsg.gif" border="0"><br>{$umLabel.compose_mnu}</a></td>
					<td align="center" valign="middle" bgcolor="#BFC6D3" height="50" width="83" onmouseover="mOvr(this,'#ACB4C5');" onmouseout="mOut(this,'#BFC6D3');" onclick="mClk(this);"><a class="lien" href="javascript:refreshlist()"><img src="themes/beauvoir2/images/refresh.gif" border="0"><br>{$umLabel.refresh_mnu}</a></td>
					<td align="center" valign="middle" bgcolor="#BFC6D3" height="50" width="83" onmouseover="mOvr(this,'#ACB4C5');" onmouseout="mOut(this,'#BFC6D3');" onclick="mClk(this);"><a class="lien" href="javascript:folderlist()"><img src="themes/beauvoir2/images/folder.gif" border="0"><br>{$umLabel.folders_mnu}</a></td>
					<td align="center" valign="middle" bgcolor="#BFC6D3" height="50" width="83" onmouseover="mOvr(this,'#ACB4C5');" onmouseout="mOut(this,'#BFC6D3');" onclick="mClk(this);"><a class="lien" href="javascript:search()"><img src="themes/beauvoir2/images/search.gif" border="0"><br>{$umLabel.search_mnu}</a></td>
					<td align="center" valign="middle" bgcolor="#BFC6D3" height="50" width="83" onmouseover="mOvr(this,'#ACB4C5');" onmouseout="mOut(this,'#BFC6D3');" onclick="mClk(this);"><a class="lien" href="javascript:addresses()"><img src="themes/beauvoir2/images/addresses.gif" border="0"><br>{$umLabel.address_mnu}</a></td>
					<td align="center" valign="middle" bgcolor="#BFC6D3" height="50" width="83" onmouseover="mOvr(this,'#ACB4C5');" onmouseout="mOut(this,'#BFC6D3');" onclick="mClk(this);"><a class="lien" href="javascript:emptytrash()"><img src="themes/beauvoir2/images/trash.gif" border="0"><br>{$umLabel.empty_trash_mnu}</a></td>
					<td align="center" valign="middle" bgcolor="#BFC6D3" height="50" width="83" onmouseover="mOvr(this,'#ACB4C5');" onmouseout="mOut(this,'#BFC6D3');" onclick="mClk(this);"><a class="lien" href="javascript:prefs()"><img src="themes/beauvoir2/images/prefs.gif" border="0"><br>{$umLabel.prefs_mnu}</a></td>
					<td align="center" valign="middle" bgcolor="#BFC6D3" height="50" width="83" onmouseover="mOvr(this,'#ACB4C5');" onmouseout="mOut(this,'#BFC6D3');" onclick="mClk(this);"><a class="lien" href="javascript:goend()"><img src="themes/beauvoir2/images/logout.gif" border="0"><br>{$umLabel.logoff_mnu}</a></td>
				</tr>
			</table>
			<table width="99.7%" border="0" cellspacing="0" cellpadding="0" class="normal" align="center">
				<tr><td colspan="5">&nbsp;</td></tr>
				<tr>
					<td width="40%" bgcolor="#78879C" align="center" valign="middle" height="20">{$umLabel.adr_name_hea}</td>
					<td width="40%" bgcolor="#78879C" align="center" valign="middle">{$umLabel.adr_email_hea}</td>
					<td width="10%" bgcolor="#78879C" align="center" valign="middle">{$umLabel.adr_edit_hea}</td>
					<!--<td width="10%" bgcolor="#78879C" align="center" valign="middle">{$umLabel.adr_expo_hea}</td>-->
					<td width="10%" bgcolor="#78879C" align="center" valign="middle">{$umLabel.adr_dele_hea}</td>
				</tr>
				{section name=i loop=$umAddressList}
				<tr bgcolor="E1E4EB" onmouseover="mOvr(this,'#ACB4C5');" onmouseout="mOut(this,'E1E4EB');">
					<td align="center" valign="middle" height="20"><a href="{$umAddressList[i].viewlink}" class="lien">{$umAddressList[i].name}</a></td>
					<td align="center" valign="middle"><a href="{$umAddressList[i].composelink}" class="lien">{$umAddressList[i].email}</a></td>
					<td align="center" valign="middle"><a href="{$umAddressList[i].editlink}" class="lien">OK</a></td>
					<!--<td align="center" valign="middle"><a href="{$umAddressList[i].exportlink}" class="lien">OK</a></td>-->
					<td align="center" valign="middle"><a href="{$umAddressList[i].dellink}" class="lien">OK</a></td>
				</tr>
                {/section}
				<tr bgcolor="E1E4EB">
					<td colspan="5" align="center" valign="middle">
					<br><form><input type="button" value="{$umLabel.adr_new_entry}" class="button" onClick="location = '{$umNew}'"></form><br><br>
					</td>
				</tr>
				<tr>
					<td colspan="5">&nbsp;</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td><map name="Uebimiau">
			<area shape="rect" coords="318,5,371,18" href="" target="_blank">
			<area shape="rect" coords="442,5,552,16" href="" target="_blank">
			</map>
			<img src="themes/beauvoir2/images/bandeau-b.gif" border="0" width="750" height="25" alt="Webmail powered by Uebimiau - Skinned by Forum.Beauvoir" usemap="#Uebimiau">
		</td>
	<tr>
</table>
</td></tr>
</table>
</body>
</html>
