{include file=$headerTemplate pageTitle=#prf_title# onLoad="dis()"}

{include file=$menuTemplate refresh="false"}
<table cellspacing="0" cellpadding="0" border="0" align="center" bgcolor="#DDE3EB" width="100%">
  <tr>
    <td valign="top"><form id="prefs_form" name="prefs_form" action="preferences.php" method="post">
        <input type="hidden" name="action" value="savePrefs" />
        <table cellspacing="0" cellpadding="2" width="100%" border="0">
          <tr>
            <td height="22" colspan="2" class="headers"><b>{$smLabel.prf_general_title}</b></td>
          </tr>
          <tr>
            <td colspan="2" class="separator"></td>
          </tr>
          <tr>
            <td class="default" width="400">&nbsp;{$smLabel.prf_name}</td>
            <td class="default"><input type="text" name="real_name" size="30" value="{$realName|escape:"html"}" class="textbox" /></td>
          </tr>
          <tr>
            <td colspan="2" class="separator"></td>
          </tr>
          <tr>
            <td class="default">&nbsp;{$smLabel.prf_reply_to}</td>
            <td class="default"><input type="text" name="reply_to" size="30" value="{$replyTo|escape:"html"}" class="textbox" /></td>
          </tr>
          <tr>
            <td colspan="2" class="separator"></td>
          </tr>
          <tr>
            <td class="default">&nbsp;{$smLabel.prf_time_zone}</td>
            <td class="default"><select name="timezone">

							{html_options options=$timezoneVals selected=$timezone}

              </select></td>
          </tr>
          <tr>
            <td colspan="2" class="separator"></td>
          </tr>
          <tr>
            <td class="default">&nbsp;{$smLabel.prf_default_editor_mode}</td>
            <td class="default"><select name="editor_mode">
                <option value="text"{if $editorMode eq "text"} selected="selected"{/if}>{$smLabel.prf_default_editor_mode_text}</option>
                <option value="html"{if $editorMode eq "html"} selected="selected"{/if}>{$smLabel.prf_default_editor_mode_html}</option>
              </select></td>
          </tr>
          <tr>
            <td height="22" colspan="2" class="headers"><b>{$smLabel.prf_trash_title}</b></td>
          </tr>
          <tr>
            <td class="separator" colspan="2"></td>
          </tr>
          <tr>
            <td class="default" colspan="2"><input type="checkbox" name="save_trash" onclick="dis()" value="1"{if $saveTrash eq true} checked="checked"{/if} />
              {$smLabel.prf_save_to_trash} "<b>{$smLabel.trash_extended}</b>" </td>
          </tr>
          <tr>
            <td class="separator" colspan="2"></td>
          </tr>
          <tr>
            <td class="default" colspan="2"><input type="checkbox" name="st_only_read" value="1"{if $saveTrashOnlyRead eq true} checked="checked"{/if} />
              {$smLabel.prf_save_only_read} "<b>{$smLabel.trash_extended}</b>" </td>
          </tr>
          <tr>
            <td class="separator" colspan="2"></td>
          </tr>
          <tr>
            <td class="default" colspan="2"><input type="checkbox" name="empty_trash_on_exit" value="1"{if $emptyTrashOnExit eq true} checked="checked"{/if} />
              {$smLabel.prf_empty_on_exit} </td>
          </tr>
          <tr>
            <td height="22" colspan="2" class="headers"><b>{$smLabel.spam_extended}</b></td>
          </tr>
          <tr>
            <td class="default">&nbsp;{$smLabel.prf_spam_level}</td>
            <td class="default"><select name="spamlevel">

                                                        {html_options values=$spamLevelVals output=$spamLevelVals selected="$spamLevel"}

              </select></td>
          </tr>
          <tr>
            <td class="separator" colspan="2"></td>
          </tr>
          <tr>
            <td class="default" colspan="2"><input type="checkbox" name="empty_spam_on_exit" value="1" {if $emptySpamOnExit eq true} checked="checked"{/if} />
              {$smLabel.prf_empty_spam_on_exit} </td>
          </tr>
          <tr>
            <td height="22" colspan="2" class="headers"><b>{$smLabel.prf_sent_title}</b></td>
          </tr>
          <tr>
            <td colspan="2" class="separator"></td>
          </tr>
          <tr>
            <td class="default" colspan="2"><input type="checkbox" name="save_sent" value="1" {if $saveSent eq true} checked="checked"{/if} />
              {$smLabel.prf_save_sent} "<b>{$smLabel.sent_extended}</b>"</td>
          </tr>
          <tr>
            <td  height="22" colspan="2" class="headers"><b>{$smLabel.prf_messages_title}</b></td>
          </tr>
          <tr>
            <td colspan="2" class="separator"></td>
          </tr>
          <tr>
            <td class="default">&nbsp;{$smLabel.prf_page_limit}</td>
            <td class="default"><select name="rpp">

                                                {html_options values=$msgPerPageVals output=$msgPerPageVals selected=$msgPerPage}

              </select></td>
          </tr>
          <tr>
            <td colspan="2" class="separator"></td>
          </tr>
          <tr>
            <td class="default">&nbsp;{$smLabel.prf_time_to_refesh}</td>
            <td class="default"><select name="refresh_time">

						{html_options values=$refreshTimeVals output=$refreshTimeVals selected=$refreshTime}

              </select></td>
          </tr>
          <tr>
            <td colspan="2" class="separator"></td>
          </tr>
          <tr>
            <td colspan="2" class="default"><input type="checkbox" name="display_images" value="1"{if $displayImages eq true} checked="checked"{/if} />
              {$smLabel.prf_display_images} </td>
          </tr>
          <tr>
            <td class="separator" colspan="2"></td>
          </tr>
          <tr>
            <td colspan="2" class="default"><input type="checkbox" name="require_receipt" value="1"{if $requireReceipt eq true} checked="checked"{/if} />
              {$smLabel.prf_auto_require_receipt} </td>
          </tr>
          <tr>
            <td class="separator" colspan="2"></td>
          </tr>
          <tr>
            <td class="default" colspan="2"><input type="checkbox" name="unmark_read_on_exit" value="1"{if $unmarkReadOnExit eq true} checked="checked"{/if} />
              {$smLabel.prf_unmark_read_on_exit} </td>
          </tr>
          <tr>
            <td  height="22" colspan="2" class="headers"><b>{$smLabel.prf_signature_title}</b></td>
          </tr>
          <tr>
            <td colspan="2" class="separator"></td>
          </tr>
          <tr>
            <td class="default" valign="top">&nbsp;{$smLabel.prf_signature}</td>
            <td class="default"><textarea cols="40" rows="3" name="sig" class="textarea">{$signature}</textarea></td>
          </tr>
          <tr>
            <td colspan="2" class="separator"></td>
          </tr>
          <tr>
            <td class="default" colspan="2"><input type="checkbox" name="add_sig" value="1"{if $addSignature eq true} checked="checked"{/if} />
              {$smLabel.prf_auto_add_sign} </td>
          </tr>
          <tr>
            <td height="40" align="center" style="background-image: url(themes/hungi.mozilla/images/menu-bg.gif)" colspan="2"><table class="buttonTable" cellspacing="0" >
                <tr>
                  <td valign="middle" class="buttonLeft">&nbsp;</td>
                  <td valign="middle" class="buttonMiddle"><input type="submit" name="submit" value="{$smLabel.prf_save_button}" class="button" /></td>
                  <td valign="middle" class="buttonRight">&nbsp;</td>
                </tr>
              </table></td>
          </tr>
        </table>
      </form>

      <!-- filters section -->

      <form action="preferences.php" method="post">
        <input type="hidden" name="action" value="addFilter" />
        <table cellspacing="0" cellpadding="2" width="100%" border="0" bgcolor="white">
          <tr>
            <td class="headers" colspan="2"><b>{$smLabel.filter_new}</b></td>
          </tr>
          <tr>
            <td class="default" width="400"> {$smLabel.filter_field}: </td>
            <td class="default"><select name="filter_field">
                <option value="1">{$smLabel.filter_field_from}</option>
                <option value="2">{$smLabel.filter_field_subject}</option>
                <option value="4">{$smLabel.filter_field_to}</option>
              </select></td>
          </tr>
          <tr>
            <td colspan="2" class="separator"></td>
          </tr>
          <tr>
            <td class="default"> {$smLabel.filter_match}: </td>
            <td class="default"><input type="text" class="textbox" name="filter_match" size="30" /></td>
          </tr>
          <tr>
            <td colspan="2" class="separator"></td>
          </tr>
          <tr>
            <td class="default"> {$smLabel.filter_type}: </td>
            <td class="default"><select name="filter_type" onchange="checkMove();">
                <option value="1">{$smLabel.filter_type_move}</option>
                <option value="2">{$smLabel.filter_type_delete}</option>
                <option value="4">{$smLabel.filter_type_mark}</option>
              </select></td>
          </tr>
          <tr>
            <td colspan="2" class="separator"></td>
          </tr>
          <tr>
            <td class="default"> {$smLabel.filter_folder}: </td>
            <td class="default"><select name="filter_folder">

						{section name=i loop=$smPersonalFolders}

                <option value="{$smPersonalFolders[i].name}">{$smPersonalFolders[i].name}</option>

						{/section}

              </select></td>
          </tr>
          <tr>
            <td class="usage" colspan="2"><center>
                <table class="buttonTable" cellspacing="0" align="center">
                  <tr>
                    <td valign="middle" class="buttonLeft">&nbsp;</td>
                    <td valign="middle" class="buttonMiddle"><input type="submit" class="button" value="{$smLabel.filter_add}" /></td>
                    <td valign="middle" class="buttonRight">&nbsp;</td>
                  </tr>
                </table>
              </center></td>
          </tr>
        </table>
      </form>
      <form id="filters_form" name="filters_form" action="preferences.php" method="post">
        <input type="hidden" name="action" value="delFilter" />
        <table cellspacing="0" cellpadding="2" width="100%" border="0" bgcolor="white">
          <tr>
            <td class="headers" colspan="6"><b>{$smLabel.filter_list}</b></td>
          </tr>
          <tr>
            <td class="headers" width="20"><input type="checkbox" name="toggle" id="toggle" onclick="selectAll('filters_form', {$filterList|@count})"></td>
            <td class="headersLeft">.:<b>{$smLabel.filter_field}</b>:.</td>
            <td class="headersLeft">.:<b>{$smLabel.filter_match}</b>:.</td>
            <td class="headersLeft">.:<b>{$smLabel.filter_type}</b>:.</td>
            <td class="headersLeft">.:<b>{$smLabel.filter_folder}</b>:.</td>
            <td class="headersLeft">&nbsp;</td>
          </tr>
          {section name=filter loop=$filterList}
          <tr>
            <td class="default" width="18" align="center"><input type="checkbox" id="cb{$smarty.section.filter.index}" name="filters_array[]" value="{$smarty.section.filter.index}" /></td>
            <td class="default"> {if $filterList[filter].field eq 1}{$smLabel.filter_field_from}
              {elseif $filterList[filter].field eq 2}{$smLabel.filter_field_subject}
              {elseif $filterList[filter].field eq 4}{$smLabel.filter_field_to}{/if} </td>
            <td class="default">{$filterList[filter].match}</td>
            <td class="default"> {if $filterList[filter].type eq 1}{$smLabel.filter_type_move}
              {elseif $filterList[filter].type eq 2}{$smLabel.filter_type_delete}
              {elseif $filterList[filter].type eq 4}{$smLabel.filter_type_mark}{/if} </td>
            <td class="default">{$filterList[filter].moveto}</td>
            <td class="default" align="center"><a href="#" class="menu" onclick="selectAndSubmit('filters_form',{$smarty.section.filter.index});return false;">[{$smLabel.filter_delete}]</a></td>
          </tr>
          <tr>
            <td colspan="6" class="separator"></td>
          </tr>
          {sectionelse}
          <tr>
            <td class="default" align="center" colspan="6">{$smLabel.filter_msg_nofilters}</td>
          </tr>
          {/section}
          <tr>
            <td colspan="6" class="default"><img src="inc/themes/default/images/arrowblue.gif" alt="" /> <a href="#" class="menu" onclick="submitForm('filters_form');return false;">{$smLabel.filter_delete_selected}</a></td>
          </tr>
        </table>
      </form></td>
  </tr>
</table>
{include file=$footerTemplate} 
