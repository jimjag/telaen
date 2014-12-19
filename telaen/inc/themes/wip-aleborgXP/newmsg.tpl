<html><body bgcolor="#FFFFFF" text="#000000" link="#0000FF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onLoad="MM_preloadImages('inc/themes/aleborgXP/images/refresh_down.gif','inc/themes/aleborgXP/images/refresh_over.gif','inc/themes/aleborgXP/images/newmsg_down.gif','inc/themes/aleborgXP/images/newmsg_over.gif','inc/themes/aleborgXP/images/search_down.gif','inc/themes/aleborgXP/images/search_over.gif','inc/themes/aleborgXP/images/folders_down.gif','inc/themes/aleborgXP/images/folders_over.gif','inc/themes/aleborgXP/images/options_down.gif','inc/themes/aleborgXP/images/options_over.gif','inc/themes/aleborgXP/images/trash_down.gif','inc/themes/aleborgXP/images/trash_over.gif','inc/themes/aleborgXP/images/addressbook_down.gif','inc/themes/aleborgXP/images/addressbook_over.gif','inc/themes/aleborgXP/images/logout_down.gif','inc/themes/aleborgXP/images/logout_over.gif','inc/themes/aleborgXP/images/inbox_down.gif','inc/themes/aleborgXP/images/inbox_over.gif','inc/themes/aleborgXP/images/previous_down.gif','inc/themes/aleborgXP/images/previous_over.gif','inc/themes/aleborgXP/images/next_down.gif','inc/themes/aleborgXP/images/next_over.gif')">{config_load file=$umLanguageFile section="Newmessage"}

