{config_load file=$umLanguageFile section="Readmsg"}

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<title>UebiMiau Webmail &copy 2003 - Skin by Beauvoir.net - {$smCCList|escape:"html"}</title>
<meta http-equiv="Content-Type" content="text/html; charset={$smLabel.default_char_set}">
<link rel="stylesheet" href="inc/themes/beauvoir/webmail.css" type="text/css">
<script language="JavaScript" src="inc/themes/beauvoir/webmail.js" type="text/javascript"></script>
</head>
{$smJS}
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
		<td valign="top">
			<table cellspacing="1" cellpadding="0" width="100%" border="0" class="normal" bgcolor="#F5F4F4">
				<tr><td>
					<table cellspacing="1" cellpadding="0" width="100%" border="0" class="normal" bgcolor="#EAEAEA">
						<tr>
							<td width="15%" align="left" height="20">&nbsp;{$smLabel.from_hea}&nbsp;</td>
							<td>{section name=i loop=$smFromList}&nbsp;{$smFromList[i].name|default:#no_sender_text#|escape:"html"}{/section}</td>
						</tr>
						<tr>
							<td width="15%" align="left" height="20">&nbsp;{$smLabel.to_hea}&nbsp;</td>
							<td>{section name=i loop=$smTOList}{if $firstto eq "no"};{/if}&nbsp;{$smTOList[i].name|escape:"html"}{assign var="firstto" value="no"}{sectionelse}&nbsp;{$smLabel.no_recipient_text}{/section}</td>
						</tr>	
						{if $smHaveCC}
						<tr>
							<td width="15%" align="left" height="20">&nbsp;{$smLabel.cc_hea}&nbsp;</td>
							<td>{section name=i loop=$smCCList}{if $firstcc eq "no"};{/if}&nbsp;{$smCCList[i].name|escape:"html"}{assign var="firstcc" value="no"}{/section}</td>
						</tr>	
						{/if}
						<tr>
							<td width="15%" align="left" height="20">&nbsp;{$smLabel.subject_hea}&nbsp;</td>
							<td>{$smSubject|default:#no_subject_text#|truncate:100:"...":true|escape:"html"}</td>
						</tr>	
						<tr>
							<td width="15%" align="left" height="20">&nbsp;{$smLabel.date_hea}&nbsp;</td>
							<td class="default">{$smDate|date_format:$smLabel.date_format}</td>
						</tr>	
						{if $smHaveAttachments}
						<tr>
							<td width="15%" align="left" height="20">&nbsp;{$smLabel.attach_hea}&nbsp;</td>
							<td>
								<table width="100%" border="0" cellspacing="1" cellpadding="0" class="normal" bgcolor="#999999">
									<tr bgcolor="#ACB6D1">
										<td width="60%">&nbsp;<b>{$smLabel.attch_name_hea}</b> ({$smLabel.attch_force_hea})</td>
										<td>&nbsp;<b>{$smLabel.attch_size_hea}</b></td>
										<td>&nbsp;<b>{$smLabel.attch_type_hea}</b></td>
									</tr>
									{section name=i loop=$smAttachList}
									<tr bgcolor="#EAEAEA">
										<td>&nbsp;{$smAttachList[i].normlink}{$smAttachList[i].name|truncate:30:"...":true|escape:"html"}</a> {$smAttachList[i].downlink}<img src="./images/download.gif" width="12" height="12" border="0"></a></td>
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
								<table width="100%" border="0" cellspacing="1" cellpadding="0" class="normal" bgcolor="#F5F4F4">
									<tr>
										<td width="60%"{$smBackImg}{$smBackColor}><font class="normal">{$smMessageBody}</font></td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	<tr>
		<td align="center" bgcolor="#EAEAEA" height="30">
			<font class="normal">Webmail powered by <a href="http://uebimiau.sourceforge.net" target="_blank">Uebimiau</a> - Skinned by <a href="" target="_blank">Beauvoir</a></font>
		</td>
	</tr>
</table>
<br><br>
</body>
</html>
