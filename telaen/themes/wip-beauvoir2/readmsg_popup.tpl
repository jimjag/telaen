{config_load file=$umLanguageFile section="Readmsg"}
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<title>UebiMiau Webmail - {$umPageTitle|escape:"html"} - Skin by Beauvoir.net</title>
	<meta http-equiv="Content-Type" content="text/html; charset={$umLabel.default_char_set}">
	<link rel="stylesheet" href="themes/beauvoir2/webmail.css" type="text/css">
	<script language="JavaScript" src="themes/beauvoir2/webmail.js" type="text/javascript"></script>
</head>

<!--
Skinned by Arnaud BEAUVOIR -  - 

Thank you to let the copyright in place on the login page and in all sources of pages.
This skin is the work of an author, thank you to respect it and not to remove the
copyright, or worse, to put your name at the place.
-->

{$umJS}
<body>
<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0" align="center">
<tr><td valign="middle" align="center">
<table width="750" border="0" cellspacing="0" cellpadding="0" class="normal" align="center">
	<tr><td><img src="themes/beauvoir2/images/bandeau-h.gif" border="0"></td></tr>
	<tr><td><img src="themes/beauvoir2/images/logo.gif" border="0" alt="Powered by Beauvoir"></td></tr>
	<tr><td><img src="themes/beauvoir2/images/bandeau-h.gif" border="0"></td></tr>
	<tr>
		<td background="themes/beauvoir2/images/ligne-fond.gif">
			<table width="99.7%" border="0" cellspacing="0" cellpadding="0" class="normal" align="center">
			<tr bgcolor="#BFC6D3">
				<td height="5" colspan="2"></td>
			</tr>
			<tr bgcolor="#BFC6D3">
				<td width="15%" align="left" height="20">&nbsp;{$umLabel.from_hea}</td>
				<td>&nbsp;{section name=i loop=$umFromList}{$umFromList[i].name|default:#no_sender_text#|escape:"html"}{/section}</td>
			</tr>
			<tr bgcolor="#BFC6D3">
				<td width="15%" align="left" height="20">&nbsp;{$umLabel.to_hea}</td>
				<td>&nbsp;{section name=i loop=$umTOList}{if $firstto eq "no"};{/if}{$umTOList[i].name|escape:"html"}{assign var="firstto" value="no"}{sectionelse}&nbsp;{$umLabel.no_recipient_text}{/section}</td>
			</tr>	
			{if $umHaveCC}
			<tr bgcolor="#BFC6D3">
				<td  width="15%" align="left" height="20">&nbsp;{$umLabel.cc_hea}</td>
				<td>&nbsp;{section name=i loop=$umCCList}{if $firstcc eq "no"};{/if}{$umCCList[i].name|escape:"html"}{assign var="firstcc" value="no"}{/section}</td>
			</tr>	
			{/if}
			<tr bgcolor="#BFC6D3">
				<td width="15%" align="left" height="20">&nbsp;{$umLabel.subject_hea}</td>
				<td>&nbsp;{$umSubject|default:#no_subject_text#|truncate:100:"...":true|escape:"html"}</td>
			</tr>	
			<tr bgcolor="#BFC6D3">
				<td width="15%" align="left" height="20">&nbsp;{$umLabel.date_hea}</td>
				<td>&nbsp;{$umDate|date_format:$umLabel.date_format}</td>
			</tr>	
			{if $umHaveAttachments}
			<tr bgcolor="#BFC6D3">
				<td width="15%" align="left" height="20">&nbsp;{$umLabel.attach_hea}</td>
				<td><table width="99.4%" border="0" cellspacing="1" cellpadding="0" bgcolor="#2D3443" class="normal">
						<tr bgcolor="#BFC6D3">
							<td width="60%">&nbsp;<b>{$umLabel.attch_name_hea}</b> ({$umLabel.attch_force_hea})</td>
							<td>&nbsp;<b>{$umLabel.attch_size_hea}</b></td>
							<td>&nbsp;<b>{$umLabel.attch_type_hea}</b></td>
						</tr>
						{section name=i loop=$umAttachList}
						<tr bgcolor="#FFFFFF">
							<td>&nbsp;{$umAttachList[i].normlink}{$umAttachList[i].name|truncate:30:"...":true|escape:"html"}</a> {$umAttachList[i].downlink}<img src="./images/download.gif" border="0" align="absmiddle"></a></td>
							<td>&nbsp;{$umAttachList[i].size} Kb &nbsp;</td>
							<td>&nbsp;{$umAttachList[i].type}</td>
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
							<td width="60%"{$umBackImg}{$umBackColor}>{$umMessageBody}</td>
						</tr>
					</table>
				</td>
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
