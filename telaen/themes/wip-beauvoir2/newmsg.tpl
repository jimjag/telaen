{config_load file=$umLanguageFile section="Newmessage"}

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<title>UebiMiau Webmail - {$umLabel.messages_to} {$umUserEmail} - Skin by Beauvoir.net</title>
	<meta http-equiv="Content-Type" content="text/html; charset={$umLabel.default_char_set}">
	<link rel="stylesheet" href="themes/beauvoir2/webmail.css" type="text/css">
	<script language="JavaScript" src="themes/beauvoir2/webmail.js" type="text/javascript"></script>
	{$umJS}
</head>

<!--
Skinned by Arnaud BEAUVOIR -  - 

Thank you to let the copyright in place on the login page and in all sources of pages.
This skin is the work of an author, thank you to respect it and not to remove the
copyright, or worse, to put your name at the place.
-->

{if $umAdvancedEditor eq 1}
	<div id="hiddenCompose" style="position: absolute; left: 3; top: -100; visibility: hidden; z-index: 3">	      
	<form name="hiddencomposeForm">
	<textarea name="hiddencomposeFormTextArea">{$umBody|escape:"html"}</textarea>
	</form>
	</div>
{/if}

<body>
<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0" align="center">
<tr><td valign="middle" align="center">
<table width="750" border="0" cellspacing="0" cellpadding="0" class="normal" align="center">
	<tr><td><img src="themes/beauvoir2/images/bandeau-h.gif" border="0"></td></tr>
	<tr><td><img src="themes/beauvoir2/images/logo.gif" border="0" alt="Powered by Beauvoir"></td></tr>
	<tr><td><img src="themes/beauvoir2/images/bandeau-h.gif" border="0"></td></tr>
	<tr>
		<td background="themes/beauvoir2/images/ligne-fond.gif">
			<form name="composeForm" method="post" action="newmsg.php" onSubmit="return false;">
			{$umForms}
			<table cellspacing="0" cellpadding="0" width="99.7%" border="0" class="normal" align="center">
				<tr>
					<td align="center" valign="middle" bgcolor="#BFC6D3" height="50" width="83" onmouseover="mOvr(this,'#ACB4C5');" onmouseout="mOut(this,'#BFC6D3');" onclick="mClk(this);"><a class="lien" href="javascript:goinbox()"><img src="themes/beauvoir2/images/inbox.gif" border="0"><br>{$umLabel.messages_mnu}</a></td>
					<td align="center" valign="middle" bgcolor="#BFC6D3" height="50" width="83"><img src="themes/beauvoir2/images/newmsg.gif" border="0"><br>{$umLabel.compose_mnu}</td>
					<td align="center" valign="middle" bgcolor="#BFC6D3" height="50" width="83"><img src="themes/beauvoir2/images/refresh.gif" border="0"><br>{$umLabel.refresh_mnu}</td>
					<td align="center" valign="middle" bgcolor="#BFC6D3" height="50" width="83" onmouseover="mOvr(this,'#ACB4C5');" onmouseout="mOut(this,'#BFC6D3');" onclick="mClk(this);"><a class="lien" href="javascript:folderlist()"><img src="themes/beauvoir2/images/folder.gif" border="0"><br>{$umLabel.folders_mnu}</a></td>
					<td align="center" valign="middle" bgcolor="#BFC6D3" height="50" width="83" onmouseover="mOvr(this,'#ACB4C5');" onmouseout="mOut(this,'#BFC6D3');" onclick="mClk(this);"><a class="lien" href="javascript:search()"><img src="themes/beauvoir2/images/search.gif" border="0"><br>{$umLabel.search_mnu}</a></td>
					<td align="center" valign="middle" bgcolor="#BFC6D3" height="50" width="83" onmouseover="mOvr(this,'#ACB4C5');" onmouseout="mOut(this,'#BFC6D3');" onclick="mClk(this);"><a class="lien" href="javascript:addresses()"><img src="themes/beauvoir2/images/addresses.gif" border="0"><br>{$umLabel.address_mnu}</a></td>
					<td align="center" valign="middle" bgcolor="#BFC6D3" height="50" width="83" onmouseover="mOvr(this,'#ACB4C5');" onmouseout="mOut(this,'#BFC6D3');" onclick="mClk(this);"><a class="lien" href="javascript:emptytrash()"><img src="themes/beauvoir2/images/trash.gif" border="0"><br>{$umLabel.empty_trash_mnu}</a></td>
					<td align="center" valign="middle" bgcolor="#BFC6D3" height="50" width="83" onmouseover="mOvr(this,'#ACB4C5');" onmouseout="mOut(this,'#BFC6D3');" onclick="mClk(this);"><a class="lien" href="javascript:prefs()"><img src="themes/beauvoir2/images/prefs.gif" border="0"><br>{$umLabel.prefs_mnu}</a></td>
					<td align="center" valign="middle" bgcolor="#BFC6D3" height="50" width="83" onmouseover="mOvr(this,'#ACB4C5');" onmouseout="mOut(this,'#BFC6D3');" onclick="mClk(this);"><a class="lien" href="javascript:goend()"><img src="themes/beauvoir2/images/logout.gif" border="0"><br>{$umLabel.logoff_mnu}</a></td>
				</tr>
			</table>
			<table width="99.7%" border="0" cellspacing="1" cellpadding="0" class="normal" align="center">
				<tr>
					<td colspan="2" height="20"></td>
				</tr>
				<tr>
					<td align="right" width="30%">{$umLabel.to_hea}&nbsp;<a href="javascript:addrpopup()"><img src="./themes/beauvoir2/images/bookmark_it.gif" border="0" alt="<!--%address_tip%-->" align="absmiddle"></a>&nbsp;</td>
					<td>{$umTo}</td>
				</tr>	
				<tr>
					<td align="right" width="30%">{$umLabel.cc_hea}&nbsp;<a href="javascript:addrpopup()"><img src="./themes/beauvoir2/images/bookmark_it.gif" border="0" alt="<!--%address_tip%-->" align="absmiddle"></a>&nbsp;</td>
					<td>{$umCc}</td>
				</tr>	
				<tr>
					<td align="right" width="30%">{$umLabel.bcc_hea}&nbsp;<a href="javascript:addrpopup()"><img src="./themes/beauvoir2/images/bookmark_it.gif" border="0" alt="<!--%address_tip%-->" align="absmiddle"></a>&nbsp;</td>
					<td>{$umBcc}</td>
				</tr>
				<tr>
					<td align="right" width="30%">{$umLabel.subject_hea}&nbsp;</td>
					<td>{$umSubject}</td>
				</tr>	
				<tr>
					<td align="right" width="30%">{$umLabel.attach_hea}&nbsp;</td>
					<td><table cellspacing="1" cellpadding="0" width="445" border="0" class="normal" bgcolor="#2D3443">
						{if $umHaveAttachs eq 1}
						<tr bgcolor="#BFC6D3">
							<td width="45%">&nbsp;{$umLabel.attch_name_hea}</td>
							<td width="15%">&nbsp;{$umLabel.attch_size}</td>
							<td width="30%">&nbsp;{$umLabel.attch_type_hea}</td>
							<td width="10%">&nbsp;{$umLabel.attch_dele_hea}&nbsp;</td>
						</tr>
						{section name=i loop=$umAttachList}
						<tr bgcolor="#FFFFFF">
							<td width="50%">&nbsp;{$umAttachList[i].name|escape:"html"}</td>
							<td width="10%">&nbsp;{$umAttachList[i].size} Kb</td>
							<td width="30%">&nbsp;{$umAttachList[i].type|truncate:23:"...":true}</td>
							<td width="10%" align="center"><a href="{$umAttachList[i].link}" class="lien">OK</a></td>
						</tr>
						{/section}
						{else}							
						<tr bgcolor="#FFFFFF">
							<td width="100%" colspan=3>&nbsp;{$umLabel.attch_no_hea}</td>
						</tr>
						{/if}
					</table>
					<table cellspacing="1" cellpadding="0" width="445" border="0" class="normal" bgcolor="#FFFFFF">
						<tr>
							<td><a href="javascript:upwin()" class="lien">&nbsp;{$umLabel.attch_add_new}</a></td>
						</tr>
					</table>
					</td>
				</tr>	
				<tr>
				<td></td>
				<td>
					{if $umAdvancedEditor eq 1}
						{include file="beauvoir2/advanced-editor.tpl"}
						<div id="hiddenCompose2" style="position: absolute; left: 3; top: -100; visibility: hidden; z-index: 3">	      
							<textarea rows="15" name="body" class="normal" style="width: 445px">{$umBody|escape:"html"}</textarea>
						</div>
					{else}
						<textarea rows="15" name="body" class="normal" style="width: 445px">{$umBody|escape:"html"}</textarea>
					{/if}
				</td>
				</tr>
				{if !$umAddSignature && $umHaveSignature}
				<tr>
					<td align="right">{$umLabel.add_signature}:&nbsp;</td>
					<td><input type="checkbox" name="cksig" onClick="return addsig()"{if $umAddSignature eq 1} checked disabled{/if}></td>
				</tr>
				{/if}
				<tr>
					<td align="right">{$umLabel.priority_text}:&nbsp;</td>
					<td>
						<select name="priority">
							<option value="1"{if $umPriority eq 1} selected{/if}>{$umLabel.priority_high}
							<option value="3"{if $umPriority eq 3} selected{/if}>{$umLabel.priority_normal}
							<option value="5"{if $umPriority eq 5} selected{/if}>{$umLabel.priority_low}
						</select>
					</td>
				</tr>
				<tr>
					<td height="30"></td>
					<td><input type="button" name="bt_enviar" value="{$umLabel.send_text}" onClick="enviar()" class="button"></td>
				</tr>
				<tr>
					<td colspan="2" height="20"></td>
				</tr>	
			</table>
		</td>
	</tr>
	</form>
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
