<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<title>{if $webmailTitle}{$webmailTitle} - {/if}{#lgn_title#|escape:"html"}</title>
<link rel="stylesheet" href="inc/themes/outlook/webmail.css" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset={$smLabel.default_char_set}">
</head>
{$smJS}

<body ONLOAD="javascript:document.getElementById('form1').{if $smServerType neq "ONE-FOR-EACH"}f_email{else}u_email{/if}.focus();">
<table width=100% height=100%>
  <tr><td align=center valign=center>
    <table class='window_outer' cellspacing="0" cellpadding="0">
      <tr>
        <td><table class='window_inner' width="100%" height="100%" cellspacing="0" cellpadding="2" align="center">
            <form name="form1" id="form1" action="process.php" method=post>
              <tr>
                <td class='window_title' colspan=2>&nbsp;{$smLabel.lgn_welcome_msg}</td>
              </tr>
              {if $error eq "true"}
              <tr>
                <td colspan=2 style="padding:0"><table cellpadding=0 cellspacing=0>
                    <tr>
                      <td height="10" style="background-color:#ffffe1;"><img src="inc/themes/outlook/images/icon_warning.gif"></td>
                      <td height="10" style="padding:2;background-color:#ffffe1;font-family: tahoma,verdana,sans;font-weight: normal ;font-size: 11px;color: #000000;"><nobr> {if $errorCode eq "0"}
                        {$smLabel.err_login_msg}: {$smLabel.error_login}
                        {elseif $errorCode eq "1"}
                        {$smLabel.err_system_msg}: {$smLabel.error_connect}
                        {elseif $errorCode eq "2"}		
                        {$smLabel.err_system_msg}: {$smLabel.error_retrieving}
                        {elseif $errorCode eq "4"}
                        {$smLabel.err_login_msg}: {$smLabel.error_session_expired}
                        {else}
                        {$smLabel.err_system_msg}: {$smLabel.error_other}
                        {/if} </nobr></td>
                    </tr>
                  </table></td>
              </tr>
              {/if}
              <tr>
                <td height="10" colspan="2"></td>
              </tr>
              {if $smServerType neq "ONE-FOR-EACH"}
              <tr>
                <td class='label'>{$smLabel.lng_user_email}: &nbsp;</td>
                <td><input type=text size=10 name="f_email" id="f_email" value="{$smEmail}" class="textbox" style="width:150px;"></td>
                {else}
              <tr>
                <td class='label'>{$smLabel.lng_user_name}: &nbsp;</td>
                <td><input type=text size=5 name="f_user" id="f_user" value="{$smUser}" class="textbox" style="width:100px;">
                  {if $smAvailableServers neq 0} <font class="xx-normal">{$smServer}&nbsp;&nbsp;</font>{/if}</td>
                {/if}
              <tr>
                <td class='label'>{$smLabel.lng_user_pwd}: &nbsp;</td>
                <td><input type=password size=5 name="f_pass" value="" class="textbox" style="width:150px;"></td>
                {if $smAllowSelectLanguage}
              <tr>
                <td class='label'>{$smLabel.lng_language}: &nbsp;</td>
                <td class='default'>{$smLanguages}</td>
                {/if}

                {if $smAllowSelectTheme}
              <tr>
                <td class='label'>{$smLabel.lng_theme}: &nbsp;</td>
                <td>{$smThemes}</td>
                {/if}
              <tr>
                <td colspan="2"><hr width='100%'></td>
              </tr>
              <tr>
                <td colspan="2" align="center"><input type="submit" name="submit" value="{$smLabel.lng_login_btn}" class="button"></td>
              <tr>
                <td colspan="2" width="300px" height="15px"></td>
              </tr>
            </form>
          </table></td>
      </tr>
        </td>

    </table>
      </td>
  </tr>
</table>
</body>
</html>
