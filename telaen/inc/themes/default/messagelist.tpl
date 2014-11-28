{include file=$headerTemplate pageTitle=#messages_to#|cat:" "|cat:$umUserEmail}
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
            - <a href="process.php?folder=spam" class="spam"><i>{$umLabel.have_spam}</i></a> {/if} </td>
            </tr>

          {if $umErrorMessage neq ""}
          <tr>
            <td colspan="7" class="default"><font color=red><b> &nbsp;&nbsp;{$umErrorMessage}</b></font></td>
          </tr>
          {/if}
          <tr>
            <td width="5"  class="headers"><input type=checkbox name=chkall onclick="sel()"></td>
            <td width="34"  class="headers"><img src="./images/prior_high.gif" width=5 height=11 border=0 alt="">&nbsp;<img src="images/attach.gif" border="0" width="6" height="14" alt="">&nbsp;<img src="images/msg_read.gif" border="0" width="14" height="14" alt=""></td>
            <td width="210" class="headers">.: <b><a class="menu" href="javascript:sortby('subject')">{$umLabel.subject_hea}{$umSubjectArrow}</a></b> :.</td>
            {if $umFolder eq "sent"}
            <td width="210" class="headers">.: <b><a class="menu" href="javascript:sortby('toname')">{$umLabel.to_hea}{$umToArrow}</a></b> :.</td>
            {else}
            <td width="210" class="headers">.: <b><a class="menu" href="javascript:sortby('fromname')">{$umLabel.from_hea}{$umFromArrow}</a></b> :.</td>
            {/if}
            <td width="90" class="headers">.: <b><a class="menu" href="javascript:sortby('date')">{$umLabel.date_hea}{$umDateArrow}</a></b> :.</td>
            <td width="70" class="headers">.: <b><a class="menu" href="javascript:sortby('size')">{$umLabel.size_hea}{$umSizeArrow}</a></b> :.</td>
          </tr>
          {section name=i loop=$umMessageList}
          <tr>
            <td class="default" nowrap>{$umMessageList[i].checkbox}</td>
            <td class="default" nowrap>{$umMessageList[i].priorimg}{$umMessageList[i].attachimg}{$umMessageList[i].statusimg}</td>
            <td class="default" nowrap><acronym title="{$umMessageList[i].subject|escape:"html"|default:$umLabel.no_subject_text}"> {if $umMessageList[i].read eq "false"}<b>{/if} <a href="{$umMessageList[i].readlink}">{$umMessageList[i].subject|truncate:30:"...":true|escape:"html"|default:$umLabel.no_subject_text}</a> {if $umMessageList[i].read eq "false"}</b>{/if} </acronym></td>
            {if $umFolder eq "sent"}
            <td class="default" nowrap><acronym title="{$umMessageList[i].to|escape:"html"|default:$umLabel.no_recipient_text}"> {if $umMessageList[i].read eq "false"}<b>{/if} <a href="{$umMessageList[i].composelinksent}">{$umMessageList[i].to|truncate:30:"...":true|escape:"html"|default:$umLabel.no_recipient_text}</a> {if $umMessageList[i].read eq "false"}</b>{/if} </acronym></td>
            {else}
            <td class="default" nowrap><acronym title="{$umMessageList[i].from|escape:"html"|default:$umLabel.no_recipient_text}"> {if $umMessageList[i].read eq "false"}<b>{/if} <a href="{$umMessageList[i].composelink}">{$umMessageList[i].from|truncate:30:"...":true|escape:"html"|default:$umLabel.no_subject_text}</a> {if $umMessageList[i].read eq "false"}</b>{/if} </acronym></td>
            {/if}
            <td class="cent" nowrap> {if $umMessageList[i].read eq "false"}<b>{/if}
              {$umMessageList[i].date|date_format:$umLabel.date_format}
              {if $umMessageList[i].read eq "false"}</b>{/if} </td>
            <td class="right" nowrap> {if $umMessageList[i].read eq "false"}<b>{/if}
              {$umMessageList[i].size} &nbsp;
              {if $umMessageList[i].read eq "false"}</b>{/if} </td>
          </tr>
          {/section}
          <tr>
            <td colspan="7" class="default"><img src="./themes/hungi.mozilla/images/arrowblue.gif" alt=""> <a class="menu" href="javascript:markmsg()">{$umLabel.mark_selected_mnu}</a> :: <a class="menu" href="javascript:unmarkmsg()">{$umLabel.unmark_selected_mnu}</a> :: <a class="menu" href="javascript:delemsg()">{$umLabel.delete_selected_mnu}</a> :: <a class="menu" href="javascript:movemsg()">{$umLabel.move_selected_mnu}</a>
              <select name="aval_folders">

						{section name=i loop=$umAvalFolders}

                <option value="{$umAvalFolders[i].path|escape:"html"}">{$umAvalFolders[i].display|escape:"html"}
                {/section}
              </select></td>
          </tr>
          <tr>
            <td colspan="7" class="default">&nbsp;{$umLabel.pages_text}:&nbsp;{if $umPreviousLink}<a href="{$umPreviousLink}" class="navigation">{$umLabel.previous_text}</a> &nbsp;{/if}{$umNavBar}{if $umNextLink} &nbsp;<a href="{$umNextLink}" class="navigation">{$umLabel.next_text}</a>{/if}</td>
          </tr>
          {else}
          <tr>
            <td colspan="7" class="cent"><br>
              &nbsp;&nbsp;{$umLabel.no_messages} <b>{$umBoxName|escape:"html"}</b><br>
              <br></td>
          </tr>
          {/if}
        </form>
        {if $umQuotaEnabled eq 1}
        <tr>
          <td class="cent" colspan="7">&nbsp; {$umLabel.quota_usage_info}: {$umLabel.quota_usage_used} <b>{$umTotalUsed}</b> {$umLabel.quota_usage_of} <b>{$umQuotaLimit}</b> {$umLabel.quota_usage_avail}<br>
            {$umUsageGraph}</td>
        </tr>
        {/if}
      </table></td>
  </tr>
</table>
{include file=$footerTemplate} 