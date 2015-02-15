<html><body bgcolor="#FFFFFF" text="#000000" link="#0000FF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onLoad="MM_preloadImages('inc/themes/aleborgXP/images/refresh_down.gif','inc/themes/aleborgXP/images/refresh_over.gif','inc/themes/aleborgXP/images/newmsg_down.gif','inc/themes/aleborgXP/images/newmsg_over.gif','inc/themes/aleborgXP/images/search_down.gif','inc/themes/aleborgXP/images/search_over.gif','inc/themes/aleborgXP/images/folders_down.gif','inc/themes/aleborgXP/images/folders_over.gif','inc/themes/aleborgXP/images/options_down.gif','inc/themes/aleborgXP/images/options_over.gif','inc/themes/aleborgXP/images/trash_down.gif','inc/themes/aleborgXP/images/trash_over.gif','inc/themes/aleborgXP/images/addressbook_down.gif','inc/themes/aleborgXP/images/addressbook_over.gif','inc/themes/aleborgXP/images/logout_down.gif','inc/themes/aleborgXP/images/logout_over.gif','inc/themes/aleborgXP/images/inbox_down.gif','inc/themes/aleborgXP/images/inbox_over.gif','inc/themes/aleborgXP/images/previous_down.gif','inc/themes/aleborgXP/images/previous_over.gif','inc/themes/aleborgXP/images/next_down.gif','inc/themes/aleborgXP/images/next_over.gif')">
{config_load file=$umLanguageFile section="Folders"}
<head>
<title>UebiMiau - {$smLabel.folders_to} {$smUserEmail}</title>
<meta http-equiv="Content-Type" content="text/html; charset={$smLabel.default_char_set}">
<link rel="stylesheet" href="inc/themes/aleborgXP/webmail.css" type="text/css">
<script language="JavaScript" src="inc/themes/aleborgXP/webmail.js" type="text/javascript">
</script>
{$smJS}
</head>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr height="1" bgcolor="#FFFFFF">
    <td height="1" bgcolor="#FFFFFF"></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellpadding="0" cellspacing="0" background="inc/themes/aleborgXP/images/menu_back.gif">
        <tr> 
          <td width="100"><img src="inc/themes/aleborgXP/images/logo.gif" width="100" height="32"></td>
          <td width="11"><img src="inc/themes/aleborgXP/images/seperator.gif" width="11" height="38"></td>
          <td width="32">{if $smPreviousLink}<a href="{$smPreviousLink}"><img src="inc/themes/aleborgXP/images/previous.gif" alt="{$smLabel.previous_text}" name="previous" width="32" height="38" border="0" id="previous" onMouseDown="MM_swapImage('previous','','inc/themes/aleborgXP/images/previous_down.gif',1)" onMouseOver="MM_swapImage('previous','','inc/themes/aleborgXP/images/previous_over.gif',1)" onMouseOut="MM_swapImgRestore()"></a>{else}<img src="inc/themes/aleborgXP/images/previous_off.gif">{/if}</td>
          <td width="32">{if $smNextLink}<a href="{$smNextLink}"><img src="inc/themes/aleborgXP/images/next.gif" alt="{$smLabel.next_text}" name="next" width="32" height="38" border="0" id="next" onMouseDown="MM_swapImage('next','','inc/themes/aleborgXP/images/next_down.gif',1)" onMouseOver="MM_swapImage('next','','inc/themes/aleborgXP/images/next_over.gif',1)" onMouseOut="MM_swapImgRestore()"></a>{else}<img src="inc/themes/aleborgXP/images/next_off.gif">{/if}</td>
          <td width="11"><img src="inc/themes/aleborgXP/images/seperator.gif" width="11" height="38"></td>
          <td width="32"><a href="javascript:goinbox()"><img src="inc/themes/aleborgXP/images/inbox.gif" alt="{$smLabel.messages_mnu}" name="inbox" width="32" height="38" border="0" id="inbox" onMouseDown="MM_swapImage('inbox','','inc/themes/aleborgXP/images/inbox_down.gif',1)" onMouseOver="MM_swapImage('inbox','','inc/themes/aleborgXP/images/inbox_over.gif',1)" onMouseOut="MM_swapImgRestore()"></a></td>
          <td width="32"><a href="javascript:newmsg()"><img src="inc/themes/aleborgXP/images/newmsg.gif" alt="{$smLabel.compose_mnu}" name="newmsg" width="32" height="38" border="0" id="newmsg" onMouseDown="MM_swapImage('newmsg','','inc/themes/aleborgXP/images/newmsg_down.gif',1)" onMouseOver="MM_swapImage('newmsg','','inc/themes/aleborgXP/images/newmsg_over.gif',1)" onMouseOut="MM_swapImgRestore()"></a></td>
          <td width="32"><img src="inc/themes/aleborgXP/images/refresh_off.gif" alt="{$smLabel.refresh_mnu}" name="refresh" width="32" height="38" border="0" id="refresh"></td>
          <td width="11"><img src="inc/themes/aleborgXP/images/seperator.gif" width="11" height="38"></td>
          <td width="32"><img src="inc/themes/aleborgXP/images/folders_off.gif" alt="{$smLabel.folders_mnu}" name="folders" width="32" height="38" border="0" id="folders"></td>
          <td width="32"><a href="javascript:search()"><img src="inc/themes/aleborgXP/images/search.gif" alt="{$smLabel.search_mnu}" name="search" width="32" height="38" border="0" id="search" onMouseDown="MM_swapImage('search','','inc/themes/aleborgXP/images/search_down.gif',1)" onMouseOver="MM_swapImage('search','','inc/themes/aleborgXP/images/search_over.gif',1)" onMouseOut="MM_swapImgRestore()"></a></td>
          <td width="32"><a href="javascript:addresses()"><img src="inc/themes/aleborgXP/images/addressbook.gif" alt="{$smLabel.address_mnu}" name="addressbook" width="32" height="38" border="0" id="addressbook" onMouseDown="MM_swapImage('addressbook','','inc/themes/aleborgXP/images/addressbook_down.gif',1)" onMouseOver="MM_swapImage('addressbook','','inc/themes/aleborgXP/images/addressbook_over.gif',1)" onMouseOut="MM_swapImgRestore()"></a></td>
          <td width="11"><img src="inc/themes/aleborgXP/images/seperator.gif" width="11" height="38"></td>
          <td width="32"><a href="javascript:emptytrash()"><img src="inc/themes/aleborgXP/images/trash.gif" alt="{$smLabel.empty_trash_mnu}" name="trash" width="32" height="38" border="0" id="trash" onMouseDown="MM_swapImage('trash','','inc/themes/aleborgXP/images/trash_down.gif',1)" onMouseOver="MM_swapImage('trash','','inc/themes/aleborgXP/images/trash_over.gif',1)" onMouseOut="MM_swapImgRestore()"></a></td>
          <td width="32"><a href="javascript:prefs()"><img src="inc/themes/aleborgXP/images/options.gif" alt="{$smLabel.prefs_mnu}" name="options" width="32" height="38" border="0" id="options" onMouseDown="MM_swapImage('options','','inc/themes/aleborgXP/images/options_down.gif',1)" onMouseOver="MM_swapImage('options','','inc/themes/aleborgXP/images/options_over.gif',1)" onMouseOut="MM_swapImgRestore()"></a></td>
          <td width="32"><a href="javascript:goend()"><img src="inc/themes/aleborgXP/images/logout.gif" alt="{$smLabel.logoff_mnu}" name="logout" width="32" height="38" border="0" id="logout" onMouseDown="MM_swapImage('logout','','inc/themes/aleborgXP/images/logout_down.gif',1)" onMouseOver="MM_swapImage('logout','','inc/themes/aleborgXP/images/logout_over.gif',1)" onMouseOut="MM_swapImgRestore()"></a></td>
          <td>&nbsp;</td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td height="2" background="inc/themes/aleborgXP/images/list_up.gif"><img src="inc/themes/aleborgXP/images/list_up.gif" width="5" height="2"></td>
  </tr>
  <tr>
    <td height="20" background="inc/themes/aleborgXP/images/menu_back.gif">&nbsp;<b>{$smLabel.fld_total}</b>
      {$smTotalUsed}Kb</td>
  </tr>
  {if $smQuotaEnabled eq 1}
  <tr>
    <td height="2" background="inc/themes/aleborgXP/images/list_up.gif"><img src="inc/themes/aleborgXP/images/list_up.gif" width="5" height="2"></td>
  </tr>
  <tr>
    <td height="20" background="inc/themes/aleborgXP/images/menu_back.gif">&nbsp;{$smLabel.quota_usage_info}:
      {$smLabel.quota_usage_used} <b>{$smTotalUsed}</b>Kb {$smLabel.quota_usage_of} <b>{$smQuotaLimit}</b>Kb
      {$smLabel.quota_usage_avail}&nbsp;&nbsp;{$smUsageGraph}</td>
  </tr>
  {/if}
  <tr>
    <td height="2" background="inc/themes/aleborgXP/images/list_up.gif"><img src="inc/themes/aleborgXP/images/list_up.gif" width="5" height="2"></td>
  </tr>
