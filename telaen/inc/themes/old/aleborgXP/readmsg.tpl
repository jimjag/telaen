<html><body bgcolor="#FFFFFF" text="#000000" link="#0000FF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onLoad="MM_preloadImages('inc/themes/aleborgXP/images/refresh_down.gif','inc/themes/aleborgXP/images/refresh_over.gif','inc/themes/aleborgXP/images/newmsg_down.gif','inc/themes/aleborgXP/images/newmsg_over.gif','inc/themes/aleborgXP/images/search_down.gif','inc/themes/aleborgXP/images/search_over.gif','inc/themes/aleborgXP/images/folders_down.gif','inc/themes/aleborgXP/images/folders_over.gif','inc/themes/aleborgXP/images/options_down.gif','inc/themes/aleborgXP/images/options_over.gif','inc/themes/aleborgXP/images/trash_down.gif','inc/themes/aleborgXP/images/trash_over.gif','inc/themes/aleborgXP/images/addressbook_down.gif','inc/themes/aleborgXP/images/addressbook_over.gif','inc/themes/aleborgXP/images/logout_down.gif','inc/themes/aleborgXP/images/logout_over.gif','inc/themes/aleborgXP/images/inbox_down.gif','inc/themes/aleborgXP/images/inbox_over.gif','inc/themes/aleborgXP/images/previous_down.gif','inc/themes/aleborgXP/images/previous_over.gif','inc/themes/aleborgXP/images/next_down.gif','inc/themes/aleborgXP/images/next_over.gif')">{config_load file=$umLanguageFile section="Readmsg"}

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<head>
	<title>UebiMiau - {$smCCList|escape:"html"}</title>
	<link rel="stylesheet" href="inc/themes/aleborgXP/webmail.css" type="text/css">

<script language="JavaScript" src="inc/themes/aleborgXP/webmail.js" type="text/javascript">
</script>
{$smJS} </head>
<table width="100%" border="0" cellspacing="0" cellpadding="0" background="inc/themes/aleborgXP/images/menu_back.gif">
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
{$smReplyForm}
  <tr>
    <td height="20">&nbsp;{if $smHavePrevious eq 1}<a class="menu" href="{$smPreviousLink}" title="{$smPreviousSubject}">{$smLabel.previous_mnu}</a>
      | {/if} {if $smHaveNext eq 1} <a class="menu" href="{$smNextLink}" title="{$smNextSubject}">{$smLabel.next_mnu}</a>
      | {/if} <a class="menu" href="javascript:goback()">{$smLabel.back_mnu}</a> | <a class="menu" href="javascript:reply()">{$smLabel.reply_mnu}</a>
      | <a class="menu" href="javascript:replyall()">{$smLabel.reply_all_mnu}</a> | <a class="menu" href="javascript:forward()">{$smLabel.forward_mnu}</a>
      | <a class="menu" href="javascript:printit()">{$smLabel.print_mnu}</a> | <a class="menu" href="javascript:headers()">{$smLabel.headers_mnu}</a></td>
  </tr>
  <tr>
    <td height="2" background="inc/themes/aleborgXP/images/list_up.gif"><img src="inc/themes/aleborgXP/images/list_up.gif" width="5" height="2"></td>
  </tr>
  <tr>
    <td height="20">
