<html><body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">{config_load file=$umLanguageFile section="Login"}
<!---
Theme created by Anders Aleborg
Visit www.cyber.nu
--->

<head>
<title>UebiMiau - {#lgn_title#|escape:"html"}</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="inc/themes/aleborgXP/webmail.css" type="text/css">
</head>
{$umJS}

<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td background="inc/themes/aleborgXP/images/menu_back.gif" bgcolor="#FFFFFF" align="center"> 
        <table border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="8"><img src="inc/themes/aleborgXP/images/login/left_up_corner.gif" width="8" height="29"></td>
            <td> <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr> 
                  <td background="inc/themes/aleborgXP/images/login/up_back.gif" class="white"><b>{$umLabel.lgn_welcome_msg}</b></td>

                <td width="31"><a href="javascript:;" onClick="self.close();"><img src="inc/themes/aleborgXP/images/login/right_up_corner.gif" width="31" height="29" border="0"></a></td>
                </tr>
              </table></td>
          </tr>
          <tr> 
            <td background="inc/themes/aleborgXP/images/login/left_side.gif"><img src="inc/themes/aleborgXP/images/login/left_side.gif" width="8" height="5"></td>
            <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr> 
                  <td> 
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td colspan="2" height="20"></td>
                    </tr>
                    <form name="form1" action="process.php" method=post>
                      {if $umServerType neq "ONE-FOR-EACH"} 
                      <tr> 
                        <td>{$umLabel.lng_user_email}:&nbsp;</td>
                        <td>
                          <input type="text" name="f_email" value="{$umEmail}">
                        </td>
                      </tr>
                      <tr> 
                        <td colspan="2" height="3"></td>
                      </tr>
                      {else} 
                      <tr> 
                        <td>{$umLabel.lng_user_name}:&nbsp;</td>
                        <td>
                          <input type="text" name="f_user" value="{$umUser}">
                          {if $umAvailableServers neq 0} <b>{$umServer}</b>{/if}</td>
                      </tr>
                      <tr> 
                        <td colspan="2" height="3"></td>
                      </tr>
                      {/if} 
                      <tr> 
                        <td>{$umLabel.lng_user_pwd}:</td>
                        <td>
                          <input type="password" name="f_pass">
                        </td>
                      </tr>
                      <tr> 
                        <td colspan="2" height="3"></td>
                      </tr>
                      {if $umAllowSelectLanguage} 
                      <tr> 
                        <td>{$umLabel.lng_language}:</td>
                        <td>{$umLanguages}</td>
                      </tr>
                      <tr> 
                        <td colspan="2" height="5"></td>
                      </tr>
                      {/if} {if $umAllowSelectTheme} 
                      <tr> 
                        <td>{$umLabel.lng_theme}:</td>
                        <td>{$umThemes}</td>
                      </tr>
                      <tr> 
                        <td colspan="2" height="15"></td>
                      </tr>
                      {/if} 
                      <tr> 
                        <td></td>
                        <td> <input type="submit" name="submit" value="{$umLabel.lng_login_btn}"> 
                        </td>
                      </tr>
                      <tr> 
                        <td colspan="2" height="5"></td>
                      </tr>
                      <tr> 
                        <td></td>
                        <td><a target="_blank" href="http://uebimiau.sourceforge.net">Powered 
                          by UebiMiau!</a></td>
                      </tr>
                    </form>
                  </table>
                    </td>
                  <td width="8" background="inc/themes/aleborgXP/images/login/right_side.gif"><img src="inc/themes/aleborgXP/images/login/right_side.gif" width="8" height="5"></td>
                </tr>
              </table></td>
          </tr>
          <tr> 
            <td><img src="inc/themes/aleborgXP/images/login/left_down_corner.gif" width="8" height="5"></td>
            <td align="right" background="inc/themes/aleborgXP/images/login/down_buttom.gif"><img src="inc/themes/aleborgXP/images/login/down_buttom.gif" width="8" height="5"><img src="inc/themes/aleborgXP/images/login/right_down_corner.gif" width="8" height="5"></td>
          </tr>
        </table>
	</td>
  </tr>
</table>
</body>
</html>