<head>
<title>UebiMiau</title>
<meta charset="utf-8" />
<link rel="stylesheet" href="inc/themes/aleborgXP/webmail.css" type="text/css">
<script language="JavaScript" src="inc/themes/aleborgXP/webmail.js" type="text/javascript">
</script>
{$umJS} 
</head>
{if $umAdvancedEditor eq 1}
	<div id="hiddenCompose" style="position: absolute; left: 3; top: -100; visibility: hidden; z-index: 3">	      
	<form name="hiddencomposeForm">
	<textarea cols=76 rows=10 name="hiddencomposeFormTextArea">{$umBody|escape:"html"}</textarea>
	</form>
	</div>
{/if}

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr height="1" bgcolor="#FFFFFF">
    <td height="1" bgcolor="#FFFFFF"></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellpadding="0" cellspacing="0" background="inc/themes/aleborgXP/images/menu_back.gif">
        <tr> 
          <td width="100"><img src="inc/themes/aleborgXP/images/logo.gif" width="100" height="32"></td>
          <td width="11"><img src="inc/themes/aleborgXP/images/seperator.gif" width="11" height="38"></td>
          <td width="32">{if $umPreviousLink}<a href="{$umPreviousLink}"><img src="inc/themes/aleborgXP/images/previous.gif" alt="{$umLabel.previous_text}" name="previous" width="32" height="38" border="0" id="previous" onMouseDown="MM_swapImage('previous','','inc/themes/aleborgXP/images/previous_down.gif',1)" onMouseOver="MM_swapImage('previous','','inc/themes/aleborgXP/images/previous_over.gif',1)" onMouseOut="MM_swapImgRestore()"></a>{else}<img src="inc/themes/aleborgXP/images/previous_off.gif">{/if}</td>
          <td width="32">{if $umNextLink}<a href="{$umNextLink}"><img src="inc/themes/aleborgXP/images/next.gif" alt="{$umLabel.next_text}" name="next" width="32" height="38" border="0" id="next" onMouseDown="MM_swapImage('next','','inc/themes/aleborgXP/images/next_down.gif',1)" onMouseOver="MM_swapImage('next','','inc/themes/aleborgXP/images/next_over.gif',1)" onMouseOut="MM_swapImgRestore()"></a>{else}<img src="inc/themes/aleborgXP/images/next_off.gif">{/if}</td>
          <td width="11"><img src="inc/themes/aleborgXP/images/seperator.gif" width="11" height="38"></td>
          <td width="32"><a href="javascript:goinbox()"><img src="inc/themes/aleborgXP/images/inbox.gif" alt="{$umLabel.messages_mnu}" name="inbox" width="32" height="38" border="0" id="inbox" onMouseDown="MM_swapImage('inbox','','inc/themes/aleborgXP/images/inbox_down.gif',1)" onMouseOver="MM_swapImage('inbox','','inc/themes/aleborgXP/images/inbox_over.gif',1)" onMouseOut="MM_swapImgRestore()"></a></td>
          <td width="32"><a href="javascript:newmsg()"><img src="inc/themes/aleborgXP/images/newmsg.gif" alt="{$umLabel.compose_mnu}" name="newmsg" width="32" height="38" border="0" id="newmsg" onMouseDown="MM_swapImage('newmsg','','inc/themes/aleborgXP/images/newmsg_down.gif',1)" onMouseOver="MM_swapImage('newmsg','','inc/themes/aleborgXP/images/newmsg_over.gif',1)" onMouseOut="MM_swapImgRestore()"></a></td>
          <td width="32"><img src="inc/themes/aleborgXP/images/refresh_off.gif" alt="{$umLabel.refresh_mnu}" name="refresh" width="32" height="38" border="0" id="refresh"></td>
          <td width="11"><img src="inc/themes/aleborgXP/images/seperator.gif" width="11" height="38"></td>
          <td width="32"><a href="javascript:folderlist()"><img src="inc/themes/aleborgXP/images/folders.gif" alt="{$umLabel.folders_mnu}" name="folders" width="32" height="38" border="0" id="folders" onMouseDown="MM_swapImage('folders','','inc/themes/aleborgXP/images/folders_down.gif',1)" onMouseOver="MM_swapImage('folders','','inc/themes/aleborgXP/images/folders_over.gif',1)" onMouseOut="MM_swapImgRestore()"></a></td>
          <td width="32"><a href="javascript:search()"><img src="inc/themes/aleborgXP/images/search.gif" alt="{$umLabel.search_mnu}" name="search" width="32" height="38" border="0" id="search" onMouseDown="MM_swapImage('search','','inc/themes/aleborgXP/images/search_down.gif',1)" onMouseOver="MM_swapImage('search','','inc/themes/aleborgXP/images/search_over.gif',1)" onMouseOut="MM_swapImgRestore()"></a></td>
          <td width="32"><a href="javascript:addresses()"><img src="inc/themes/aleborgXP/images/addressbook.gif" alt="{$umLabel.address_mnu}" name="addressbook" width="32" height="38" border="0" id="addressbook" onMouseDown="MM_swapImage('addressbook','','inc/themes/aleborgXP/images/addressbook_down.gif',1)" onMouseOver="MM_swapImage('addressbook','','inc/themes/aleborgXP/images/addressbook_over.gif',1)" onMouseOut="MM_swapImgRestore()"></a></td>
          <td width="11"><img src="inc/themes/aleborgXP/images/seperator.gif" width="11" height="38"></td>
          <td width="32"><a href="javascript:emptytrash()"><img src="inc/themes/aleborgXP/images/trash.gif" alt="{$umLabel.empty_trash_mnu}" name="trash" width="32" height="38" border="0" id="trash" onMouseDown="MM_swapImage('trash','','inc/themes/aleborgXP/images/trash_down.gif',1)" onMouseOver="MM_swapImage('trash','','inc/themes/aleborgXP/images/trash_over.gif',1)" onMouseOut="MM_swapImgRestore()"></a></td>
          <td width="32"><a href="javascript:prefs()"><img src="inc/themes/aleborgXP/images/options.gif" alt="{$umLabel.prefs_mnu}" name="options" width="32" height="38" border="0" id="options" onMouseDown="MM_swapImage('options','','inc/themes/aleborgXP/images/options_down.gif',1)" onMouseOver="MM_swapImage('options','','inc/themes/aleborgXP/images/options_over.gif',1)" onMouseOut="MM_swapImgRestore()"></a></td>
          <td width="32"><a href="javascript:goend()"><img src="inc/themes/aleborgXP/images/logout.gif" alt="{$umLabel.logoff_mnu}" name="logout" width="32" height="38" border="0" id="logout" onMouseDown="MM_swapImage('logout','','inc/themes/aleborgXP/images/logout_down.gif',1)" onMouseOver="MM_swapImage('logout','','inc/themes/aleborgXP/images/logout_over.gif',1)" onMouseOut="MM_swapImgRestore()"></a></td>
          <td>&nbsp;</td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td height="2" background="inc/themes/aleborgXP/images/list_up.gif"><img src="inc/themes/aleborgXP/images/list_up.gif" width="5" height="2"></td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0" background="inc/themes/aleborgXP/images/menu_back.gif">
  <form name=composeForm method=post action="newmsg.php" onSubmit="return false;">
    {$umForms} 
    <tr> 
      <td height="16" class="default"> 
        <table width="500" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="160">&nbsp;{$umLabel.to_hea} &nbsp;</td>
            <td width="20"><a href="javascript:addrpopup()"><img src="images/bookmark_it.gif" width="15" height="12" border="0" alt="{$umLabel.address_tip}"></a></td>
            <td>{$umTo}</td>
          </tr>
        </table>
      </td>
    </tr>
    <tr> 
      <td height="2" background="inc/themes/aleborgXP/images/list_up.gif"><img src="inc/themes/aleborgXP/images/list_up.gif" width="5" height="2"></td>
    </tr>
    <tr> 
      <td height="16" class="default">
        <table width="500" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="160">&nbsp;{$umLabel.cc_hea} &nbsp;</td>
            <td width="20"><a href="javascript:addrpopup()"><img src="images/bookmark_it.gif" width="15" height="12" border="0" alt="{$umLabel.address_tip}"></a></td>
            <td>{$umCc}</td>
          </tr>
        </table>
      </td>
    </tr>
    <tr> 
      <td height="2" background="inc/themes/aleborgXP/images/list_up.gif"><img src="inc/themes/aleborgXP/images/list_up.gif" width="5" height="2"></td>
    </tr>
    <tr> 
      <td height="16" class="default">
        <table width="500" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="160">&nbsp;{$umLabel.bcc_hea} &nbsp;</td>
            <td width="20"><a href="javascript:addrpopup()"><img src="images/bookmark_it.gif" width="15" height="12" border="0" alt="{$umLabel.address_tip}"></a></td>
            <td>{$umBcc}</td>
          </tr>
        </table>
      </td>
    </tr>
    <tr> 
      <td height="2" background="inc/themes/aleborgXP/images/list_up.gif"><img src="inc/themes/aleborgXP/images/list_up.gif" width="5" height="2"></td>
    </tr>
    <tr> 
      <td height="16" class="default">
        <table width="500" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="160">&nbsp;{$umLabel.subject_hea}</td>
            <td width="20">&nbsp;</td>
            <td>{$umSubject}</td>
          </tr>
        </table>
      </td>
    </tr>
    <tr> 
      <td height="2" background="inc/themes/aleborgXP/images/list_up.gif"><img src="inc/themes/aleborgXP/images/list_up.gif" width="5" height="2"></td>
    </tr>
    <tr> 
      <td height="16" class="default">
        <table width="500" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="160">&nbsp;{$umLabel.priority_text}</td>
            <td width="20">&nbsp;</td>
            <td>
              <select name="priority" class="textbox" style="width : 200px;">
                <option value="1"{if $umPriority eq 1} selected{/if}>{$umLabel.priority_high} 
                <option value="3"{if $umPriority eq 3} selected{/if}>{$umLabel.priority_normal} 
                <option value="5"{if $umPriority eq 5} selected{/if}>{$umLabel.priority_low} 
              </select>
            </td>
          </tr>
        </table>
      </td>
    </tr>
    <tr> 
      <td height="2" background="inc/themes/aleborgXP/images/list_up.gif"><img src="inc/themes/aleborgXP/images/list_up.gif" width="5" height="2"></td>
    </tr>
{if !$umAddSignature && $umHaveSignature}
    <tr> 
      <td height="16" class="default">
        <table width="500" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="160">&nbsp;{$umLabel.add_signature}</td>
            <td width="20">&nbsp;</td>
            <td>
              <input type="checkbox" name="cksig" onClick="return addsig()"{if $umAddSignature eq 1} checked disabled{/if}>
            </td>
          </tr>
        </table>
      </td>
    </tr>
    <tr> 
      <td height="2" background="inc/themes/aleborgXP/images/list_up.gif"><img src="inc/themes/aleborgXP/images/list_up.gif" width="5" height="2"></td>
    </tr>
{/if} 
    <tr> 
      <td height="16" class="default">&nbsp;<img src="images/attach.gif" align="absmiddle">&nbsp;<a href="javascript:upwin()" class="navigation">{$umLabel.attch_add_new}</a></td>
    </tr>
    <tr> 
      <td height="2" background="inc/themes/aleborgXP/images/list_up.gif"><img src="inc/themes/aleborgXP/images/list_up.gif" width="5" height="2"></td>
    </tr>
    <tr> 
      <td height="16" class="default">&nbsp;{$umLabel.attach_hea}</td>
    </tr>
    <tr> 
      <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr background="inc/themes/aleborgXP/images/back_list.gif">
    <td background="inc/themes/aleborgXP/images/back_list.gif" height="20"><table width="620" border="0" cellspacing="0" cellpadding="0">
                <tr background="inc/themes/aleborgXP/images/back_list.gif"> 
                  <td width="300" height="20" background="inc/themes/aleborgXP/images/back_list.gif" class="defaultC"> 
                    <div align="left"><b>&nbsp;{$umLabel.attch_name_hea}</b></div>
                  </td>

            <td width="100" height="20" background="inc/themes/aleborgXP/images/back_list.gif" class="defaultC"><b>{$umLabel.attch_size}</b></td>

            <td width="160" height="20" background="inc/themes/aleborgXP/images/back_list.gif" class="defaultC"><b>{$umLabel.attch_type_hea}</b></td>

            <td width="60" height="20" background="inc/themes/aleborgXP/images/back_list.gif" class="defaultC"><b>{$umLabel.attch_dele_hea}</b></td>
           </tr>
		   </table></td>
  </tr>