<table width="720" border="0" cellspacing="0" cellpadding="0">
  <tr>
          <td width="130">&nbsp;{$smLabel.from_hea}</td>
    <td>{section name=i loop=$smFromList}
								 <a href="{$smFromList[i].link}" title="{$smFromList[i].title|escape:"html"}">{$smFromList[i].name|default:#no_sender_text#|escape:"html"}</a>
								{/section}</td>
  </tr>
</table>
    </td>
  </tr>
  <tr>
    <td height="2" background="inc/themes/aleborgXP/images/list_up.gif"><img src="inc/themes/aleborgXP/images/list_up.gif" width="5" height="2"></td>
  </tr>
  <tr>
    <td height="20">
<table width="720" border="0" cellspacing="0" cellpadding="0">
  <tr>
          <td width="130">&nbsp;{$smLabel.to_hea}</td>
    <td>{section name=i loop=$smTOList}{if $firstto eq "no"};{/if}<a href="{$smTOList[i].link}" title="{$smTOList[i].title|escape:"html"}">{$smTOList[i].name|escape:"html"}</a>{assign var="firstto" value="no"}{sectionelse}{$smLabel.no_recipient_text}{/section}</td>
  </tr>
</table>
    </td>
  </tr>
{if $smHaveCC}
  <tr>
    <td height="2" background="inc/themes/aleborgXP/images/list_up.gif"><img src="inc/themes/aleborgXP/images/list_up.gif" width="5" height="2"></td>
  </tr>
  <tr>
    <td height="20">
<table width="720" border="0" cellspacing="0" cellpadding="0">
  <tr>
          <td width="130">&nbsp;{$smLabel.cc_hea}</td>
    <td>{section name=i loop=$smCCList}{if $firstcc eq "no"};{/if}<a href="{$smCCList[i].link}" title="{$smCCList[i].title|escape:"html"}">{$smCCList[i].name|escape:"html"}</a>{assign var="firstcc" value="no"}{/section}</td>
  </tr>
</table>
    </td>
  </tr>
{/if}
  <tr>
    <td height="2" background="inc/themes/aleborgXP/images/list_up.gif"><img src="inc/themes/aleborgXP/images/list_up.gif" width="5" height="2"></td>
  </tr>
  <tr>
    <td height="20">
<table width="720" border="0" cellspacing="0" cellpadding="0">
  <tr>
          <td width="130">&nbsp;{$smLabel.subject_hea}</td>
    <td>{$smSubject|default:#no_subject_text#|truncate:100:"...":true|escape:"html"}</td>
  </tr>
</table>
    </td>
  </tr>
  <tr>
    <td height="2" background="inc/themes/aleborgXP/images/list_up.gif"><img src="inc/themes/aleborgXP/images/list_up.gif" width="5" height="2"></td>
  </tr>
  <tr>
    <td height="20">
<table width="720" border="0" cellspacing="0" cellpadding="0">
  <tr>
          <td width="130">&nbsp;{$smLabel.date_hea}</td>
    <td>{$smDate|date_format:$smLabel.date_format}</td>
  </tr>
</table>
    </td>
  </tr>
		{if $smHaveAttachments}
  <tr>
    <td height="2" background="inc/themes/aleborgXP/images/list_up.gif"><img src="inc/themes/aleborgXP/images/list_up.gif" width="5" height="2"></td>
  </tr>
			<tr>

    <td height="20"><b>&nbsp;{$smLabel.attach_hea}</b></td>
				</tr>
				<tr>

    <td bgcolor="#FFFFFF">
<table width="100%" border="0" cellspacing="0" cellpadding="0" background="inc/themes/aleborgXP/images/back_list.gif">
  <tr>
    <td>
            <table border=0 cellspacing=0 cellpadding=0 width="500">
              <tr background="inc/themes/aleborgXP/images/back_list.gif"> 
                <td nowrap>&nbsp;<b>{$smLabel.attch_name_hea}</b> ({$smLabel.attch_force_hea})</td>
                <td width="150" align="right" nowrap> &nbsp;<b>{$smLabel.attch_size_hea}</b></td>
                <td width="150" align="center" nowrap> &nbsp;<b>{$smLabel.attch_type_hea}</b></td>
		</tr>
	</table></td>
  </tr>
</table>
      <table border=0 cellpadding=0 cellspacing=0 width="500">
        {section name=i loop=$smAttachList}
        <tr> 
          <td bgcolor="white" class="default" nowrap> &nbsp;{$smAttachList[i].normlink}{$smAttachList[i].name|truncate:30:"...":true|escape:"html"} {$smAttachList[i].downlink}<img src="./images/download.gif" width="12" height="12" border="0" alt=""></td>
          <td bgcolor="white" class="right" width="150" nowrap>&nbsp;{$smAttachList[i].size}Kb&nbsp;</td>
          <td width="150" align="center" bgcolor="white" class="default" nowrap> 
            &nbsp;{$smAttachList[i].type}&nbsp;</td>
							{/section}
						</tr>
					</table>

    </td>
			</tr>	
		{/if}
  <tr>
    <td height="2" background="inc/themes/aleborgXP/images/list_up.gif"><img src="inc/themes/aleborgXP/images/list_up.gif" width="5" height="2"></td>
  </tr>
  <tr>
    <td height="20">
      <table border="0" cellspacing="0" cellpadding="0">
        <form name=move action="process.php" method=POST>
{$smDeleteForm}
  <tr>
            <td>&nbsp;<a class="menu" href="javascript:deletemsg()">{$smLabel.delete_mnu}</a>
              | <a class="menu" href="javascript:movemsg()">{$smLabel.move_mnu}&nbsp;
              </a> </td>
    <td>
										<select name="aval_folders">
											{section name=i loop=$smAvalFolders}
												<option value="{$smAvalFolders[i].path|escape:"html"}">{$smAvalFolders[i].display|escape:"html"}
											{/section}
										</select></td>
  </tr>
</form>
</table>
    </td>
  </tr>
  <tr>
    <td height="3" background="inc/themes/aleborgXP/images/list_down.gif"><img src="inc/themes/aleborgXP/images/list_down.gif" width="5" height="3"></td>
  </tr>
</table>

									<table width="100%" border=0 cellspacing=1 cellpadding=0>
										<tr bgcolor=white>
											<td width="60%"{$smBackImg}{$smBackColor}><font color=black>{$smMessageBody}</font></td>
										</tr>
									</table>
</body>
</html>
