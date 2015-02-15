<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<title>{if $webmailTitle}{$webmailTitle} - {/if}{$smLabel.prf_title}</title>
<link rel="stylesheet" href="inc/themes/outlook/webmail.css" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset={$smLabel.default_char_set}">
{$pageMetas}
<script src="inc/themes/outlook/webmail.js" type="text/javascript"></script>
{$smJS}
</head>
<body>
<table width='100%' cellspacing="2" cellpadding="0" class="window_inner">
  <tr>
    <td><table width='100%' cellpadding='0' cellspacing='0'>
        <tr>
          <td class="window_title"><img src='inc/themes/outlook/images/icon_outlook.gif'></td>
          <td width='100%' class="window_title">&nbsp;{$smLabel.prf_title}</td>
          <td class='window_title_X'><a href='javascript:goinbox()'><img border='0' src='inc/themes/outlook/images/X.png'></a></td>
        </tr>
      </table>
      <table width='100%' cellpadding='0' cellspacing='0'>
        <tr>
          <td height="30" valign="bottom"><table width='100%' cellpadding='0' cellspacing='0'>
              <tr>
                <td id="tab_info" class="tab_info_visible"><table cellpadding="0" cellspacing="0">
                    <tr>
                      <td><img src="inc/themes/outlook/images/tab_left.gif"></td>
                      <td background="inc/themes/outlook/images/tab_middle.gif" onclick="switchPrefsTab('info')"><nobr><font class="xx-normal">&nbsp;{$smLabel.prf_general_title}&nbsp;</font></nobr></td>
                      <td><img src="inc/themes/outlook/images/tab_right.gif"></td>
                    </tr>
                  </table></td>
                <td id="tab_trash" class="tab_info_hidden"><table cellpadding="0" cellspacing="0">
                    <tr>
                      <td><img src="inc/themes/outlook/images/tab_left.gif"></td>
                      <td background="inc/themes/outlook/images/tab_middle.gif" onclick="switchPrefsTab('trash')"><nobr><font class="xx-normal">&nbsp;{$smLabel.prf_messages_title}&nbsp;</font></nobr></td>
                      <td><img src="inc/themes/outlook/images/tab_right.gif"></td>
                    </tr>
                  </table></td>
                <td id="tab_messages" class="tab_info_hidden"><table cellpadding="0" cellspacing="0">
                    <tr>
                      <td><img src="inc/themes/outlook/images/tab_left.gif"></td>
                      <td background="inc/themes/outlook/images/tab_middle.gif" onclick="switchPrefsTab('messages')"><nobr><font class="xx-normal">&nbsp;{$smLabel.prf_trash_title}&nbsp;</font></nobr></td>
                      <td><img src="inc/themes/outlook/images/tab_right.gif"></td>
                    </tr>
                  </table></td>
                <td id="tab_filters" class="tab_info_hidden"><table cellpadding="0" cellspacing="0">
                    <tr>
                      <td><img src="inc/themes/outlook/images/tab_left.gif"></td>
                      <td background="inc/themes/outlook/images/tab_middle.gif" onclick="switchPrefsTab('filters')"><nobr><font class="xx-normal">&nbsp;{$smLabel.filter_title}&nbsp;</font></nobr></td>
                      <td><img src="inc/themes/outlook/images/tab_right.gif"></td>
                    </tr>
                  </table></td>
                <td class="tab_blank" width='100%'>&nbsp;</td>
              </tr>
            </table></td>
        </tr>
      </table>
      <table width='100%' cellpadding='15' cellspacing='0' class="tab" height="430">
        <tr>
          <td width='100%' valign='top'><form name="prefs_form" id="prefs_form" action="preferences.php" method="post">
              <input type="hidden" name="action" value="savePrefs">

              <!-- first tab - general -->
              <div id="info" class="tab_visible">
                <fieldset>
                  <legend><font class='xx-normal'>{$smLabel.prf_general_title}</font></legend>
                  <table width='100%' cellpadding='2' cellspacing='0'>
                    <tr>
                      <td class="label" size="120">{$smLabel.prf_name}</td>
                      <td><input type="text" name="real_name" size="30" value="{$realName|escape:"html"}" class="textbox"></td>
                    </tr>
                    <tr>
                      <td class="label" size="120">{$smLabel.prf_reply_to}</td>
                      <td><input type="text" name="reply_to" size="30" value="{$replyTo|escape:"html"}" class="textbox"></td>
                    </tr>
                    <tr>
                      <td class='label' size="120">{$smLabel.prf_time_zone}</td>
                      <td><select name="timezone">

								{html_options options=$timezoneVals selected=$timezone}

                        </select></td>
                    </tr>
                    <tr>
                      <td class='label' size="120">{$smLabel.prf_default_editor_mode}</td>
                      <td><select name="editor_mode">
                          <option value="text"{if $editorMode eq "text"} selected{/if}>{$smLabel.prf_default_editor_mode_text}
                          <option value="html"{if $editorMode eq "html"} selected{/if}>{$smLabel.prf_default_editor_mode_html}
                        </select></td>
                    </tr>
                  </table>
                </fieldset>
                <table>
                  <tr>
                    <td><input type="submit" value="&nbsp;&nbsp;&nbsp;{$smLabel.prf_save_button}&nbsp;&nbsp;&nbsp;" class="button"></td>
                  </tr>
                </table>
              </div>

              <!-- second tab - messages -->
              <div id="trash" class="tab_hidden">
                <fieldset>
                  <legend><font class='xx-normal'>{$smLabel.prf_messages_title}</font></legend>
                  <table width='100%' cellpadding='2' cellspacing='0'>
                    <tr>
                      <td class="label" size="120">{$smLabel.prf_page_limit}</td>
                      <td><select name="rpp">

								{html_options values=$msgPerPageVals output=$msgPerPageVals selected=$msgPerPage}

                        </select></td>
                    </tr>
                    <tr>
                      <td class="label" size="120">{$smLabel.prf_time_to_refesh}</td>
                      <td><select name="refresh_time">

								{html_options values=$refreshTimeVals output=$refreshTimeVals selected=$refreshTime}

                        </select></td>
                    </tr>
                    <tr>
                      <td colspan="2"><input type="checkbox" name="display_images" value="1"{if $displayImages eq true} checked="checked"{/if}>
                        <font class="xx-normal">{$smLabel.prf_display_images}</font><br>
                        <input type="checkbox" name="require_receipt" value="1"{if $requireReceipt eq true} checked="checked"{/if}>
                        <font class="xx-normal">{$smLabel.prf_auto_require_receipt}</font><br>
                        <input type="checkbox" name="unmark_read_on_exit" value="1" {if $unmarkReadOnExit eq true} checked="checked"{/if}>
                        <font class="xx-normal">{$smLabel.prf_unmark_read_on_exit}</font></td>
                    </tr>
                  </table>
                </fieldset>
                <font class="xx-normal"><br>
                </font>
                <fieldset>
                  <legend><font class='xx-normal'>{$smLabel.prf_sent_title}</font></legend>
                  <table width='100%' cellpadding='2' cellspacing='0'>
                    <tr>
                      <td><input type="checkbox" name="save_sent" value="1"{if $saveSent eq true} checked="checked"{/if}>
                        <font class="xx-normal">{$smLabel.prf_save_sent} "<b>{$smLabel.sent_extended}</b>"</font></td>
                    </tr>
                  </table>
                </fieldset>
                <font class="xx-normal"><br>
                </font>
                <fieldset>
                  <legend><font class='xx-normal'>{$smLabel.prf_signature_title}</font></legend>
                  <table width='100%' cellpadding='2' cellspacing='0'>
                    <tr>
                      <td class='label' size="120">{$smLabel.prf_signature}</td>
                      <td><textarea cols="40" rows="3" name="sig" class="textarea">{$signature}</textarea></td>
                    </tr>
                    <tr>
                      <td colspan="2"><input type="checkbox" name="add_sig" value="1"{if $addSignature eq true} checked="checked"{/if}>
                        <font class="xx-normal">{$smLabel.prf_auto_add_sign}</font></td>
                    </tr>
                  </table>
                </fieldset>
                <table>
                  <tr>
                    <td><input type="submit" value="&nbsp;&nbsp;&nbsp;{$smLabel.prf_save_button}&nbsp;&nbsp;&nbsp;" class="button"></td>
                  </tr>
                </table>
              </div>

              <!-- third tab - trash -->
              <div id="messages" class="tab_hidden">
              <fieldset>
                <legend><font class="xx-normal">{$smLabel.prf_trash_title}</font></legend>
                <table width="100%" cellpadding="2" cellspacing="0">
                  <tr>
                    <td><input type="checkbox" name="save_trash" onClick="dis()" value="1"{if $saveTrash eq true} checked="checked"{/if}>
                      <font class="xx-normal">{$smLabel.prf_save_to_trash} "<b>{$smLabel.trash_extended}</b>"</font></td>
                  </tr>
                  <tr>
                    <td><input type="checkbox" name="st_only_read" value="1"{if $saveTrashOnlyRead eq true} checked="checked"{/if}>
                      <font class="xx-normal">{$smLabel.prf_save_only_read} "<b>{$smLabel.trash_extended}</b>"</font></td>
                  </tr>
                  <tr>
                    <td><input type="checkbox" name="empty_trash_on_exit" value="1"{if $emptyTrashOnExit eq true} checked="checked"{/if}>
                      <font class='xx-normal'>{$smLabel.prf_empty_on_exit}</font></td>
                  </tr>
                </table>
              </fieldset>
              <font class="xx-normal"><br>
              </font>
              <fieldset>
                <legend><font class='xx-normal'>{$smLabel.spam_extended}</font></legend>
                <table width='100%' cellpadding='2' cellspacing='0'>
                  <tr>
                    <td class='label' size="120">{$smLabel.prf_spam_level}</td>
                    <td><select name="spamlevel">

							{html_options values=$spamLevelVals output=$spamLevelVals selected=$spamLevel}

                      </select></td>
                  </tr>
                  <tr>
                    <td colspan="2"><input type="checkbox" name="empty_spam_on_exit" value="1"{if $emptySpamOnExit eq true} checked="checked"{/if}>
                      <font class='xx-normal'>{$smLabel.prf_empty_spam_on_exit}</font></td>
                  </tr>
                </table>
              </fieldset>
              <table>
              <tr>
                <td><input type="submit" value="&nbsp;&nbsp;&nbsp;{$smLabel.prf_save_button}&nbsp;&nbsp;&nbsp;" class="button"></td>
              </tr>
            </form>
      </table>
      </div>

      <!-- fourth tab - filters -->

      <div id="filters" class="tab_hidden">
        <form action="preferences.php" method="post">
          <fieldset>
          <legend><font class="xx-normal">{$smLabel.filter_new}</font></legend>
          <input type="hidden" name="action" value="addFilter">
          <table width="100%" cellpadding="2" cellspacing="0">
            <tr>
              <td class="label" size="120">{$smLabel.filter_field}:</td>
              <td><select name="filter_field">
                  <option value="1">{$smLabel.filter_field_from}</option>
                  <option value="2">{$smLabel.filter_field_subject}</option>
                  <option value="4">{$smLabel.filter_field_to}</option>
                </select></td>
            </tr>
            <tr>
              <td class="label">{$smLabel.filter_match}:</td>
              <td><input type="text" class="textbox" name="filter_match" size="30"></td>
            </tr>
            <tr>
              <td class="label"> {$smLabel.filter_type}: </td>
              <td><select name="filter_type" onchange="checkMove();">
                  <option value="1">{$smLabel.filter_type_move}</option>
                  <option value="2">{$smLabel.filter_type_delete}</option>
                  <option value="4">{$smLabel.filter_type_mark}</option>
                </select></td>
            </tr>
            <tr>
              <td class="label"> {$smLabel.filter_folder}: </td>
              <td><select name="filter_folder">

									{section name=i loop=$smPersonalFolders}

                  <option value="{$smPersonalFolders[i].name}">{$smPersonalFolders[i].name}</option>

									{/section}

                </select></td>
            </tr>
            <tr>
              <td class="default" align="center" colspan="2"><input type="submit" class="button" value="{$smLabel.filter_add}"></td>
            </tr>
          </table>
        </form>
        </fieldset>
        <br>
        <fieldset>
          <legend><font class="xx-normal">{$smLabel.filter_list}</font></legend>
          <form id="filters_form" name="filters_form" action="preferences.php" method="post">
            <input type="hidden" name="action" value="delFilter">
            <table cellspacing=2 cellpadding=0 width=100%>
              <tr>
                <td class='messages' valign=top ><table cellspacing="0" cellpadding="0" width="100%" border="0" bgcolor="white">
                    <tr>
                      <td class="headers" width="20"><input type="checkbox" name=toggle" id="toggle" onclick="selectAll('filters_form', {$filterList|@count})"></td>
                      <td class="headers">{$smLabel.filter_field}</td>
                      <td class="headers">{$smLabel.filter_match}</td>
                      <td class="headers">{$smLabel.filter_type}</td>
                      <td class="headers">{$smLabel.filter_folder}</td>
                      <td class="headers">&nbsp;</td>
                    </tr>
                    {section name=filter loop=$filterList}
                    <tr>
                      <td width="18" align="center"><input type="checkbox" id="cb{$smarty.section.filter.index}" name="filters_array[]" value="{$smarty.section.filter.index}"></td>
                      <td class="label"> {if $filterList[filter].field eq 1}{$smLabel.filter_field_from}
                        {elseif $filterList[filter].field eq 2}{$smLabel.filter_field_subject}
                        {elseif $filterList[filter].field eq 4}{$smLabel.filter_field_to}{/if} </td>
                      <td class="label">{$filterList[filter].match}</td>
                      <td class="label"> {if $filterList[filter].type eq 1}{$smLabel.filter_type_move}
                        {elseif $filterList[filter].type eq 2}{$smLabel.filter_type_delete}
                        {elseif $filterList[filter].type eq 4}{$smLabel.filter_type_mark}{/if} </td>
                      <td class="label">{$filterList[filter].moveto}</td>
                      <td align="center"><a href="#" onclick="selectAndSubmit('filters_form',{$smarty.section.filter.index});return false;"><acronym title="{$smLabel.filter_delete}"><img src='inc/themes/outlook/images/icon_delete_mini.gif' border=0></acronym></a></td>
                    </tr>
                    {sectionelse}
                    <tr>
                      <td class="label" align="center" colspan="6"><br>
                        {$smLabel.filter_msg_nofilters}<br>
                        <br></td>
                    </tr>
                    {/section}
                  </table></td>
              </tr>
              {if $filterList}
              <tr>
                <td class="default" align="center" colspan="2"><input type="button" class="button" value="{$smLabel.filter_delete_selected}" onclick="submitForm('filters_form');return false;"></td>
              </tr>
              {/if}
            </table>
          </form>
        </fieldset>
      </div></td>
  </tr>
</table>
</td>
</tr>
</table>
</body>
</html>
