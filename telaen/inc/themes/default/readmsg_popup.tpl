{include file=$popupHeaderTemplate pageTitle=$smCCList|escape:"html"}

<body>
<div id="popup">
<table cellspacing="2" cellpadding="0" border="0" align="center" bgcolor="White" width="760">
    <tr>

    <td valign="top">

  <table cellspacing=1 cellpadding=2 width="100%" border=0 bgcolor=White align=center>
    <tr> </tr>
  </table>
  <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
      <tr>

      <td bgcolor=white>

    <table width="100%" border=0 cellspacing=1 cellpadding=0>
      <tr bgcolor=white>
        <td width="20%" height="18" class="headerright">{$smLabel.from_hea} &nbsp;</td>
        <td class="default"> {section name=i loop=$smFromList}
          &nbsp;{$smFromList[i].name|default:#no_sender_text#|escape:"html"}
          {/section} </td>
      </tr>
      <tr bgcolor=white>
        <td height="18" class="headerright">{$smLabel.to_hea} &nbsp;</td>
        <td class="default"> {section name=i loop=$smTOList}{if $firstto eq "no"};{/if}&nbsp;{$smTOList[i].name|escape:"html"}{assign var="firstto" value="no"}{sectionelse}&nbsp;{$smLabel.no_recipient_text}{/section} </td>
      </tr>
      {if $smHaveCC}
      <tr bgcolor=white>
        <td height="18" class="headerright">{$smLabel.cc_hea} &nbsp;</td>
        <td class="default"> {section name=i loop=$smCCList}{if $firstcc eq "no"};{/if}&nbsp;{$smCCList[i].name|escape:"html"}{assign var="firstcc" value="no"}{/section} </td>
      </tr>
      {/if}
      <tr bgcolor=white>
        <td height="18" class="headerright">{$smLabel.subject_hea} &nbsp;</td>
        <td class="default">&nbsp;{$smSubject|default:#no_subject_text#|truncate:100:"...":true|escape:"html"}</td>
      </tr>
      <tr bgcolor=white>
        <td height="18" class="headerright">{$smLabel.date_hea} &nbsp;</td>
        <td class="default">&nbsp;{$smDate|date_format:$smLabel.date_format}</td>
      </tr>
      {if $smHaveAttachments}
      <tr bgcolor=silver>
        <td class="headerright">{$smLabel.attach_hea} &nbsp;</td>
          <td>
        <table width="100%" border=0 cellspacing=1 cellpadding=0>
          <tr bgcolor="#f1f1f1">
            <td class="headers" width="60%">&nbsp;<b>{$smLabel.attch_name_hea}</b> ({$smLabel.attch_force_hea})</td>
            <td class="headers">&nbsp;<b>{$smLabel.attch_size_hea}</b></td>
            <td class="headers">&nbsp;<b>{$smLabel.attch_type_hea}</b></td>
            {section name=i loop=$smAttachList}
          <tr bgcolor=white>
            <td class="default">&nbsp;{$smAttachList[i].normlink}{$smAttachList[i].name|truncate:30:"...":true|escape:"html"}</a> &nbsp;&nbsp;&nbsp;&nbsp;{$smAttachList[i].downlink}<img src="inc/themes/default/images/download.gif" width="12" height="12" border="0" alt=""></a></td>
            <td class="right">{$smAttachList[i].size}Kb &nbsp;</td>
            <td class="default">&nbsp;{$smAttachList[i].type}</td>
            {/section}
            </td>

        </table>
        </td>

        </tr>

      {/if}
      <tr>
        <td colspan=2 class="default"><table width="100%" border=0 cellspacing=1 cellpadding=0>
            <tr bgcolor=white>
              <td width="60%"{$smBackImg}{$smBackColor}><font color=black>{$smMessageBody}</font></td>
            </tr>
          </table></td>
      </tr>
    </table>
      </td>

      </tr>

  </table>
    </td>

    </tr>

</table>
{include file=$footerTemplate} 
