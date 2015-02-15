{include file=$popupHeaderTemplate pageTitle=#ctc_title# }

<body>
<div id="popup">
  <div id="logo"> <img src="inc/themes/default/images/telaen_logo.jpg" width="310" height="73" alt="logo"> </div>
  <form name="form1" action="catch.php" method="post">
    <input type="hidden" name="ix" value="{$smIx}">
    <input type="hidden" name="folder" value="{$smFolder|escape:"html"}">
    <table width="100%" border="0" cellspacing="0" cellpadding="2" align="center">
      <tr>
        <td class=default  width="100%" colspan="2" align=center><b>{$smLabel.ctc_information}</b><br>
          <br></td>
      </tr>
      {if $smAvailableAddresses gt 0 }
      <tr>
        <td class=headers width="60%"><b>{$smLabel.ctc_name}</b></td>
        <td class=headers><b>{$smLabel.ctc_email}</b></td>
      </tr>
      {section name=i loop=$smAddressList}
      <tr>
        <td class="default" valign="top"><input type="checkbox" name="ckaval[]" checked value={$smAddressList[i].index}>
          {$smAddressList[i].name|truncate:30:"...":true|escape:"html"}</td>
        <td class="default">{$smAddressList[i].mail}</td>
      </tr>
      {/section}
      <tr>
        <td class="cent" colspan="2"><br>
          <br>
          <input type="submit" name="submit" class="button" value="{$smLabel.ctc_save}"></td>
      </tr>
      {else}
      <tr>
        <td class="cent">{$smLabel.ctc_no_address}</td>
      </tr>
      <tr>
        <td class="cent"><br>
          <br>
          <a href="javascript:self.close()">{$smLabel.ctc_close}</a></td>
      </tr>
      {/if}
    </table>
  </form>
</div>
</body>
</html>
