<html><body bgcolor="#FFFFFF" text="#000000" link="#0000FF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onLoad="MM_preloadImages('themes/aleborgXP/images/refresh_down.gif','themes/aleborgXP/images/refresh_over.gif','themes/aleborgXP/images/newmsg_down.gif','themes/aleborgXP/images/newmsg_over.gif','themes/aleborgXP/images/search_down.gif','themes/aleborgXP/images/search_over.gif','themes/aleborgXP/images/folders_down.gif','themes/aleborgXP/images/folders_over.gif','themes/aleborgXP/images/options_down.gif','themes/aleborgXP/images/options_over.gif','themes/aleborgXP/images/trash_down.gif','themes/aleborgXP/images/trash_over.gif','themes/aleborgXP/images/addressbook_down.gif','themes/aleborgXP/images/addressbook_over.gif','themes/aleborgXP/images/logout_down.gif','themes/aleborgXP/images/logout_over.gif','themes/aleborgXP/images/inbox_down.gif','themes/aleborgXP/images/inbox_over.gif','themes/aleborgXP/images/previous_down.gif','themes/aleborgXP/images/previous_over.gif','themes/aleborgXP/images/next_down.gif','themes/aleborgXP/images/next_over.gif')">{config_load file=$umLanguageFile section="MessageList"}
{um_welcome_message messages=$umNumMessages unread=$umNumUnread boxname=$umBoxName var="umWelcomeMessage"}

