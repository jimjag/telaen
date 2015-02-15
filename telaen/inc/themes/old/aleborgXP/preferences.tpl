<html><body bgcolor="#FFFFFF" text="#000000" link="#0000FF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onLoad="MM_preloadImages('inc/themes/aleborgXP/images/refresh_down.gif','inc/themes/aleborgXP/images/refresh_over.gif','inc/themes/aleborgXP/images/newmsg_down.gif','inc/themes/aleborgXP/images/newmsg_over.gif','inc/themes/aleborgXP/images/search_down.gif','inc/themes/aleborgXP/images/search_over.gif','inc/themes/aleborgXP/images/folders_down.gif','inc/themes/aleborgXP/images/folders_over.gif','inc/themes/aleborgXP/images/options_down.gif','inc/themes/aleborgXP/images/options_over.gif','inc/themes/aleborgXP/images/trash_down.gif','inc/themes/aleborgXP/images/trash_over.gif','inc/themes/aleborgXP/images/addressbook_down.gif','inc/themes/aleborgXP/images/addressbook_over.gif','inc/themes/aleborgXP/images/logout_down.gif','inc/themes/aleborgXP/images/logout_over.gif','inc/themes/aleborgXP/images/inbox_down.gif','inc/themes/aleborgXP/images/inbox_over.gif','inc/themes/aleborgXP/images/previous_down.gif','inc/themes/aleborgXP/images/previous_over.gif','inc/themes/aleborgXP/images/next_down.gif','inc/themes/aleborgXP/images/next_over.gif')">{config_load file=$umLanguageFile section="Preferences"}
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<head>
	<title>UebiMiau - {$smLabel.prf_title}</title>
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
          <td width="32"><a href="javascript:folderlist()"><img src="inc/themes/aleborgXP/images/folders.gif" alt="{$smLabel.folders_mnu}" name="folders" width="32" height="38" border="0" id="folders" onMouseDown="MM_swapImage('folders','','inc/themes/aleborgXP/images/folders_down.gif',1)" onMouseOver="MM_swapImage('folders','','inc/themes/aleborgXP/images/folders_over.gif',1)" onMouseOut="MM_swapImgRestore()"></a></td>
          <td width="32"><a href="javascript:search()"><img src="inc/themes/aleborgXP/images/search.gif" alt="{$smLabel.search_mnu}" name="search" width="32" height="38" border="0" id="search" onMouseDown="MM_swapImage('search','','inc/themes/aleborgXP/images/search_down.gif',1)" onMouseOver="MM_swapImage('search','','inc/themes/aleborgXP/images/search_over.gif',1)" onMouseOut="MM_swapImgRestore()"></a></td>
          <td width="32"><a href="javascript:addresses()"><img src="inc/themes/aleborgXP/images/addressbook.gif" alt="{$smLabel.address_mnu}" name="addressbook" width="32" height="38" border="0" id="addressbook" onMouseDown="MM_swapImage('addressbook','','inc/themes/aleborgXP/images/addressbook_down.gif',1)" onMouseOver="MM_swapImage('addressbook','','inc/themes/aleborgXP/images/addressbook_over.gif',1)" onMouseOut="MM_swapImgRestore()"></a></td>
          <td width="11"><img src="inc/themes/aleborgXP/images/seperator.gif" width="11" height="38"></td>
          <td width="32"><a href="javascript:emptytrash()"><img src="inc/themes/aleborgXP/images/trash.gif" alt="{$smLabel.empty_trash_mnu}" name="trash" width="32" height="38" border="0" id="trash" onMouseDown="MM_swapImage('trash','','inc/themes/aleborgXP/images/trash_down.gif',1)" onMouseOver="MM_swapImage('trash','','inc/themes/aleborgXP/images/trash_over.gif',1)" onMouseOut="MM_swapImgRestore()"></a></td>
          <td width="32"><img src="inc/themes/aleborgXP/images/options_off.gif" alt="{$smLabel.prefs_mnu}" name="options" width="32" height="38" border="0" id="options"></td>
          <td width="32"><a href="javascript:goend()"><img src="inc/themes/aleborgXP/images/logout.gif" alt="{$smLabel.logoff_mnu}" name="logout" width="32" height="38" border="0" id="logout" onMouseDown="MM_swapImage('logout','','inc/themes/aleborgXP/images/logout_down.gif',1)" onMouseOver="MM_swapImage('logout','','inc/themes/aleborgXP/images/logout_over.gif',1)" onMouseOut="MM_swapImgRestore()"></a></td>
          <td>&nbsp;</td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td height="3" background="inc/themes/aleborgXP/images/list_down.gif"><img src="inc/themes/aleborgXP/images/list_down.gif" width="5" height="3"></td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<form name="form1" action="preferences.php" method="POST">
  <tr>
    <td>
