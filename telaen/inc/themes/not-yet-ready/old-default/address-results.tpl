{include file=$headerTemplate pageTitle=$smLabel.adr_title}
<table width="100%" border="0" cellspacing="0" cellpadding="2" align="center" bgcolor="white">
  <tr>
    <td valign="top"  width="20%"> {include file=$menuTemplate refresh="false"}
      {include file=$calendarTemplate}
      {include file=$newsTemplate} </td>
    <td bgcolor="white" valign="top"><table width="500" border="0" cellspacing="1" cellpadding="0">
        <tr>
          <td class="default9" align="center"><br>
            {if $smOpt eq 1}{$smLabel.addr_saved}
            {elseif $smOpt eq 2}{$smLabel.addr_added}
            {elseif $smOpt eq 3}{$smLabel.addr_deleted}
            {/if} <br>
            <br>
            <a href="{$smGoBack}">{$smLabel.adr_back}</a></td>
        </tr>
      </table></td>
  </tr>
</table>
{include file=$footerTemplate} 