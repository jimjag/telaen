{config_load file=$umLanguageFile section="Login"}

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<title>UebiMiau Webmail - {#lgn_title#|escape:"html"}</title>
	<meta http-equiv="Content-Type" content="text/html; charset={$umLabel.default_char_set}">
	<link rel="stylesheet" href="inc/themes/webmail/css.css" type="text/css">
</head>
{$umJS}
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
<tr><td valign="middle" align="center">
<p>&nbsp;</p>
      <p>&nbsp;</p>
      <table width="750" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC" class="frame">

	<tr><td class=top><img src="inc/themes/webmail/images/logo.gif" border="0""></td></tr>
	<tr><td><img src="inc/themes/webmail/images/bandeau-h.gif" border="0"></td></tr>
	<tr>
		<td background="inc/themes/webmail/images/ligne-fond.gif">
			<table width="415" border="0" cellspacing="1" cellpadding="1" align="center">
			<form name="form1" action="process.php" method=post>
				<tr><td align="center" colspan="2"><br>.: <b>{$umLabel.lgn_welcome_msg}</b> :.<br></td></tr>
				<tr><td>&nbsp;</td></tr>
				{if $umServerType neq "ONE-FOR-EACH"}
				<tr><td align="left" width="40%"><b>{$umLabel.lng_user_email}</b> :</td>
				<td><input name="f_email" type="text" class="normal" value="{$umEmail}" style="width:140px;"></td></tr>
				{else}
				<tr><td align="left" width="40%"><b>{$umLabel.lng_user_name}</b> :</td>
				<td><input name="f_user" type="text" class="normal" value="{$umUser}" style="width:80px;">
                    {if $umAvailableServers neq 0} <b>{$umServer}</b>{/if}</td></tr>
				{/if}
				<tr><td align="left" width="40%"><b>{$umLabel.lng_user_pwd}</b> :</td>
				<td><input type="password" name="f_pass" class="normal"></td></tr>
				{if $umAllowSelectLanguage}
				<tr><td align="left" width="40%"><b>{$umLabel.lng_language}</b> :</td>
				<td>{$umLanguages}</td></tr>
				{/if}
				{if $umAllowSelectTheme}
				<tr><td align="left"><b>{$umLabel.lng_theme}</b> :</td>
				<td>{$umThemes}</td></tr>
				{/if}
				<tr><td>&nbsp;</td></tr>
				<tr><td class="left"></td>
				<td><input type="submit" name="submit" value="{$umLabel.lng_login_btn}" class="button"></td></tr>
				<tr><td>&nbsp;</td></tr>
			</form>
			</table>
		</td>
	</tr>
	<tr>
		<td class=bot>
			<img src="inc/themes/webmail/images/bandeau-b.gif" border="0" width="750" height="25">
		</td>
	<tr>
</table>
    </td>
  </tr>
</table>
</body>
</html>