<table width="720" border="0" cellpadding="0" cellspacing="5">
  <tr> 
    <td><table border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td width="8"><img src="inc/themes/aleborgXP/images/login/left_up_corner.gif" width="8" height="29"></td>
          <td> <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td background="inc/themes/aleborgXP/images/login/up_back.gif" class="white"><b>{$smLabel.prf_general_title}</b>&nbsp;</td>
                <td width="31"><img src="inc/themes/aleborgXP/images/login/right_up_corner.gif" width="31" height="29"></td>
              </tr>
            </table></td>
        </tr>
        <tr> 
          <td background="inc/themes/aleborgXP/images/login/left_side.gif"><img src="inc/themes/aleborgXP/images/login/left_side.gif" width="8" height="5"></td>
          <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td><table width="650" border="0" cellspacing="0" cellpadding="0">
                      <tr height="5"> 
                        <td height="5" colspan="2"><img src="images/empty.gif" width="5" height="5"></td>
                      </tr>
                      <tr> 
                              <td width="233">&nbsp;{$smLabel.prf_name}:</td>
                        <td width="417"><input type="text" name="f_real_name" size="30" value="{$umRealName|escape:"html"}" class="textbox"></td>
                      </tr>
                      <tr> 
                              <td>&nbsp;{$smLabel.prf_reply_to}:</td>
                        <td><input type=text name="f_reply_to" size="30" value="{$umReplyTo|escape:"html"}" class="textbox"></td>
                      </tr>
                      <tr> 
                              <td>&nbsp;{$smLabel.prf_time_zone}:</td>
                        <td>{$umTimezoneSelect}</td>
                      </tr>
                      <tr> 
                              <td>&nbsp;{$smLabel.prf_default_editor_mode}:</td>
                        <td><select name="f_editor_mode">
							<option value="text"{if $umEditorMode eq "text"} selected{/if}>{$smLabel.prf_default_editor_mode_text}
							<option value="html"{if $umEditorMode eq "html"} selected{/if}>{$smLabel.prf_default_editor_mode_html}
                          </select></td>
                      </tr>
                      <tr height="5"> 
                        <td height="5" colspan="2"><img src="images/empty.gif" width="5" height="5"></td>
                      </tr>
                    </table></td>
                <td width="8" background="inc/themes/aleborgXP/images/login/right_side.gif"><img src="inc/themes/aleborgXP/images/login/right_side.gif" width="8" height="5"></td>
              </tr>
            </table></td>
        </tr>
        <tr> 
          <td><img src="inc/themes/aleborgXP/images/login/left_down_corner.gif" width="8" height="5"></td>
          <td align="right" background="inc/themes/aleborgXP/images/login/down_buttom.gif"><img src="inc/themes/aleborgXP/images/login/down_buttom.gif" width="8" height="5"><img src="inc/themes/aleborgXP/images/login/right_down_corner.gif" width="8" height="5"></td>
        </tr>
      </table></td>
  </tr>
