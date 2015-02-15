{include file=$popupHeaderTemplate pageTitle=$smLabel.up_title}

<body>
<div id="popup">
  <form name="form1" enctype="multipart/form-data" action="upload.php" method="post">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
      <tr>
        <td><img src="inc/themes/hungi.mozilla/images/header-bg-left.gif" border="0"></td>
        <td height="22" width="100%" class="headers"><b>{$smLabel.up_information_text}</b></td>
        <td><img src="inc/themes/hungi.mozilla/images/header-bg-right.gif" border="0"></td>
      </tr>
      <tr>
        <td colspan="3" class="cent"><br />
          <input type="file" name="userfile" class="textbox" size="29" style="">
          <br />
          <br /></td>
      </tr>
      <tr>
        <td  colspan="3" class="usage" align="center"><center>
            <table class="buttonTable" cellspacing="0" cellpadding="0">
              <tr>
                <td valign="middle" class="buttonLeft">&nbsp;</td>
                <td valign="middle" class="buttonMiddle"><input type="button" value="{$smLabel.up_button_text}" class="button" onClick="javascript:document.form1.submit()" /></td>
                <td valign="middle" class="buttonRight">&nbsp;</td>
              </tr>
            </table>
          </center></td>
      </tr>
    </table>
  </form>
</div>
</body>
</html>
