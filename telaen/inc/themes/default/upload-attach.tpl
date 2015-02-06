{include file=$popupHeaderTemplate pageTitle=#up_title# showLogo="false"}

<body>
<div id="popup"> <br>
  <table width="300" border="0" cellspacing="0" cellpadding="2" align="center">
    <form enctype="multipart/form-data" action="upload.php" method="post">
      <tr>
        <td class="headers"><b>{$umLabel.up_information_text}</b></td>
      </tr>
      <tr>
        <td class="default" align="left"><input type="file" name="userfile"  size="22" style="width: 300;"></td>
      </tr>
      <tr>
        <td class="default" align="center"><input type="submit" value="{$umLabel.up_button_text}" name="submit" class="button"></td>
      </tr>
    </form>
  </table>
</div>
</body>
</html>