</table>
<table width="720" border="0" cellspacing="5" cellpadding="0">
  <tr> 
    <td><table border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td width="8"><img src="inc/themes/aleborgXP/images/login/left_up_corner.gif" width="8" height="29"></td>
          <td> <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                  <td background="inc/themes/aleborgXP/images/login/up_back.gif" class="white"><b>{$smLabel.prf_trash_title}</b></td>
                <td width="31"><img src="inc/themes/aleborgXP/images/login/right_up_corner.gif" width="31" height="29"></td>
              </tr>
            </table></td>
        </tr>
        <tr> 
          <td background="inc/themes/aleborgXP/images/login/left_side.gif"><img src="inc/themes/aleborgXP/images/login/left_side.gif" width="8" height="5"></td>
          <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td><table width="650" border="0" cellspacing="0" cellpadding="0">
                      <tr> 
                        <td><img src="images/empty.gif" width="5" height="5"></td>
                      </tr>
                      <tr> 
                        <td><input type="checkbox" name="f_save_trash" onClick="dis()" value="1"{$umSaveTrash}> 
                          <acronym style="cursor: hand;" onClick="f_save_trash.click()">{$smLabel.prf_save_to_trash}
                          "<b>{$smLabel.trash_extended}</b>"</acronym></td>
                      </tr>
                      <tr> 
                        <td><input type="checkbox" name="f_st_only_read" onClick="return checkDis()" value="1"{$umSaveTrashOnlyRead}> 
                          <acronym style="cursor: hand;" onClick="f_st_only_read.click()">{$smLabel.prf_save_only_read}
                          "<b>{$smLabel.trash_extended}</b>"</acronym></td>
                      </tr>
                      <tr> 
                        <td><input type="checkbox" name="f_empty_on_exit" value="1"{$umEmptyTrashOnExit}> 
                          <acronym style="cursor: hand;" onClick="f_empty_on_exit.click()">{$smLabel.prf_empty_on_exit}</acronym></td>
                      </tr>
                      <tr>
                        <td><img src="images/empty.gif" width="5" height="5"></td>
                      </tr>
                    </table> </td>
                <td width="8" background="inc/themes/aleborgXP/images/login/right_side.gif"><img src="inc/themes/aleborgXP/images/login/right_side.gif" width="8" height="5"></td>
              </tr>
            </table></td>
        </tr>
        <tr> 
          <td><img src="inc/themes/aleborgXP/images/login/left_down_corner.gif" width="8" height="5"></td>
          <td align="right" background="inc/themes/aleborgXP/images/login/down_buttom.gif"><img src="inc/themes/aleborgXP/images/login/down_buttom.gif" width="8" height="5"><img src="inc/themes/aleborgXP/images/login/right_down_corner.gif" width="8" height="5"></td>
        </tr>
      </table></td>
  </tr>
</table>
<table width="720" border="0" cellspacing="5" cellpadding="0">
  <tr> 
    <td><table border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td width="8"><img src="inc/themes/aleborgXP/images/login/left_up_corner.gif" width="8" height="29"></td>
          <td> <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                  <td background="inc/themes/aleborgXP/images/login/up_back.gif" class="white"><b>{$smLabel.prf_sent_title}</b></td>
                <td width="31"><img src="inc/themes/aleborgXP/images/login/right_up_corner.gif" width="31" height="29"></td>
              </tr>
            </table></td>
        </tr>
        <tr> 
          <td background="inc/themes/aleborgXP/images/login/left_side.gif"><img src="inc/themes/aleborgXP/images/login/left_side.gif" width="8" height="5"></td>
          <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td><table width="650" border="0" cellspacing="0" cellpadding="0">
                      <tr> 
                        <td><img src="images/empty.gif" width="5" height="5"></td>
                      </tr>
                      <tr> 
                        <td> 
                          <input type="checkbox" name="f_save_sent" value="1"{$umSaveSent}>
                          <acronym style="cursor: hand;" onClick="f_save_sent.click()">{$smLabel.prf_save_sent}
                          "<b>{$smLabel.sent_extended}</b>"</acronym></td>
                      </tr>
                      <tr>
                        <td><img src="images/empty.gif" width="5" height="5"></td>
                      </tr>
                    </table> </td>
                <td width="8" background="inc/themes/aleborgXP/images/login/right_side.gif"><img src="inc/themes/aleborgXP/images/login/right_side.gif" width="8" height="5"></td>
              </tr>
            </table></td>
        </tr>
        <tr> 
          <td><img src="inc/themes/aleborgXP/images/login/left_down_corner.gif" width="8" height="5"></td>
          <td align="right" background="inc/themes/aleborgXP/images/login/down_buttom.gif"><img src="inc/themes/aleborgXP/images/login/down_buttom.gif" width="8" height="5"><img src="inc/themes/aleborgXP/images/login/right_down_corner.gif" width="8" height="5"></td>
        </tr>
      </table></td>
  </tr>