<head>
<title>UebiMiau - {$umLabel.messages_to} {$umUserEmail}</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="themes/aleborgXP/webmail.css" type="text/css">
<script language="JavaScript" src="themes/aleborgXP/webmail.js" type="text/javascript">
</script>
{$umJS} 
</head>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr height="1" bgcolor="#FFFFFF">
    <td height="1" bgcolor="#FFFFFF"></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellpadding="0" cellspacing="0" background="themes/aleborgXP/images/menu_back.gif">
        <tr> 
          <td width="100"><img src="themes/aleborgXP/images/logo.gif" width="100" height="32"></td>
          <td width="11"><img src="themes/aleborgXP/images/seperator.gif" width="11" height="38"></td>
          <td width="32">{if $umPreviousLink}<a href="{$umPreviousLink}"><img src="themes/aleborgXP/images/previous.gif" alt="{$umLabel.previous_text}" name="previous" width="32" height="38" border="0" id="previous" onMouseDown="MM_swapImage('previous','','themes/aleborgXP/images/previous_down.gif',1)" onMouseOver="MM_swapImage('previous','','themes/aleborgXP/images/previous_over.gif',1)" onMouseOut="MM_swapImgRestore()"></a>{else}<img src="themes/aleborgXP/images/previous_off.gif">{/if}</td>
          <td width="32">{if $umNextLink}<a href="{$umNextLink}"><img src="themes/aleborgXP/images/next.gif" alt="{$umLabel.next_text}" name="next" width="32" height="38" border="0" id="next" onMouseDown="MM_swapImage('next','','themes/aleborgXP/images/next_down.gif',1)" onMouseOver="MM_swapImage('next','','themes/aleborgXP/images/next_over.gif',1)" onMouseOut="MM_swapImgRestore()"></a>{else}<img src="themes/aleborgXP/images/next_off.gif">{/if}</td>
          <td width="11"><img src="themes/aleborgXP/images/seperator.gif" width="11" height="38"></td>
          <td width="32"><a href="javascript:goinbox()"><img src="themes/aleborgXP/images/inbox.gif" alt="{$umLabel.messages_mnu}" name="inbox" width="32" height="38" border="0" id="inbox" onMouseDown="MM_swapImage('inbox','','themes/aleborgXP/images/inbox_down.gif',1)" onMouseOver="MM_swapImage('inbox','','themes/aleborgXP/images/inbox_over.gif',1)" onMouseOut="MM_swapImgRestore()"></a></td>
          <td width="32"><a href="javascript:newmsg()"><img src="themes/aleborgXP/images/newmsg.gif" alt="{$umLabel.compose_mnu}" name="newmsg" width="32" height="38" border="0" id="newmsg" onMouseDown="MM_swapImage('newmsg','','themes/aleborgXP/images/newmsg_down.gif',1)" onMouseOver="MM_swapImage('newmsg','','themes/aleborgXP/images/newmsg_over.gif',1)" onMouseOut="MM_swapImgRestore()"></a></td>
          <td width="32"><a href="javascript:refreshlist()"><img src="themes/aleborgXP/images/refresh.gif" alt="{$umLabel.refresh_mnu}" name="refresh" width="32" height="38" border="0" id="refresh" onMouseDown="MM_swapImage('refresh','','themes/aleborgXP/images/refresh_down.gif',1)" onMouseOver="MM_swapImage('refresh','','themes/aleborgXP/images/refresh_over.gif',1)" onMouseOut="MM_swapImgRestore()"></a></td>
          <td width="11"><img src="themes/aleborgXP/images/seperator.gif" width="11" height="38"></td>
          <td width="32"><a href="javascript:folderlist()"><img src="themes/aleborgXP/images/folders.gif" alt="{$umLabel.folders_mnu}" name="folders" width="32" height="38" border="0" id="folders" onMouseDown="MM_swapImage('folders','','themes/aleborgXP/images/folders_down.gif',1)" onMouseOver="MM_swapImage('folders','','themes/aleborgXP/images/folders_over.gif',1)" onMouseOut="MM_swapImgRestore()"></a></td>
          <td width="32"><a href="javascript:search()"><img src="themes/aleborgXP/images/search.gif" alt="{$umLabel.search_mnu}" name="search" width="32" height="38" border="0" id="search" onMouseDown="MM_swapImage('search','','themes/aleborgXP/images/search_down.gif',1)" onMouseOver="MM_swapImage('search','','themes/aleborgXP/images/search_over.gif',1)" onMouseOut="MM_swapImgRestore()"></a></td>
          <td width="32"><a href="javascript:addresses()"><img src="themes/aleborgXP/images/addressbook.gif" alt="{$umLabel.address_mnu}" name="addressbook" width="32" height="38" border="0" id="addressbook" onMouseDown="MM_swapImage('addressbook','','themes/aleborgXP/images/addressbook_down.gif',1)" onMouseOver="MM_swapImage('addressbook','','themes/aleborgXP/images/addressbook_over.gif',1)" onMouseOut="MM_swapImgRestore()"></a></td>
          <td width="11"><img src="themes/aleborgXP/images/seperator.gif" width="11" height="38"></td>
          <td width="32"><a href="javascript:emptytrash()"><img src="themes/aleborgXP/images/trash.gif" alt="{$umLabel.empty_trash_mnu}" name="trash" width="32" height="38" border="0" id="trash" onMouseDown="MM_swapImage('trash','','themes/aleborgXP/images/trash_down.gif',1)" onMouseOver="MM_swapImage('trash','','themes/aleborgXP/images/trash_over.gif',1)" onMouseOut="MM_swapImgRestore()"></a></td>
          <td width="32"><a href="javascript:prefs()"><img src="themes/aleborgXP/images/options.gif" alt="{$umLabel.prefs_mnu}" name="options" width="32" height="38" border="0" id="options" onMouseDown="MM_swapImage('options','','themes/aleborgXP/images/options_down.gif',1)" onMouseOver="MM_swapImage('options','','themes/aleborgXP/images/options_over.gif',1)" onMouseOut="MM_swapImgRestore()"></a></td>
          <td width="32"><a href="javascript:goend()"><img src="themes/aleborgXP/images/logout.gif" alt="{$umLabel.logoff_mnu}" name="logout" width="32" height="38" border="0" id="logout" onMouseDown="MM_swapImage('logout','','themes/aleborgXP/images/logout_down.gif',1)" onMouseOver="MM_swapImage('logout','','themes/aleborgXP/images/logout_over.gif',1)" onMouseOut="MM_swapImgRestore()"></a></td>
          <td>&nbsp;</td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td height="2" background="themes/aleborgXP/images/list_up.gif"><img src="themes/aleborgXP/images/list_up.gif" width="5" height="2"></td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0" background="themes/aleborgXP/images/menu_back.gif">
  {if $umNumMessages gt 0} 
  <form name="form1" action="process.php" method="post">
    {$umForms} 
    <tr> 
      <td height="16" class="default">&nbsp;<img src="themes/aleborgXP/images/pages.gif" align="absmiddle">&nbsp;{$umNavBar}</td>
    </tr>
    <tr> 
      <td height="2" background="themes/aleborgXP/images/list_up.gif"><img src="themes/aleborgXP/images/list_up.gif" width="5" height="2"></td>
    </tr>
    <tr> 
      <td height="16" class="default">&nbsp;<img src="themes/aleborgXP/images/index.gif" align="absmiddle">&nbsp;{$umWelcomeMessage}</td>
    </tr>
    <tr> 
      <td height="2" background="themes/aleborgXP/images/list_up.gif"><img src="themes/aleborgXP/images/list_up.gif" width="5" height="2"></td>
    </tr>
    {if $umErrorMessage neq ""} 
    <tr> 
      <td height="16" class="default">&nbsp;<img src="themes/aleborgXP/images/index.gif" align="absmiddle">&nbsp;<font color=red><b>{$umErrorMessage}</b></font></td>
    </tr>
    <tr> 
      <td height="2" background="themes/aleborgXP/images/list_up.gif"><img src="themes/aleborgXP/images/list_up.gif" width="5" height="2"></td>
    </tr>
    {/if} {else} 
    <tr> 
      <td height="16" class="default">&nbsp;<img src="themes/aleborgXP/images/index.gif" align="absmiddle">&nbsp;{$umLabel.no_messages} 
        <b>{$umBoxName|escape:"html"}</b></td>
    </tr>
    <tr> 
      <td height="2" background="themes/aleborgXP/images/list_up.gif"><img src="themes/aleborgXP/images/list_up.gif" width="5" height="2"></td>
    </tr>
    {/if} {if $umQuotaEnabled eq 1} 
    <tr> 
      <td height="16" class="default">&nbsp;<img src="themes/aleborgXP/images/index.gif" align="absmiddle">&nbsp;{$umLabel.quota_usage_info}: 
        {$umLabel.quota_usage_used} <b>{$umTotalUsed}</b>Kb {$umLabel.quota_usage_of} <b>{$umQuotaLimit}</b>Kb 
        {$umLabel.quota_usage_avail}&nbsp;&nbsp;{$umUsageGraph}</td>
    </tr>
    <tr> 
      <td height="2" background="themes/aleborgXP/images/list_up.gif"><img src="themes/aleborgXP/images/list_up.gif" width="5" height="2"></td>
    </tr>
    {/if} 
    <tr> 
      <td height="16" class="default">&nbsp;<a href="javascript:delemsg()"><img src="themes/aleborgXP/images/delete.gif" border="0" alt="{$umLabel.delete_selected_mnu}"></a>&nbsp;<a href="javascript:movemsg()"><img src="themes/aleborgXP/images/move_to.gif" border="0" alt="{$umLabel.move_selected_mnu}"></a>&nbsp; 
        <select name="aval_folders" class="textbox">
						{section name=i loop=$umAvalFolders}

          <option value="{$umAvalFolders[i].path|escape:"html"}">{$umAvalFolders[i].display|escape:"html"} 
          {/section} 
        </select>
      </td>
    </tr>
    <tr> 
      <td bgcolor="#FFFFFF"> 
        <table width="100%" height="20" border="0" cellpadding="0" cellspacing="0" style="background-image: url(themes/aleborgXP/images/back_list.gif); background-repeat: repeat-x">
          <tr> 
            <td width="1"> 
              <table border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" width="100%">
                <tr> 
                  <td background="themes/aleborgXP/images/back_list.gif" class="defaultC"> 
                    <input type=checkbox name=chkall onClick="sel()">
                  </td>
                  <td background="themes/aleborgXP/images/back_list.gif" class="defaultC"><img src="./images/prior_high.gif" width=5 height=11 border=0 alt=""></td>
                  <td background="themes/aleborgXP/images/back_list.gif" class="defaultC"><img src="images/attach.gif" border="0" width="6" height="14" alt=""></td>
                  <td background="themes/aleborgXP/images/back_list.gif" class="defaultC"> 
                    <table border="0" cellspacing="0" cellpadding="0">
                      <tr> 
                        <td><img src="images/trans.gif" border="0" width="5" height="1" alt=""></td>
                        <td><img src="images/msg_read.gif" border="0" width="14" height="14" alt=""></td>
                      </tr>
                    </table>
                  </td>
                  {if $umFolder eq "sent"} 
                  <td background="themes/aleborgXP/images/back_list.gif" class="defaultC" nowrap align="left"> 
                    <div align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><a class="menu" href="javascript:sortby('toname')">{$umLabel.to_hea}{$umToArrow}</a></b></div>
                  </td>
                  {else} 
                  <td background="themes/aleborgXP/images/back_list.gif" class="defaultC" nowrap align="left"> 
                    <div align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><a class="menu" href="javascript:sortby('fromname')">{$umLabel.from_hea}{$umFromArrow}</a></b></div>
                  </td>
                  {/if} 
                  <td background="themes/aleborgXP/images/back_list.gif" class="defaultC" nowrap align="left"> 
                    <div align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><a class="menu" href="javascript:sortby('subject')">{$umLabel.subject_hea}{$umSubjectArrow}</a></b></div>
                  </td>
                  <td background="themes/aleborgXP/images/back_list.gif" class="defaultC" nowrap align="left"> 
                    <div align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><a class="menu" href="javascript:sortby('date')">{$umLabel.date_hea}{$umDateArrow}</a></b></div>
                  </td>
                  <td background="themes/aleborgXP/images/back_list.gif" class="defaultC" align="right" nowrap> 
                    <div align="right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><a class="menu" href="javascript:sortby('size')">{$umLabel.size_hea}{$umSizeArrow}</a></b> 
                    </div>
                  </td>
                </tr>
                {section name=i loop=$umMessageList} 
                <tr> 
                  <td class="default">{$umMessageList[i].checkbox}</td>
                  <td width="17" height="20" class="defaultC"> 
                    <table width="10%" border="0" cellspacing="0" cellpadding="0">
                      <tr> 
                        <td align="center" valign="middle"> 
                          <div align="center">{$umMessageList[i].priorimg}</div>
                        </td>
                      </tr>
                    </table>
                  </td>
                  <td class="defaultC">{$umMessageList[i].attachimg}</td>
                  <td class="defaultC">{$umMessageList[i].statusimg}</td>
                  {if $umFolder eq "sent"} 
                  <td class="default" nowrap>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<acronym title="{$umMessageList[i].to|escape:"html"|default:$umLabel.no_recipient_text}">{if 
                    $umMessageList[i].read eq "false"}<b>{/if}<a href="{$umMessageList[i].readlink}">{$umMessageList[i].to|truncate:30:"...":true|escape:"html"|default:$umLabel.no_subject_text}</a>{if 
                    $umMessageList[i].read eq "false"}</b>{/if}</acronym></td>
                  {else} 
                  <td class="default" nowrap>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<acronym title="{$umMessageList[i].from|escape:"html"|default:$umLabel.no_recipient_text}">{if 
                    $umMessageList[i].read eq "false"}<b>{/if}<a href="{$umMessageList[i].readlink}">{$umMessageList[i].from|truncate:30:"...":true|escape:"html"|default:$umLabel.no_subject_text}</a></acronym>{if 
                    $umMessageList[i].read eq "false"}</b>{/if}</td>
                  {/if} 
                  <td class="default" nowrap><acronym title="{$umMessageList[i].subject|escape:"html"|default:$umLabel.no_subject_text}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{if 
                    $umMessageList[i].read eq "false"}<b>{/if}<a href="{$umMessageList[i].readlink}">{$umMessageList[i].subject|truncate:30:"...":true|escape:"html"|default:$umLabel.no_subject_text}</a>{if 
                    $umMessageList[i].read eq "false"}</b>{/if}</acronym></td>
                  <td class="defaultC" nowrap align="left"> 
                    <div align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{if $umMessageList[i].read 
                      eq "false"}<b>{/if}{$umMessageList[i].date|date_format:$umLabel.date_format}</b></div>
                  </td>
                  <td class="defaultC" align="right" nowrap> 
                    <div align="right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{if $umMessageList[i].read 
                      eq "false"}<b>{/if}{$umMessageList[i].size}Kb{if $umMessageList[i].read 
                      eq "false"}</b>{/if}</div>
                  </td>
                </tr>
                {/section} 
              </table>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </form>
</table>
</body>
</html>
