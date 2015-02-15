<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<title>{if $webmailTitle}{$webmailTitle} - {/if}{$smLabel.adr_title}</title>
<meta http-equiv="Content-Type" content="text/html; charset={$smLabel.default_char_set}">
{$pageMetas}
	{$smJS}
</head>
<link rel="stylesheet" href="inc/themes/outlook/webmail.css" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset={$smLabel.default_char_set}">
<script language="JavaScript" src="inc/themes/outlook/webmail.js" type="text/javascript"></script>
{$smJS}

<body>
<form name="form1" method="post" action="addressbook.php">
<input type="hidden" name="id" value="{$smAddrID}">
<input type="hidden" name="opt" value="{$smOpt}">
<table width='100%' cellspacing=2 cellpadding=0 class='window_inner'>
  <tr>
    <td><table width='100%' cellpadding='0' cellspacing='0'>
        <tr>
          <td class="window_title"><img src='inc/themes/outlook/images/icon_ab.gif'></td>
          <td width='100%' class="window_title">&nbsp;{$smLabel.adr_title}</td>
          <td class='window_title_X'><a href='javascript:goinbox()'><img border='0' src='inc/themes/outlook/images/X.png'></a></td>
        </tr>
      </table>
      <table width='100%' cellpadding='0' cellspacing='0'>
        <tr>
          <td height=30 valign='bottom'><table width='100%' cellpadding='0' cellspacing='0'>
              <tr>
                <td id="tab_info" class="tab_info_visible"><table cellpadding='0' cellspacing='0'>
                    <tr>
                      <td><img src="inc/themes/outlook/images/tab_left.gif"></td>
                      <td background="inc/themes/outlook/images/tab_middle.gif" onclick="info.className='tab_visible';edit.className='tab_hidden';tab_info.className='tab_info_visible';tab_edit.className='tab_info_hidden'"><nobr><font class='xx-normal'>&nbsp;{$smLabel.adr_name_hea}&nbsp;</font></nobr></td>
                      <td><img src="inc/themes/outlook/images/tab_right.gif"></td>
                    </tr>
                  </table></td>
                <td id="tab_edit" class="tab_info_hidden"><table cellpadding='0' cellspacing='0'>
                    <tr>
                      <td><img src="inc/themes/outlook/images/tab_left.gif"></td>
                      <td background="inc/themes/outlook/images/tab_middle.gif" onclick="info.className='tab_hidden';edit.className='tab_visible';tab_info.className='tab_info_hidden';tab_edit.className='tab_info_visible'"><nobr><font class='xx-normal'>&nbsp;{$smLabel.adr_edit_hea}&nbsp;</font></nobr></td>
                      <td><img src="inc/themes/outlook/images/tab_right.gif"></td>
                    </tr>
                  </table></td>
                <td class="tab_blank" width='100%'>&nbsp;</td>
              </tr>
            </table></td>
        </tr>
      </table>
      <table width='100%' cellpadding='15' cellspacing='0' class="tab">
        <tr>
          <td width='100%' height='200'><div id="info" class="tab_visible">
              <fieldset>
                <table  border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td class="label" align='right'>{$smLabel.adr_name}:</td>
                    <td   class="label">&nbsp;{$smAddrName|escape:"html"}</td>
                  </tr>
                  <tr>
                    <td class="label" align='right'>{$smLabel.adr_email}:</td>
                    <td  class="label">&nbsp;{$smAddrEmail|escape:"html"}</td>
                  </tr>
                  <tr>
                    <td class="label" align='right'>{$smLabel.adr_street}:</td>
                    <td class="label">&nbsp;{$smAddrStreet|escape:"html"}</td>
                  </tr>
                  <tr>
                    <td class="label" align='right'>{$smLabel.adr_city}:</td>
                    <td   class="label">&nbsp;{$smAddrCity|escape:"html"}</td>
                  </tr>
                  <tr>
                    <td class="label" align='right'>{$smLabel.adr_state}:</td>
                    <td  class="label">&nbsp;{$smAddrState|escape:"html"}</td>
                  </tr>
                  <tr>
                    <td class="label" align='right'>{$smLabel.adr_work}:</td>
                    <td   class="label">&nbsp;{$smAddrWork|escape:"html"}</td>
                  </tr>
                  <tr>
                    <td class="label" align='right'>{$smLabel.adr_phone}:</td>
                    <td   class="label">&nbsp;{$smAddrPhone|escape:"html"}</td>
                  </tr>
                  <tr>
                    <td class="label" align='right'>{$smLabel.adr_cell}:</td>
                    <td   class="label">&nbsp;{$smAddrCell|escape:"html"}</td>
                  </tr>
                  <tr>
                    <td class="label" align='right'>{$smLabel.adr_note}:</td>
                    <td   class="label">&nbsp;{$smAddrNote|escape:"html"}</td>
                  </tr>
                </table>
              </fieldset>
            </div>
            <div id="edit" class="tab_hidden">
              <fieldset>
                <table border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td class="label" align='right'>{$smLabel.adr_name}:</td>
                    <td><input type=text name="name" value="{$smAddrName|escape:"html"}" class="textbox"></td>
                  </tr>
                  <tr>
                    <td class="label" align='right'>{$smLabel.adr_email}:</td>
                    <td><input type=text name="email" value="{$smAddrEmail|escape:"html"}" class="textbox"></td>
                  </tr>
                  <tr>
                    <td class="label" align='right'>{$smLabel.adr_street}:</td>
                    <td><input type=text name="street" value="{$smAddrStreet|escape:"html"}" class="textbox"></td>
                  </tr>
                  <tr>
                    <td class="label" align='right'>{$smLabel.adr_city}:</td>
                    <td><input type=text name="city" value="{$smAddrCity|escape:"html"}" class="textbox"></td>
                  </tr>
                  <tr>
                    <td class="label" align='right'>{$smLabel.adr_state}:</td>
                    <td><input type=text name="state" value="{$smAddrState|escape:"html"}" class="textbox" maxlength=2></td>
                  </tr>
                  <tr>
                    <td class="label" align='right'>{$smLabel.adr_work}:</td>
                    <td><input type=text name="work" value="{$smAddrWork|escape:"html"}" class="textbox"></td>
                  </tr>
                  <tr>
                    <td class="label" align='right'>{$smLabel.adr_phone}:</td>
                    <td><input type=text name="phone" value="{$smAddrPhone|escape:"html"}" class="textbox"></td>
                  </tr>
                  <tr>
                    <td class="label" align='right'>{$smLabel.adr_cell}:</td>
                    <td><input type=text name="cell" value="{$smAddrCell|escape:"html"}" class="textbox"></td>
                  </tr>
                  <tr>
                    <td class="label" align='right'>{$smLabel.adr_note}:</td>
                    <td><textarea type=text name="note" class="textbox">{$smAddrNote|escape:"html"}</textarea></td>
                  </tr>
                </table>
              </fieldset>
            </div></td>
        </tr>
        <tr>
          <td align='left'><input type=submit value="{$smLabel.adr_save}" class=button>
            <input type=button value="{$smLabel.adr_back}" class=button onClick="location = '{$smGoBack}'"></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
