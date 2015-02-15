{include file=$headerTemplate pageTitle=$smLabel.newmsg_title}
<table cellspacing="2" cellpadding="0" border="0" align="center" bgcolor="White" width="100%">
  <tr>
    <td valign=top width="20%"> {include file=$menuTemplate refresh="false"}
      {include file=$calendarTemplate}
      {include file=$newsTemplate} </td>
    <td valign=center bgcolor=white><table width="100%" border="0" cellspacing="1" cellpadding="0">
        {if $umMailSent}
        <tr>
          <td class=cent> {$smLabel.result_success}<br>
            <br>
            <a href="messages.php"><b><i>{$smLabel.nav_continue}</i></b></a></td>
        </tr>
        {else}
        <tr>
          <td class=cent> {$smLabel.result_error}<br>
            <br>
            <font color=red>{$umErrorMessage}</font><br>
            <br>
            <a href="javascript:history.go(-1)">{$smLabel.nav_back}</a></td>
        </tr>
        {/if}
      </table></td>
  </tr>
</table>
{include file=$footerTemplate} 