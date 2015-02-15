<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<title>{if $webmailTitle}{$webmailTitle} - {/if}{$smBoxName} - {$smUserEmail}</title>
<link rel="stylesheet" href="inc/themes/outlook/webmail.css" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset={$smLabel.default_char_set}">
{$pageMetas}
<script src="inc/themes/outlook/webmail.js" type="text/javascript"></script>
{$smJS}
</head>

<body>
<form name=form1 action=process.php method=post>
  {$smForms}
  <table width='100%'>
    {if $smNumMessages gt 0}
    {if $smErrorMessage neq ""}
    <tr>
      <td colspan="7" class="default"><font color=red><b> &nbsp;&nbsp;{$smErrorMessage}</b></font></td>
    </tr>
    {/if}
    {/if}
  </table>
  <table width='100%' cellspacing=2 cellpadding=0 class='window_inner'>
  <tr>
    <td><table width='100%' cellpadding='0' cellspacing='0'>
        <tr>
          <td class="window_title"><img src='inc/themes/outlook/images/icon_outlook.gif'></td>
          <td width='100%' class="window_title">&nbsp;{$smBoxName} - {$smUserEmail}</td>
          <td class='window_title_X'><a href='javascript:goend()'><img border='0' src='inc/themes/outlook/images/X.png'></a></td>
        </tr>
      </table>
      <table width='100%' height='2' cellpadding='0' cellspacing='0'>
        <tr>
          <td></td>
        </tr>
      </table>
      <table width='100%' cellpadding='0' cellspacing='0'>
        <!-- BARRA DE HERRAMIENTAS -->
        <tr>
          <td class='toolbar_outer' ><table width='100%' cellpadding='0' cellspacing='0'>
              <tr>
                <td class='toolbar_inner'><table width='0' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td class="toolbar_splitter"><img src='inc/themes/outlook/images/bar_handler.gif'></td>
                      <td class="toolbar_button_off" onmouseover="this.className='toolbar_button_on'" onmouseout="this.className='toolbar_button_off'" onmousedown="this.className='toolbar_button_down'" onmouseup="this.className='toolbar_button_on'" onclick="javascript:newmsg()"><acronym title="{$smLabel.compose_mnu}"><img src="inc/themes/outlook/images/icon_new.gif"><font class='xx-normal'><br>
                        {#compose_mnu#|truncate:13:"...":true}</font></acronym></td>
                      <td class="toolbar_splitter"><img src='inc/themes/outlook/images/bar_splitter.gif'></td>
                      <td class="toolbar_button_off" onmouseover="this.className='toolbar_button_on'" onmouseout="this.className='toolbar_button_off'" onmousedown="this.className='toolbar_button_down'" onmouseup="this.className='toolbar_button_on'" onclick="javascript:delemsg()"><acronym title="{$smLabel.delete_selected_mnu}"><img src="inc/themes/outlook/images/icon_delete.gif"><font class='xx-normal'><br>
                        {#delete_selected_mnu#|truncate:13:"...":true}</font></acronym></td>
                      <!-- added for telaen -->
                      <td class="toolbar_button_off" onmouseover="this.className='toolbar_button_on'" onmouseout="this.className='toolbar_button_off'" onmousedown="this.className='toolbar_button_down'" onmouseup="this.className='toolbar_button_on'" onclick="javascript:markmsg()"><acronym title="{$smLabel.mark_selected_mnu}"><img src="inc/themes/outlook/images/icon_read.gif"	alt="mark"><font class='xx-normal'><br>
                        {#mark_selected_mnu#|truncate:13:"...":true}</font></acronym></td>
                      <td class="toolbar_button_off" onmouseover="this.className='toolbar_button_on'" onmouseout="this.className='toolbar_button_off'" onmousedown="this.className='toolbar_button_down'" onmouseup="this.className='toolbar_button_on'" onclick="javascript:unmarkmsg()"><acronym title="{$smLabel.unmark_selected_mnu}"><img src="inc/themes/outlook/images/icon_unread.gif" alt="unmark"><font class='xx-normal'><br>
                        {#unmark_selected_mnu#|truncate:13:"...":true}</font></acronym></td>
                      <!-- end telaen add -->
                      <td class="toolbar_button_off" onmouseover="this.className='toolbar_button_on'" onmouseout="this.className='toolbar_button_off'" onmousedown="this.className='toolbar_button_down'" onmouseup="this.className='toolbar_button_on'" onclick="javascript:refreshlist()"><acronym title="{$smLabel.refresh_mnu}"><img src="inc/themes/outlook/images/icon_sendreceive.gif"><font class='xx-normal'><br>
                        {#refresh_mnu#|truncate:13:"...":true}</font></acronym></td>
                      <td class="toolbar_splitter"><img src='inc/themes/outlook/images/bar_splitter.gif'></td>
                      <td class="toolbar_button_off" onmouseover="this.className='toolbar_button_on'" onmouseout="this.className='toolbar_button_off'" onmousedown="this.className='toolbar_button_down'" onmouseup="this.className='toolbar_button_on'" onclick="javascript:addresses()"><acronym title="{$smLabel.address_mnu}"><img src="inc/themes/outlook/images/icon_addressbook.gif"><font class='xx-normal'><br>
                        {#address_mnu#|truncate:13:"...":true}</font></acronym></td>
                      <td class="toolbar_button_off" onmouseover="this.className='toolbar_button_on'" onmouseout="this.className='toolbar_button_off'" onmousedown="this.className='toolbar_button_down'" onmouseup="this.className='toolbar_button_on'" onclick="javascript:search()"><acronym title="{$smLabel.search_mnu}"><img src="inc/themes/outlook/images/icon_search.gif"><font class='xx-normal'><br>
                        {#search_mnu#|truncate:13:"...":true}</font></acronym></td>
                      <td class="toolbar_splitter"><img src='inc/themes/outlook/images/bar_splitter.gif'></td>
                      <td class="toolbar_button_off" onmouseover="this.className='toolbar_button_on'" onmouseout="this.className='toolbar_button_off'" onmousedown="this.className='toolbar_button_down'" onmouseup="this.className='toolbar_button_on'" onclick="javascript:prefs()"><acronym title="{$smLabel.prefs_mnu}"><img src="inc/themes/outlook/images/icon_options.gif"><font class='xx-normal'><br>
                        {#prefs_mnu#|truncate:13:"...":true}</font></acronym></td>
                    </tr>
                  </table></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td><table width='100%' height='100%' cellspacing=2 cellpadding=0>
        <tr>
          <td valign=top colspan=3><table width='100%' cellpadding='0' cellspacing='0'>
              <tr>
                <td onmouseover="this.className='seccion_title_over'" onmouseout="this.className='seccion_title_out'" onmouseup="this.className='seccion_title_out'" onmousedown="this.className='seccion_title_down'" onclick="javascript:folderlist()" class='seccion_title_out'>&nbsp;<img src="inc/themes/outlook/images/icon_folder_other.gif">&nbsp;<nobr>{$smBoxName}<img src="inc/themes/outlook/images/arrow_down.gif" border='0'></nobr></td>
                <td class='seccion_title' align='right'><font class='xx-normal' color='#FFFFFF'>{$smLabel.move_selected_mnu}
                  <select name="aval_folders">

								{section name=i loop=$smAvalFolders}

                    <option value="{$smAvalFolders[i].path|escape:"html"}">{$smAvalFolders[i].display|escape:"html"}
                    {/section}
                  </select>
                  <a class="menu" href="javascript:movemsg()"><img border=0 src="inc/themes/outlook/images/icon_go.gif"></a>&nbsp; </font></td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td valign=top colspan=3 height=3></td>
        </tr>
        <tr> 
          <!-- BARRA DE OUTLOOK -->
          <td width='100%' height='100%' class="outlook_bar_outer" valign='top'><table width='100%' height='100%' cellpadding='0' cellspacing='0'>
              <tr>
                <td class="headers" onclick="javascript:folderlist()"><a href="#">{#folders_mnu#|truncate:26:"...":true}</a></td>
              </tr>
              <tr>
                <td valign=top style="background: #FFFFFF; padding:5px;"><div id="folderlist" name="folderlist">
                  <table cellpadding=0 cellspacing=0>
                    <tr>
                      <td><img src=themes/outlook/images/icon_outlook.gif></td>
                      <td><font class=xx-normal><nobr>{if $webmailTitle}{$webmailTitle}{else}Webmail{/if}</nobr></font></td>
                    </tr>
                  </table>
                  <div>
                  {literal}<script>function WriteFolders(res) {document.getElementById('folderlist').innerHTML=res;}</script>{/literal}
                  <iframe src="folders.php?oefolders=true" style="display:none;"></iframe></td>
              </tr>
            </table></td>
          <!-- FIN BARRA DE OUTLOOK --> 
          <!-- LISTA DE MENSAJES -->
          <td valign='top' height='100%'><table width='100%' height='100%' cellpadding='0' cellspacing='0'>
              <tr>
                <td width=100% height=100% valign='top' class="messages"><table width=100% cellpadding='0' cellspacing='0'>
                    <tr>
                      <td width="10px" align="center" class="headers" onmousedown="javascript:sel()"><nobr>&nbsp;<img src="inc/themes/outlook/images/icon_checkbox.gif">&nbsp;</nobr></td>
                      <td width="10px" align="center" class="headers"><img src="inc/themes/outlook/images/icon_high_priority.gif"></td>
                      <td width="10px" align="center" class="headers"><img src="inc/themes/outlook/images/icon_attachment_clip.gif"></td>
                      {if $smFolder eq "sent"}
                      <td colspan=2 onclick="javascript:sortby('toname')" class="headers">{$smLabel.to_hea}{$smToArrow}</td>
                      {else}
                      <td colspan=2 onclick="javascript:sortby('fromname')" class="headers">{$smLabel.from_hea}{$smFromArrow}</td>
                      {/if}
                      <td onclick="javascript:sortby('subject')" class="headers">{$smLabel.subject_hea}{$smSubjectArrow}</td>
                      <td onclick="javascript:sortby('date')" width="100" class="headers">{$smLabel.date_hea}{$smDateArrow}</td>
                      <td onclick="javascript:sortby('size')" width="60" class="headers">{$smLabel.size_hea}{$smSizeArrow}</td>
                    </tr>
                    {counter start=0 print=false}
                    {section name=i loop=$smMessageList}
                    {counter assign=contador}
                    <tr>
                      <td align="center">{$smMessageList[i].checkbox}</td>
                      <td align="center" class="messagelist">{$smMessageList[i].priorimg}</td>
                      <td align="center" class="messagelist">{$smMessageList[i].attachimg}</td>
                      <td width="10px" align="center" class="messagelist"><nobr>{$smMessageList[i].statusimg}</nobr></td>
                      {if $smFolder eq "sent"}
                      <td onclick="{$smMessageList[i].readlink}" id="address_{$contador}"
												onmouseover="address_{$contador}.className='messagelist_over';subject_{$contador}.className='messagelist_over';date_{$contador}.className='messagelist_over';size_{$contador}.className='messagelist_over';"
												onmouseout="address_{$contador}.className='messagelist';subject_{$contador}.className='messagelist';date_{$contador}.className='messagelist';size_{$contador}.className='messagelist';"
												class="messagelist"><acronym title="{$smMessageList[i].to|escape:"html"|default:$smLabel.no_recipient_text}"><a href="{$smMessageList[i].readlink}">{if !$smMessageList[i].read}<b>{/if}{$smMessageList[i].to|truncate:30:"...":true|escape:"html"|default:$smLabel.no_recipient_text}{if $smMessageList[i].read eq "false"}</b>{/if}</a></acronym></td>
                      {else}
                      <td onclick="{$smMessageList[i].readlink}" id="address_{$contador}"
												onmouseover="address_{$contador}.className='messagelist_over';subject_{$contador}.className='messagelist_over';date_{$contador}.className='messagelist_over';size_{$contador}.className='messagelist_over';"
												onmouseout="address_{$contador}.className='messagelist';subject_{$contador}.className='messagelist';date_{$contador}.className='messagelist';size_{$contador}.className='messagelist';"
												class="messagelist"><acronym title="{$smMessageList[i].from|escape:"html"|default:$smLabel.no_subject_text}"><a href="{$smMessageList[i].readlink}">{if !$smMessageList[i].read}<b>{/if}{$smMessageList[i].from|truncate:30:"...":true|escape:"html"|default:$smLabel.no_sender_text}{if $smMessageList[i].read eq "false"}</b>{/if}</a></acronym></td>
                      {/if}
                      <td onclick="{$smMessageList[i].readlink}" id="subject_{$contador}"
												onmouseover="address_{$contador}.className='messagelist_over';subject_{$contador}.className='messagelist_over';date_{$contador}.className='messagelist_over';size_{$contador}.className='messagelist_over';"
												onmouseout="address_{$contador}.className='messagelist';subject_{$contador}.className='messagelist';date_{$contador}.className='messagelist';size_{$contador}.className='messagelist';"
												class="messagelist"><acronym title="{$smMessageList[i].subject|escape:"html"|default:$smLabel.no_subject_text}"><a href="{$smMessageList[i].readlink}">{if !$smMessageList[i].read}<b>{/if}{$smMessageList[i].subject|truncate:30:"...":true|escape:"html"|default:$smLabel.no_subject_text}{if $smMessageList[i].read eq "false"}</b>{/if}</a></acronym></td>
                      <td onclick="{$smMessageList[i].readlink}" id="date_{$contador}"
												onmouseover="address_{$contador}.className='messagelist_over';subject_{$contador}.className='messagelist_over';date_{$contador}.className='messagelist_over';size_{$contador}.className='messagelist_over';"
												onmouseout="address_{$contador}.className='messagelist';subject_{$contador}.className='messagelist';date_{$contador}.className='messagelist';size_{$contador}.className='messagelist';"
												class="messagelist">{if $smMessageList[i].read eq "false"}<b>{/if}{$smMessageList[i].date|date_format:$smLabel.date_format}{if !$smMessageList[i].read}</b>{/if}</td>
                      <td align="right" onclick="{$smMessageList[i].readlink}" id="size_{$contador}"
												onmouseover="address_{$contador}.className='messagelist_over';subject_{$contador}.className='messagelist_over';date_{$contador}.className='messagelist_over';size_{$contador}.className='messagelist_over';"
												onmouseout="address_{$contador}.className='messagelist';subject_{$contador}.className='messagelist';date_{$contador}.className='messagelist';size_{$contador}.className='messagelist';"
												class="messagelist">{if $smMessageList[i].read eq "false"}<b>{/if}{$i}{$smMessageList[i].size}&nbsp;{if !$smMessageList[i].read}</b>{/if}</td>
                    </tr>
                    {/section}
                    {if $smNumMessages eq 0}
                    <tr>
                      <td class="messagelist" colspan=7 align='center'><br>
                        <br>
                        <br>
                        <br>
                        {$smLabel.no_messages} {$smBoxName|escape:"html"}<br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br></td>
                    </tr>
                    {/if}
                  </table></td>
                <!-- SCROLLBAR -->
                <td><table border=0 width=17px height=100% cellpadding=0 cellspacing=0>
                    <tr>
                      <td class="outer" width=17px height=17px>{if $smPreviousLink}<a href="{$smPreviousLink}"><img border='0' src="inc/themes/outlook/images/scrollbar_up.gif"></a>{else}<img src="inc/themes/outlook/images/scrollbar_up_off.gif">{/if}</td>
                    </tr>
                    {if $smPreviousLink}
                    <tr>
                      <td class="scrollbar_path" onclick="javascript:location='{$smPreviousLink}'">&nbsp;</td>
                    </tr>
                    {/if}
                    {if $smPreviousLink || $smNextLink}
                    <tr>
                      <td width=17px height=75px class="outer"><img src="inc/themes/outlook/images/scrollbar_handler.gif"></td>
                    </tr>
                    {else}
                    <tr>
                      <td height=100% class="scrollbar_path">&nbsp;</td>
                    </tr>
                    {/if}
                    {if $smNextLink}
                    <tr>
                      <td class="scrollbar_path" onclick="javascript:location='{$smNextLink}'">&nbsp;</td>
                    </tr>
                    {/if}
                    <tr>
                      <td class="outer" width=17px height=17px >{if $smNextLink}<a href="{$smNextLink}"><img border='0' src="inc/themes/outlook/images/scrollbar_down.gif"></a>{else}<img src="inc/themes/outlook/images/scrollbar_down_off.gif">{/if}
                    </tr>
                  </table></td>
                <!-- SCROLLBARS --> 

              </tr>
            </table></td>
          <!-- FIN LISTA MENSAJES --> 
        </tr>
      </table></td>
  </tr>
</form>
<tr>
  <td class='info_bar'> {if $smNumMessages gt 0}
    {$smWelcomeMessage2}
    {else}
    {$smLabel.no_messages} {$smBoxName|escape:"html"}
    {/if}

    {if $smQuotaEnabled eq 1}
    ({$smLabel.quota_usage_used} {$smTotalUsed} {$smLabel.quota_usage_of} {$smQuotaLimit} {$smLabel.quota_usage_avail})
    {/if} 

    <!-- spam alert --> 
    {if $smHaveSpam eq "TRUE"} <span style="color:red"><i>{$smLabel.have_spam}</i></span> {/if} </td>
</tr>
</table>
</body>
</html>
