{config_load file=$umLanguageFile section="BadLogin"}

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title>UebiMiau - {$smLabel.bdl_title}</title>
<link rel="stylesheet" href="inc/themes/aleborgXP/webmail.css" type="text/css">
</head>
{$smJS}
<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td background="inc/themes/aleborgXP/images/menu_back.gif" bgcolor="#FFFFFF" align="center"> 
        <table border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="8"><img src="inc/themes/aleborgXP/images/login/left_up_corner.gif" width="8" height="29"></td>
            <td> <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr> 

                <td background="inc/themes/aleborgXP/images/login/up_back.gif" class="white"><font color=#FFFFFF size=3><b>{$smLabel.bdl_title}</b></font></td>
                  <td width="31"><img src="inc/themes/aleborgXP/images/login/right_up_corner.gif" width="31" height="29"></td>
                </tr>
              </table></td>
          </tr>
          <tr> 
            <td background="inc/themes/aleborgXP/images/login/left_side.gif"><img src="inc/themes/aleborgXP/images/login/left_side.gif" width="8" height="5"></td>
            <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr> 

                <td> <table width="400" border="0" cellspacing="0" cellpadding="2" align="center">
                    <tr> 
                      <td bgcolor=white> <table width="100%" border="0" cellspacing="1" cellpadding="1" align="center">
                          <tr> 
                            <td align=right class="cent"><br>
                              {$smLabel.bdl_msg}<br> <br>
                              <a href="./index.php?tid={$umTid}&lid={$umLid}"><strong>{$smLabel.bdl_back}</strong></a><br>
                              <br> </td>
                          </tr>
                        </table></td>
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
        </table>
	</td>
  </tr>
</table>
</body>
</html>
