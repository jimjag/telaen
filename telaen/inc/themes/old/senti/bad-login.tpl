
{config_load file=$umLanguageFile section="BadLogin"}

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title>sentiMail - {$smLabel.bdl_title}</title>
	<link rel="stylesheet" href="inc/themes/senti/webmail.css" type="text/css">
	<meta http-equiv="Content-Type" content="text/html; charset={$smLabel.default_char_set}">
</head>
	<body><!-- Form name used to be "form1" this has been changed for w3c compliancy--><br><br><br><br><br><br>
	<form action="process.php" method="post">		
				<table border="0" align="center" cellpadding="0" cellspacing="0">
                                               <tr>
                                                        <td colspan="3" align="center"><img src="inc/themes/senti/images/globe.jpg" alt=""></td>
                                                </tr>
						<tr>
							<td align="left"><img src="inc/themes/senti/images/rounded-top-left.gif" alt=""></td>
							<td align="center" width="450"><image src="inc/themes/senti/images/top-middle.gif" width="100%" height="30"></td>
							<td align="right"><img src="inc/themes/senti/images/rounded-senti-top.gif" alt=""></td>
						</tr>
						<tr>		
							<td colspan="3" class="mainLoginTable">
									<table width="100%" border="0" cellspacing="1" cellpadding="1" align="left">
										<tr><td align="left" class="title">.: <b>{$smLabel.bdl_title}</b> :.</td>
										<tr><td align="left" class="default"><br>
										{$smLabel.bdl_msg}<br><br>
										<i>{$smServerResponse}</i></td>
										<tr><td align="right"><br><br>										
											<a href="./index.php?tid={$umTid}&lid={$umLid}" class="menu">{$smLabel.bdl_back}</a><br><br>
										</td>
									</table>
							</td>
						</tr>
						<tr>
							<td width="60" class="bottomEdge" align="left"><img src="inc/themes/senti/images/rounded-bottom-left.gif" alt=""></td>
							<td class="bottomEdge"><img src="inc/themes/senti/images/theme-images/bottom-middle.gif" alt="" height="49" width="100%" border="0"></td>
							<td width="60" class="bottomEdge" align="right"><img src="inc/themes/senti/images/rounded-bottom-right.gif" alt=""></td>
						</tr>
						<tr>
							<td colspan="3" class="footer" align="center"></td>
						</tr>
				</table>	
			</form>	
	</body>

</html>