</table>
<table width="720" border="0" cellspacing="5" cellpadding="0">
  <tr> 
    <td><table border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td width="8"><img src="inc/themes/aleborgXP/images/login/left_up_corner.gif" width="8" height="29"></td>
          <td> <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                  <td background="inc/themes/aleborgXP/images/login/up_back.gif" class="white"><b>{$smLabel.prf_messages_title}</b></td>
                <td width="31"><img src="inc/themes/aleborgXP/images/login/right_up_corner.gif" width="31" height="29"></td>
              </tr>
            </table></td>
        </tr>
        <tr> 
          <td background="inc/themes/aleborgXP/images/login/left_side.gif"><img src="inc/themes/aleborgXP/images/login/left_side.gif" width="8" height="5"></td>
          <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td><table width="650" border="0" cellspacing="0" cellpadding="0">
                      <tr> 
                        <td colspan="2"><img src="images/empty.gif" width="5" height="5"></td>
                      </tr>
                      <tr> 
                              <td nowrap>&nbsp;{$smLabel.prf_page_limit}&nbsp;</td>
                        <td width="355">{$umRecordsPerPage}</td>
                      </tr>
                      <tr> 
                              <td nowrap>&nbsp;{$smLabel.prf_time_to_refesh}&nbsp;</td>
                        <td>{$umTimeToRefresh}</td>
                      </tr>
                      <tr> 
                              <td colspan="2">
                                <input type="checkbox" name="f_display_images" value="1"{$umDisplayImages} checked>
                                <acronym style="cursor: hand;" onClick="f_display_images.click()">{$smLabel.prf_display_images}</acronym></td>
                      </tr>
                      <tr>
                        <td colspan="2"><img src="images/empty.gif" width="5" height="5"></td>
                      </tr>
                    </table> </td>
                <td width="8" background="inc/themes/aleborgXP/images/login/right_side.gif"><img src="inc/themes/aleborgXP/images/login/right_side.gif" width="8" height="5"></td>
              </tr>
            </table></td>
        </tr>
        <tr> 
          <td><img src="inc/themes/aleborgXP/images/login/left_down_corner.gif" width="8" height="5"></td>
          <td align="right" background="inc/themes/aleborgXP/images/login/down_buttom.gif"><img src="inc/themes/aleborgXP/images/login/down_buttom.gif" width="8" height="5"><img src="inc/themes/aleborgXP/images/login/right_down_corner.gif" width="8" height="5"></td>
        </tr>
      </table></td>
  </tr>
</table>
<table width="720" border="0" cellspacing="5" cellpadding="0">
  <tr> 
    <td><table border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td width="8"><img src="inc/themes/aleborgXP/images/login/left_up_corner.gif" width="8" height="29"></td>
          <td> <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                  <td background="inc/themes/aleborgXP/images/login/up_back.gif" class="white"><b>{$smLabel.prf_signature_title}</b></td>
                <td width="31"><img src="inc/themes/aleborgXP/images/login/right_up_corner.gif" width="31" height="29"></td>
              </tr>
            </table></td>
        </tr>
        <tr> 
          <td background="inc/themes/aleborgXP/images/login/left_side.gif"><img src="inc/themes/aleborgXP/images/login/left_side.gif" width="8" height="5"></td>
          <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td><table width="650" border="0" cellspacing="0" cellpadding="0">
                      <tr> 
                        <td colspan="2"><img src="images/empty.gif" width="5" height="5"></td>
                      </tr>
                      <tr> 
                              <td>&nbsp;{$smLabel.prf_signature}</td>
                        <td width="420">{$umSignature}</td>
                      </tr>
                      <tr> 
                        <td colspan="2"><input type="checkbox" name="f_add_sig" value="1"{$umAddSignature}> 
                          <acronym style="cursor: hand;" onClick="f_add_sig.click()">{$smLabel.prf_auto_add_sign}</acronym></td>
                      </tr>
                      <tr>
                        <td colspan="2"><img src="images/empty.gif" width="5" height="5"></td>
                      </tr>
                    </table> </td>
                <td width="8" background="inc/themes/aleborgXP/images/login/right_side.gif"><img src="inc/themes/aleborgXP/images/login/right_side.gif" width="8" height="5"></td>
              </tr>
            </table></td>
        </tr>
        <tr> 
          <td><img src="inc/themes/aleborgXP/images/login/left_down_corner.gif" width="8" height="5"></td>
          <td align="right" background="inc/themes/aleborgXP/images/login/down_buttom.gif"><img src="inc/themes/aleborgXP/images/login/down_buttom.gif" width="8" height="5"><img src="inc/themes/aleborgXP/images/login/right_down_corner.gif" width="8" height="5"></td>
        </tr>
      </table></td>
  </tr>
</table>
<table cellspacing=2 cellpadding=0 border=0 bgcolor=White width="720">
  <tr>
		<td valign=top>
			<table cellspacing=1 cellpadding=1 width="100%" border=0 bgcolor=White>
          <input type=hidden name="tid"  value="{$umTid}">
          <input type=hidden name="sid"  value="{$umSid}">
          <input type=hidden name="lid"  value="{$umLid}">
          <tr> 
                  <td bgcolor=white align="center"><br>
                     <input type="submit" value="{$smLabel.prf_save_button}">
                    <br>
                  </td>
          </tr>
        </table>
		</td>
	</tr>
</table></td>
  </tr>
				</form>
</table>
</body>
</html>