</table>

			<table width="620" border=0 cellspacing=1 cellpadding=0>
                {if $umHaveAttachs eq 1} 
                {section name=i loop=$umAttachList} 
                <tr> 
                  <td width="300" class="default"> &nbsp;{$umAttachList[i].name|escape:"html"}</td>
                  <td width="100" class="defaultC">{$umAttachList[i].size}Kb&nbsp;</td>
                  <td width="160" class="defaultC"> &nbsp;{$umAttachList[i].type|truncate:23:"...":true}</td>
                  <td width="60" class="defaultC"> &nbsp;<a href="{$umAttachList[i].link}"><img src="inc/themes/aleborgXP/images/delete.gif" border="0"></a></td>
                </tr>
                {/section} {else} 
                <tr> 
                  <td> &nbsp;{$umLabel.attch_no_hea}</td>
                </tr>
                {/if} 
              </table></td>
    </tr>
    <tr> 
      <td height="3" background="inc/themes/aleborgXP/images/list_down.gif"><img src="inc/themes/aleborgXP/images/list_down.gif" width="5" height="3"></td>
    </tr>
    <tr> 
      <td bgcolor="#FFFFFF">{if $umAdvancedEditor eq 1} {include file="uebimiau/advanced-editor.tpl"} 
        <div id="hiddenCompose2" style="position: absolute; left: 3; top: -100; visibility: hidden; z-index: 3">	
          <textarea cols=76 rows=10 name=body>{$umBody|escape:"html"}</textarea>
        </div>
        {else} 
        <textarea cols=76 rows=10 name=body>{$umBody|escape:"html"}</textarea>
        {/if}</td>
    </tr>
    <tr>
      <td bgcolor="#FFFFFF">&nbsp;<input type="button" name="bt_enviar" value="{$umLabel.send_text}" onClick="enviar()"></td>
    </tr>
  </form>
</table>
</body>
</html>
