<html><body bgcolor="#FFFFFF" text="#000000" link="#0000FF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onLoad="MM_preloadImages('inc/themes/aleborgXP/images/refresh_down.gif','inc/themes/aleborgXP/images/refresh_over.gif','inc/themes/aleborgXP/images/newmsg_down.gif','inc/themes/aleborgXP/images/newmsg_over.gif','inc/themes/aleborgXP/images/search_down.gif','inc/themes/aleborgXP/images/search_over.gif','inc/themes/aleborgXP/images/folders_down.gif','inc/themes/aleborgXP/images/folders_over.gif','inc/themes/aleborgXP/images/options_down.gif','inc/themes/aleborgXP/images/options_over.gif','inc/themes/aleborgXP/images/trash_down.gif','inc/themes/aleborgXP/images/trash_over.gif','inc/themes/aleborgXP/images/addressbook_down.gif','inc/themes/aleborgXP/images/addressbook_over.gif','inc/themes/aleborgXP/images/logout_down.gif','inc/themes/aleborgXP/images/logout_over.gif','inc/themes/aleborgXP/images/inbox_down.gif','inc/themes/aleborgXP/images/inbox_over.gif','inc/themes/aleborgXP/images/previous_down.gif','inc/themes/aleborgXP/images/previous_over.gif','inc/themes/aleborgXP/images/next_down.gif','inc/themes/aleborgXP/images/next_over.gif')">{config_load file=$umLanguageFile section="AddressBook"}
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<head>
        <title>UebiMiau - {$smLabel.adr_title}</title>
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
          <td width="32"><img src="inc/themes/aleborgXP/images/previous_off.gif" alt="{$smLabel.previous_text}" name="previous" width="32" height="38" border="0" id="previous"></td>
          <td width="32">{if $smNextLink}<a href="{$smNextLink}"><img src="inc/themes/aleborgXP/images/next.gif" alt="{$smLabel.next_text}" name="next" width="32" height="38" border="0" id="next" onMouseDown="MM_swapImage('next','','inc/themes/aleborgXP/images/next_down.gif',1)" onMouseOver="MM_swapImage('next','','inc/themes/aleborgXP/images/next_over.gif',1)" onMouseOut="MM_swapImgRestore()"></a>{else}<img src="inc/themes/aleborgXP/images/next_off.gif">{/if}</td>
          <td width="11"><img src="inc/themes/aleborgXP/images/seperator.gif" width="11" height="38"></td>
          <td width="32"><a href="javascript:goinbox()"><img src="inc/themes/aleborgXP/images/inbox.gif" alt="{$smLabel.messages_mnu}" name="inbox" width="32" height="38" border="0" id="inbox" onMouseDown="MM_swapImage('inbox','','inc/themes/aleborgXP/images/inbox_down.gif',1)" onMouseOver="MM_swapImage('inbox','','inc/themes/aleborgXP/images/inbox_over.gif',1)" onMouseOut="MM_swapImgRestore()"></a></td>
          <td width="32"><a href="javascript:newmsg()"><img src="inc/themes/aleborgXP/images/newmsg.gif" alt="{$smLabel.compose_mnu}" name="newmsg" width="32" height="38" border="0" id="newmsg" onMouseDown="MM_swapImage('newmsg','','inc/themes/aleborgXP/images/newmsg_down.gif',1)" onMouseOver="MM_swapImage('newmsg','','inc/themes/aleborgXP/images/newmsg_over.gif',1)" onMouseOut="MM_swapImgRestore()"></a></td>
          <td width="32"><img src="inc/themes/aleborgXP/images/refresh_off.gif" alt="{$smLabel.refresh_mnu}" name="refresh" width="32" height="38" border="0" id="refresh"></td>
          <td width="11"><img src="inc/themes/aleborgXP/images/seperator.gif" width="11" height="38"></td>
          <td width="32"><a href="javascript:folderlist()"><img src="inc/themes/aleborgXP/images/folders.gif" alt="{$smLabel.folders_mnu}" name="folders" width="32" height="38" border="0" id="folders" onMouseDown="MM_swapImage('folders','','inc/themes/aleborgXP/images/folders_down.gif',1)" onMouseOver="MM_swapImage('folders','','inc/themes/aleborgXP/images/folders_over.gif',1)" onMouseOut="MM_swapImgRestore()"></a></td>
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
  <tr background="inc/themes/aleborgXP/images/menu_back.gif">
    <form>
      <td height="20" background="inc/themes/aleborgXP/images/menu_back.gif">
<input type="button" value="{$smLabel.adr_new_entry}" onClick="location = '{$smNew}'" style="height: 20px; font-family: verdana;font-size: 9px;">
      </td>
    </form>
  </tr>
</table>
<table width="100%" height="20" border="0" cellpadding="0" cellspacing="0" background="inc/themes/aleborgXP/images/back_list.gif">
  <tr>
    <td> 
      <table width="720" border="0" cellspacing="1" cellpadding="2">
        <tr>

          <td width="270"><strong> &nbsp;{$smLabel.adr_name_hea}</strong></td>

          <td><strong>{$smLabel.adr_email_hea}</strong></td>

          <td width="100" class="headers" align="center"><strong>{$smLabel.adr_edit_hea}</strong></td>
<!---
			 <td width="10%" class="headers"><strong>{$smLabel.adr_expo_hea}</strong></td>
--->

          <td width="100" class="headers" align="center"><strong>{$smLabel.adr_dele_hea}</strong></td>
		</tr>
	</table>
</td>
  </tr>
  <tr>
    <td height="3" background="inc/themes/aleborgXP/images/list_down.gif"><img src="inc/themes/aleborgXP/images/list_down.gif" width="5" height="3"></td>
  </tr>
</table>
<table width="720" border="0" cellspacing="1" cellpadding="2">
  {section name=i loop=$smAddressList}
  <tr>

    <td width="270" class="default"> &nbsp;<a class="menu" href="{$smAddressList[i].viewlink}">{$smAddressList[i].name}</a>&nbsp;</td>

    <td class="default"><a class="menu" href="{$smAddressList[i].composelink}">{$smAddressList[i].email}</a>&nbsp;</td>

    <td width="100" align="center" class="default"> &nbsp;<a class="menu" href="{$smAddressList[i].editlink}"><img src="inc/themes/aleborgXP/images/edit.gif" width="16" height="16" border="0" alt="{$smLabel.adr_edit_hea}"></a></td>
<!---
                                        <td class="default"> &nbsp;<a class="menu" href="{$smAddressList[i].exportlink}">OK</a></td>
--->

    <td width="100" align="center" class="default"> &nbsp;<a class="menu" href="{$smAddressList[i].dellink}"><img src="inc/themes/aleborgXP/images/delete.gif" width="16" height="16" border="0" alt="{$smLabel.adr_dele_hea}"></a></td>
                                </tr>
                                {/section}
                        </table>
</body>
</html>
