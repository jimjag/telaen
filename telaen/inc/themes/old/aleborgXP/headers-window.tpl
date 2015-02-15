
{config_load file=$umLanguageFile section="Headers"}

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title>UebiMiau - {$smCCList|escape:"html"}</title>
</head>
<link rel="stylesheet" href="inc/themes/aleborgXP/webmail.css" type="text/css">
<body bgcolor="#FFFFFF" text="#FFFFFF" link="#FFFFFF" vlink="#FFFFFF" alink="#FFFFFF">
<table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#000000">
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="2">
        <tr> 
          <td bgcolor=white><font face="Courier New" size=2>{$umHeaders}</font></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
