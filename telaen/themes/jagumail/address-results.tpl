{include file=$headerTemplate pageTitle=$umLabel.adr_title}
<table width="100%" border="0" cellspacing="0" cellpadding="2" align="center" bgcolor="white">
  <tr>
    <td valign="top"  width="20%"> {include file=$menuTemplate refresh="false"}
      {include file=$calendarTemplate}			
      {include file=$newsTemplate} </td>
    <td bgcolor="white" valign="top"><table width="500" border="0" cellspacing="1" cellpadding="0">
        <tr>
          <td class="default9" align="center"><br>
            {if $umOpt eq 1}{$umLabel.addr_saved}
            {elseif $umOpt eq 2}{$umLabel.addr_added}
            {elseif $umOpt eq 3}{$umLabel.addr_deleted}
            {/if} <br>
            <br>
            <a href="{$umGoBack}">{$umLabel.adr_back}</a></td>
        </tr>
      </table></td>
  </tr>
</table>
{include file=$footerTemplate} 