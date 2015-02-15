{config_load file=$umLanguageFile section="Readmsg"}

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset={$smLabel.default_char_set}">
<title>UebiMiau Webmail &copy 2003 - Skin by Beauvoir.net - {$smCCList|escape:"html"}</title>
<link rel="stylesheet" href="inc/themes/beauvoir/webmail.css" type="text/css">
</head>
<!--
Skinned by Arnaud BEAUVOIR -  - 

Thank you to let the copyright in place on the login page and in all sources of pages.
This skin is the work of an author, thank you to respect it and not to remove the
copyright, or worse, to put your name at the place.
-->
{literal}
<script language="JavaScript" type="text/javascript">
function printIt() {
	try {
		self.print();
	} catch(err) {
		//
	}
}
</script>
{/literal}

<body onLoad="printIt()" leftmargin="5" topmargin="5" marginwidth="5" marginheigth="5">
<br><br>
<table width="750" border="0" cellspacing="1" cellpadding="0" class="normal" align="center" bgcolor="#999999">
	<tr>
		<td align="center"><img src="inc/themes/beauvoir/logo.gif" border="0" alt="Beauvoir Skin"></td>
	</tr>
</table>
<br><br>
<table width="750" border="0" cellspacing="1" cellpadding="0" class="normal" align="center" bgcolor="#999999">
	<tr>
		<td valign="top">
			<table cellspacing="1" cellpadding="0" width="100%" border="0" class="normal" bgcolor="#EAEAEA">
				<tr bgcolor="#EAEAEA">
					<td width="20%" valign="middle">&nbsp;{$smLabel.from_hea}</td>
					<td valign="middle">{section name=i loop=$smFromList}<a href="{$smFromList[i].link}" title="{$smFromList[i].title|escape:"html"}">{$smFromList[i].name|default:#no_sender_text#|escape:"html"}</a>{/section}</td>
				</tr>
				<tr bgcolor="#EAEAEA">
					<td valign="middle">&nbsp;{$smLabel.to_hea}</td>
					<td valign="middle">{section name=i loop=$smTOList}{if $firstto eq "no"};{/if}<a href="{$smTOList[i].link}" title="{$smTOList[i].title|escape:"html"}">{$smTOList[i].name|escape:"html"}</a>{assign var="firstto" value="no"}{sectionelse}&nbsp;{$smLabel.no_recipient_text}{/section}</td>
				</tr>	
				{if $smHaveCC eq 1}
				<tr bgcolor="#EAEAEA">
					<td valign="middle">&nbsp;{$smLabel.cc_hea}</td>
					<td valign="middle">{section name=i loop=$smCCList}{if $firstcc eq "no"};{/if}<a href="{$smCCList[i].link}" title="{$smCCList[i].title|escape:"html"}">{$smCCList[i].name|escape:"html"}</a>{assign var="firstcc" value="no"}{/section}</td>
				</tr>	
				{/if}
				<tr bgcolor="#EAEAEA">
					<td valign="middle">&nbsp;{$smLabel.subject_hea}</td>
					<td valign="middle">{$smSubject|default:#no_subject_text#|truncate:100:"...":true|escape:"html"}</td>
				</tr>	
				<tr bgcolor="#EAEAEA">
					<td valign="middle">&nbsp;{$smLabel.date_hea}</td>
					<td valign="middle">{$smDate|date_format:$smLabel.date_format}</td>
				</tr>	
				{if $smHaveAttachments eq 1}
				<tr>
					<td bgcolor="#EAEAEA">&nbsp;{$smLabel.attach_hea}</td>
					<td>
						<table cellspacing="1" cellpadding="0" width="100%" border="0" class="normal" bgcolor="#999999">
							<tr bgcolor="#ACB6D1">
								<td width="60%"> &nbsp;<b>{$smLabel.attch_name_hea}</b> ({$smLabel.attch_force_hea})</td>
								<td>&nbsp;<b>{$smLabel.attch_size_hea}</b></td>
								<td>&nbsp;<b>{$smLabel.attch_type_hea}</b></td>
							</tr>
							{section name=i loop=$smAttachList}
							<tr bgcolor="#EAEAEA">
								<td>&nbsp;<a href="{$smAttachList[i].normlink}" target=_blank>{$smAttachList[i].name|truncate:30:"...":true|escape:"html"}</a> <a href="{$smAttachList[i].downlink}" target=_blank><img src="./images/download.gif" width="12" height="12" border="0" alt=""></a></td>
								<td>&nbsp;{$smAttachList[i].size} Kb &nbsp;</td>
								<td>&nbsp;{$smAttachList[i].type}</td>
							{/section}
							</tr>
						</table>
					</td>
				</tr>	
				{/if}
				<tr>
					<td colspan="2">
						<table cellspacing="1" cellpadding="0" width="100%" border="0" class="normal" bgcolor="#F5F4F4">
							<tr>
								<td width="60%"{$smBackImg}{$smBackColor}>{$smMessageBody}</td>
							</tr>
						</table>
					</td>
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
