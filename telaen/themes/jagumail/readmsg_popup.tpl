{include file=$popupHeaderTemplate pageTitle=$umPageTitle|escape:"html"}

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
        <td width="20%" height="18" class="headerright">{$umLabel.from_hea} &nbsp;</td>
        <td class="default"> {section name=i loop=$umFromList}
          &nbsp;{$umFromList[i].name|default:#no_sender_text#|escape:"html"}
          {/section} </td>
      </tr>
      <tr bgcolor=white>
        <td height="18" class="headerright">{$umLabel.to_hea} &nbsp;</td>
        <td class="default"> {section name=i loop=$umTOList}{if $firstto eq "no"};{/if}&nbsp;{$umTOList[i].name|escape:"html"}{assign var="firstto" value="no"}{sectionelse}&nbsp;{$umLabel.no_recipient_text}{/section} </td>
      </tr>
      {if $umHaveCC}
      <tr bgcolor=white>
        <td height="18" class="headerright">{$umLabel.cc_hea} &nbsp;</td>
        <td class="default"> {section name=i loop=$umCCList}{if $firstcc eq "no"};{/if}&nbsp;{$umCCList[i].name|escape:"html"}{assign var="firstcc" value="no"}{/section} </td>
      </tr>
      {/if}
      <tr bgcolor=white>
        <td height="18" class="headerright">{$umLabel.subject_hea} &nbsp;</td>
        <td class="default">&nbsp;{$umSubject|default:#no_subject_text#|truncate:100:"...":true|escape:"html"}</td>
      </tr>
      <tr bgcolor=white>
        <td height="18" class="headerright">{$umLabel.date_hea} &nbsp;</td>
        <td class="default">&nbsp;{$umDate|date_format:$umLabel.date_format}</td>
      </tr>
      {if $umHaveAttachments}
      <tr bgcolor=silver>
        <td class="headerright">{$umLabel.attach_hea} &nbsp;</td>
          <td>
        <table width="100%" border=0 cellspacing=1 cellpadding=0>
          <tr bgcolor="#f1f1f1">
            <td class="headers" width="60%">&nbsp;<b>{$umLabel.attch_name_hea}</b> ({$umLabel.attch_force_hea})</td>
            <td class="headers">&nbsp;<b>{$umLabel.attch_size_hea}</b></td>
            <td class="headers">&nbsp;<b>{$umLabel.attch_type_hea}</b></td>
            {section name=i loop=$umAttachList}
          <tr bgcolor=white>
            <td class="default">&nbsp;{$umAttachList[i].normlink}{$umAttachList[i].name|truncate:30:"...":true|escape:"html"}</a> &nbsp;&nbsp;&nbsp;&nbsp;{$umAttachList[i].downlink}<img src="./images/download.gif" width="12" height="12" border="0" alt=""></a></td>
            <td class="right">{$umAttachList[i].size}Kb &nbsp;</td>
            <td class="default">&nbsp;{$umAttachList[i].type}</td>
            {/section}
            </td>

        </table>
        </td>

        </tr>

      {/if}
      <tr>
        <td colspan=2 class="default"><table width="100%" border=0 cellspacing=1 cellpadding=0>
            <tr bgcolor=white>
              <td width="60%"{$umBackImg}{$umBackColor}><font color=black>{$umMessageBody}</font></td>
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
