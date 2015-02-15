<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<title>{if $webmailTitle}{$webmailTitle} - {/if}{$smLabel.adr_title}</title>
<meta http-equiv="Content-Type" content="text/html; charset={$smLabel.default_char_set}">
{$pageMetas}
	{$smJS}
<link rel="stylesheet" href="inc/themes/outlook/webmail.css" type="text/css">
<script src="inc/themes/outlook/webmail.js" type="text/javascript"></script>
</head>
<body >
<table width='100%' cellspacing=2 cellpadding=0 class='window_inner'>
  <tr>
    <td><table width='100%' cellpadding='0' cellspacing='0'>
        <tr>
          <td class="window_title"><img src='inc/themes/outlook/images/icon_ab.gif'></td>
          <td width='100%' class="window_title">&nbsp;{$smLabel.adr_title}</td>
          <td class='window_title_X'><a href='javascript:goinbox()'><img border='0' src='inc/themes/outlook/images/X.png'></a></td>
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
                      <td class="toolbar_button_off" onmouseover="this.className='toolbar_button_on'" onmouseout="this.className='toolbar_button_off'" onmousedown="this.className='toolbar_button_down'" onmouseup="this.className='toolbar_button_on'" onclick="location = '{$smNew}'"><acronym title="{$smLabel.adr_new_entry}"><img src="inc/themes/outlook/images/icon_new_contact.gif"><font class='xx-normal'><br>
                        {#adr_new_entry#|truncate:13:"...":true}</font></acronym></td>
                    </tr>
                  </table></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td class='messages' height=200 valign=top ><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="40%" class="headers">{$smLabel.adr_name_hea}</td>
          <td width="40%" class="headers">{$smLabel.adr_email_hea}</td>
          <td width="10%" class="headers">{$smLabel.adr_dele_hea}</td>
        </tr>
        {counter start=0 skip=1 print=false}
        <iframe id="process" name="process" style="display:none;"></iframe>
        {section name=i loop=$smAddressList}
        {counter print=false assign=contador}
        <tr>
          <td id="name_{$contador}" onmouseover="name_{$contador}.className='messagelist_over';mail_{$contador}.className='messagelist_over';ok_{$contador}.className='messagelist_over';" onmouseout="name_{$contador}.className='messagelist';mail_{$contador}.className='messagelist';ok_{$contador}.className='messagelist';" class="messagelist" onclick="location = '{$smAddressList[i].editlink}'"><img src="inc/themes/outlook/images/icon_addtoaddressbook.gif" border=0>&nbsp;{$smAddressList[i].name}</td>
          <td id="mail_{$contador}" onmouseover="name_{$contador}.className='messagelist_over';mail_{$contador}.className='messagelist_over';ok_{$contador}.className='messagelist_over';" onmouseout="name_{$contador}.className='messagelist';mail_{$contador}.className='messagelist';ok_{$contador}.className='messagelist';" class="messagelist" onclick="location = '{$smAddressList[i].editlink}'">{$smAddressList[i].email}</td>
          <td id="ok_{$contador}" onmouseover="name_{$contador}.className='messagelist_over';mail_{$contador}.className='messagelist_over';ok_{$contador}.className='messagelist_over';" onmouseout="name_{$contador}.className='messagelist';mail_{$contador}.className='messagelist';ok_{$contador}.className='messagelist';" class="messagelist"><a target="process" class="menu" href="{$smAddressList[i].dellink}"><img src='inc/themes/outlook/images/icon_delete_mini.gif' border=0></a></td>
        </tr>
        {/section}
      </table></td>
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
  </tr>
    </form>

  <tr>
    <td class='info_bar'> {if $contador}{$contador}{else}0{/if}&nbsp;{$smLabel.quota_usage_avail} </td>
  </tr>
</table>
</body>
</html>
