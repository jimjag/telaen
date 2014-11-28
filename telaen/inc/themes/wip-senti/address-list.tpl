{config_load file=$umLanguageFile section="AddressBook"}
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
    <title>sentiMail - {$umLabel.adr_title}</title>

<meta http-equiv="Content-Type" content="text/html; charset={$umLabel.default_char_set}">
<link rel="stylesheet" href="themes/senti/webmail.css" type="text/css">
{$umJS}
</head>

<body><br><br>
<table width="760" height="400" border="0" cellpadding="0" cellspacing="0" align="center">
	<tr valign="bottom">
		<td height="61">
			<img src="themes/senti/images/mail_01.gif" width="18" height="61" alt=""></td>
		<td>
			<a class="menu" href="javascript:goinbox()"><img src="themes/senti/images/inbox.gif" width="60" height="61" border="0" alt=""></a></td>
		<td>
			<img src="themes/senti/images/mail_03.gif" width="33" height="61" alt=""></td>
		<td>
			<a class="menu" href="javascript:newmsg()"><img src="themes/senti/images/write.gif" width="85" height="61" border="0" alt=""></a></td>
		<td>
			<img src="themes/senti/images/mail_05.gif" width="32" height="61" alt=""></td>
		<td>
			<a class="menu" href="javascript:folderlist()"><img src="themes/senti/images/folders.gif" width="72" height="61" border="0" alt=""></a></td>
		<td>
			<img src="themes/senti/images/mail_07.gif" width="36" height="61" alt=""></td>
		<td>
			<a class="menu" href="javascript:search()"><img src="themes/senti/images/search.gif" width="74" height="61" alt="" border="0"></a></td>
		<td>
			<img src="themes/senti/images/mail_09.gif" width="27" height="61" alt=""></td>
		<td>
			<a class="menu" href="javascript:addresses()"><img src="themes/senti/images/addresses_selected.gif" width="89" height="61" border="0" alt=""></a></td>
		<td>
			<img src="themes/senti/images/mail_11.gif" width="28" height="61" alt=""></td>
		<td>
			<a class="menu" href="javascript:prefs()"><img src="themes/senti/images/preferences.gif" width="88" height="61" border="0" alt=""></a></td>
		<td>
			<img src="themes/senti/images/mail_13.gif" width="31" height="61" alt=""></td>
		<td>
			<a class="menu" href="javascript:goend()"><img src="themes/senti/images/logout.gif" width="70" height="61" border="0" alt=""></a></td>
		<td>
			<img src="themes/senti/images/mail_15.gif" width="17" height="61" alt=""></td>
	</tr>
	<tr><td width="18"><img src="themes/senti/images/leftside.gif" width="18" height="100%"></td>
		<td colspan="13" valign="top" bgcolor="#dddcdc"><br />
												<table height="100%" width="100%" border="0" cellspacing="1" cellpadding="0">

                                <tr height="18">
                                        <td width="40%" class="headers" height="18">{$umLabel.adr_name_hea}</td>
                                        <td width="40%" class="headers" height="18">{$umLabel.adr_email_hea}</td>
                                        <td width="10%" class="headers" height="18">{$umLabel.adr_edit_hea}</td>
                                        <td width="10%" class="headers" height="18">{$umLabel.adr_dele_hea}</td>
                                </tr>
<tr height="18">{section name=i loop=$umAddressList}                            
                                        <td class="default" align="center" height="18"> &nbsp;<a class="menu" href="{$umAddressList[i].viewlink}">{$umAddressList[i].name}</a></td>
                                        <td class="default" align="center" height="18"> &nbsp;<a class="menu" href="{$umAddressList[i].composelink}">{$umAddressList[i].email}</a></td>
                                        <td class="default" align="center" height="18"> &nbsp;<a class="menu" href="{$umAddressList[i].editlink}">OK</a></td>
<!---
                                        <td class="default"> &nbsp;<a class="menu" href="{$umAddressList[i].exportlink}">OK</a></td>
--->
                                        <td class="default"> &nbsp;<a class="menu" href="{$umAddressList[i].dellink}">OK</a></td>
                                </tr>
                                {/section}
                                <tr><td class="default" colspan=4 align=center><form><input type=button value="{$umLabel.adr_new_entry}" class=button onClick="location = '{$umNew}'"></form></td></tr>
                        </table>

		</td><td width="17"><img src="themes/senti/images/rightside.gif" width="17" height="100%"></td>
	</tr>
	<tr>
<td colspan="15" valign="top" height="25">
			<img src="themes/senti/images/footer.gif" width="760" height="25" alt=""></td>
	</tr>
</table>
</body>
</html>
