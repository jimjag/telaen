{include file=$headerTemplate pageTitle=#folders_to#|cat:" "|cat:$smUserEmail}
<table cellspacing="2" cellpadding="0" border="0" align="center" bgcolor="White" width="100%">
  <tr>
    <td valign=top width="20%"> {include file=$menuTemplate}
      {include file=$calendarTemplate}
      {include file=$newsTemplate} </td>
    <td valign=top><table cellspacing=1 cellpadding=1 width="100%" border=0 bgcolor=White>
        <tr>
          <td width="30%" class="headers">.: {$smLabel.fld_name_hea} :.</td>
          <td width="20%" class="headers">.: {$smLabel.fld_messages_hea} :.</td>
          <td width="15%" class="headers">.: {$smLabel.fld_size_hea} :.</td>
          <td width="15%" class="headers">.: {$smLabel.fld_empty_hea} :.</td>
          <td width="20%" class="headers">.: {$smLabel.fld_delete_hea} :.</td>
        </tr>
        {section name=i loop=$smFolderList}
        <tr>
          <td class="default"><a href="{$smFolderList[i].chlink}">{$smFolderList[i].name|escape:"html"}</a></td>
          <td class="cent">{$smFolderList[i].msgs}</td>
          <td class="right">{$smFolderList[i].boxsize} &nbsp;</td>
          <td class="cent"><a href="{$smFolderList[i].emptylink}">OK</a></td>
          <td class="cent">{$smFolderList[i].del}</td>
        </tr>
        {/section}
        <tr>
          <td class="default">&nbsp;</td>
          <td class="right"><b>{$smLabel.fld_total}</b> &nbsp;</td>
          <td class="right"><b>{$smTotalUsed}</b> &nbsp;</td>
          <td class="cent">&nbsp;</td>
          <td class="cent">&nbsp;</td>
        </tr>
        {if $smQuotaEnabled eq 1}
        <tr>
          <td class="cent" colspan=5>&nbsp; {$smLabel.quota_usage_info}: {$smLabel.quota_usage_used} <b>{$smTotalUsed}</b> {$smLabel.quota_usage_of} <b>{$smQuotaLimit}</b> {$smLabel.quota_usage_avail}<br>
            {$smUsageGraph}</td>
        </tr>
        {/if}
        <tr>
          <form name="form1" action="folders.php" method="post" onsubmit="return create();">
            <td class="default" colspan="5"><br>
              <input type=Text name=newfolder value="" class="textbox">
              &nbsp;
              <input type=button value="{$smLabel.fld_make_new}" class=button onClick="create()"></td>
          </form>
        </tr>
      </table></td>
  </tr>
</table>
{include file=$footerTemplate} 