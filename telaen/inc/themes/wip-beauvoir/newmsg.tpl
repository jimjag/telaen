{config_load file=$umLanguageFile section="Newmessage"}

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset={$umLabel.default_char_set}">
<title>UebiMiau Webmail &copy 2003 - Skin by Beauvoir.net</title>
<link rel="stylesheet" href="themes/beauvoir/webmail.css" type="text/css">
<script language="JavaScript" src="themes/beauvoir/webmail.js" type="text/javascript"></script>
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
<br><br>
<table width="750" border="0" cellspacing="1" cellpadding="0" class="normal" align="center" bgcolor="#999999">
	<tr>
		<td align="center"><img src="themes/beauvoir/logo.gif" border="0" alt="Beauvoir Skin"></td>
	</tr>
</table>
<br><br>
<table width="750" border="0" cellspacing="1" cellpadding="0" class="normal" align="center" bgcolor="#999999">
	<tr>
		<form name="composeForm" method="post" action="newmsg.php" onSubmit="return false;">
		{$umForms}
		<td valign="middle">
			<table cellspacing="0" cellpadding="0" width="100%" border="0" class="normal" >
				<tr><td align="center" valign="middle" bgcolor="#EAEAEA" height="70" width="84" onmouseover="mOvr(this,'#ACB6D1');" onmouseout="mOut(this,'#EAEAEA');" onclick="mClk(this);"><a href="javascript:goinbox()"><img src="themes/beauvoir/inbox.gif" border="0" width="31" height="31"><br>{$umLabel.messages_mnu}</a></td>
				<td align="center" valign="middle" bgcolor="#EAEAEA" height="70" width="84"><img src="themes/beauvoir/write.gif" border="0" width="31" height="31"><br><font class="inactive">{$umLabel.compose_mnu}</font></td>
				<td align="center" valign="middle" bgcolor="#EAEAEA" height="70" width="84"><img src="themes/beauvoir/refresh.gif" border="0" width="31" height="31"><br><font class="inactive">{$umLabel.refresh_mnu}</font></td>
				<td align="center" valign="middle" bgcolor="#EAEAEA" height="70" width="83" onmouseover="mOvr(this,'#ACB6D1');" onmouseout="mOut(this,'#EAEAEA');" onclick="mClk(this);"><a href="javascript:folderlist()"><img src="themes/beauvoir/folder.gif" border="0" width="31" height="31"><br>{$umLabel.folders_mnu}</a></td>
				<td align="center" valign="middle" bgcolor="#EAEAEA" height="70" width="83" onmouseover="mOvr(this,'#ACB6D1');" onmouseout="mOut(this,'#EAEAEA');" onclick="mClk(this);"><a href="javascript:search()"><img src="themes/beauvoir/search.gif" border="0" width="31" height="31"><br>{$umLabel.search_mnu}</a></td>
				<td align="center" valign="middle" bgcolor="#EAEAEA" height="70" width="83" onmouseover="mOvr(this,'#ACB6D1');" onmouseout="mOut(this,'#EAEAEA');" onclick="mClk(this);"><a href="javascript:addresses()"><img src="themes/beauvoir/contact.gif" border="0" width="31" height="31"><br>{$umLabel.address_mnu}</a></td>
				<td align="center" valign="middle" bgcolor="#EAEAEA" height="70" width="83" onmouseover="mOvr(this,'#ACB6D1');" onmouseout="mOut(this,'#EAEAEA');" onclick="mClk(this);"><a href="javascript:emptytrash()"><img src="themes/beauvoir/trash.gif" border="0" width="31" height="31"><br>{$umLabel.empty_trash_mnu}</a></td>
				<td align="center" valign="middle" bgcolor="#EAEAEA" height="70" width="83" onmouseover="mOvr(this,'#ACB6D1');" onmouseout="mOut(this,'#EAEAEA');" onclick="mClk(this);"><a href="javascript:prefs()"><img src="themes/beauvoir/prefs.gif" border="0" width="31" height="31"><br>{$umLabel.prefs_mnu}</a></td>
				<td align="center" valign="middle" bgcolor="#EAEAEA" height="70" width="83" onmouseover="mOvr(this,'#ACB6D1');" onmouseout="mOut(this,'#EAEAEA');" onclick="mClk(this);"><a href="javascript:goend()"><img src="themes/beauvoir/logout.gif" border="0" width="31" height="31"><br>{$umLabel.logoff_mnu}</a></td></tr>
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
					<td align="right" width="30%">{$umLabel.to_hea}&nbsp;<a href="javascript:addrpopup()"><img src="./themes/beauvoir/catch.gif" width="15" height="15" border="0" alt="<!--%address_tip%-->" align="absmiddle"></a>&nbsp;</td>
					<td>{$umTo}</td>
				</tr>	
				<tr>
					<td align="right">{$umLabel.cc_hea}&nbsp;<a href="javascript:addrpopup()"><img src="./themes/beauvoir/catch.gif" width="15" height="15" border="0" alt="<!--%address_tip%-->" align="absmiddle"></a>&nbsp;</td>
					<td>{$umCc}</td>
				</tr>	
				<tr>
					<td align="right">{$umLabel.bcc_hea}&nbsp;<a href="javascript:addrpopup()"><img src="./themes/beauvoir/catch.gif" width="15" height="15" border="0" alt="<!--%address_tip%-->" align="absmiddle"></a>&nbsp;</td>
					<td>{$umBcc}</td>
				</tr>	
				<tr>
					<td align="right">{$umLabel.subject_hea}&nbsp;</td>
					<td>{$umSubject}</td>
				</tr>	
				<tr>
					<td align="right">{$umLabel.attach_hea}&nbsp;</td>
					<td align="left">
						<table cellspacing="1" cellpadding="0" width="445" border="0" class="normal" bgcolor="#999999">
						{if $umHaveAttachs eq 1}
							<tr bgcolor="#ACB6D1">
								<td width="45%">{$umLabel.attch_name_hea}</td>
								<td width="15%">{$umLabel.attch_size}</td>
								<td width="30%">{$umLabel.attch_type_hea}</td>
								<td width="10%">{$umLabel.attch_dele_hea}</td>
							</tr>
						{section name=i loop=$umAttachList}
							<tr bgcolor="#EAEAEA">
								<td width="50%">{$umAttachList[i].name|escape:"html"}</td>
								<td width="10%">{$umAttachList[i].size} Kb</td>
								<td width="30%">{$umAttachList[i].type|truncate:23:"...":true}</td>
								<td width="10%" align="center"><a href="{$umAttachList[i].link}">OK</a></td>
							</tr>
						{/section}
						{else}							
							<tr bgcolor="#EAEAEA">
								<td width="100%" colspan="3">{$umLabel.attch_no_hea}</td>
							</tr>
						{/if}
						</table>
						<table cellspacing="1" cellpadding="0" width="445" border="0" class="normal" bgcolor="#EAEAEA">
							<tr>
								<td><a href="javascript:upwin()">{$umLabel.attch_add_new}</a></td>
							</tr>
						</table>
					</td>
				</tr>	
				<tr>
					<td>&nbsp;</td>
					<td>
					{if $umAdvancedEditor eq 1}
						{include file="beauvoir/advanced-editor.tpl"}
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
					<td align="right">{$umLabel.add_signature} :&nbsp;</td>
					<td><input type="checkbox" name="cksig" onClick="return addsig()"{if $umAddSignature eq 1} checked disabled{/if}></td>
				</tr>
				{/if}
				<tr>
					<td align="right">{$umLabel.priority_text} :&nbsp;</td>
					<td>
						<select name="priority">
							<option value="1"{if $umPriority eq 1} selected{/if}>{$umLabel.priority_high}
							<option value="3"{if $umPriority eq 3} selected{/if}>{$umLabel.priority_normal}
							<option value="5"{if $umPriority eq 5} selected{/if}>{$umLabel.priority_low}
						</select>
					</td>
				</tr>
				<tr>
					<td height="30">&nbsp;</td>
					<td><input type="button" class="normal" name="bt_enviar" value="{$umLabel.send_text}" onClick=enviar()></td>
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
