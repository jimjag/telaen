{include file=$headerTemplate pageTitle=#messages_to#|cat:" "|cat:$smUserEmail}
<table cellspacing="2" cellpadding="0" border="0" align="center" bgcolor="White" width="100%">
  <tr>
    <td valign="top" width="20%"> {include file=$menuTemplate}			
      {include file=$calendarTemplate}			
      {include file=$newsTemplate} </td>
    <td valign="top"><table cellspacing="1" cellpadding="1" width="100%" border="0" bgcolor="White">
        {if $umNumMessages gt 0}
          <tr>

        <form name="form1" action="process.php" method="post">
          {$umForms}
          <td colspan="7" class="default">&nbsp;&nbsp;
            {$umWelcomeMessage2}
            {if $umHaveSpam eq "TRUE"}
            - <a href="process.php?folder=spam" class="spam"><i>{$smLabel.have_spam}</i></a> {/if} </td>
            </tr>

          {if $umErrorMessage neq ""}
          <tr>
            <td colspan="7" class="default"><font color=red><b> &nbsp;&nbsp;{$umErrorMessage}</b></font></td>
          </tr>
          {/if}
          <tr>
            <td width="5"  class="headers"><input type=checkbox name=chkall onclick="sel()"></td>
            <td width="34"  class="headers"><img src="inc/themes/default/images/prior_high.gif" width=5 height=11 border=0 alt="">&nbsp;<img src="inc/themes/default/images/attach.gif" border="0" width="6" height="14" alt="">&nbsp;<img src="inc/themes/default/images/msg_read.gif" border="0" width="14" height="14" alt=""></td>
            <td width="225" class="headers">.: <b><a class="menu" href="javascript:sortby('subject')">{$smLabel.subject_hea}{$smSubjectArrow}</a></b> :.</td>
            {if $umFolder eq "sent"}
            <td width="210" class="headers">.: <b><a class="menu" href="javascript:sortby('toname')">{$smLabel.to_hea}{$umToArrow}</a></b> :.</td>
            {else}
            <td width="210" class="headers">.: <b><a class="menu" href="javascript:sortby('fromname')">{$smLabel.from_hea}{$umFromArrow}</a></b> :.</td>
            {/if}
            <td width="90" class="headers">.: <b><a class="menu" href="javascript:sortby('date')">{$smLabel.date_hea}{$smDateArrow}</a></b> :.</td>
            <td width="70" class="headers">.: <b><a class="menu" href="javascript:sortby('size')">{$smLabel.size_hea}{$umSizeArrow}</a></b> :.</td>
          </tr>
          {section name=i loop=$smMessageList}
          <tr>
            <td class="default" nowrap>{$smMessageList[i].checkbox}</td>
            <td class="default" nowrap>{$smMessageList[i].priorimg}{$smMessageList[i].attachimg}{$smMessageList[i].statusimg}</td>
            <td class="default" nowrap><acronym title="{$smMessageList[i].subject|escape:"html"|default:$smLabel.no_subject_text}">{if !$smMessageList[i].read}<b>{/if}<a href="{$smMessageList[i].readlink}">{$smMessageList[i].subject|truncate:50:"...":true|escape:"html"|default:$smLabel.no_subject_text}</a>{if !$smMessageList[i].read}</b>{/if}</acronym></td>
            {if $umFolder eq "sent"}
            <td class="default" nowrap><acronym title="{$smMessageList[i].to|escape:"html"|default:$smLabel.no_recipient_text}"><a href="{$smMessageList[i].composelinksent}">{$smMessageList[i].to|truncate:30:"...":true|escape:"html"|default:$smLabel.no_recipient_text}</a></acronym></td>
            {else}
            <td class="default" nowrap><acronym title="{$smMessageList[i].from|escape:"html"|default:$smLabel.no_recipient_text}"><a href="{$smMessageList[i].composelink}">{$smMessageList[i].from|truncate:30:"...":true|escape:"html"|default:$smLabel.no_subject_text}</a></acronym></td>
            {/if}
            <td class="cent" nowrap>{$smMessageList[i].date|date_format:$smLabel.date_format}</td>
            <td class="right" nowrap>{$smMessageList[i].size} &nbsp;</td>
          </tr>
          {/section}
          <tr>
            <td colspan="7" class="default"><img src="./themes/hungi.mozilla/images/arrowblue.gif" alt=""> <a class="menu" href="javascript:markmsg()">{$smLabel.mark_selected_mnu}</a> :: <a class="menu" href="javascript:unmarkmsg()">{$smLabel.unmark_selected_mnu}</a> :: <a class="menu" href="javascript:delemsg()">{$smLabel.delete_selected_mnu}</a> :: <a class="menu" href="javascript:movemsg()">{$smLabel.move_selected_mnu}</a>
              <select name="aval_folders">

						{section name=i loop=$smAvalFolders}

                <option value="{$smAvalFolders[i].path|escape:"html"}">{$smAvalFolders[i].display|escape:"html"}
                {/section}
              </select></td>
          </tr>
          <tr>
            <td colspan="7" class="default">&nbsp;{$smLabel.pages_text}:&nbsp;{if $smPreviousLink}<a href="{$smPreviousLink}" class="navigation">{$smLabel.previous_text}</a> &nbsp;{/if}{$umNavBar}{if $smNextLink} &nbsp;<a href="{$smNextLink}" class="navigation">{$smLabel.next_text}</a>{/if}</td>
          </tr>
          {else}
          <tr>
            <td colspan="7" class="cent"><br>
              &nbsp;&nbsp;{$smLabel.no_messages} <b>{$smBoxName|escape:"html"}</b><br>
              <br></td>
          </tr>
          {/if}
        </form>
        {if $smQuotaEnabled eq 1}
        <tr>
          <td class="cent" colspan="7">&nbsp; {$smLabel.quota_usage_info}: {$smLabel.quota_usage_used} <b>{$smTotalUsed}</b> {$smLabel.quota_usage_of} <b>{$smQuotaLimit}</b> {$smLabel.quota_usage_avail}<br>
            {$smUsageGraph}</td>
        </tr>
        {/if}
      </table></td>
  </tr>
</table>
{include file=$footerTemplate} 
