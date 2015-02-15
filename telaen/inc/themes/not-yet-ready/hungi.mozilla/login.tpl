{include file=$headerTemplate showLogo="false" pageTitle=#lgn_title#|escape:"html"} <br />
<br />
<br />
<table width="450" border="0" cellspacing="0" cellpadding="2" align="center">
  <tr>
    <td><center>
        <img src="inc/themes/hungi.mozilla/images/login-logo.gif" alt="" />
      </center>
      <form name="form1" action="process.php" method="post">
        <table class="login_bg" width="100%" cellspacing="0" cellpadding="1" align="center">
          <tr>
            <td height="22" align="right" class="headers" colspan="2">.: <b>{$smLabel.lgn_welcome_msg}</b> :.</td>
          </tr>
          {if $error eq "true"}
          <tr>
            <td align="center" colspan="2"><div id="errorBox"> {if $errorCode eq "0"} <b>{$smLabel.err_login_msg}:</b> {$smLabel.error_login}
                {elseif $errorCode eq "1"} <b>{$smLabel.err_system_msg}:</b> {$smLabel.error_connect}
                {elseif $errorCode eq "2"} <b>{$smLabel.err_system_msg}:</b> {$smLabel.error_retrieving}
                {elseif $errorCode eq "4"} <b>{$smLabel.err_login_msg}:</b> {$smLabel.error_session_expired}
                {else} <b>{$smLabel.err_system_msg}:</b> {$smLabel.error_other}
                {/if} </div></td>
          </tr>
          {/if}

          {if $smServerType neq "ONE-FOR-EACH"}
          <tr>
            <td align="right" class="right2" width="40%"><b>{$smLabel.lng_user_email}</b>: &nbsp;</td>
            <td class="default2"><input id="user" type="text" size="10" name="f_email" value="{$smEmail}" class="textbox" style="width:140px;" tabindex="1" /></td>
          </tr>
          {else}
          <tr>
            <td align="right" class="right2" width="40%"><b>{$smLabel.lng_user_name}</b>: &nbsp;</td>
            <td class="default2"><input id="user" type="text" size="5" name="f_user" value="{$smUser}" class="textbox" style="width:80px;" tabindex="1" />
              {if $smAvailableServers neq 0} <b>{$smServer}</b>{/if}</td>
          </tr>
          {/if}
          <tr>
            <td align="right" class="right2"><b>{$smLabel.lng_user_pwd}</b>: &nbsp;</td>
            <td class="default2"><input type="password" size="5" name="f_pass" value="" class="textbox" style="width:80px;" tabindex="2" /></td>
          </tr>
          {if $smAllowSelectLanguage}
          <tr>
            <td align="right" class="right2"><b>{$smLabel.lng_language}</b>: &nbsp;</td>
            <td class="default2">{$smLanguages}</td>
          </tr>
          {/if}

          {if $smAllowSelectTheme}
          <tr>
            <td align="right" class="right2"><b>{$smLabel.lng_theme}</b>: &nbsp;</td>
            <td class="default2">{$smThemes}</td>
          </tr>
          {/if}
          <tr>
            <td class="default2" colspan="2"><center>
                <table class="buttonTable" cellspacing="0" >
                  <tr>
                    <td valign="middle" class="buttonLeft">&nbsp;</td>
                    <td valign="middle" class="buttonMiddle"><input type="submit" name="submit" value="{$smLabel.lng_login_btn}" class="button" /></td>
                    <td valign="middle" class="buttonRight">&nbsp;</td>
                  </tr>
                </table>
              </center></td>
          </tr>
          <tr>
            <td height="3" colspan="2"></td>
          </tr>
          <tr>
            <td height="22" class="headers" colspan="2"><a target="_blank" href="http://www.telaen.com" >Powered by Telaen Webmail!</a></td>
          </tr>
        </table>
      </form></td>
  </tr>
</table>
<script language="javascript" type="text/javascript">
//<![CDATA[
        // simple tip for focus the user field on page load
        document.getElementById("user").focus();
//]]>
</script> 
{include file=$footerTemplate} 
