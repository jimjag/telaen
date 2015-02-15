{include file=$popupHeaderTemplate pageTitle=#ctc_title# }

<body>
<div id="popup">
  <form name="form1" action="catch.php" method="post">
    <input type="hidden" name="ix" value="{$smIx}" />
    <input type="hidden" name="folder" value="{$smFolder|escape:"html"}" />
    <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
      <tr>
        <td class="default" width="100%" colspan="2" align="center"><b>{$smLabel.ctc_information}</b><br />
          <br /></td>
      </tr>
      {if $smAvailableAddresses gt 0 }
      <tr>
        <td class="headersLeft" width="50%">&nbsp;.: <b>{$smLabel.ctc_name}</b> :.</td>
        <td class="headersLeft">.: <b>{$smLabel.ctc_email}</b> :.</td>
      </tr>
      {section name=i loop=$smAddressList}
      <tr>
        <td class="default" valign="top"><input type="checkbox" name="ckaval[]" checked="checked" value="{$smAddressList[i].index}">
          {$smAddressList[i].name|truncate:30:"...":true|escape:"html"}</td>
        <td class="default">{$smAddressList[i].mail}</td>
      </tr>
      {/section}
      <tr>
        <td class="usage" colspan="2"><center>
            <table class="buttonTable" cellspacing="0" align="center">
              <tr>
                <td valign="middle" class="buttonLeft">&nbsp;</td>
                <td valign="middle" class="buttonMiddle"><input type="submit" name="submit" class="button" value="{$smLabel.ctc_save}" /></td>
                <td valign="middle" class="buttonRight">&nbsp;</td>
              </tr>
            </table>
          </center></td>
      </tr>
      {else}
      <tr>
        <td class="cent">{$smLabel.ctc_no_address}</td>
      </tr>
      <tr>
        <td class="usage"><center>
            <table class="buttonTable" cellspacing="0" aling="center">
              <tr>
                <td valign="middle" class="buttonLeft">&nbsp;</td>
                <td valign="middle" class="buttonMiddle"><input type="button" name="submit" class="button" value="{$smLabel.ctc_close}" onClick="self.close()" /></td>
                <td valign="middle" class="buttonRight">&nbsp;</td>
              </tr>
            </table>
          </center></td>
      </tr>
      {/if}
    </table>
  </form>
</div>
</body>
</html>