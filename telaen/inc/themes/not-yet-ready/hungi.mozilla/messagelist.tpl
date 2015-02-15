{include file=$headerTemplate pageTitle=#messages_to#|cat:" "|cat:$smUserEmail}

{include file=$menuTemplate}
<table cellspacing="0" cellpadding="0" border="0" align="center" bgcolor="#DDE3EB" width="100%">
  <tr>
    <td valign="top"><form name="form1" action="process.php" method="post">
        {$smForms}
        <table cellspacing="0" cellpadding="1" width="100%" border="0" bgcolor="#DDE3EB">
          {if $smNumMessages gt 0}
          <tr>
            <td colspan="7" class="default">&nbsp;&nbsp;
              {$smWelcomeMessage2}
              {if $smHaveSpam eq "TRUE"}
              - <a href="process.php?folder=spam" class="spam"><i>{$smLabel.have_spam}</i></a> {/if} </td>
          </tr>
          {if $smErrorMessage neq ""}
          <tr>
            <td colspan="7" class="default"><font color="red"><b>&nbsp;&nbsp;{$smErrorMessage}</b></font></td>
          </tr>
          {/if}
          <tr>
            <td width="20" class="headers"><input type="checkbox" name="chkall" onclick="sel()" /></td>
            <td width="34" class="headersLeft"><img src="./images/prior_high.gif" alt="" />&nbsp;<img src="images/attach.gif" alt="" />&nbsp;<img src="images/msg_read.gif" alt="" /></td>
            {if $smFolder eq "sent"}
            <td width="180" class="headersLeft">.: <b><a class="menu" href="javascript:sortby('toname')">{$smLabel.to_hea}{$smToArrow}</a></b> :.</td>
            {else}
            <td width="180" class="headersLeft">.: <b><a class="menu" href="javascript:sortby('fromname')">{$smLabel.from_hea}{$smFromArrow}</a></b> :.</td>
            {/if}
            <td class="headersLeft">.: <b><a class="menu" href="javascript:sortby('subject')">{$smLabel.subject_hea}{$smSubjectArrow}</a></b> :.</td>
            <td width="140" class="headers">.: <b><a class="menu" href="javascript:sortby('date')">{$smLabel.date_hea}{$smDateArrow}</a></b> :.</td>
            <td width="120" class="headersRight">.: <b><a class="menu" href="javascript:sortby('size')">{$smLabel.size_hea}{$smSizeArrow}</a></b> :.&nbsp;</td>
          </tr>
          {section name=i loop=$smMessageList}
          <tr>
            <td class="cent">{$smMessageList[i].checkbox}</td>
            <td class="default">{$smMessageList[i].priorimg}{$smMessageList[i].attachimg}{$smMessageList[i].statusimg}</td>
            {if $smFolder eq "sent"}
            <td class="default"><acronym title="{$smMessageList[i].to|escape:"html"|default:$smLabel.no_recipient_text}">{if !$smMessageList[i].read}<b>{/if}<a href="{$smMessageList[i].composelinksent}">{$smMessageList[i].to|truncate:30:"...":true|escape:"html"|default:$smLabel.no_subject_text}</a>{if !$smMessageList[i].read}</b>{/if}</acronym></td>
            {else}
            <td class="default"><acronym title="{$smMessageList[i].from|escape:"html"|default:$smLabel.no_recipient_text}">{if !$smMessageList[i].read}<b>{/if}<a href="{$smMessageList[i].readlink}">{$smMessageList[i].from|truncate:30:"...":true|escape:"html"|default:$smLabel.no_subject_text}</a>{if !$smMessageList[i].read}</b>{/if}</acronym></td>
            {/if}
            <td class="default"><acronym title="{$smMessageList[i].subject|escape:"html"|default:$smLabel.no_subject_text}">{if !$smMessageList[i].read}<b>{/if}<a href="{$smMessageList[i].readlink}">{$smMessageList[i].subject|truncate:40:"...":true|escape:"html"|default:$smLabel.no_subject_text}</a>{if !$smMessageList[i].read}</b>{/if}</acronym></td>
            <td class="cent">{if !$smMessageList[i].read}<b>{/if}{$smMessageList[i].date|date_format:$smLabel.date_format}{if $smMessageList[i].read eq "false"}</b>{/if}</td>
            <td class="right">{if !$smMessageList[i].read}<b>{/if}{$smMessageList[i].size} &nbsp;{if !$smMessageList[i].read}</b>{/if}</td>
          </tr>
          <tr>
            <td colspan="7" class="separator"></td>
          </tr>
          {/section}
          <tr>
            <td colspan="7" class="default"><img src="./themes/hungi.mozilla/images/arrowblue.gif" alt="" />&nbsp; <a class="menu" href="javascript:markmsg()">{$smLabel.mark_selected_mnu}</a> :: <a class="menu" href="javascript:unmarkmsg()">{$smLabel.unmark_selected_mnu}</a> :: <a class="menu" href="javascript:delemsg()">{$smLabel.delete_selected_mnu}</a> :: <a class="menu" href="javascript:movemsg()">{$smLabel.move_selected_mnu}</a>
              <select name="aval_folders">

					{section name=i loop=$smAvalFolders}

                <option value="{$smAvalFolders[i].path|escape:"html"}">{$smAvalFolders[i].display|escape:"html"}</option>

					{/section}

              </select></td>
          </tr>
          <tr>
            <td colspan="7" class="default">&nbsp;&nbsp;<span class="menu"><b>{$smLabel.pages_text}:</b></span> {if $smPreviousLink}<!--<a href="{$smFirstLink}" class="navigation">&laquo; {$smLabel.first_text}</a>&nbsp; -->
              <a href="{$smPreviousLink}" class="navigation">&laquo; {$smLabel.previous_text}</a>&nbsp;{/if}
              {$smNavBar}
              {if $smNextLink}&nbsp;<a href="{$smNextLink}" class="navigation">{$smLabel.next_text} &raquo;</a>
              <!--&nbsp;<a href="{$smLastLink}" class="navigation">{$smLabel.last_text} &raquo;</a>-->{/if} </td>
          </tr>
          {else}
          <tr>
            <td colspan="7" class="cent"><br/>
              &nbsp;&nbsp;{$smLabel.no_messages} <b>{$smBoxName|escape:"html"}</b><br/>
              <br/></td>
          </tr>
          {/if}

          {if $smQuotaEnabled eq 1}
          <tr>
            <td class="usage" colspan="7">{$smLabel.quota_usage_info}: {$smLabel.quota_usage_used} <b>{$smTotalUsed}</b> {$smLabel.quota_usage_of} <b>{$smQuotaLimit}</b> {$smLabel.quota_usage_avail}<br/>
              {$smUsageGraph}</td>
          </tr>
          {/if}
        </table>
      </form></td>
  </tr>
</table>
{include file=$footerTemplate} 