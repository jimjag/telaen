{include file=$headerTemplate pageTitle=$umPageTitle|escape:"html"}
<table cellspacing="2" cellpadding="0" border="0" align="center" bgcolor="White" width="100%">
    <tr>

  <td valign="top" width="20%"> {include file=$menuTemplate refresh="false"}
    {include file=$calendarTemplate}			
    {include file=$newsTemplate} </td>
    <td valign="top">

  <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
      <tr>

      <td bgcolor="white">

    <table width="100%" border="0" cellspacing="1" cellpadding="0">
      {$umReplyForm}
      <tr>
        <td class=default colspan=2  height="18">&nbsp; 
          {if $umHavePrevious eq 1} <a class="menu" href="{$umPreviousLink}" title="{$umPreviousSubject}">{$umLabel.previous_mnu}</a> :: 
          {/if}
          {if $umHaveNext eq 1} <a class="menu" href="{$umNextLink}" title="{$umNextSubject}">{$umLabel.next_mnu}</a> :: 
          {/if} <a class="menu" href="javascript:goback()">{$umLabel.back_mnu}</a> :: <a class="menu" href="javascript:reply()">{$umLabel.reply_mnu}</a> :: <a class="menu" href="javascript:replyall()">{$umLabel.reply_all_mnu}</a> :: <a class="menu" href="javascript:forward()">{$umLabel.forward_mnu}</a> :: <a class="menu" href="javascript:printit()">{$umLabel.print_mnu}</a> :: <a class="menu" href="javascript:headers()">{$umLabel.headers_mnu}</a> :: <a class="menu" href="{$downloadLink}">{$umLabel.download_mnu}</a></td>
      </tr>
      <tr bgcolor=white>
        <td width="20%" height="18" class="headerright">{$umLabel.from_hea} &nbsp;</td>
        <td class="default"> {section name=i loop=$umFromList}
          &nbsp;<a href="{$umFromList[i].link}" title="{$umFromList[i].title|escape:"html"}">{$umFromList[i].name|default:#no_sender_text#|escape:"html"}</a> {/section}&nbsp; <a href="javascript:block_addresses()">{* not fully functional <img src="inc/themes/default/images/cross.gif" width="15" height="13" border="0" alt="{$umLabel.block_address}"></a>&nbsp; *}<a href="javascript:catch_addresses()"><img src="inc/themes/default/images/bookmark_it.gif" width="15" height="12" border="0" alt="{$umLabel.catch_address}"></a></td>
      </tr>
      <tr bgcolor=white>
        <td height="18" class="headerright">{$umLabel.to_hea} &nbsp;</td>
        <td class="default"> {section name=i loop=$umTOList}{if $firstto eq "no"}; {/if} &nbsp;<a href="{$umTOList[i].link}" title="{$umTOList[i].title|escape:"html"}">{$umTOList[i].name|escape:"html"}</a>{assign var="firstto" value="no"}{sectionelse}&nbsp;{$umLabel.no_recipient_text}{/section} </td>
      </tr>
      {if $umHaveCC}
      <tr bgcolor=white>
        <td height="18" class="headerright">{$umLabel.cc_hea} &nbsp;</td>
        <td class="default"> {section name=i loop=$umCCList}{if $firstcc eq "no"}; {/if} <a href="{$umCCList[i].link}" title="{$umCCList[i].title|escape:"html"}">{$umCCList[i].name|escape:"html"}</a>{assign var="firstcc" value="no"}{/section} </td>
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
            <td class="default">&nbsp;{$umAttachList[i].normlink}{$umAttachList[i].name|truncate:30:"...":true|escape:"html"}</a> &nbsp;&nbsp;&nbsp;&nbsp;{$umAttachList[i].downlink}<img src="inc/themes/default/images/download.gif" width="12" height="12" border="0" alt=""></a></td>
            <td class="right">{$umAttachList[i].size} &nbsp;</td>
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
      <tr>
        <form name="move" action="process.php" method="post">
          {$umDeleteForm}
          <td class=default colspan=2  height="18"><a class="menu" href="javascript:deletemsg()">{$umLabel.delete_mnu}</a> :: <a class="menu" href="javascript:movemsg()">{$umLabel.move_mnu} </a>
            <select name="aval_folders">

											{section name=i loop=$umAvalFolders}

              <option value="{$umAvalFolders[i].path|escape:"html"}">{$umAvalFolders[i].display|escape:"html"}
              {/section}
            </select></td>
        </form>
      </tr>
    </table>
      </td>

      </tr>

  </table>
    </td>

    </tr>

</table>
</div>
</body></html>
