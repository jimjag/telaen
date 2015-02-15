{include file=$headerTemplate pageTitle=$smCCList|escape:"html"}

{include file=$menuTemplate refresh="false"}

{$smReplyForm}
<table cellspacing="0" cellpadding="0" border="0" align="center" bgcolor="#DDE3EB" width="100%">
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td class="default" colspan="2" height="18">&nbsp; 
            {if $smHavePrevious eq 1} <a class="menu" href="{$smPreviousLink}" title="{$smPreviousSubject}">{$smLabel.previous_mnu}</a> ::
            {/if}
            {if $smHaveNext eq 1} <a class="menu" href="{$smNextLink}" title="{$smNextSubject}">{$smLabel.next_mnu}</a> ::
            {/if} <a class="menu" href="javascript:goback()">{$smLabel.back_mnu}</a> :: <a class="menu" href="javascript:reply()">{$smLabel.reply_mnu}</a> :: <a class="menu" href="javascript:replyall()">{$smLabel.reply_all_mnu}</a> :: <a class="menu" href="javascript:forward()">{$smLabel.forward_mnu}</a> :: <a class="menu" href="javascript:printit()">{$smLabel.print_mnu}</a> :: <a class="menu" href="javascript:headers()">{$smLabel.headers_mnu}</a> :: <a class="menu" href="{$downloadLink}">{$smLabel.download_mnu}</a></td>
        </tr>
        <tr>
          <td colspan="2" class="separator"></td>
        </tr>
        <tr bgcolor="white">
          <td width="20%" height="18" class="headerright">{$smLabel.from_hea} &nbsp;</td>
          <td class="default" valing="middle"> {section name=i loop=$smFromList}
            &nbsp;<a href="{$smFromList[i].link}" title="{$smFromList[i].title|escape:"html"}">{$smFromList[i].name|default:#no_sender_text#|escape:"html"}</a> {/section} <a href="javascript:catch_addresses()"><img src="./themes/hungi.mozilla/images/bookmark_it.gif" title="{$smLabel.catch_address}" align="middle" alt="" /></a></td>
        </tr>
        <tr bgcolor="white">
          <td height="18" class="headerright">{$smLabel.to_hea} &nbsp;</td>
          <td class="default"> {section name=i loop=$smTOList}{if $firstto eq "no"};{/if}&nbsp;<a href="{$smTOList[i].link}" title="{$smTOList[i].title|escape:"html"}">{$smTOList[i].name|escape:"html"}</a>{assign var="firstto" value="no"}{sectionelse}&nbsp;{$smLabel.no_recipient_text}{/section} </td>
        </tr>
        {if $smHaveCC}
        <tr bgcolor="white">
          <td height="18" class="headerright">{$smLabel.cc_hea} &nbsp;</td>
          <td class="default"> {section name=i loop=$smCCList}{if $firstcc eq "no"};{/if}&nbsp;<a href="{$smCCList[i].link}" title="{$smCCList[i].title|escape:"html"}">{$smCCList[i].name|escape:"html"}</a>{assign var="firstcc" value="no"}{/section} </td>
        </tr>
        {/if}
        <tr bgcolor="white">
          <td height="18" class="headerright">{$smLabel.subject_hea} &nbsp;</td>
          <td class="default">&nbsp;{$smSubject|default:#no_subject_text#|truncate:100:"...":true|escape:"html"}</td>
        </tr>
        <tr bgcolor="white">
          <td height="18" class="headerright">{$smLabel.date_hea} &nbsp;</td>
          <td class="default">&nbsp;{$smDate|date_format:$smLabel.date_format}</td>
        </tr>
        {if $smHaveAttachments}
        <tr bgcolor="silver">
          <td class="headerright">{$smLabel.attach_hea} &nbsp;</td>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr height="22" bgcolor="#f1f1f1">
                <td class="headersLeft" width="60%">&nbsp; .: <b>{$smLabel.attch_name_hea}</b> ({$smLabel.attch_force_hea}) :.</td>
                <td class="headers">.: <b>{$smLabel.attch_size_hea}</b> :.</td>
                <td class="headersLeft">.: <b>{$smLabel.attch_type_hea}</b> :.</td>
              </tr>
              {section name=i loop=$smAttachList}
              <tr bgcolor="white">
                <td class="default">&nbsp;{$smAttachList[i].normlink}{$smAttachList[i].name|truncate:30:"...":true|escape:"html"}</a> {$smAttachList[i].downlink}<img src="./images/download.gif" width="12" height="12" border="0" alt="" title="Download"></a></td>
                <td class="cent">{$smAttachList[i].size} </td>
                <td class="default">{$smAttachList[i].type}</td>
              </tr>
              {/section}
            </table></td>
        </tr>
        {/if}
        <tr>
          <td colspan="2" class="default"><center>
              <table width="99%" border="2" cellspacing="1" cellpadding="0">
                <tr bgcolor="white">
                  <td width="60%"{$smBackImg}{$smBackColor}><font color="black">{$smMessageBody}</font></td>
                </tr>
              </table>
            </center></td>
        </tr>
        <tr>
          <td class="default" colspan="2" height="18"><form name="move" action="process.php" method="post">
              {$smDeleteForm}
              &nbsp;&nbsp; <a class="menu" href="javascript:deletemsg()">{$smLabel.delete_mnu}</a> :: <a class="menu" href="javascript:movemsg()">{$smLabel.move_mnu} </a>
              <select name="aval_folders">

							{section name=i loop=$smAvalFolders}

                <option value="{$smAvalFolders[i].path|escape:"html"}">{$smAvalFolders[i].display|escape:"html"}</option>

							{/section}

              </select>
            </form></td>
        </tr>
      </table></td>
  </tr>
</table>
{include file=$footerTemplate} 