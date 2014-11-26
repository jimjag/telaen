{config_load file=$umLanguageFile section="Readmsg"}

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset={$umLabel.default_char_set}">
<title>UebiMiau Webmail &copy 2003 - Skin by Beauvoir.net - {$umPageTitle|escape:"html"}</title>
<link rel="stylesheet" href="themes/beauvoir/webmail.css" type="text/css">
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
		<td align="center"><img src="themes/beauvoir/logo.gif" border="0" alt="Beauvoir Skin"></td>
	</tr>
</table>
<br><br>
<table width="750" border="0" cellspacing="1" cellpadding="0" class="normal" align="center" bgcolor="#999999">
	<tr>
		<td valign="top">
			<table cellspacing="1" cellpadding="0" width="100%" border="0" class="normal" bgcolor="#EAEAEA">
				<tr bgcolor="#EAEAEA">
					<td width="20%" valign="middle">&nbsp;{$umLabel.from_hea}</td>
					<td valign="middle">{section name=i loop=$umFromList}<a href="{$umFromList[i].link}" title="{$umFromList[i].title|escape:"html"}">{$umFromList[i].name|default:#no_sender_text#|escape:"html"}</a>{/section}</td>
				</tr>
				<tr bgcolor="#EAEAEA">
					<td valign="middle">&nbsp;{$umLabel.to_hea}</td>
					<td valign="middle">{section name=i loop=$umTOList}{if $firstto eq "no"};{/if}<a href="{$umTOList[i].link}" title="{$umTOList[i].title|escape:"html"}">{$umTOList[i].name|escape:"html"}</a>{assign var="firstto" value="no"}{sectionelse}&nbsp;{$umLabel.no_recipient_text}{/section}</td>
				</tr>	
				{if $umHaveCC eq 1}
				<tr bgcolor="#EAEAEA">
					<td valign="middle">&nbsp;{$umLabel.cc_hea}</td>
					<td valign="middle">{section name=i loop=$umCCList}{if $firstcc eq "no"};{/if}<a href="{$umCCList[i].link}" title="{$umCCList[i].title|escape:"html"}">{$umCCList[i].name|escape:"html"}</a>{assign var="firstcc" value="no"}{/section}</td>
				</tr>	
				{/if}
				<tr bgcolor="#EAEAEA">
					<td valign="middle">&nbsp;{$umLabel.subject_hea}</td>
					<td valign="middle">{$umSubject|default:#no_subject_text#|truncate:100:"...":true|escape:"html"}</td>
				</tr>	
				<tr bgcolor="#EAEAEA">
					<td valign="middle">&nbsp;{$umLabel.date_hea}</td>
					<td valign="middle">{$umDate|date_format:$umLabel.date_format}</td>
				</tr>	
				{if $umHaveAttachments eq 1}
				<tr>
					<td bgcolor="#EAEAEA">&nbsp;{$umLabel.attach_hea}</td>
					<td>
						<table cellspacing="1" cellpadding="0" width="100%" border="0" class="normal" bgcolor="#999999">
							<tr bgcolor="#ACB6D1">
								<td width="60%"> &nbsp;<b>{$umLabel.attch_name_hea}</b> ({$umLabel.attch_force_hea})</td>
								<td>&nbsp;<b>{$umLabel.attch_size_hea}</b></td>
								<td>&nbsp;<b>{$umLabel.attch_type_hea}</b></td>
							</tr>
							{section name=i loop=$umAttachList}
							<tr bgcolor="#EAEAEA">
								<td>&nbsp;<a href="{$umAttachList[i].normlink}" target=_blank>{$umAttachList[i].name|truncate:30:"...":true|escape:"html"}</a> <a href="{$umAttachList[i].downlink}" target=_blank><img src="./images/download.gif" width="12" height="12" border="0" alt=""></a></td>
								<td>&nbsp;{$umAttachList[i].size} Kb &nbsp;</td>
								<td>&nbsp;{$umAttachList[i].type}</td>
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
								<td width="60%"{$umBackImg}{$umBackColor}>{$umMessageBody}</td>
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
