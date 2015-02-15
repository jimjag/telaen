{config_load file=$umLanguageFile section="Readmsg"}
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset={$smLabel.default_char_set}">
<title>UebiMiau Webmail - {$smCCList|escape:"html"}</title>
<link rel="stylesheet" href="inc/themes/webmail/css.css" type="text/css">
</head>
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
<table width="750" border="0" cellspacing="0" cellpadding="0" class="frame" align="center">

	<tr><td class=top><img src="inc/themes/webmail/images/logo.gif" border="0""></td></tr>
	<tr><td><img src="inc/themes/webmail/images/bandeau-h.gif" border="0"></td></tr>
</table>
<br><br>
<table width="750" border="0" cellspacing="0" cellpadding="0" class="frame" align="center">
	<tr>
		<td valign="top">
			<table cellspacing="0" cellpadding="0" width="100%" border="0" class="normal">
				<tr bgcolor="#BFC6D3">
					<td width="20%" valign="middle">&nbsp;{$smLabel.from_hea}</td>
					<td valign="middle">{section name=i loop=$smFromList}{$smFromList[i].name|default:#no_sender_text#|escape:"html"}{/section}</td>
				</tr>
				<tr bgcolor="#BFC6D3">
					<td valign="middle">&nbsp;{$smLabel.to_hea}</td>
					<td valign="middle">{section name=i loop=$smTOList}{if $firstto eq "no"};{/if}{$smTOList[i].name|escape:"html"}{assign var="firstto" value="no"}{sectionelse}&nbsp;{$smLabel.no_recipient_text}{/section}</td>
				</tr>	
				{if $smHaveCC eq 1}
				<tr bgcolor="#BFC6D3">
					<td valign="middle">&nbsp;{$smLabel.cc_hea}</td>
					<td valign="middle">{section name=i loop=$smCCList}{if $firstcc eq "no"};{/if}{$smCCList[i].name|escape:"html"}{assign var="firstcc" value="no"}{/section}</td>
				</tr>	
				{/if}
				<tr bgcolor="#BFC6D3">
					<td valign="middle">&nbsp;{$smLabel.subject_hea}</td>
					<td valign="middle">{$smSubject|default:#no_subject_text#|truncate:100:"...":true|escape:"html"}</td>
				</tr>	
				<tr bgcolor="#BFC6D3">
					<td valign="middle">&nbsp;{$smLabel.date_hea}</td>
					<td valign="middle">{$smDate|date_format:$smLabel.date_format}</td>
				</tr>	
				{if $smHaveAttachments eq 1}
				<tr>
					<td bgcolor="#BFC6D3">&nbsp;{$smLabel.attach_hea}</td>
					<td>
						<table cellspacing="1" cellpadding="0" width="100%" border="0" class="normal" bgcolor="#2D3443">
							<tr bgcolor="#BFC6D3">
								<td width="60%"> &nbsp;<b>{$smLabel.attch_name_hea}</b> ({$smLabel.attch_force_hea})</td>
								<td>&nbsp;<b>{$smLabel.attch_size_hea}</b></td>
								<td>&nbsp;<b>{$smLabel.attch_type_hea}</b></td>
							</tr>
							{section name=i loop=$smAttachList}
							<tr bgcolor="#FFFFFF">
								<td>&nbsp;{$smAttachList[i].name|truncate:30:"...":true|escape:"html"} <img src="./images/download.gif" width="12" height="12" border="0" alt=""></td>
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
						<table cellspacing="1" cellpadding="0" width="100%" border="0" class="normal">
							<tr>
								<td width="60%"{$smBackImg}{$smBackColor}>{$smMessageBody}<br><br></td>
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
<br><br>
</body>
</html>
