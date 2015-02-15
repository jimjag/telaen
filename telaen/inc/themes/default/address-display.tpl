{include file=$headerTemplate pageTitle=$smLabel.adr_title}
<table width="100%" border="0" cellspacing="0" cellpadding="2" align="center" bgcolor="white">
  <tr>
    <td valign=top width="20%"> {include file=$menuTemplate refresh="false"}
      {include file=$calendarTemplate}			
      {include file=$newsTemplate} </td>
    <td bgcolor="white" valign="top"><table width="500" border="0" cellspacing="1" cellpadding="0">
        <tr>
          <td class="headerright" size="20%">{$smLabel.adr_name} &nbsp;</td>
          <td class=default>&nbsp;{$smAddrName|escape:"html"}</td>
        </tr>
        <tr>
          <td class="headerright">{$smLabel.adr_email} &nbsp;</td>
          <td class=default>&nbsp;{$smAddrEmail|escape:"html"}</td>
        </tr>
        <tr>
          <td class="headerright">{$smLabel.adr_street} &nbsp;</td>
          <td class=default>&nbsp;{$smAddrStreet|escape:"html"}</td>
        </tr>
        <tr>
          <td class="headerright">{$smLabel.adr_city} &nbsp;</td>
          <td class=default>&nbsp;{$smAddrCity|escape:"html"}</td>
        </tr>
        <tr>
          <td class="headerright">{$smLabel.adr_state} &nbsp;</td>
          <td class=default>&nbsp;{$smAddrState|escape:"html"}</td>
        </tr>
        <tr>
          <td class="headerright">{$smLabel.adr_work} &nbsp;</td>
          <td class=default>&nbsp;{$smAddrWork|escape:"html"}</td>
        </tr>
        <tr>
          <td class="headerright">{$smLabel.adr_phone} &nbsp;</td>
          <td class=default>&nbsp;{$smAddrPhone|escape:"html"}</td>
        </tr>
        <tr>
          <td class="headerright">{$smLabel.adr_cell} &nbsp;</td>
          <td class=default>&nbsp;{$smAddrCell|escape:"html"}</td>
        </tr>
        <tr>
          <td class="headerright">{$smLabel.adr_note} &nbsp;</td>
          <td class=default>&nbsp;{$smAddrNote|escape:"html"}</td>
        </tr>
        <tr>
          <td class="default9" colspan=2 align=center><br>
            <a href="{$smGoBack}">{$smLabel.adr_back}</a></td>
        </tr>
      </table></td>
  </tr>
</table>
{include file=$footerTemplate} 