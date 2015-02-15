<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<title>{if $webmailTitle}{$webmailTitle} - {/if}</title>
<meta http-equiv="Content-Type" content="text/html; charset={$smLabel.default_char_set}">
{$pageMetas}
<link rel="stylesheet" href="inc/themes/outlook/webmail.css" type="text/css">
{literal}
<script language="JavaScript" type="text/javascript">
function printIt() {
	try {
		self.print();
	} catch(err) {
		//
	}
	window.close();
}
</script>
{/literal}
</head>

<body style="background-color: #FFFFFF; width: 100%" onLoad="printIt()" leftmargin=5 topmargin=5 marginwidth=5 marginheight=5>
<br>
<br>
<table width='100%' cellpadding=0 cellspacing=0>
  <tr>
    <td style="border-bottom: 4px #000000 solid;font-family: Arial,sans serif;font-size: 16;font-weight: bold ;"><nobr>{$smSubject}</nobr></td>
    <td width="100%" style="border-bottom: 2px #000000 solid;">&nbsp;</td>
  </tr>
</table>
<br>
<table cellpadding=0 cellspacing=0 width='100%'>
  <tr>
    <td width="120px" valign="top" style="font-family: Arial,sans serif;font-size: 13;font-weight: bold ;">{$smLabel.from_hea}</td>
    <td style="font-family: Arial,sans serif;font-size: 13;font-weight: normal; width: 100%;"> {section name=i loop=$smFromList}"{$smFromList[i].name|default:#no_sender_text#|escape:"html"}"&nbsp;&lt;{$smFromList[i].mail|default:#no_sender_text#|escape:"html"}&gt;{/section} </td>
  </tr>
  <tr>
    <td width="120px" valign="top" style="font-family: Arial,sans serif;font-size: 13;font-weight: bold ;">{$smLabel.to_hea}</td>
    <td style="font-family: Arial,sans serif;font-size: 13;font-weight: normal; width: 100%;"> {section name=i loop=$smTOList}
      {if $smTOList[i].name neq $smTOList[i].mail}"{$smTOList[i].name|escape:"html"}"&nbsp;{/if}&lt;{$smTOList[i].mail|escape:"html"}&gt;
      {sectionelse}
      {$smLabel.no_recipient_text}
      {/section}</td>
  </tr>
  {if $smHaveCC eq 1}
  <tr>
    <td width="120px" valign="top" style="font-family: Arial,sans serif;font-size: 13;font-weight: bold ;">{$smLabel.cc_hea}</td>
    <td style="font-family: Arial,sans serif;font-size: 13;font-weight: normal; width: 100%;"> {section name=i loop=$smCCList}
      {if $smCCList[i].name neq $smCCList[i].mail}"{$smCCList[i].name|escape:"html"}"&nbsp;{/if}&lt;{$smCCList[i].mail|escape:"html"}&gt;
      {/section} </td>
  </tr>
  {/if}
  <tr>
    <td width="120px" valign="top" style="font-family: Arial,sans serif;font-size: 13;font-weight: bold ;">{$smLabel.date_hea}</td>
    <td style="font-family: Arial,sans serif;font-size: 13;font-weight: normal; width: 100%;">{$smDate|date_format:$smLabel.date_format}</td>
  </tr>
  {if $smHaveAttachments eq 1}
  <tr>
    <td width="120px" valign="top" style="font-family: Arial,sans serif;font-size: 13;font-weight: bold ;">{$smLabel.attach_hea}</td>
    <td style="font-family: Arial,sans serif;font-size: 13;font-weight: normal; width: 100%;">{section name=i loop=$smAttachList}{$smAttachList[i].name|escape:"html"}&nbsp;&nbsp;{/section}</td>
  </tr>
  {/if}
  <tr>
    <td width="120px" valign="top" style="font-family: Arial,sans serif;font-size: 13;font-weight: bold ;">{$smLabel.subject_hea}</td>
    <td style="font-family: Arial,sans serif;font-size: 13;font-weight: normal; width: 100%;">{$smSubject|default:#no_subject_text#|truncate:100:"...":true|escape:"html"}</td>
  </tr>
</table>
{$smMessageBody}
</body>
</html>