<form name="form1" action="folders.php" method="POST" onsubmit="return create();">
  <tr>
      <td height="20" background="inc/themes/aleborgXP/images/menu_back.gif">&nbsp;
<input type="hidden" name="tid" value="{$umTid}"><input type="hidden" name="sid" value="{$umSid}">
				<input type="hidden" name="lid" value="{$umLid}"><input type="Text" name="newfolder" value="" class="textbox"> &nbsp;<input type="button" value="{$smLabel.fld_make_new}" onClick="create()" style="height: 20px; font-family: verdana;font-size: 9px;">
      </td>
  </tr>
</form>
  <tr>
    <td height="3" background="inc/themes/aleborgXP/images/list_down.gif"><img src="inc/themes/aleborgXP/images/list_down.gif" width="5" height="3"></td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="20" background="inc/themes/aleborgXP/images/back_list.gif">			

      <table cellspacing="0" cellpadding="0" width="650" border="0">
        <tr align="center"> 
          <td width="200" class="headers" align="left"> 
            <div align="left"><b>{$smLabel.fld_name_hea}</b></div>
          </td>
          <td width="100" class="headers" align="center"> 
            <div align="center"><b>{$smLabel.fld_messages_hea}</b></div>
          </td>
          <td width="100" class="headers" align="center"> 
            <div align="center"><b>{$smLabel.fld_size_hea}</b></div>
          </td>
          <td width="100" class="headers" align="center"> 
            <div align="center"><b>{$smLabel.fld_empty_hea}</b></div>
          </td>
          <td width="100" class="headers" align="center"> 
            <div align="center"><b>{$smLabel.fld_delete_hea}</b></div>
          </td>
        </tr>
      </table>
</td>
  </tr>
</table>

<table cellspacing="0" cellpadding="0" width="650" border="0" bgcolor="White">
  {section name=i loop=$smFolderList}
  <tr> 
    <td width="200" class="default" align="left"> 
      <div align="left">&nbsp;<a href="{$smFolderList[i].chlink}"><img src="inc/themes/aleborgXP/images/index.gif" border="0" align="absmiddle">&nbsp;{$smFolderList[i].name|escape:"html"}</a></div>
    </td>
    <td width="100" class="defaultC" align="center"> 
      <div align="center">{$smFolderList[i].msgs}</div>
    </td>
    <td width="100" class="right" align="center"> 
      <div align="center">{$smFolderList[i].boxsize}Kb</div>
    </td>
    <td width="100" class="defaultC" align="center"> 
      <div align="center"><a href="{$smFolderList[i].emptylink}"><img src="inc/themes/aleborgXP/images/delete.gif" border="0"></a></div>
    </td>
    <td width="100" class="defaultC" align="center"> 
      <div align="center">{$smFolderList[i].del}</div>
    </td>
  </tr>
  {/section} 
</table>
</body>
</html>
