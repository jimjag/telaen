{config_load file=$umLanguageFile section="Newmessage"}

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
{if $smAdvancedEditor eq 1}
	<div id="hiddenCompose" style="position: absolute; left: 3; top: -100; visibility: hidden; z-index: 3">	      
	<form name="hiddencomposeForm">
	<textarea name="hiddencomposeFormTextArea">{$smBody|escape:"html"}</textarea>
	</form>
	</div>
{/if}

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
		<form name="composeForm" method="post" action="newmsg.php" onSubmit="return false;">
		{$smForms}
		<td valign="middle">
			<table cellspacing="0" cellpadding="0" width="100%" border="0" class="normal" >
				<tr><td align="center" valign="middle" bgcolor="#EAEAEA" height="70" width="84" onmouseover="mOvr(this,'#ACB6D1');" onmouseout="mOut(this,'#EAEAEA');" onclick="mClk(this);"><a href="javascript:goinbox()"><img src="inc/themes/beauvoir/inbox.gif" border="0" width="31" height="31"><br>{$smLabel.messages_mnu}</a></td>
				<td align="center" valign="middle" bgcolor="#EAEAEA" height="70" width="84"><img src="inc/themes/beauvoir/write.gif" border="0" width="31" height="31"><br><font class="inactive">{$smLabel.compose_mnu}</font></td>
				<td align="center" valign="middle" bgcolor="#EAEAEA" height="70" width="84"><img src="inc/themes/beauvoir/refresh.gif" border="0" width="31" height="31"><br><font class="inactive">{$smLabel.refresh_mnu}</font></td>
				<td align="center" valign="middle" bgcolor="#EAEAEA" height="70" width="83" onmouseover="mOvr(this,'#ACB6D1');" onmouseout="mOut(this,'#EAEAEA');" onclick="mClk(this);"><a href="javascript:folderlist()"><img src="inc/themes/beauvoir/folder.gif" border="0" width="31" height="31"><br>{$smLabel.folders_mnu}</a></td>
				<td align="center" valign="middle" bgcolor="#EAEAEA" height="70" width="83" onmouseover="mOvr(this,'#ACB6D1');" onmouseout="mOut(this,'#EAEAEA');" onclick="mClk(this);"><a href="javascript:search()"><img src="inc/themes/beauvoir/search.gif" border="0" width="31" height="31"><br>{$smLabel.search_mnu}</a></td>
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
					<td colspan="2" height="20">&nbsp;</td>
				</tr>	
				<tr>
					<td align="right" width="30%">{$smLabel.to_hea}&nbsp;<a href="javascript:addrpopup()"><img src="./themes/beauvoir/catch.gif" width="15" height="15" border="0" alt="<!--%address_tip%-->" align="absmiddle"></a>&nbsp;</td>
					<td>{$smTo}</td>
				</tr>	
				<tr>
					<td align="right">{$smLabel.cc_hea}&nbsp;<a href="javascript:addrpopup()"><img src="./themes/beauvoir/catch.gif" width="15" height="15" border="0" alt="<!--%address_tip%-->" align="absmiddle"></a>&nbsp;</td>
					<td>{$smCc}</td>
				</tr>	
				<tr>
					<td align="right">{$smLabel.bcc_hea}&nbsp;<a href="javascript:addrpopup()"><img src="./themes/beauvoir/catch.gif" width="15" height="15" border="0" alt="<!--%address_tip%-->" align="absmiddle"></a>&nbsp;</td>
					<td>{$smBcc}</td>
				</tr>	
				<tr>
					<td align="right">{$smLabel.subject_hea}&nbsp;</td>
					<td>{$smSubject}</td>
				</tr>	
				<tr>
					<td align="right">{$smLabel.attach_hea}&nbsp;</td>
					<td align="left">
						<table cellspacing="1" cellpadding="0" width="445" border="0" class="normal" bgcolor="#999999">
						{if $smHaveAttachs eq 1}
							<tr bgcolor="#ACB6D1">
								<td width="45%">{$smLabel.attch_name_hea}</td>
								<td width="15%">{$smLabel.attch_size}</td>
								<td width="30%">{$smLabel.attch_type_hea}</td>
								<td width="10%">{$smLabel.attch_dele_hea}</td>
							</tr>
						{section name=i loop=$smAttachList}
							<tr bgcolor="#EAEAEA">
								<td width="50%">{$smAttachList[i].name|escape:"html"}</td>
								<td width="10%">{$smAttachList[i].size} Kb</td>
								<td width="30%">{$smAttachList[i].type|truncate:23:"...":true}</td>
								<td width="10%" align="center"><a href="{$smAttachList[i].link}">OK</a></td>
							</tr>
						{/section}
						{else}							
							<tr bgcolor="#EAEAEA">
								<td width="100%" colspan="3">{$smLabel.attch_no_hea}</td>
							</tr>
						{/if}
						</table>
						<table cellspacing="1" cellpadding="0" width="445" border="0" class="normal" bgcolor="#EAEAEA">
							<tr>
								<td><a href="javascript:upwin()">{$smLabel.attch_add_new}</a></td>
							</tr>
						</table>
					</td>
				</tr>	
				<tr>
					<td>&nbsp;</td>
					<td>
					{if $smAdvancedEditor eq 1}
						{include file="beauvoir/advanced-editor.tpl"}
						<div id="hiddenCompose2" style="position: absolute; left: 3; top: -100; visibility: hidden; z-index: 3">	      
							<textarea rows="15" name="body" class="normal" style="width: 445px">{$smBody|escape:"html"}</textarea>
						</div>
					{else}
						<textarea rows="15" name="body" class="normal" style="width: 445px">{$smBody|escape:"html"}</textarea>
					{/if}
					</td>
				</tr>
				{if !$smAddSignature && $smHaveSignature}
				<tr>
					<td align="right">{$smLabel.add_signature} :&nbsp;</td>
					<td><input type="checkbox" name="cksig" onClick="return addsig()"{if $smAddSignature eq 1} checked disabled{/if}></td>
				</tr>
				{/if}
				<tr>
					<td align="right">{$smLabel.priority_text} :&nbsp;</td>
					<td>
						<select name="priority">
							<option value="1"{if $smPriority eq 1} selected{/if}>{$smLabel.priority_high}
							<option value="3"{if $smPriority eq 3} selected{/if}>{$smLabel.priority_normal}
							<option value="5"{if $smPriority eq 5} selected{/if}>{$smLabel.priority_low}
						</select>
					</td>
				</tr>
				<tr>
					<td height="30">&nbsp;</td>
					<td><input type="button" class="normal" name="bt_enviar" value="{$smLabel.send_text}" onClick=enviar()></td>
				</tr>
				<tr>
					<td colspan="2" height="20">&nbsp;</td>
				</tr>	
			</table>
		</td>
		</form>
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
