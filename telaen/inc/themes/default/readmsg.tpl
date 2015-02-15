{include file=$headerTemplate pageTitle=$smCCList|escape:"html"}
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
      {$smReplyForm}
      <tr>
        <td class=default colspan=2  height="18">&nbsp; 
          {if $smHavePrevious eq 1} <a class="menu" href="{$smPreviousLink}" title="{$smPreviousSubject}">{$smLabel.previous_mnu}</a> ::
          {/if}
          {if $smHaveNext eq 1} <a class="menu" href="{$smNextLink}" title="{$smNextSubject}">{$smLabel.next_mnu}</a> ::
          {/if} <a class="menu" href="javascript:goback()">{$smLabel.back_mnu}</a> :: <a class="menu" href="javascript:reply()">{$smLabel.reply_mnu}</a> :: <a class="menu" href="javascript:replyall()">{$smLabel.reply_all_mnu}</a> :: <a class="menu" href="javascript:forward()">{$smLabel.forward_mnu}</a> :: <a class="menu" href="javascript:printit()">{$smLabel.print_mnu}</a> :: <a class="menu" href="javascript:headers()">{$smLabel.headers_mnu}</a> :: <a class="menu" href="{$downloadLink}">{$smLabel.download_mnu}</a></td>
      </tr>
      <tr bgcolor=white>
        <td width="20%" height="18" class="headerright">{$smLabel.from_hea} &nbsp;</td>
        <td class="default"> {section name=i loop=$smFromList}
          &nbsp;<a href="{$smFromList[i].link}" title="{$smFromList[i].title|escape:"html"}">{$smFromList[i].name|default:#no_sender_text#|escape:"html"}</a> {/section}&nbsp; <a href="javascript:block_addresses()">{* not fully functional <img src="inc/themes/default/images/cross.gif" width="15" height="13" border="0" alt="{$smLabel.block_address}"></a>&nbsp; *}<a href="javascript:catch_addresses()"><img src="inc/themes/default/images/bookmark_it.gif" width="15" height="12" border="0" alt="{$smLabel.catch_address}"></a></td>
      </tr>
      <tr bgcolor=white>
        <td height="18" class="headerright">{$smLabel.to_hea} &nbsp;</td>
        <td class="default"> {section name=i loop=$smTOList}{if $firstto eq "no"}; {/if} &nbsp;<a href="{$smTOList[i].link}" title="{$smTOList[i].title|escape:"html"}">{$smTOList[i].name|escape:"html"}</a>{assign var="firstto" value="no"}{sectionelse}&nbsp;{$smLabel.no_recipient_text}{/section} </td>
      </tr>
      {if $smHaveCC}
      <tr bgcolor=white>
        <td height="18" class="headerright">{$smLabel.cc_hea} &nbsp;</td>
        <td class="default"> {section name=i loop=$smCCList}{if $firstcc eq "no"}; {/if} <a href="{$smCCList[i].link}" title="{$smCCList[i].title|escape:"html"}">{$smCCList[i].name|escape:"html"}</a>{assign var="firstcc" value="no"}{/section} </td>
      </tr>
      {/if}
      <tr bgcolor=white>
        <td height="18" class="headerright">{$smLabel.subject_hea} &nbsp;</td>
        <td class="default">&nbsp;{$smSubject|default:#no_subject_text#|truncate:100:"...":true|escape:"html"}</td>
      </tr>
      <tr bgcolor=white>
        <td height="18" class="headerright">{$smLabel.date_hea} &nbsp;</td>
        <td class="default">&nbsp;{$smDate|date_format:$smLabel.date_format}</td>
      </tr>
      {if $smHaveAttachments}
      <tr bgcolor=silver>
        <td class="headerright">{$smLabel.attach_hea} &nbsp;</td>
          <td>
        <table width="100%" border=0 cellspacing=1 cellpadding=0>
          <tr bgcolor="#f1f1f1">
            <td class="headers" width="60%">&nbsp;<b>{$smLabel.attch_name_hea}</b> ({$smLabel.attch_force_hea})</td>
            <td class="headers">&nbsp;<b>{$smLabel.attch_size_hea}</b></td>
            <td class="headers">&nbsp;<b>{$smLabel.attch_type_hea}</b></td>
            {section name=i loop=$smAttachList}
          <tr bgcolor=white>
            <td class="default">&nbsp;{$smAttachList[i].normlink}{$smAttachList[i].name|truncate:30:"...":true|escape:"html"}</a> &nbsp;&nbsp;&nbsp;&nbsp;{$smAttachList[i].downlink}<img src="inc/themes/default/images/download.gif" width="12" height="12" border="0" alt=""></a></td>
            <td class="right">{$smAttachList[i].size} &nbsp;</td>
            <td class="default">&nbsp;{$smAttachList[i].type}</td>
            {/section}
            </td>

        </table>
        </td>

        </tr>

      {/if}
      <tr>
        <td colspan=2 class="default"><table width="100%" border=0 cellspacing=1 cellpadding=0>
            <tr bgcolor=white>
              <td width="60%"{$smBackImg}{$smBackColor}><font color=black>{$smMessageBody}</font></td>
            </tr>
          </table></td>
      </tr>
      <tr>
        <form name="move" action="process.php" method="post">
          {$smDeleteForm}
          <td class=default colspan=2  height="18"><a class="menu" href="javascript:deletemsg()">{$smLabel.delete_mnu}</a> :: <a class="menu" href="javascript:movemsg()">{$smLabel.move_mnu} </a>
            <select name="aval_folders">

											{section name=i loop=$smAvalFolders}

              <option value="{$smAvalFolders[i].path|escape:"html"}">{$smAvalFolders[i].display|escape:"html"}
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
