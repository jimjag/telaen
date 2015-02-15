{config_load file=$umLanguageFile section="Readmsg"}
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<title>UebiMiau Webmail - {$smCCList|escape:"html"}</title>
	<meta http-equiv="Content-Type" content="text/html; charset={$smLabel.default_char_set}">
	<link rel="stylesheet" href="inc/themes/webmail/css.css" type="text/css">
	<script language="JavaScript" src="inc/themes/webmail/js.js" type="text/javascript"></script>
</head>
{$smJS}
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
<tr><td valign="middle" align="center">
<table width="750" border="0" cellspacing="0" cellpadding="0" class="frame" align="center">

	<tr><td class=top><img src="inc/themes/webmail/images/logo.gif" border="0""></td></tr>
	<tr><td><img src="inc/themes/webmail/images/bandeau-h.gif" border="0"></td></tr>
	<tr>
		<td background="inc/themes/webmail/images/ligne-fond.gif">
			<table width="99.7%" border="0" cellspacing="0" cellpadding="0" class="normal" align="center">
			<tr bgcolor="#BFC6D3">
				<td height="5" colspan="2"></td>
			</tr>
			<tr bgcolor="#BFC6D3">
				<td width="15%" align="left" height="20">&nbsp;{$smLabel.from_hea}</td>
				<td>&nbsp;{section name=i loop=$smFromList}{$smFromList[i].name|default:#no_sender_text#|escape:"html"}{/section}</td>
			</tr>
			<tr bgcolor="#BFC6D3">
				<td width="15%" align="left" height="20">&nbsp;{$smLabel.to_hea}</td>
				<td>&nbsp;{section name=i loop=$smTOList}{if $firstto eq "no"};{/if}{$smTOList[i].name|escape:"html"}{assign var="firstto" value="no"}{sectionelse}&nbsp;{$smLabel.no_recipient_text}{/section}</td>
			</tr>	
			{if $smHaveCC}
			<tr bgcolor="#BFC6D3">
				<td  width="15%" align="left" height="20">&nbsp;{$smLabel.cc_hea}</td>
				<td>&nbsp;{section name=i loop=$smCCList}{if $firstcc eq "no"};{/if}{$smCCList[i].name|escape:"html"}{assign var="firstcc" value="no"}{/section}</td>
			</tr>	
			{/if}
			<tr bgcolor="#BFC6D3">
				<td width="15%" align="left" height="20">&nbsp;{$smLabel.subject_hea}</td>
				<td>&nbsp;{$smSubject|default:#no_subject_text#|truncate:100:"...":true|escape:"html"}</td>
			</tr>	
			<tr bgcolor="#BFC6D3">
				<td width="15%" align="left" height="20">&nbsp;{$smLabel.date_hea}</td>
				<td>&nbsp;{$smDate|date_format:$smLabel.date_format}</td>
			</tr>	
			{if $smHaveAttachments}
			<tr bgcolor="#BFC6D3">
				<td width="15%" align="left" height="20">&nbsp;{$smLabel.attach_hea}</td>
				<td><table width="99.4%" border="0" cellspacing="1" cellpadding="0" bgcolor="#2D3443" class="normal">
						<tr bgcolor="#BFC6D3">
							<td width="60%">&nbsp;<b>{$smLabel.attch_name_hea}</b> ({$smLabel.attch_force_hea})</td>
							<td>&nbsp;<b>{$smLabel.attch_size_hea}</b></td>
							<td>&nbsp;<b>{$smLabel.attch_type_hea}</b></td>
						</tr>
						{section name=i loop=$smAttachList}
						<tr bgcolor="#FFFFFF">
							<td>&nbsp;{$smAttachList[i].normlink}{$smAttachList[i].name|truncate:30:"...":true|escape:"html"}</a> {$smAttachList[i].downlink}<img src="./images/download.gif" border="0" align="absmiddle"></a></td>
							<td>&nbsp;{$smAttachList[i].size} Kb &nbsp;</td>
							<td>&nbsp;{$smAttachList[i].type}</td>
						</tr>
						{/section}
					</table>
				</td>
			</tr>
			<tr bgcolor="#BFC6D3">
				<td height="5" colspan="2"></td>
			</tr>
			{/if}
			<tr>
				<td colspan="2">
					<table width="100%" border="0" cellspacing="1" cellpadding="0" class="normal">
						<tr bgcolor="#FFFFFF">
							<td width="60%"{$smBackImg}{$smBackColor}>{$smMessageBody}</td>
						</tr>
					</table>
				</td>
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
