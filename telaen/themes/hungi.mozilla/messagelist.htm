{include file=$headerTemplate pageTitle=#messages_to#|cat:" "|cat:$umUserEmail}

{include file=$menuTemplate}
<table cellspacing="0" cellpadding="0" border="0" align="center" bgcolor="#DDE3EB" width="100%">
  <tr>
    <td valign="top"><form name="form1" action="process.php" method="post">
        {$umForms}
        <table cellspacing="0" cellpadding="1" width="100%" border="0" bgcolor="#DDE3EB">
          {if $umNumMessages gt 0}
          <tr>
            <td colspan="7" class="default">&nbsp;&nbsp;
              {$umWelcomeMessage2}
              {if $umHaveSpam eq "TRUE"}
              - <a href="process.php?folder=spam" class="spam"><i>{$umLabel.have_spam}</i></a> {/if} </td>
          </tr>
          {if $umErrorMessage neq ""}
          <tr>
            <td colspan="7" class="default"><font color="red"><b>&nbsp;&nbsp;{$umErrorMessage}</b></font></td>
          </tr>
          {/if}
          <tr>
            <td width="20" class="headers"><input type="checkbox" name="chkall" onclick="sel()" /></td>
            <td width="34" class="headersLeft"><img src="./images/prior_high.gif" alt="" />&nbsp;<img src="images/attach.gif" alt="" />&nbsp;<img src="images/msg_read.gif" alt="" /></td>
            {if $umFolder eq "sent"}
            <td width="180" class="headersLeft">.: <b><a class="menu" href="javascript:sortby('toname')">{$umLabel.to_hea}{$umToArrow}</a></b> :.</td>
            {else}
            <td width="180" class="headersLeft">.: <b><a class="menu" href="javascript:sortby('fromname')">{$umLabel.from_hea}{$umFromArrow}</a></b> :.</td>
            {/if}
            <td class="headersLeft">.: <b><a class="menu" href="javascript:sortby('subject')">{$umLabel.subject_hea}{$umSubjectArrow}</a></b> :.</td>
            <td width="140" class="headers">.: <b><a class="menu" href="javascript:sortby('date')">{$umLabel.date_hea}{$umDateArrow}</a></b> :.</td>
            <td width="120" class="headersRight">.: <b><a class="menu" href="javascript:sortby('size')">{$umLabel.size_hea}{$umSizeArrow}</a></b> :.&nbsp;</td>
          </tr>
          {section name=i loop=$umMessageList}
          <tr>
            <td class="cent">{$umMessageList[i].checkbox}</td>
            <td class="default">{$umMessageList[i].priorimg}{$umMessageList[i].attachimg}{$umMessageList[i].statusimg}</td>
            {if $umFolder eq "sent"}
            <td class="default"><acronym title="{$umMessageList[i].to|escape:"html"|default:$umLabel.no_recipient_text}">{if $umMessageList[i].read eq "false"}<b>{/if}<a href="{$umMessageList[i].composelinksent}">{$umMessageList[i].to|truncate:30:"...":true|escape:"html"|default:$umLabel.no_subject_text}</a>{if $umMessageList[i].read eq "false"}</b>{/if}</acronym></td>
            {else}
            <td class="default"><acronym title="{$umMessageList[i].from|escape:"html"|default:$umLabel.no_recipient_text}">{if $umMessageList[i].read eq "false"}<b>{/if}<a href="{$umMessageList[i].readlink}">{$umMessageList[i].from|truncate:30:"...":true|escape:"html"|default:$umLabel.no_subject_text}</a>{if $umMessageList[i].read eq "false"}</b>{/if}</acronym></td>
            {/if}
            <td class="default"><acronym title="{$umMessageList[i].subject|escape:"html"|default:$umLabel.no_subject_text}">{if $umMessageList[i].read eq "false"}<b>{/if}<a href="{$umMessageList[i].readlink}">{$umMessageList[i].subject|truncate:40:"...":true|escape:"html"|default:$umLabel.no_subject_text}</a>{if $umMessageList[i].read eq "false"}</b>{/if}</acronym></td>
            <td class="cent">{if $umMessageList[i].read eq "false"}<b>{/if}{$umMessageList[i].date|date_format:$umLabel.date_format}{if $umMessageList[i].read eq "false"}</b>{/if}</td>
            <td class="right">{if $umMessageList[i].read eq "false"}<b>{/if}{$umMessageList[i].size} &nbsp;{if $umMessageList[i].read eq "false"}</b>{/if}</td>
          </tr>
          <tr>
            <td colspan="7" class="separator"></td>
          </tr>
          {/section}
          <tr>
            <td colspan="7" class="default"><img src="./themes/hungi.mozilla/images/arrowblue.gif" alt="" />&nbsp; <a class="menu" href="javascript:markmsg()">{$umLabel.mark_selected_mnu}</a> :: <a class="menu" href="javascript:unmarkmsg()">{$umLabel.unmark_selected_mnu}</a> :: <a class="menu" href="javascript:delemsg()">{$umLabel.delete_selected_mnu}</a> :: <a class="menu" href="javascript:movemsg()">{$umLabel.move_selected_mnu}</a>
              <select name="aval_folders">

					{section name=i loop=$umAvalFolders}

                <option value="{$umAvalFolders[i].path|escape:"html"}">{$umAvalFolders[i].display|escape:"html"}</option>

					{/section}

              </select></td>
          </tr>
          <tr>
            <td colspan="7" class="default">&nbsp;&nbsp;<span class="menu"><b>{$umLabel.pages_text}:</b></span> {if $umPreviousLink}<!--<a href="{$umFirstLink}" class="navigation">&laquo; {$umLabel.first_text}</a>&nbsp; --> 
              <a href="{$umPreviousLink}" class="navigation">&laquo; {$umLabel.previous_text}</a>&nbsp;{/if}
              {$umNavBar}
              {if $umNextLink}&nbsp;<a href="{$umNextLink}" class="navigation">{$umLabel.next_text} &raquo;</a> 
              <!--&nbsp;<a href="{$umLastLink}" class="navigation">{$umLabel.last_text} &raquo;</a>-->{/if} </td>
          </tr>
          {else}
          <tr>
            <td colspan="7" class="cent"><br/>
              &nbsp;&nbsp;{$umLabel.no_messages} <b>{$umBoxName|escape:"html"}</b><br/>
              <br/></td>
          </tr>
          {/if}

          {if $umQuotaEnabled eq 1}
          <tr>
            <td class="usage" colspan="7">{$umLabel.quota_usage_info}: {$umLabel.quota_usage_used} <b>{$umTotalUsed}</b> {$umLabel.quota_usage_of} <b>{$umQuotaLimit}</b> {$umLabel.quota_usage_avail}<br/>
              {$umUsageGraph}</td>
          </tr>
          {/if}
        </table>
      </form></td>
  </tr>
</table>
{include file=$footerTemplate} 